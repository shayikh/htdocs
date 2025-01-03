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


$SQL = "SELECT * FROM `$unique_id_me chats`";
$run = mysqli_query($connection_info,$SQL);

while ($data1 = mysqli_fetch_assoc($run)){


    $to_unique_id_fr = $data1['unique_id_fr'];

    if($unique_id_me < $to_unique_id_fr){
        $SQL1 = "INSERT INTO `$unique_id_me to $to_unique_id_fr`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('$unique_id_me','$message','$imageNewName','$time','Unseen')";
    }else{
        $SQL1 = "INSERT INTO `$to_unique_id_fr to $unique_id_me`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('$unique_id_me','$message','$imageNewName','$time','Unseen')";
    }
    mysqli_query($connection_message, $SQL1);


    //notification sql

    $SQL3 = "INSERT INTO `$to_unique_id_fr notify`(`sender`, `sender_id`, `seen`) VALUES ('$MyName','$unique_id_me','0')";
    mysqli_query($connection_info, $SQL3);
}



