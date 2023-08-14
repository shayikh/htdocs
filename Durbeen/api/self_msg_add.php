<?php
include '../connection.php';



date_default_timezone_set("Asia/Dhaka");
$time = date_default_timezone_get().' time: '.date("d-M-Y-D-H:i:s");

if($_FILES['image_khan_bahadur']['name']){
  $imageOldName = $_FILES['image_khan_bahadur']['name'];
  $imageNewName = uniqid().'_'.date("Y-M-H-i-s").'_'.$imageOldName;
  $image_tmp = $_FILES['image_khan_bahadur']['tmp_name'];
  move_uploaded_file($image_tmp,'../chat_image/'.$imageNewName);
}else{
  $imageNewName = '';
}




$message = $_POST['message'];
$message = mysqli_real_escape_string($connection_message, $message);
$unique_id_me = $_POST['unique_id_me'];



$SQL2 = "INSERT INTO `$unique_id_me to $unique_id_me`(`message`, `image`, `time`) VALUES ('$message','$imageNewName','$time')";
mysqli_query($connection_message, $SQL2);







$SQL = "SELECT * FROM `$unique_id_me to $unique_id_me` ORDER BY `id` DESC LIMIT 1";
$run = mysqli_query($connection_message, $SQL);
$latestData = mysqli_fetch_assoc($run);

echo json_encode(["unique_id_me"=>$unique_id_me, "newMessage" => $latestData]);

















