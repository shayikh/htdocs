<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);



$unique_id_me = $data['unique_id_me'];
$unique_id_fr = $data['unique_id_fr'];




$SQL1 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_fr'";
$run1 = mysqli_query($connection,$SQL1);
$data1 = mysqli_fetch_assoc($run1);
$frlocking = $data1['locking'];

$SQLfrA = "SELECT * FROM `$unique_id_fr allow` WHERE `unique_id_fr`='$unique_id_me'";
$runfrA = mysqli_query($connection_info, $SQLfrA);
$countfrA = mysqli_num_rows($runfrA);

$SQLF = "SELECT * FROM `$unique_id_me follow` WHERE `unique_id_fr`='$unique_id_fr'";
$runF = mysqli_query($connection_info, $SQLF);
$countF = mysqli_num_rows($runF);




if(($countF == 0) && ($frlocking == 1) && ($countfrA == 0)){
    //create two table if not exist
    if($unique_id_me < $unique_id_fr){
      $SQLcreateMe = "CREATE TABLE IF NOT EXISTS `$unique_id_me to $unique_id_fr` (
          `id` bigint(255) unsigned NOT NULL auto_increment,
          `sender` bigint(255),
          `message` longtext,
          `image` varchar(1000),
          `time` varchar(1000),
          `seen` varchar(1000),
          PRIMARY KEY  (`id`)
      )";
  }else{
      $SQLcreateMe = "CREATE TABLE IF NOT EXISTS `$unique_id_fr to $unique_id_me` (
          `id` bigint(255) unsigned NOT NULL auto_increment,
          `sender` bigint(255),
          `message` longtext,
          `image` varchar(1000),
          `time` varchar(1000),
          `seen` varchar(1000),
          PRIMARY KEY  (`id`)
      )";
  }
  mysqli_query($connection_message, $SQLcreateMe);
  //table creation end


  //chat friend start
  $SQL3 = "SELECT * FROM `$unique_id_me chats` WHERE `unique_id_fr`='$unique_id_fr'";
  $run3 = mysqli_query($connection_info, $SQL3);
  $count3 = mysqli_num_rows($run3);

  if ($count3 == 0) {
      $SQL16 = "INSERT INTO `$unique_id_me chats`(`unique_id_fr`, `chat_type`) VALUES ('$unique_id_fr','3')";
      mysqli_query($connection_info, $SQL16);
  }


  $SQL4 = "SELECT * FROM `$unique_id_fr chats` WHERE `unique_id_fr`='$unique_id_me'";
  $run4 = mysqli_query($connection_info, $SQL4);
  $count4 = mysqli_num_rows($run4);

  if ($count4 == 0) {
      $SQL5 = "INSERT INTO `$unique_id_fr chats`(`unique_id_fr`, `chat_type`) VALUES ('$unique_id_me','3')";
      mysqli_query($connection_info, $SQL5);
  }










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


  








  date_default_timezone_set("Asia/Dhaka");
  $time = date_default_timezone_get().' time: '.date("d-M-Y-D-h:i:s a");

  $imageNewName = '';

  $message = "Hello, i want to follow you. Please allow me so that i can follow you";
  $message = mysqli_real_escape_string($connection_message, $message);



  if($unique_id_me < $unique_id_fr){
      $SQL1 = "INSERT INTO `$unique_id_me to $unique_id_fr`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('$unique_id_me','$message','$imageNewName','$time','Unseen')";
  }else{
      $SQL1 = "INSERT INTO `$unique_id_fr to $unique_id_me`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('$unique_id_me','$message','$imageNewName','$time','Unseen')";
  }
  mysqli_query($connection_message, $SQL1);



  //notification sql

  $SQL3 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_me'";
  $run3 = mysqli_query($connection, $SQL3);
  $data3 = mysqli_fetch_assoc($run3);
  $my_name = $data3['name'];

  $SQL3 = "INSERT INTO `$unique_id_fr notify`(`sender`, `sender_id`, `seen`) VALUES ('$my_name','$unique_id_me','0')";
  mysqli_query($connection_info, $SQL3);




  echo "1";
}

elseif(($countF == 0) && ($frlocking == 1) && ($countfrA == 1)){
  $SQL1 = "INSERT INTO `$unique_id_me follow`(`unique_id_fr`, `chat_type`) VALUES ('$unique_id_fr','3')";
  mysqli_query($connection_info,$SQL1);
  echo "2";
}

elseif(($countF == 0) && ($frlocking == 0)){
  $SQL1 = "INSERT INTO `$unique_id_me follow`(`unique_id_fr`, `chat_type`) VALUES ('$unique_id_fr','3')";
  mysqli_query($connection_info,$SQL1);

  if($countfrA == 0){
    $SQL1 = "INSERT INTO `$unique_id_fr allow`(`unique_id_fr`) VALUES ('$unique_id_me')";
    mysqli_query($connection_info,$SQL1);
  }

  echo "2";
}

elseif($countF == 1){
  $SQL2 = "DELETE FROM `$unique_id_me follow` WHERE `unique_id_fr`='$unique_id_fr'";
	mysqli_query($connection_info,$SQL2);

  echo "3";
}



