<?php
include '../../connection.php';



date_default_timezone_set("Asia/Dhaka");
$time = date_default_timezone_get().' time: '.date("d-M-Y-D-h:i:s a");

if($_FILES['image_khan_bahadur']['name']){
  $imageOldName = $_FILES['image_khan_bahadur']['name'];
  $imageNewName = uniqid().'_'.date("Y-M-H-i-s").'_'.$imageOldName;
  $image_tmp = $_FILES['image_khan_bahadur']['tmp_name'];
  move_uploaded_file($image_tmp,'../../chat_image/'.$imageNewName);
}else{
  $imageNewName = '';
}




$message = $_POST['message'];
$message = mysqli_real_escape_string($connection_message, $message);

$my_name = $_POST['my_name'];
$my_name = mysqli_real_escape_string($con_notification, $my_name);

$unique_id_me = $_POST['unique_id_me'];
$unique_id_fr = $_POST['unique_id_fr'];



$SQL1 = "INSERT INTO `$unique_id_me to $unique_id_fr`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('me','$message','$imageNewName','$time','Unseen')";
mysqli_query($connection_message, $SQL1);

$SQL2 = "INSERT INTO `$unique_id_fr to $unique_id_me`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('fr','$message','$imageNewName','$time','Unseen')";
mysqli_query($connection_message, $SQL2);



//notification sql

$SQL3 = "INSERT INTO `$unique_id_fr notify`(`sender`, `sender_id`, `seen`) VALUES ('$my_name','$unique_id_me','0')";
mysqli_query($con_notification, $SQL3);






$SQL4 = "SELECT * FROM `$unique_id_me to $unique_id_fr` ORDER BY `id` DESC LIMIT 1";
$run4 = mysqli_query($connection_message, $SQL4);
$latestData = mysqli_fetch_assoc($run4);

echo json_encode(["unique_id_me"=>$unique_id_me, "unique_id_fr"=>$unique_id_fr, "newMessage" => $latestData]);

















