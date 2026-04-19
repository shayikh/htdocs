<?php
require "db.php";

$uploadDir = "uploads/";

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$content = $_POST["content"] ?? "";

/* 1. Insert text into posts table */
$stmt = $conn->prepare("INSERT INTO posts (content) VALUES (?)");
$stmt->bind_param("s", $content);
$stmt->execute();

$post_id = $stmt->insert_id;

/* 2. Insert multiple images into post_images table */
if (isset($_FILES["images"])) {

    $count = count($_FILES["images"]["name"]);

    for ($i = 0; $i < $count; $i++) {

        $tmp  = $_FILES["images"]["tmp_name"][$i];
        $name = $_FILES["images"]["name"][$i];

        $ext = pathinfo($name, PATHINFO_EXTENSION);
        $fileName = uniqid("img_", true) . "." . $ext;

        $path = $uploadDir . $fileName;

        move_uploaded_file($tmp, $path);

        $img = $conn->prepare("INSERT INTO post_images (post_id, image_path) VALUES (?, ?)");
        $img->bind_param("is", $post_id, $path);
        $img->execute();
    }
}

echo "Post uploaded successfully!";
?>