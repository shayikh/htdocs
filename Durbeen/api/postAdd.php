<?php
include '../connection.php';



date_default_timezone_set("Asia/Dhaka");
$time = date_default_timezone_get().' time: '.date("d-M-Y-D-H:i:s");

if($_FILES['image_khan_bahadur']['name']){
  $imageOldName = $_FILES['image_khan_bahadur']['name'];
  $imageNewName = uniqid().'_'.date("Y-M-H-i-s").'_'.$imageOldName;
  $image_tmp = $_FILES['image_khan_bahadur']['tmp_name'];
  move_uploaded_file($image_tmp,'../post_image/'.$imageNewName);
}else{
  $imageNewName = '';
}


$post = $_POST['post'];
$post = mysqli_real_escape_string($connection, $post);
$unique_id_me = $_POST['unique_id_me'];



$SQL4 = "INSERT INTO `post`(`unique_id`, `image`, `time`, `post`) VALUES ('$unique_id_me','$imageNewName','$time','$post')";
mysqli_query($connection,$SQL4);





$SQL = "SELECT * FROM `post` ORDER BY `id` DESC LIMIT 1";
$run = mysqli_query($connection, $SQL);
$latestData = mysqli_fetch_assoc($run);

echo json_encode(["unique_id_me"=>$unique_id_me, "newPost" => $latestData]);













