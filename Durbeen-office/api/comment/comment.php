<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);





$comment = $data['comment'];
$comment = mysqli_real_escape_string($connection, $comment);
$post_id = $data['post_id'];
$post_giver_id = $data['post_giver_id'];
$comn_giver_id = $data['comn_giver_id'];




date_default_timezone_set("Asia/Dhaka");
$time = date_default_timezone_get().' time: '.date("d-M-Y-D-h:i:s a");


$SQL2 = "INSERT INTO `comment`(`post_id`, `post_giver_id`, `comn_giver_id`, `time`, `comment`) VALUES ('$post_id','$post_giver_id','$comn_giver_id','$time','$comment')";
mysqli_query($connection, $SQL2);


echo "1";

















