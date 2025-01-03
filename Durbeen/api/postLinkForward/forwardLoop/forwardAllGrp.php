<?php
include '../../../connection.php';

$unique_id_me = $_POST['unique_id_me'];
$post_id = $_POST['hidden_post_id'];


$SQLMe = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_me'";
$runMe = mysqli_query($connection, $SQLMe);
$dataMe = mysqli_fetch_assoc($runMe);
$MyName = $dataMe['name'];
$MyProPic = $dataMe['pro_pic'];






date_default_timezone_set("Asia/Dhaka");
$time = date_default_timezone_get().' time: '.date("d-M-Y-D-h:i:s a");

$imageNewName = '';

$message = "<a href='./singlePost.php?type&post_id=$post_id'>Click To See Post ($post_id)</a>";
$message = mysqli_real_escape_string($connection_message, $message);



$SQL = "SELECT * FROM `$unique_id_me msg_grp`";
$run = mysqli_query($connection_info,$SQL);

while ($data1 = mysqli_fetch_assoc($run)){

    $grp_id = $data1['grp_id'];

    $SQL1 = "INSERT INTO `group $grp_id`(`senderName`, `senderId`, `senderProPic`, `message`, `image`, `time`) VALUES ('$my_name','$unique_id_me','$MyProPic','$message','$imageNewName','$time')";
    mysqli_query($connection_message, $SQL1);

}
