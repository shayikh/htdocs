<?php
include '../../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);


$unique_id_me = $data['unique_id_me'];
$unique_id_fr = $data['unique_id_fr'];



    
$SQL9 = "SELECT * FROM `$unique_id_me to $unique_id_fr`";
$run9 = mysqli_query($connection_message, $SQL9);

if ($run9 == true) {
    while ($data9 = mysqli_fetch_assoc($run9)) {
        $imgNameinDB = $data9['image'];
        if ($imgNameinDB != '') {
            unlink('../../chat_image/' . $imgNameinDB);
        }
    }
}

$SQL10 = "DROP TABLE IF EXISTS `$unique_id_me to $unique_id_fr`";
mysqli_query($connection_message, $SQL10);

$SQL11 = "SELECT * FROM `$unique_id_fr to $unique_id_me`";
$run11 = mysqli_query($connection_message, $SQL11);

if ($run11 == true) {
    while ($data11 = mysqli_fetch_assoc($run11)) {
        $imgNameinDB = $data11['image'];
        if ($imgNameinDB != '') {
            unlink('../../chat_image/' . $imgNameinDB);
        }
    }
}


$SQL12 = "DROP TABLE IF EXISTS `$unique_id_fr to $unique_id_me`";
mysqli_query($connection_message, $SQL12);


$SQL13 = "DELETE FROM `$unique_id_me chats` WHERE `unique_id_fr`='$unique_id_fr'";
mysqli_query($connection_info, $SQL13);

$SQL14 = "DELETE FROM `$unique_id_fr chats` WHERE `unique_id_fr`='$unique_id_me'";
mysqli_query($connection_info, $SQL14);

$SQL15 = "DELETE FROM `$unique_id_me notify` WHERE `sender_id`='$unique_id_fr'";
mysqli_query($connection_info, $SQL15);

$SQL16 = "DELETE FROM `$unique_id_fr notify` WHERE `sender_id`='$unique_id_me'";
mysqli_query($connection_info, $SQL16);

















