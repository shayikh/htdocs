<?php

include "./files/connection.php";
header("Content-Type: application/json");

$q = strtolower(trim($_GET['q'] ?? ''));

$stmt = $conn->prepare("
    SELECT word 
    FROM dictionary 
    WHERE word LIKE CONCAT(?, '%') 
    LIMIT 10
");

$stmt->bind_param("s", $q);
$stmt->execute();

$res = $stmt->get_result();

$suggestions = [];

while ($row = $res->fetch_assoc()) {
    $suggestions[] = $row['word'];
}

echo json_encode($suggestions);