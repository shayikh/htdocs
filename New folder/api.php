<?php
include 'connection.php';
header('Content-Type: application/json');
$word = strtolower(trim($_GET['word'] ?? ''));
$stmt = $conn->prepare('SELECT word,bangla,phonetics,meanings FROM dictionary WHERE word=? LIMIT 1');
$stmt->bind_param('s', $word);
$stmt->execute();
$res = $stmt->get_result();
if ($row = $res->fetch_assoc()) {
    echo json_encode([
        'word' => $row['word'],
        'bangla' => $row['bangla'],
        'phonetics' => json_decode($row['phonetics'], true),
        'meanings' => json_decode($row['meanings'], true)
    ], JSON_UNESCAPED_UNICODE);
    exit;
}
echo json_encode(['error' => 'Word not found']);