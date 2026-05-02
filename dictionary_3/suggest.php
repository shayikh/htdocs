<?php

include "connection.php";
header("Content-Type: application/json");

$q = $_GET['q'] ?? '';
$q = strtolower(trim($q));

$stmt = $conn->prepare("
    SELECT word FROM dictionary 
    WHERE word LIKE CONCAT(?, '%') 
    LIMIT 10
");

$stmt->bind_param("s", $q);
$stmt->execute();

$result = $stmt->get_result();

$suggestions = [];

while ($row = $result->fetch_assoc()) {
    $suggestions[] = $row['word'];
}

echo json_encode($suggestions);