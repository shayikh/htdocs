<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);



$unique_id_me = $data['unique_id_me'];
$post_id = $data['post_id'];







date_default_timezone_set("Asia/Dhaka");
$time = date_default_timezone_get().' time: '.date("d-M-Y-D-h:i:s a");

$imageNewName = '';

$message = "<a href='./singlePost.php?type&post_id=$post_id'>Click To See Post ($post_id)</a>";
$message = mysqli_real_escape_string($connection_message, $message);



$SQL1 = "INSERT INTO `$unique_id_me to $unique_id_me`(`message`, `image`, `time`) VALUES ('$message','$imageNewName','$time')";
mysqli_query($connection_message, $SQL1);




echo "1";







