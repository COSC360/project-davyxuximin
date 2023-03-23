<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();
include "main.php";

if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    die("No form data submitted.");
}

if (isset($_POST['text'])) {
    $userId = $_SESSION['user_id'];
    $userName = ''; // Retrieve the username from the users table
    $questTitle = "Untitled"; // You can set a default value for the questtitle here
    $questContent = $_POST['text'];
    $questImage = null;
    $hasImage = false;

    echo "Form data submitted.<br>";

    // Get the username from the users table
    $sql = "SELECT username FROM users WHERE userid = ?";
    $stmt = mysqli_prepare($connection, $sql);
    if (!$stmt) {
        die("Error preparing statement: " . mysqli_error($connection));
    }

    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $userName);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $questImage = file_get_contents($_FILES['image']['tmp_name']);
        $hasImage = true;
    }

    $sql = "INSERT INTO questions (userid, username, questtitle, questcontent, questimage) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $sql);
    
    if (!$stmt) {
        die("Error preparing statement: " . mysqli_error($connection));
    }

    $null = NULL;
    mysqli_stmt_bind_param($stmt, "isssb", $userId, $userName, $questTitle, $questContent, $null);
    

if ($hasImage) {
    mysqli_stmt_send_long_data($stmt, 4, $questImage);
}

if (mysqli_stmt_execute($stmt)) {
    header("Location: Knowwell.php");
    exit();
} else {
    echo "Failed to post the question: " . mysqli_stmt_error($stmt);
}


    mysqli_stmt_close($stmt);
}

mysqli_close($connection);
?>
