<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);



$post_id = $data['post_id'];
$unique_id_me = $data['unique_id_me'];



$SQL1 = "SELECT * FROM `post` WHERE `id`='$post_id'";
$run1 = mysqli_query($connection,$SQL1);
$data1 = mysqli_fetch_assoc($run1);

$post = $data1['post'];
$image = $data1['image'];


date_default_timezone_set("Asia/Dhaka");
$time = "The time in " . date_default_timezone_get() . " is " . date("d-M-Y-D-h:i:s a");


if ($image != ""){
    $extension = pathinfo($image, PATHINFO_EXTENSION);
    $imageNewName = uniqid().'_'.date("d_M_Y_D_h_i_s_a").'.'.$extension;
    $oldPath = "../../post_image/".$image;
    $newPath = "../../post_image/".$imageNewName;

    $copied = copy($oldPath , $newPath);
}else{
    $imageNewName = "";
}






$SQL2 = "INSERT INTO `post`(`unique_id`, `image`, `time`, `post`) VALUES ('$unique_id_me','$imageNewName','$time','$post')";
mysqli_query($connection,$SQL2);



$SQL3 = "SELECT * FROM `post` ORDER BY `id` DESC LIMIT 1";
$run3 = mysqli_query($connection, $SQL3);
$latestData = mysqli_fetch_assoc($run3);

echo json_encode(["unique_id_me"=>$unique_id_me, "newPost" => $latestData]);







