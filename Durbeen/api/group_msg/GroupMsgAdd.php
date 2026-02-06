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








$SQL6 = "SELECT * FROM `group $grp_id members`";
$run6 = mysqli_query($connection_message, $SQL6);

while ($data6 = mysqli_fetch_assoc($run6)) {

  $memberId = $data6['memberId'];

  $SQL5 = "SELECT * FROM `$memberId chats` ORDER BY `id` DESC LIMIT 1";
  $run5 = mysqli_query($connection_info, $SQL5);
  $latestChating = mysqli_fetch_assoc($run5);

  if (($latestChating['unique_id_fr'] != $grp_id || $latestChating['chat_type'] != '2')) {
    $SQL3 = "DELETE FROM `$memberId chats` WHERE `unique_id_fr`='$grp_id' AND `chat_type`='2'";
    mysqli_query($connection_info, $SQL3);

    

    $SQL2 = "INSERT INTO `$memberId chats`(`unique_id_fr`, `chat_type`) VALUES ('$grp_id','2')";
    mysqli_query($connection_info, $SQL2);
  }

}









$SQL4 = "SELECT * FROM `group $grp_id` ORDER BY `id` DESC LIMIT 1";
$run4 = mysqli_query($connection_message, $SQL4);
$latestData = mysqli_fetch_assoc($run4);

echo json_encode(["grp_id"=>$grp_id, "newMessage" => $latestData]);

















