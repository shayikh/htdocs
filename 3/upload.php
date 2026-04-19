<?php
$conn = new mysqli("localhost", "root", "", "test");

if ($conn->connect_error) {
    die("DB connection failed");
}

$uploadDir = "uploads/";

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$content = $_POST["content"] ?? "";

if (isset($_FILES["images"])) {

    $count = count($_FILES["images"]["name"]);

    for ($i = 0; $i < $count; $i++) {

        $tmp  = $_FILES["images"]["tmp_name"][$i];
        $name = $_FILES["images"]["name"][$i];

        $ext = pathinfo($name, PATHINFO_EXTENSION);
        $fileName = uniqid("img_", true) . "." . $ext;

        $path = $uploadDir . $fileName;

        move_uploaded_file($tmp, $path);

        // SAME TEXT, MULTIPLE IMAGE ROWS
        $stmt = $conn->prepare("INSERT INTO posts (content, image_path) VALUES (?, ?)");
        $stmt->bind_param("ss", $content, $path);
        $stmt->execute();
    }

    echo "Post uploaded successfully!";
} else {
    echo "No images uploaded";
}
?>