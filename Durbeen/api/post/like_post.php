<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);



$post_id = $data['post_id'];
$unique_id_me = $data['unique_id_me'];


$SQL1 = "SELECT * FROM `like_post` WHERE `post_id`='$post_id' AND `unique_id`='$unique_id_me'";
$run1 = mysqli_query($connection, $SQL1);
$count1 = mysqli_num_rows($run1);


if($count1 == 0){
  $SQL2 = "INSERT INTO `like_post`(`post_id`, `unique_id`) VALUES ('$post_id','$unique_id_me')";
  mysqli_query($connection, $SQL2);
  echo "1";




  $SQL3 = "SELECT * FROM `dislike_post` WHERE `post_id`='$post_id' AND `unique_id`='$unique_id_me'";
  $run3 = mysqli_query($connection, $SQL3);
  $count2 = mysqli_num_rows($run3);

  if($count2 == 1){
    $SQL4 = "DELETE FROM `dislike_post` WHERE `post_id`='$post_id' AND `unique_id`='$unique_id_me'";
    mysqli_query($connection, $SQL4);
  }

}else{
  $SQL5 = "DELETE FROM `like_post` WHERE `post_id`='$post_id' AND `unique_id`='$unique_id_me'";
  mysqli_query($connection, $SQL5);
  echo "0";
}











