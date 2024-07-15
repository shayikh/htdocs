<?php

include '../../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);

$unique_id_me = $data['unique_id_me'];
$unique_id_fr = $data['unique_id_fr'];




//create two table if not exist
$SQLcreateMe = "CREATE TABLE IF NOT EXISTS `$unique_id_me to $unique_id_fr` (
    `id` int(255) unsigned NOT NULL auto_increment,
    `sender` varchar(255),
    `message` text,
    `image` varchar(1000),
    `time` varchar(1000),
    `seen` varchar(1000),
    PRIMARY KEY  (`id`)
)";
mysqli_query($connection_message, $SQLcreateMe);

$SQLcreateFr = "CREATE TABLE IF NOT EXISTS `$unique_id_fr to $unique_id_me` (
    `id` int(255) unsigned NOT NULL auto_increment,
    `sender` varchar(255),
    `message` text,
    `image` varchar(1000),
    `time` varchar(1000),
    `seen` varchar(1000),
    PRIMARY KEY  (`id`)
)";
mysqli_query($connection_message, $SQLcreateFr);
//table creation end


//chat friend start
$SQL3 = "SELECT * FROM `$unique_id_me chats` WHERE `unique_id_fr`='$unique_id_fr'";
$run3 = mysqli_query($durbeen_chats, $SQL3);
$count3 = mysqli_num_rows($run3);

if ($count3 == 0) {
    $SQL16 = "INSERT INTO `$unique_id_me chats`(`unique_id_fr`) VALUES ('$unique_id_fr')";
    mysqli_query($durbeen_chats, $SQL16);
}


$SQL4 = "SELECT * FROM `$unique_id_fr chats` WHERE `unique_id_fr`='$unique_id_me'";
$run4 = mysqli_query($durbeen_chats, $SQL4);
$count4 = mysqli_num_rows($run4);

if ($count4 == 0) {
    $SQL5 = "INSERT INTO `$unique_id_fr chats`(`unique_id_fr`) VALUES ('$unique_id_me')";
    mysqli_query($durbeen_chats, $SQL5);
}









date_default_timezone_set("Asia/Dhaka");
$time = date_default_timezone_get().' time: '.date("d-M-Y-D-h:i:s a");

$imageNewName = '';

$message = "Hello, i want to follow you. Please allow me so that i can follow you";
$message = mysqli_real_escape_string($connection_message, $message);



$SQL1 = "INSERT INTO `$unique_id_me to $unique_id_fr`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('me','$message','$imageNewName','$time','Unseen')";
mysqli_query($connection_message, $SQL1);

$SQL2 = "INSERT INTO `$unique_id_fr to $unique_id_me`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('fr','$message','$imageNewName','$time','Unseen')";
mysqli_query($connection_message, $SQL2);



//notification sql

$SQL3 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_me'";
$run3 = mysqli_query($connection, $SQL3);
$data3 = mysqli_fetch_assoc($run3);
$my_name = $data3['name'];

$SQL3 = "INSERT INTO `$unique_id_fr notify`(`sender`, `sender_id`, `seen`) VALUES ('$my_name','$unique_id_me','0')";
mysqli_query($durbeen_chats, $SQL3);




echo "0";

