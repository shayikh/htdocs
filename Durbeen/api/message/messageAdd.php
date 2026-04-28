<?php
include '../../connection.php';

header('Content-Type: application/json');
error_reporting(0); // hide warnings from breaking JSON

$response = [
	"unique_id_me" => "",
	"unique_id_fr" => "",
	"number" => "",
	"newMessage" => []
];

$content = $_POST["contentID"] ?? "";
$unique_id_me = $_POST["unique_id_me"] ?? "";
$unique_id_fr = $_POST["unique_id_fr"] ?? "";

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

date_default_timezone_set("Asia/Dhaka");
$time = date("d-M-Y-D-h:i:s a");

// ✅ Handle images safely
if (!empty($_FILES["images"]["name"][0])) {

    $uploadDir = "../../chat_image/";
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

        $table = ($unique_id_me < $unique_id_fr)
            ? "$unique_id_me to $unique_id_fr"
            : "$unique_id_fr to $unique_id_me";

        $stmt = $connection_message->prepare("INSERT INTO `$table` (sender, message, image, time, seen) VALUES (?, ?, ?, ?, ?)");

        if ($stmt) {
            $seen = "Unseen";
            $stmt->bind_param("sssss", $unique_id_me, $content, $fileName, $time, $seen);
            $stmt->execute();
        }
    }


    // ✅ Fetch latest posts
    $SQL4 = "SELECT * FROM `$table` ORDER BY id DESC LIMIT $count";
    $run4 = mysqli_query($connection_message, $SQL4);

    if ($run4) {
        while ($row = mysqli_fetch_assoc($run4)) {
            $response["newMessage"][] = $row;
        }
    }

	$response["number"] = "1";
	$response["unique_id_me"] = $unique_id_me;
	$response["unique_id_fr"] = $unique_id_fr;

	echo json_encode($response);
}else{
	$imageNewName = '';

	if($unique_id_me < $unique_id_fr){
		$SQL1 = "INSERT INTO `$unique_id_me to $unique_id_fr`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('$unique_id_me','$content','$imageNewName','$time','Unseen')";
	}else{
		$SQL1 = "INSERT INTO `$unique_id_fr to $unique_id_me`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('$unique_id_me','$content','$imageNewName','$time','Unseen')";
	}
	mysqli_query($connection_message, $SQL1);

	


	if($unique_id_me < $unique_id_fr){
	$SQL4 = "SELECT * FROM `$unique_id_me to $unique_id_fr` ORDER BY `id` DESC LIMIT 1";
	}else{
	$SQL4 = "SELECT * FROM `$unique_id_fr to $unique_id_me` ORDER BY `id` DESC LIMIT 1";
	}
	$run4 = mysqli_query($connection_message, $SQL4);
	$newMessage = mysqli_fetch_assoc($run4);

	echo json_encode(["unique_id_me"=>$unique_id_me, "unique_id_fr"=>$unique_id_fr, "newMessage" => $newMessage, "number" => "0"]);
}




//notification sql
$SQL3 = "INSERT INTO `$unique_id_fr notify`(`sender`, `sender_id`, `seen`) VALUES ('$my_name','$unique_id_me','0')";
mysqli_query($connection_info, $SQL3);




$SQL54 = "SELECT * FROM `$unique_id_me chats` ORDER BY `id` DESC LIMIT 1";
$run54 = mysqli_query($connection_info, $SQL54);
$latestChating = mysqli_fetch_assoc($run54);

if (($latestChating['unique_id_fr'] != $unique_id_fr || $latestChating['chat_type'] != '3')) {
	$SQL34 = "DELETE FROM `$unique_id_me chats` WHERE `unique_id_fr`='$unique_id_fr' AND `chat_type`='3'";
	mysqli_query($connection_info, $SQL34);

	
	$SQL28 = "INSERT INTO `$unique_id_me chats`(`unique_id_fr`, `chat_type`) VALUES ('$unique_id_fr','3')";
	mysqli_query($connection_info, $SQL28);
}





$SQL54 = "SELECT * FROM `$unique_id_fr chats` ORDER BY `id` DESC LIMIT 1";
$run54 = mysqli_query($connection_info, $SQL54);
$latestChating = mysqli_fetch_assoc($run54);

if (($latestChating['unique_id_fr'] != $unique_id_me || $latestChating['chat_type'] != '3')) {
	$SQL44 = "DELETE FROM `$unique_id_fr chats` WHERE `unique_id_fr`='$unique_id_me' AND `chat_type`='3'";
	mysqli_query($connection_info, $SQL44);


	$SQL24 = "INSERT INTO `$unique_id_fr chats`(`unique_id_fr`, `chat_type`) VALUES ('$unique_id_me','3')";
	mysqli_query($connection_info, $SQL24);
}




exit;