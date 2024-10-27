<?php
// Connect to the database
$conn = mysqli_connect('localhost', 'root', 'pass', 'laundry_db');

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get the updated text from the AJAX request
$updateText = $_POST['myTextbox1'];

// Update the database
$id = $_POST['price_id'];
$query = "UPDATE price SET prices = '$updateText' WHERE price_id = $id ";
$result = mysqli_query($conn, $query);

if ($result) {
  echo 'Data updated successfully!';
} else {
  echo 'Error updating data: ' . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>