<?php
// Start the session and include the connection information
session_start();
include 'main.php';

// Get the question ID from the URL parameter
$questionid = $_POST['questionid'];

// Delete the corresponding row from the database
$sql = "DELETE FROM questions WHERE questionid='" . $questionid . "'";
if (mysqli_query($connection, $sql)) {
  header("location:Knowwell.php");
  exit();
} else {
  echo "Error deleting question: " . mysqli_error($connection);
}

// Close the database connection and redirect to the main page
mysqli_close($connection);

?>
