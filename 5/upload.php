<?php
require "db.php";

$uploadDir = "uploads/";

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$content = $_POST["content"] ?? "";

/* insert post */
$stmt = $conn->prepare("INSERT INTO posts (content) VALUES (?)");
$stmt->bind_param("s", $content);
$stmt->execute();

$post_id = $stmt->insert_id;

/* images */
if (!empty($_FILES["images"]["name"][0])) {

    for ($i = 0; $i < count($_FILES["images"]["name"]); $i++) {

        $tmp = $_FILES["images"]["tmp_name"][$i];
        $name = $_FILES["images"]["name"][$i];

        if (!$tmp) continue;

        $ext = pathinfo($name, PATHINFO_EXTENSION);
        $fileName = uniqid() . "." . $ext;

        $path = $uploadDir . $fileName;

        move_uploaded_file($tmp, $path);

        $stmt2 = $conn->prepare("INSERT INTO post_images (post_id, image_path) VALUES (?, ?)");
        $stmt2->bind_param("is", $post_id, $path);
        $stmt2->execute();
    }
}

echo "OK";
?>