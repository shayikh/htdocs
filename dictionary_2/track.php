<?php

$word = $_GET['word'] ?? '';
$word = strtolower(trim($word));

if (!$word) exit;

$file = "search_log.json";

$log = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

// increase count
$log[$word] = ($log[$word] ?? 0) + 1;

file_put_contents($file, json_encode($log, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo json_encode(["status" => "ok"]);