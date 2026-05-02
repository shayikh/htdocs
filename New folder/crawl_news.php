<?php
include 'connection.php';
$sites = [
    'https://www.reuters.com/world/',
    'https://www.bbc.com/news',
    'https://www.theguardian.com/world'
];

function fetchHtml($url) {
    $ctx = stream_context_create([
        'http' => [
            'header' => "User-Agent: Mozilla/5.0\r\n",
            'timeout' => 10
        ]
    ]);
    return @file_get_contents($url, false, $ctx);
}

function extractLinks($html, $base) {
    preg_match_all('/href="([^"]+)"/i', $html, $m);
    $out = [];
    foreach ($m[1] as $u) {
        if (strpos($u, 'http') !== 0) {
            $u = rtrim($base,'/') . '/' . ltrim($u,'/');
        }
        if (strpos($u,'reuters.com') || strpos($u,'bbc.com') || strpos($u,'theguardian.com')) {
            $out[] = $u;
        }
    }
    return array_unique($out);
}

function extractWords($html) {
    $text = strtolower(strip_tags($html));
    preg_match_all('/[a-z]{3,}/', $text, $m);
    return array_unique($m[0]);
}

$queue = $conn->prepare('INSERT IGNORE INTO dictionary_queue (word) VALUES (?)');
$seen = $conn->query('SELECT word FROM dictionary');
$known = [];
while ($r = $seen->fetch_assoc()) $known[$r['word']] = true;

foreach ($sites as $site) {
    $html = fetchHtml($site);
    if (!$html) continue;

    $links = array_slice(extractLinks($html, $site), 0, 6);

    foreach ($links as $url) {
        $hash = md5($url);
        $exists = $conn->prepare('SELECT id FROM crawled_urls WHERE url_hash=?');
        $exists->bind_param('s', $hash);
        $exists->execute();
        if ($exists->get_result()->num_rows) continue;

        $article = fetchHtml($url);
        if (!$article) continue;

        $ins = $conn->prepare('INSERT INTO crawled_urls (url, url_hash) VALUES (?, ?)');
        $ins->bind_param('ss', $url, $hash);
        $ins->execute();

        foreach (extractWords($article) as $word) {
            if (!isset($known[$word])) {
                $queue->bind_param('s', $word);
                $queue->execute();
                $known[$word] = true;
            }
        }

        sleep(1);
    }
}