<?php
// FunctionsTest.php

use PHPUnit\Framework\TestCase;

require 'Knowwell.php';

class FunctionsTest extends TestCase {

    protected function setUp(): void {
        // Set up a connection to a test database
        $this->connection = new mysqli("localhost", "root", "", "project");

        // Create a dummy user with a known image
        $sql = "INSERT INTO users (userid, userimage) VALUES (?, ?)";
        $stmt = mysqli_prepare($this->connection, $sql);
        $user_id = 1;
        $user_image = "C:\Users\ROG\Desktop\COSC360\project-davyxuximin\images\profile.jpg";
        
        mysqli_stmt_bind_param($stmt, "is", $user_id, $user_image);
        mysqli_stmt_execute($stmt);
        mysqli_begin_transaction($this->connection);

    }

    protected function tearDown(): void {
            // Delete the test user
    $sql = "DELETE FROM users WHERE userid=?";
    $stmt = mysqli_prepare($this->connection, $sql);
    mysqli_stmt_bind_param($stmt, "i", $this->user_id);
    mysqli_stmt_execute($stmt);
    mysqli_rollback($this->connection);
    // Close the database connection
    mysqli_close($this->connection);
    }

    public function testGetUserImage() {
        $user_image = getUserImage($this->connection, $this->user_id);
        $this->assertEquals($this->user_image, $user_image);
    }
}

?>