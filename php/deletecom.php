<?php
include "main.php";

if (isset($_POST['commentid'])) {
    $comid = $_POST['commentid'];
    $sql = "DELETE FROM comments WHERE commentid='" . $comid . "'";

    if (mysqli_query($connection, $sql)) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "Error deleting comment: " . mysqli_error($connection);
    }
    mysqli_close($connection);
}
?>
