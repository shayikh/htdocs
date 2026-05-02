<?php

include "connection.php";
header("Content-Type: application/json");

$type = $_GET['type'] ?? 'today';

/* =========================
   TIME FILTER
========================= */
if ($type == "today") {
    $timeCondition = "DATE(last_searched) = CURDATE()";
} elseif ($type == "week") {
    $timeCondition = "last_searched >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
} else {
    $timeCondition = "last_searched >= DATE_SUB(NOW(), INTERVAL 30 DAY)";
}

/* =========================
   QUERY TOP WORDS
========================= */
$sql = "
SELECT word, SUM(count) as count
FROM search_log
WHERE $timeCondition
GROUP BY word
ORDER BY count DESC
LIMIT 10
";

$result = $conn->query($sql);

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);