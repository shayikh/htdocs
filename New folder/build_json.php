<?php
include 'connection.php';
$res = $conn->query('SELECT word,bangla,phonetics,meanings,updated_at FROM dictionary ORDER BY word ASC');
$data = [];
while ($r = $res->fetch_assoc()) {
    $data[$r['word']] = [
        'word' => $r['word'],
        'bangla' => $r['bangla'],
        'phonetics' => json_decode($r['phonetics'], true),
        'meanings' => json_decode($r['meanings'], true),
        'updated_at' => $r['updated_at']
    ];
}
file_put_contents('dictionary.json', json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));