<?php

header("Content-Type: application/json");

$q = $_GET['q'] ?? '';
$q = strtolower(trim($q));

$file = "dictionary.json";
$data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

$suggestions = [];

foreach ($data as $word => $value) {
    if (strpos($word, $q) === 0) {
        $suggestions[] = $word;
    }

    if (count($suggestions) >= 10) break;
}

echo json_encode($suggestions);