<?php
include '../../connection.php';



$post = $_POST['grp_name'];
$post = mysqli_real_escape_string($connection, $post);
$grp_id = $_POST['grp_id'];



$SQL3 = "SELECT * FROM `groups` WHERE `id`='$grp_id'";
$run3 = mysqli_query($connection, $SQL3);
$data3 = mysqli_fetch_assoc($run3);
$pro_pic = $data3['pro_pic'];


if($_FILES['image_khan_bahadur']['name']){
  $imageOldName = $_FILES['image_khan_bahadur']['name'];
  $imageNewName = uniqid().'_'.date("Y-M-H-i-s").'_'.$imageOldName;
  $image_tmp = $_FILES['image_khan_bahadur']['tmp_name'];
  move_uploaded_file($image_tmp,'../../pro_pic/'.$imageNewName);

  unlink('../../pro_pic/'.$pro_pic);
}else{
  $imageNewName = $pro_pic;
}







$SQL1 = "UPDATE `groups` SET `grp_name`='$post',`pro_pic`='$imageNewName' WHERE `id`='$grp_id'";
mysqli_query($connection,$SQL1);




$SQL2 = "SELECT * FROM `groups` WHERE `id`='$grp_id'";
$run2 = mysqli_query($connection, $SQL2);
$latestData = mysqli_fetch_assoc($run2);

echo json_encode(["newGroup" => $latestData]);













