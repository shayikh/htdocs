<?php

include "./files/connection.php";

header("Content-Type: application/json; charset=UTF-8");

error_reporting(E_ALL);
ini_set('display_errors', 0);

function respond($data) {
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

$word = strtolower(trim($_GET['word'] ?? ''));

if (!$word) {
    respond(["error" => "No word provided"]);
}

/* =========================
   SEARCH LOG
========================= */
$stmt = $conn->prepare("SELECT count FROM search_log WHERE word = ?");
$stmt->bind_param("s", $word);
$stmt->execute();
$res = $stmt->get_result();

if ($row = $res->fetch_assoc()) {

    $stmt = $conn->prepare("
        UPDATE search_log 
        SET count = count + 1,
            last_searched = NOW()
        WHERE word = ?
    ");

    $stmt->bind_param("s", $word);
    $stmt->execute();

} else {

    $stmt = $conn->prepare("
        INSERT INTO search_log (word, count, last_searched)
        VALUES (?, 1, NOW())
    ");

    $stmt->bind_param("s", $word);
    $stmt->execute();
}

/* =========================
   SEARCH FROM MYSQL
========================= */
$stmt = $conn->prepare("SELECT * FROM dictionary WHERE word = ?");
$stmt->bind_param("s", $word);
$stmt->execute();

$res = $stmt->get_result();

if ($row = $res->fetch_assoc()) {

    respond([
        "word" => $row['word'],
        "bangla" => $row['bangla'],
        "phonetics" => json_decode($row['phonetics'], true),
        "meanings" => json_decode($row['meanings'], true),
        "source" => "mysql"
    ]);
}

/* =========================
   FETCH FROM API
========================= */
$dictUrl = "https://api.dictionaryapi.dev/api/v2/entries/en/" . urlencode($word);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $dictUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$dictResponse = curl_exec($ch);

curl_close($ch);

$dictData = json_decode($dictResponse, true);

if (!$dictData || isset($dictData['title'])) {
    respond(["error" => "Word not found"]);
}

$meanings = $dictData[0]['meanings'] ?? [];
$phonetics = $dictData[0]['phonetics'] ?? [];

/* =========================
   BANGLA TRANSLATION
========================= */
$translateUrl = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=bn&dt=t&q=" . urlencode($word);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $translateUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$translateResponse = curl_exec($ch);

curl_close($ch);

$translateData = json_decode($translateResponse, true);

$bangla = $translateData[0][0][0] ?? "";

/* =========================
   SAVE TO MYSQL
========================= */
$stmt = $conn->prepare("
    INSERT INTO dictionary (word, bangla, phonetics, meanings)
    VALUES (?, ?, ?, ?)
    ON DUPLICATE KEY UPDATE
        bangla = VALUES(bangla),
        phonetics = VALUES(phonetics),
        meanings = VALUES(meanings)
");

$phoneticsJson = json_encode($phonetics, JSON_UNESCAPED_UNICODE);
$meaningsJson = json_encode($meanings, JSON_UNESCAPED_UNICODE);

$stmt->bind_param("ssss", $word, $bangla, $phoneticsJson, $meaningsJson);

$stmt->execute();

/* =========================
   LOAD EXISTING DATA
========================= */
$data = [];

$jsonFile = "./files/dictionary.json";
$jsFile = "./files/dictionary-data.js";

/* Load dictionary.json */
if (file_exists($jsonFile)) {

    $existingJson = json_decode(file_get_contents($jsonFile), true);

    if (is_array($existingJson)) {
        $data = $existingJson;
    }
}

/* Update word */
$data[$word] = [
    "word" => $word,
    "bangla" => $bangla,
    "phonetics" => $phonetics,
    "meanings" => $meanings
];

/* =========================
   SAVE dictionary.json
========================= */
file_put_contents(
    $jsonFile,
    json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
);

/* =========================
   SAVE dictionary-data.js
========================= */
file_put_contents(
    $jsFile,
    "window.dictionaryData = " .
    json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) .
    ";"
);

/* =========================
   FINAL RESPONSE
========================= */
respond([
    "word" => $word,
    "bangla" => $bangla,
    "phonetics" => $phonetics,
    "meanings" => $meanings,
    "source" => "api"
]);