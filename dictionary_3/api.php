<?php

include "./files/connection.php";
header("Content-Type: application/json");

$word = strtolower(trim($_GET['word'] ?? ''));

if (!$word) {
    echo json_encode(["error" => "No word provided"]);
    exit;
}

$expiryDays = 7;

/* =========================
   TRACK SEARCH (MySQL)
========================= */
$stmt = $conn->prepare("
    INSERT INTO search_log (word, count, last_searched)
    VALUES (?, 1, NOW())
    ON DUPLICATE KEY UPDATE 
        count = count + 1,
        last_searched = NOW()
");
$stmt->bind_param("s", $word);
$stmt->execute();

/* =========================
   SEARCH ONLY IN MYSQL
========================= */
$stmt = $conn->prepare("SELECT * FROM dictionary WHERE word = ?");
$stmt->bind_param("s", $word);
$stmt->execute();
$res = $stmt->get_result();

if ($row = $res->fetch_assoc()) {

    $created = strtotime($row['created_at']);
    $now = time();

    if (($now - $created) < ($expiryDays * 86400)) {

        echo json_encode([
            "word" => $row['word'],
            "bangla" => $row['bangla'],
            "phonetics" => json_decode($row['phonetics'], true),
            "meanings" => json_decode($row['meanings'], true),
            "source" => "mysql"
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        exit;
    }
}

/* =========================
   FETCH FROM API (fallback)
========================= */

$dictUrl = "https://api.dictionaryapi.dev/api/v2/entries/en/" . urlencode($word);
$dictResponse = @file_get_contents($dictUrl);
$dictData = json_decode($dictResponse, true);

if (!$dictResponse || isset($dictData['title'])) {
    echo json_encode(["error" => "Word not found"]);
    exit;
}

$meanings = $dictData[0]['meanings'] ?? [];
$phonetics = $dictData[0]['phonetics'] ?? [];

/* =========================
   BANGLA TRANSLATION
========================= */
$translateUrl = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=bn&dt=t&q=" . urlencode($word);
$translateResponse = @file_get_contents($translateUrl);
$translateData = json_decode($translateResponse, true);

$bangla = $translateData[0][0][0] ?? "";

/* =========================
   SAVE MYSQL
========================= */
$stmt = $conn->prepare("
    INSERT INTO dictionary (word, bangla, phonetics, meanings, created_at)
    VALUES (?, ?, ?, ?, NOW())
    ON DUPLICATE KEY UPDATE
        bangla = VALUES(bangla),
        phonetics = VALUES(phonetics),
        meanings = VALUES(meanings),
        created_at = NOW()
");

$phoneticsJson = json_encode($phonetics, JSON_UNESCAPED_UNICODE);
$meaningsJson = json_encode($meanings, JSON_UNESCAPED_UNICODE);

$stmt->bind_param("ssss", $word, $bangla, $phoneticsJson, $meaningsJson);
$stmt->execute();

/* =========================
   SAVE JSON CACHE
========================= */
$file = "./files/dictionary.json";
$data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

$data[$word] = [
    "word" => $word,
    "bangla" => $bangla,
    "phonetics" => $phonetics,
    "meanings" => $meanings,
    "created_at" => date("Y-m-d H:i:s")
];

file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

/* =========================
   OUTPUT
========================= */
echo json_encode([
    "word" => $word,
    "bangla" => $bangla,
    "phonetics" => $phonetics,
    "meanings" => $meanings,
    "source" => "api"
], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);