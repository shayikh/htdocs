<?php
include '../../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$id = $data['id'];

$SQL1 = "SELECT * FROM `account` WHERE `id`='$id'";
$run1 = mysqli_query($connection, $SQL1);
$data1 = mysqli_fetch_assoc($run1);

$name = $data1['name'];
$email = $data1['email'];
$password = $data1['password'];
$date_birth = $data1['date_birth'];
$gender = $data1['gender'];
$pro_pic = $data1['pro_pic'];


$SQL2 = "INSERT INTO `registration`(`name`, `email`, `password`, `pro_pic`, `cov_pic`) VALUES ('$name','$email','$password','$pro_pic','cov_pic.jpg')";
mysqli_query($connection, $SQL2);


$SQL3 = "SELECT * FROM `registration` WHERE `email`='$email'";
$run3 = mysqli_query($connection, $SQL3);
$data3 = mysqli_fetch_assoc($run3);

$unique_id_me = $data3['unique_id'];


$SQL4 = "INSERT INTO `about`(`unique_id`, `date_birth`, `gender`) VALUES ('$unique_id_me','$date_birth','$gender')";
mysqli_query($connection, $SQL4);



//create notification table
$SQL5 = "CREATE TABLE `$unique_id_me notify` (
    `id` int(255) unsigned NOT NULL auto_increment,
    `sender` varchar(255),
    `sender_id` int(255),
    `seen` int(255),
    PRIMARY KEY  (`id`)
)";
mysqli_query($durbeen_chats, $SQL5);


$SQLcreate = "CREATE TABLE IF NOT EXISTS `$unique_id_me chats` (
    `id` int(255) unsigned NOT NULL auto_increment,
    `unique_id_fr` int(255),
    PRIMARY KEY  (`id`)
)";
mysqli_query($durbeen_chats, $SQLcreate);

$SQLcreate = "CREATE TABLE IF NOT EXISTS `$unique_id_me follow` (
    `id` int(255) unsigned NOT NULL auto_increment,
    `unique_id_fr` int(255),
    PRIMARY KEY  (`id`)
)";
mysqli_query($durbeen_chats, $SQLcreate);

$SQLcreate = "CREATE TABLE IF NOT EXISTS `$unique_id_me allow` (
    `id` int(255) unsigned NOT NULL auto_increment,
    `unique_id_fr` int(255),
    PRIMARY KEY  (`id`)
)";
mysqli_query($durbeen_chats, $SQLcreate);

$SQL400 = "INSERT INTO `$unique_id_me follow`(`unique_id_fr`) VALUES ('$unique_id_me')";
mysqli_query($durbeen_chats, $SQL400);
$SQL400 = "INSERT INTO `$unique_id_me follow`(`unique_id_fr`) VALUES ('1')";
mysqli_query($durbeen_chats, $SQL400);
$SQL400 = "INSERT INTO `1 allow`(`unique_id_fr`) VALUES ('$unique_id_me')";
mysqli_query($durbeen_chats, $SQL400);


$SQLcreateMe = "CREATE TABLE IF NOT EXISTS `$unique_id_me to $unique_id_me` (
    `id` int(255) unsigned NOT NULL auto_increment,
    `message` text,
    `image` varchar(1000),
    `time` varchar(1000),
    PRIMARY KEY  (`id`)
)";
mysqli_query($connection_message, $SQLcreateMe);


$SQLcreateMe = "CREATE TABLE IF NOT EXISTS `$unique_id_me pro_pic` (
    `id` int(255) unsigned NOT NULL auto_increment,
    `pro_pic` varchar(1000),
    `watch` tinyint(1) DEFAULT '1',
    PRIMARY KEY  (`id`)
)";
mysqli_query($durbeen_chats, $SQLcreateMe);

$SQLcreateMe = "CREATE TABLE IF NOT EXISTS `$unique_id_me cov_pic` (
    `id` int(255) unsigned NOT NULL auto_increment,
    `cov_pic` varchar(1000),
    PRIMARY KEY  (`id`)
)";
mysqli_query($durbeen_chats, $SQLcreateMe);

$SQLcreateMe = "CREATE TABLE IF NOT EXISTS `$unique_id_me msg_grp` (
    `id` int(255) unsigned NOT NULL auto_increment,
    `grp_id` int(255),
    PRIMARY KEY  (`id`)
)";
mysqli_query($durbeen_chats, $SQLcreateMe);






$SQL2 = "DELETE FROM `account` WHERE `id`='$id'";
mysqli_query($connection, $SQL2);

echo "0";







