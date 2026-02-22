<?php
include '../../connection.php';


date_default_timezone_set("Asia/Dhaka");
$time = date_default_timezone_get().' time: '.date("d-M-Y-D-h:i:s a");

if($_FILES['image_khan_bahadur']['name']){
  $imageOldName = $_FILES['image_khan_bahadur']['name'];
  $extension = pathinfo($imageOldName, PATHINFO_EXTENSION);
  $imageNewName = uniqid().'_'.date("d_M_Y_D_h_i_s_a").'.'.$extension;
  $image_tmp = $_FILES['image_khan_bahadur']['tmp_name'];
  move_uploaded_file($image_tmp,'../../chat_image/'.$imageNewName);
}else{
  $imageNewName = '';
}




$message = $_POST['message'];
$message = mysqli_real_escape_string($connection_message, $message);

$my_name = $_POST['my_name'];
$my_name = mysqli_real_escape_string($connection_info, $my_name);

$unique_id_me = $_POST['unique_id_me'];
$unique_id_fr = $_POST['unique_id_fr'];



if($unique_id_me < $unique_id_fr){
  $SQL1 = "INSERT INTO `$unique_id_me to $unique_id_fr`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('$unique_id_me','$message','$imageNewName','$time','Unseen')";
}else{
  $SQL1 = "INSERT INTO `$unique_id_fr to $unique_id_me`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('$unique_id_me','$message','$imageNewName','$time','Unseen')";
}
mysqli_query($connection_message, $SQL1);


//notification sql

$SQL3 = "INSERT INTO `$unique_id_fr notify`(`sender`, `sender_id`, `seen`) VALUES ('$my_name','$unique_id_me','0')";
mysqli_query($connection_info, $SQL3);














$SQL54 = "SELECT * FROM `$unique_id_me chats` ORDER BY `id` DESC LIMIT 1";
$run54 = mysqli_query($connection_info, $SQL54);
$latestChating = mysqli_fetch_assoc($run54);

if (($latestChating['unique_id_fr'] != $unique_id_fr || $latestChating['chat_type'] != '3')) {
  $SQL34 = "DELETE FROM `$unique_id_me chats` WHERE `unique_id_fr`='$unique_id_fr' AND `chat_type`='3'";
  mysqli_query($connection_info, $SQL34);

  
  $SQL28 = "INSERT INTO `$unique_id_me chats`(`unique_id_fr`, `chat_type`) VALUES ('$unique_id_fr','3')";
  mysqli_query($connection_info, $SQL28);
}





$SQL54 = "SELECT * FROM `$unique_id_fr chats` ORDER BY `id` DESC LIMIT 1";
$run54 = mysqli_query($connection_info, $SQL54);
$latestChating = mysqli_fetch_assoc($run54);

if (($latestChating['unique_id_fr'] != $unique_id_me || $latestChating['chat_type'] != '3')) {
  $SQL44 = "DELETE FROM `$unique_id_fr chats` WHERE `unique_id_fr`='$unique_id_me' AND `chat_type`='3'";
  mysqli_query($connection_info, $SQL44);


  $SQL24 = "INSERT INTO `$unique_id_fr chats`(`unique_id_fr`, `chat_type`) VALUES ('$unique_id_me','3')";
  mysqli_query($connection_info, $SQL24);
}













if($unique_id_me < $unique_id_fr){
  $SQL4 = "SELECT * FROM `$unique_id_me to $unique_id_fr` ORDER BY `id` DESC LIMIT 1";
}else{
  $SQL4 = "SELECT * FROM `$unique_id_fr to $unique_id_me` ORDER BY `id` DESC LIMIT 1";
}
$run4 = mysqli_query($connection_message, $SQL4);
$latestData = mysqli_fetch_assoc($run4);

echo json_encode(["unique_id_me"=>$unique_id_me, "unique_id_fr"=>$unique_id_fr, "newMessage" => $latestData]);

















