<?php
include "common/session.php";
?>

<?php
include 'connection.php';

$sql = "SELECT * FROM ignpl";
$result = $conn->query($sql);
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
      <h1>Downlaod</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">IGNPL</li>
          <li class="breadcrumb-item active">Downlaod</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Download Documents</h5>
          
          <!-- Responsive Wrapper -->
          <div class="table-responsive">
            <table id="download" class="table table-striped border">
              <thead>
                  <tr>
                      <th>S.No.</th>
                      <th>Documents Name</th>
                      <th>Upload Date</th>
                      <th>Upload Time</th>
                      <th>Note</th>
                      <th>Download</th>
                  </tr>
              </thead>
              <tbody>
              <?php
                if ($result->num_rows > 0) {
                    $serial = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$serial}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['upload_date']}</td>
                                <td>{$row['upload_time']}</td>
                                <td>{$row['note']}</td>
                                <td><a href='ignpl-download-backend.php?id={$row['id']}' class='btn btn-sm btn-primary'><i class='bi bi-arrow-down-circle'> Download</a></td>
                              </tr>";
                        $serial++;
                    }
                } else {
                    echo "<tr><td colspan='6'>No documents found.</td></tr>";
                }
                ?>
              </tbody>
              <tfoot>
                  <tr>
                      <th>S.No.</th>
                      <th>Documents Name</th>
                      <th>Upload Date</th>
                      <th>Upload Time</th>
                      <th>Note</th>
                      <th>Download</th>
                  </tr>
              </tfoot>
            </table>
          </div>
          
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