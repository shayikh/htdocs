<?php

header("Content-Type: application/json");

$word = $_GET['word'] ?? '';

if (!$word) {
    echo json_encode(["error" => "No word provided"]);
    exit;
}

$word = strtolower(trim($word));

$file = "dictionary.json";
$existing = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

/* =========================
   1. CHECK CACHE (NO EXPIRY)
========================= */
if (isset($existing[$word])) {

    $existing[$word]['source'] = "json";

    echo json_encode(
        $existing[$word],
        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
    );
    exit;
}

/* =========================
   2. FETCH FROM API
========================= */

$dictUrl = "https://api.dictionaryapi.dev/api/v2/entries/en/" . urlencode($word);
$dictResponse = @file_get_contents($dictUrl);
$dictData = json_decode($dictResponse, true);

if (!$dictResponse || isset($dictData['title'])) {
    echo json_encode(["error" => "Word not found"]);
    exit;
}

$englishMeanings = $dictData[0]['meanings'] ?? [];
$phonetics = $dictData[0]['phonetics'] ?? [];

/* Bangla translation */
$translateUrl = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=bn&dt=t&q=" . urlencode($word);

$translateResponse = @file_get_contents($translateUrl);
$translateData = json_decode($translateResponse, true);

$banglaWord = $translateData[0][0][0] ?? "";

/* =========================
   3. BUILD RESULT
========================= */
$result = [
    "word" => $word,
    "bangla" => $banglaWord,
    "phonetics" => $phonetics,
    "meanings" => $englishMeanings,
    "source" => "api"
];

/* =========================
   4. SAVE TO JSON
========================= */
$existing[$word] = $result;

file_put_contents(
    $file,
    json_encode($existing, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

/* =========================
   5. RETURN RESULT
========================= */
echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);