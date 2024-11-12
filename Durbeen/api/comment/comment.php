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



$SQL1 = "SELECT * FROM `registration` WHERE `unique_id`='$comn_giver_id'";
$run1 = mysqli_query($connection, $SQL1);
$commenter = mysqli_fetch_assoc($run1);

$name = $commenter['name'];
$name = mysqli_real_escape_string($connection, $name);
$pro_pic = $commenter['pro_pic'];



date_default_timezone_set("Asia/Dhaka");
$time = date_default_timezone_get().' time: '.date("d-M-Y-D-h:i:s a");


$SQL2 = "INSERT INTO `comment`(`post_id`, `post_giver_id`, `comn_giver_id`, `name`, `pro_pic`, `time`, `comment`) VALUES ('$post_id','$post_giver_id','$comn_giver_id','$name','$pro_pic','$time','$comment')";
mysqli_query($connection, $SQL2);


echo "1";

















