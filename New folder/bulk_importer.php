<?php
include 'connection.php';
set_time_limit(0);

$res = $conn->query("SELECT id, word FROM dictionary_queue WHERE status IN ('pending','failed') AND attempts < 5 LIMIT 20");

$save = $conn->prepare("INSERT INTO dictionary (word,bangla,phonetics,meanings,created_at,updated_at)
VALUES (?,?,?,?,NOW(),NOW())
ON DUPLICATE KEY UPDATE
bangla=VALUES(bangla),
phonetics=VALUES(phonetics),
meanings=VALUES(meanings),
updated_at=NOW()");

while ($row = $res->fetch_assoc()) {
    $id = (int)$row['id'];
    $word = $row['word'];

    try {
        $url = 'https://api.dictionaryapi.dev/api/v2/entries/en/' . urlencode($word);
        $raw = @file_get_contents($url);
        if (!$raw) throw new Exception('api failed');

        $data = json_decode($raw, true);
        if (!$data || isset($data['title'])) throw new Exception('not found');

        $meanings = json_encode($data[0]['meanings'] ?? [], JSON_UNESCAPED_UNICODE);
        $phonetics = json_encode($data[0]['phonetics'] ?? [], JSON_UNESCAPED_UNICODE);

        $t = 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=bn&dt=t&q=' . urlencode($word);
        $tr = json_decode(@file_get_contents($t), true);
        $bangla = $tr[0][0][0] ?? '';

        $save->bind_param('ssss', $word, $bangla, $phonetics, $meanings);
        $save->execute();

        $done = $conn->prepare("UPDATE dictionary_queue SET status='done', attempts=attempts+1, last_error=NULL WHERE id=?");
        $done->bind_param('i', $id);
        $done->execute();

    } catch (Exception $e) {
        $msg = $e->getMessage();
        $fail = $conn->prepare("UPDATE dictionary_queue SET status='failed', attempts=attempts+1, last_error=? WHERE id=?");
        $fail->bind_param('si', $msg, $id);
        $fail->execute();
    }

    sleep(1);
}