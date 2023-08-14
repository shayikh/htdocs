<?php
include '../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);

$post_id = $data['post_id'];
$unique_id_me = $data['unique_id_me'];



$SQL1 = "SELECT * FROM `post` WHERE `id`='$post_id'";
$run1 = mysqli_query($connection,$SQL1);
$data1 = mysqli_fetch_assoc($run1);

$post = $data1['post'];
$image = $data1['image'];

date_default_timezone_set("Asia/Dhaka");
$time = "The time in " . date_default_timezone_get() . " is " . date("d-M-Y-D-H:i:s");



$SQL2 = "INSERT INTO `post`(`unique_id`, `image`, `time`, `post`) VALUES ('$unique_id_me','$image','$time','$post')";
mysqli_query($connection,$SQL2);



echo '1';







