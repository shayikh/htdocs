<?php
$conn = new mysqli("localhost", "root", "", "test");

if ($conn->connect_error) {
    die("DB failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>