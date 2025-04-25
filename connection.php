<?php
// Database connection
$servername = "127.0.0.1";
$username = "u182879714_Inpravia_db";
$password = "Inp_db@123";  //  your DB password
$dbname = "u182879714_inpravia_db";  // your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
