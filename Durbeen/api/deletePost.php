<?php
include '../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);

$Deleteid = $data['post_id'];
$unique_id_me = $data['unique_id_me'];



$SQL1 = "SELECT * FROM `post` WHERE `id`='$Deleteid'";
$run1 = mysqli_query($connection, $SQL1);
$data1 = mysqli_fetch_assoc($run1);


$user_id = $data1['unique_id'];

if($user_id == $unique_id_me){
  $imgNameinDB = $data1['image'];

  if($imgNameinDB!=''){
    unlink('../post_image/'.$imgNameinDB);
  }
  
  
  
  
  $SQL6 = "DELETE FROM `post` WHERE `id`='$Deleteid'";
  mysqli_query($connection, $SQL6);
  
  $SQL40 = "DELETE FROM `comment` WHERE `post_id`='$Deleteid'";
  mysqli_query($connection, $SQL40);
  
  $SQL41 = "DELETE FROM `like_post` WHERE `post_id`='$Deleteid'";
  mysqli_query($connection, $SQL41);
  
  $SQL42 = "DELETE FROM `dislike_post` WHERE `post_id`='$Deleteid'";
  mysqli_query($connection, $SQL42);
  
  
  echo '1';
  
}else{
  echo "0";
}




























