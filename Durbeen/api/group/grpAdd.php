<?php
include '../../connection.php';



if($_FILES['image_khan_bahadur']['name']){
  $imageOldName = $_FILES['image_khan_bahadur']['name'];
  $imageNewName = uniqid().'_'.date("Y-M-H-i-s").'_'.$imageOldName;
  $image_tmp = $_FILES['image_khan_bahadur']['tmp_name'];
  move_uploaded_file($image_tmp,'../../pro_pic/'.$imageNewName);
}else{
  $imageNewName = 'red_comet.png';
}


$post = $_POST['grp_name'];
$post = mysqli_real_escape_string($connection, $post);
$unique_id_me = $_POST['unique_id_me'];



$SQL1 = "INSERT INTO `groups`(`grp_name`, `pro_pic`, `admin_id`) VALUES ('$post','$imageNewName','$unique_id_me')";
mysqli_query($connection,$SQL1);


$SQL2 = "SELECT * FROM `groups` ORDER BY `id` DESC LIMIT 1";
$run2 = mysqli_query($connection, $SQL2);
$latestData = mysqli_fetch_assoc($run2);

$grp_id = $latestData['id'];
$SQL1 = "INSERT INTO `$unique_id_me msg_grp`(`grp_id`, `grp_name`, `pro_pic`, `admin`) VALUES ('$grp_id','$post','$imageNewName','1')";
mysqli_query($durbeen_chats,$SQL1);



$SQLcreateMe = "CREATE TABLE IF NOT EXISTS `group $grp_id` (
  `id` int(255) unsigned NOT NULL auto_increment,
  `senderName` varchar(1000),
  `senderId` varchar(1000),
  `senderProPic` varchar(1000),
  `message` text,
  `image` varchar(1000),
  `time` varchar(1000),
  PRIMARY KEY  (`id`)
)";
mysqli_query($connection_message, $SQLcreateMe);

$SQLcreateMe = "CREATE TABLE IF NOT EXISTS `group $grp_id members` (
  `id` int(255) unsigned NOT NULL auto_increment,
  `memberId` varchar(1000),
  `admin` tinyint(1) DEFAULT '0',
  PRIMARY KEY  (`id`)
)";
mysqli_query($connection_message, $SQLcreateMe);

$SQL400 = "INSERT INTO `group $grp_id members`(`memberId`, `admin`) VALUES ('$unique_id_me','1')";
mysqli_query($connection_message, $SQL400);




echo json_encode(["unique_id_me"=>$unique_id_me, "newGroup" => $latestData]);













