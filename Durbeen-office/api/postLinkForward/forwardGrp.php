<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);



$unique_id_me = $data['unique_id_me'];
$grp_id = $data['grp_id'];
$post_id = $data['post_id'];


$SQLMe = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_me'";
$runMe = mysqli_query($connection, $SQLMe);
$dataMe = mysqli_fetch_assoc($runMe);

$EmailMe = $dataMe['email'];
$pro_pic_me = $dataMe['pro_pic'];
$my_name = $dataMe['name'];






date_default_timezone_set("Asia/Dhaka");
$time = date_default_timezone_get().' time: '.date("d-M-Y-D-h:i:s a");

$imageNewName = '';

$message = "<a href='./singlePost.php?type&post_id=$post_id'>Click To See Post ($post_id)</a>";
$message = mysqli_real_escape_string($connection_message, $message);



$SQL1 = "INSERT INTO `group $grp_id`(`senderName`, `senderId`, `senderProPic`, `message`, `image`, `time`) VALUES ('$my_name','$unique_id_me','$pro_pic_me','$message','$imageNewName','$time')";
mysqli_query($connection_message, $SQL1);




echo "1";







