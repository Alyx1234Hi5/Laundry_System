<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laundry_db";

$conn = mysqli_connect('localhost', 'root', '', 'laundry_db');

if($conn->connect_error) {
    die("Connection Error: " . $con->connect_error);

}
?>