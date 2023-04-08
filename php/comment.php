<?php
include "main.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (isset($_POST['commentcontent']) && isset($_POST['questionid']) && isset($_POST['userid'])) {
    $comment = $_POST['commentcontent'];
    $qid = $_POST['questionid'];
    $userid = $_POST['userid'];
    $commentDate = date("Y-m-d H:i:s");
    $sql = 'INSERT INTO comments (questionid, userid, commentcontent, commentdate) VALUES (?, ?, ?, ?)';
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "iiss", $qid, $userid, $comment, $commentDate);
    mysqli_stmt_execute($stmt);
    header("Location: detail.php?id=" . $qid);
    exit();
}
?>
