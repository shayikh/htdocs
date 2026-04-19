<?php
require "db.php";

$sql = "
SELECT p.id, p.content, pi.image_path
FROM posts p
LEFT JOIN post_images pi ON p.id = pi.post_id
ORDER BY p.id DESC
";

$res = $conn->query($sql);

$posts = [];

while ($row = $res->fetch_assoc()) {

    $id = $row['id'];

    if (!isset($posts[$id])) {
        $posts[$id] = [
            "content" => $row['content'],
            "images" => []
        ];
    }

    if ($row['image_path']) {
        $posts[$id]["images"][] = $row['image_path'];
    }
}

echo json_encode(array_values($posts));
?>