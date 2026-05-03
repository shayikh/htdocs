<?php

include "./connection.php";
header('Content-Type: application/json');

$result = mysqli_query($conn, "SELECT * FROM dictionary ORDER BY id DESC");

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode([
    "status" => true,
    "count" => count($data),
    "data" => $data
], JSON_PRETTY_PRINT);
?>