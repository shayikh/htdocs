<?php
include '../../connection.php';


date_default_timezone_set("Asia/Dhaka");
$time = date_default_timezone_get().' time: '.date("d-M-Y-D-h:i:s a");

if($_FILES['image_khan_bahadur']['name']){
  $imageOldName = $_FILES['image_khan_bahadur']['name'];
  $extension = pathinfo($imageOldName, PATHINFO_EXTENSION);
  $imageNewName = uniqid().'_'.date("d_M_Y_D_h_i_s_a").'.'.$extension;
  $image_tmp = $_FILES['image_khan_bahadur']['tmp_name'];
  move_uploaded_file($image_tmp,'../../grp_image/'.$imageNewName);
}else{
  $imageNewName = '';
}




$message = $_POST['message'];
$message = mysqli_real_escape_string($connection_message, $message);

$my_name = $_POST['my_name'];
$my_name = mysqli_real_escape_string($connection_info, $my_name);

$unique_id_me = $_POST['unique_id_me'];
$grp_id = $_POST['grp_id'];
$myProPic = $_POST['myProPic'];


$SQL1 = "INSERT INTO `group $grp_id`(`senderName`, `senderId`, `senderProPic`, `message`, `image`, `time`) VALUES ('$my_name','$unique_id_me','$myProPic','$message','$imageNewName','$time')";
mysqli_query($connection_message, $SQL1);









$SQL4 = "SELECT * FROM `group $grp_id` ORDER BY `id` DESC LIMIT 1";
$run4 = mysqli_query($connection_message, $SQL4);
$latestData = mysqli_fetch_assoc($run4);

echo json_encode(["unique_id_me"=>$unique_id_me, "newMessage" => $latestData]);

















