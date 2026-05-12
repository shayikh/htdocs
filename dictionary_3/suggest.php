<?php

include "./files/connection.php";
header("Content-Type: application/json");

$q = strtolower(trim($_GET['q'] ?? ''));

if (!$q) {
    echo json_encode([]);
    exit;
}

$stmt = $conn->prepare("
    SELECT word 
    FROM dictionary 
    WHERE word LIKE CONCAT(?, '%') 
    ORDER BY word ASC 
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