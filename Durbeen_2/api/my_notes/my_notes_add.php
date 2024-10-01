<?php
include '../../connection.php';



date_default_timezone_set("Asia/Dhaka");
$time = date_default_timezone_get().' time: '.date("d-M-Y-D-h:i:s a");

if($_FILES['image_khan_bahadur']['name']){
  $imageOldName = $_FILES['image_khan_bahadur']['name'];
  $extension = pathinfo($imageOldName, PATHINFO_EXTENSION);
  $imageNewName = uniqid().'_'.date("d_M_Y_D_h_i_s_a").'.'.$extension;
  $image_tmp = $_FILES['image_khan_bahadur']['tmp_name'];
  move_uploaded_file($image_tmp,'../../note_image/'.$imageNewName);
}else{
  $imageNewName = '';
}




$message = $_POST['message'];
$message = mysqli_real_escape_string($connection_message, $message);
$unique_id_me = $_POST['unique_id_me'];



$SQL1 = "INSERT INTO `$unique_id_me to $unique_id_me`(`message`, `image`, `time`) VALUES ('$message','$imageNewName','$time')";
mysqli_query($connection_message, $SQL1);







$SQL2 = "SELECT * FROM `$unique_id_me to $unique_id_me` ORDER BY `id` DESC LIMIT 1";
$run2 = mysqli_query($connection_message, $SQL2);
$latestData = mysqli_fetch_assoc($run2);

echo json_encode(["unique_id_me"=>$unique_id_me, "newMessage" => $latestData]);

















