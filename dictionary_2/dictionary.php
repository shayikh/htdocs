<?php
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);
$word = strtolower(trim($data["word"]));

$file = "dictionary.json";

// Load existing dictionary
if (file_exists($file)) {
    $dictionary = json_decode(file_get_contents($file), true);
} else {
    $dictionary = [];
}

// ✅ If already cached
if (isset($dictionary[$word])) {
    echo json_encode([
        "source" => "cache",
        "data" => $dictionary[$word]
    ]);
    exit;
}

// ❗ Fetch from API (example API endpoint)
$apiUrl = "https://api.dictionaryapi.dev/api/v2/entries/en/" . urlencode($word);

$response = file_get_contents($apiUrl);

if ($response === FALSE) {
    echo json_encode(["error" => "Word not found"]);
    exit;
}

$apiData = json_decode($response, true);

// Extract useful info
$result = [
    "word" => $word,
    "meaning" => $apiData[0]["meanings"][0]["definitions"][0]["definition"] ?? "N/A",
    "phonetic" => $apiData[0]["phonetic"] ?? "",
    "source" => "api"
];

// Store in JSON file
$dictionary[$word] = $result;

file_put_contents($file, json_encode($dictionary, JSON_PRETTY_PRINT));

// Return result
echo json_encode([
    "source" => "api",
    "data" => $result
]);
?>