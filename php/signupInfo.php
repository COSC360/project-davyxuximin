<?php
include "main.php";

if ($error != null) {
    $output = "<p>Unable to connect to database!</p >";
    exit($output);
} else {
    if (isset($_POST['submit'])) {
        $userName = $connection->real_escape_string($_POST['name']);
        $email = $connection->real_escape_string($_POST['email']);
        $password = $connection->real_escape_string($_POST['password']);
        $password2 = $connection->real_escape_string($_POST['password2']);
        $address = $connection->real_escape_string($_POST['address']);
        $phone_number = $connection->real_escape_string($_POST['phone_number']);
        $gender = $connection->real_escape_string($_POST['gender']);
        $school = $connection->real_escape_string($_POST['school']);
        
        $userImage = file_get_contents($_FILES['image']['tmp_name']);


        $stmt = $connection->prepare("INSERT INTO users (username, email, password, userimage, address, phone, sex, school)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssbssss", $userName, $email, $password, $userImage, $address, $phone_number, $gender, $school);
    $stmt->send_long_data(3, $userImage);
        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }




}

?>