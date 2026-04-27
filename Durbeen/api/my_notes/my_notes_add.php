<?php
include '../../connection.php';

header('Content-Type: application/json');
error_reporting(0); // hide warnings from breaking JSON

$response = [
  "unique_id_me" => "",
  "newPost" => []
];

$content = $_POST["contentID"] ?? "";
$unique_id_me = $_POST["unique_id_me"] ?? "";

// ✅ Validate DB
if (!$connection || !$connection_message || !$connection_info) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

// ✅ Escape safely
$content = mysqli_real_escape_string($connection_message, $content);


date_default_timezone_set("Asia/Dhaka");
$time = date("d-M-Y-D-h:i:s a");

// ✅ Handle images safely
if (!empty($_FILES["images"]["name"][0])) {

    $uploadDir = "../../note_image/";
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $count = count($_FILES["images"]["name"]);

    for ($i = 0; $i < $count; $i++) {

        $tmp  = $_FILES["images"]["tmp_name"][$i];
        $name = $_FILES["images"]["name"][$i];

        if (!$tmp) continue;

        $extension = pathinfo($name, PATHINFO_EXTENSION);
        $fileName = uniqid().'_'.time().'.'.$extension;
        $path = $uploadDir . $fileName;

        move_uploaded_file($tmp, $path);

        $table = "$unique_id_me to $unique_id_me";

        $stmt = $connection_message->prepare("INSERT INTO `$table` (message, image, time) VALUES (?, ?, ?)");

        if ($stmt) {
            $stmt->bind_param("sss", $content, $fileName, $time);
            $stmt->execute();
        }
    }



    // ✅ Fetch latest posts
    $SQL4 = "SELECT * FROM `$table` ORDER BY id DESC LIMIT $count";
    $run4 = mysqli_query($connection_message, $SQL4);

    if ($run4) {
        while ($row = mysqli_fetch_assoc($run4)) {
            $response["newPost"][] = $row;
        }
    }
}

$response["unique_id_me"] = $unique_id_me;

echo json_encode($response);
exit;