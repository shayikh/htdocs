<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);



$cov_pic_id = $data['cov_pic_id'];
$unique_id_me = $data['unique_id_me'];

$SQLMe = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_me'";
$runMe = mysqli_query($connection,$SQLMe);
$dataMe = mysqli_fetch_assoc($runMe);

$old_cov_pic = $dataMe['cov_pic'];


$SQL2 = "SELECT * FROM `$unique_id_me cov_pic` WHERE `id`='$cov_pic_id'";
$run2 = mysqli_query($connection_info,$SQL2);
$data2 = mysqli_fetch_assoc($run2);
$new_cov_pic = $data2['cov_pic'];

$SQL3 = "UPDATE `registration` SET `cov_pic`='$new_cov_pic' WHERE `unique_id`='$unique_id_me'";
mysqli_query($connection,$SQL3);


$SQL1 = "UPDATE `$unique_id_me cov_pic` SET `cov_pic`='$old_cov_pic' WHERE `id`='$cov_pic_id'";
mysqli_query($connection_info,$SQL1);




$SQL3 = "SELECT * FROM `$unique_id_me cov_pic` WHERE `id`='$cov_pic_id'";
$run3 = mysqli_query($connection_info, $SQL3);
$latestData = mysqli_fetch_assoc($run3);

echo json_encode(["new_cov_pic"=>$new_cov_pic, "newCovPic" => $latestData]);









