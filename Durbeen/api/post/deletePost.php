<?php
include '../../connection.php';

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
    unlink('../../post_image/'.$imgNameinDB);
  }
  
  
  
  
  $SQL2 = "DELETE FROM `post` WHERE `id`='$Deleteid'";
  mysqli_query($connection, $SQL2);
  
  $SQL3 = "DELETE FROM `comment` WHERE `post_id`='$Deleteid'";
  mysqli_query($connection, $SQL3);
  
  $SQL4 = "DELETE FROM `like_post` WHERE `post_id`='$Deleteid'";
  mysqli_query($connection, $SQL4);
  
  $SQL5 = "DELETE FROM `dislike_post` WHERE `post_id`='$Deleteid'";
  mysqli_query($connection, $SQL5);
  
  
  echo '1';
  
}else{
  echo "0";
}






