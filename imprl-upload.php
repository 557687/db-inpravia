<?php
include "common/session.php";
?>
<!DOCTYPE html>
<html lang="en">

<?php include "common/head.php"; ?>

<body>

   <!-- ======= Header ======= -->
   <?php include "common/top-header.php"; ?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php include "common/sidebar.php"; ?>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Upload</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">IMPRL</li>
          <li class="breadcrumb-item active">Upload</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Upload Docuemnts</h5>
              <!-- alert -->
              <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <i class="bi bi-check-circle me-1"></i>
                  Document uploaded successfully.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endif; ?>
              <!-- General Form Elements -->
              <form method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">File Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" oninput="this.value = this.value.toUpperCase();" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                  <div class="col-sm-10">
                    <input class="form-control" name="file"  type="file" id="formFile" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-2 col-form-label">Date</label>
                  <div class="col-sm-10">
                    <input type="date" name="date" class="form-control" id="currentDate" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputTime" class="col-sm-2 col-form-label">Time</label>
                  <div class="col-sm-10">
                    <input type="time" name="time" class="form-control" id="currentTime" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Note</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" name="note" style="height: 100px"></textarea>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Upload</button>
                  </div>
                </div>

              </form><!-- End General Form Elements -->
            </div>
          </div>

        </div>

        
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include "common/footer.php"; ?>

</body>

</html>

<!-- ================================================= Uploading Docuemnts ================================================== -->
<?php
// Database connection
require "connection.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $date = $conn->real_escape_string($_POST['date']);
    $time = $conn->real_escape_string($_POST['time']);
    $note = $conn->real_escape_string($_POST['note']);

    // Check if file is uploaded without errors
    if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES["file"]["name"]);
        $filePath = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        // Allowed file types
        $allowedTypes = array("pdf", "doc", "docx", "jpg", "jpeg", "png", "xls", "xlsx");

        if (in_array($fileType, $allowedTypes)) {
            // Ensure uploads directory exists
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }

            // Move the uploaded file to uploads folder
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)) {
                // Insert file data into the database
                $sql = "INSERT INTO imprl (name, file_path, upload_date, upload_time, note)
                        VALUES ('$name', '$filePath', '$date', '$time', '$note')";

                if ($conn->query($sql) === TRUE) {
                  echo "<script>window.location.href='imprl-upload.php?success=1';</script>";
                  exit();
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Error uploading the file.";
            }
        } else {
            echo "Invalid file type. Allowed types: PDF, DOC, DOCX, JPG, PNG.";
        }
    } else {
        echo "No file uploaded or upload error.";
    }
}

$conn->close();
?>

<!-- JavaScript to Auto-fill Date and Time -->
<script>
    window.onload = function() {
        // Get current date and time
        const now = new Date();

        // Format date to YYYY-MM-DD
        const formattedDate = now.toISOString().split('T')[0];

        // Format time to HH:MM (24-hour format)
        const formattedTime = now.toTimeString().split(' ')[0].slice(0, 5);

        // Set the values in the input fields
        document.getElementById('currentDate').value = formattedDate;
        document.getElementById('currentTime').value = formattedTime;
    }
</script>
