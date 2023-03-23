<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "main.php";

if (isset($_GET['id'])) {
    $question_id = intval($_GET['id']);
    $sql = "SELECT questimage FROM questions WHERE questionid = ?";
    
    if ($stmt = mysqli_prepare($connection, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $question_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $image_data);
        
        if (mysqli_stmt_fetch($stmt)) {
            if ($image_data !== null) {
                header("Content-Type: image/jpeg");
                echo $image_data;
            } else {
                header("HTTP/1.1 404 Not Found");
                echo "Image data is NULL.";
            }
        } else {
            header("HTTP/1.1 404 Not Found");
            echo "Image not found.";
        }
        
        mysqli_stmt_close($stmt);
    } else {
        header("HTTP/1.1 500 Internal Server Error");
        echo "Error preparing statement: " . mysqli_error($connection);
    }
} else {
    header("HTTP/1.1 400 Bad Request");
    echo "Invalid request. No ID specified.";
}

mysqli_close($connection);
?>
