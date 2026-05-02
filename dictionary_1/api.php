<?php

header("Content-Type: application/json");

$word = $_GET['word'] ?? '';
if (!$word) {
    echo json_encode(["error" => "No word provided"]);
    exit;
}

$word = strtolower(trim($word));

$file = "dictionary.json";
$logFile = "search_log.json";

$existing = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

/* =========================
   SEARCH TRACKING
========================= */
$log = file_exists($logFile) ? json_decode(file_get_contents($logFile), true) : [];
$log[$word] = ($log[$word] ?? 0) + 1;
file_put_contents($logFile, json_encode($log, JSON_PRETTY_PRINT));

/* =========================
   CACHE EXPIRY SETTINGS
========================= */
$expiryDays = 7;

/* =========================
   CHECK JSON CACHE
========================= */
if (isset($existing[$word])) {

    $created = strtotime($existing[$word]['created_at'] ?? '2000-01-01');
    $now = time();

    if (($now - $created) < ($expiryDays * 86400)) {
        $result = $existing[$word];
        $result['source'] = "json";
        echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        exit;
    }

    // expired → continue to API refresh
}

/* =========================
   FETCH FROM API
========================= */

// English
$dictUrl = "https://api.dictionaryapi.dev/api/v2/entries/en/" . urlencode($word);
$dictResponse = @file_get_contents($dictUrl);
$dictData = json_decode($dictResponse, true);

if (!$dictResponse || isset($dictData['title'])) {
    echo json_encode(["error" => "Word not found"]);
    exit;
}

$meanings = $dictData[0]['meanings'] ?? [];
$phonetics = $dictData[0]['phonetics'] ?? [];

// Bangla
$translateUrl = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=bn&dt=t&q=" . urlencode($word);
$translateResponse = @file_get_contents($translateUrl);
$translateData = json_decode($translateResponse, true);

$bangla = $translateData[0][0][0] ?? "";

/* =========================
   BUILD RESULT
========================= */
$result = [
    "word" => $word,
    "bangla" => $bangla,
    "phonetics" => $phonetics,
    "meanings" => $meanings,
    "created_at" => date("Y-m-d H:i:s"),
    "source" => "api"
];

/* =========================
   SAVE (without source)
========================= */
$save = $result;
unset($save['source']);

$existing[$word] = $save;

file_put_contents($file, json_encode($existing, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);