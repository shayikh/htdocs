<?php

include '../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);


$unique_id_me = $data['unique_id_me'];
$comment = $data['comment'];
$comment = mysqli_real_escape_string($connection, $comment);
$postid = $data['postid'];
$post_user_id = $data['post_user_id'];


$SQL1 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_me'";
$run1 = mysqli_query($connection, $SQL1);
$commenter = mysqli_fetch_assoc($run1);

$name = $commenter['name'];
$name = mysqli_real_escape_string($connection, $name);
$pro_pic = $commenter['pro_pic'];



date_default_timezone_set("Asia/Dhaka");
$time = date_default_timezone_get().' time: '.date("d-M-Y-D-H:i:s");


$SQL3 = "INSERT INTO `comment`(`unique_id`, `post_id`, `unique_id_comn`, `name_comn`, `pro_pic_comn`, `time`, `comment`) VALUES ('$post_user_id','$postid','$unique_id_me','$name','$pro_pic','$time','$comment')";
mysqli_query($connection, $SQL3);


echo "1";

















