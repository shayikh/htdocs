<?php
include '../../connection.php';

header('Content-Type: application/json');
error_reporting(0); // hide warnings from breaking JSON

$response = [
    "grp_id" => "",
    "number" => "",
    "newMessage" => []
];

$content = $_POST["contentID"] ?? "";
$unique_id_me = $_POST["unique_id_me"] ?? "";
$grp_id = $_POST["grp_id"] ?? "";

// ✅ Validate DB
if (!$connection || !$connection_message || !$connection_info) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

// ✅ Escape safely
$content = mysqli_real_escape_string($connection_message, $content);

// ✅ Get user
$SQLMe = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_me'";
$runMe = mysqli_query($connection, $SQLMe);

if (!$runMe) {
    echo json_encode(["error" => "Query failed"]);
    exit;
}

$dataMe = mysqli_fetch_assoc($runMe);
$my_name = $dataMe['name'] ?? '';
$my_name = mysqli_real_escape_string($connection_message, $my_name);
$myProPic = $dataMe['pro_pic'];


date_default_timezone_set("Asia/Dhaka");
$time = date("d-M-Y-D-h:i:s a");

// ✅ Handle images safely
if (!empty($_FILES["images"]["name"][0])) {

    $uploadDir = "../../grp_image/";
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

        $stmt = $connection_message->prepare("INSERT INTO `group $grp_id` (senderName, senderId, senderProPic, message, image, time) VALUES (?, ?, ?, ?, ?, ?)");

        if ($stmt) {
            $stmt->bind_param("ssssss", $my_name, $unique_id_me, $myProPic, $content, $fileName, $time);
            $stmt->execute();
        }
    }





    // ✅ Fetch latest posts
    $SQL4 = "SELECT * FROM `group $grp_id` ORDER BY id DESC LIMIT $count";
    $run4 = mysqli_query($connection_message, $SQL4);

    if ($run4) {
        while ($row = mysqli_fetch_assoc($run4)) {
            $response["newMessage"][] = $row;
        }
    }

	$response["number"] = "1";
    $response["grp_id"] = $grp_id;

    echo json_encode($response);
}else{
    $imageNewName = '';

    $SQL1 = "INSERT INTO `group $grp_id`(`senderName`, `senderId`, `senderProPic`, `message`, `image`, `time`) VALUES ('$my_name','$unique_id_me','$myProPic','$content','$imageNewName','$time')";
    mysqli_query($connection_message, $SQL1);


    $SQL4 = "SELECT * FROM `group $grp_id` ORDER BY `id` DESC LIMIT 1";
    $run4 = mysqli_query($connection_message, $SQL4);
    $newMessage = mysqli_fetch_assoc($run4);

    echo json_encode(["grp_id"=>$grp_id, "newMessage" => $newMessage, "number" => "0"]);
}






$SQL6 = "SELECT * FROM `group $grp_id members`";
$run6 = mysqli_query($connection_message, $SQL6);

while ($data6 = mysqli_fetch_assoc($run6)) {

    $memberId = $data6['memberId'];

    $SQL5 = "SELECT * FROM `$memberId chats` ORDER BY `id` DESC LIMIT 1";
    $run5 = mysqli_query($connection_info, $SQL5);
    $latestChating = mysqli_fetch_assoc($run5);

    if (($latestChating['unique_id_fr'] != $grp_id || $latestChating['chat_type'] != '2')) {
        $SQL3 = "DELETE FROM `$memberId chats` WHERE `unique_id_fr`='$grp_id' AND `chat_type`='2'";
        mysqli_query($connection_info, $SQL3);

        

        $SQL2 = "INSERT INTO `$memberId chats`(`unique_id_fr`, `chat_type`) VALUES ('$grp_id','2')";
        mysqli_query($connection_info, $SQL2);
    }

}













exit;