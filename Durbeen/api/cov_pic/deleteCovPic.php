<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);



$Deleteid = $data['cov_pic_id'];
$unique_id_me = $data['unique_id_me'];



$SQL2 = "SELECT * FROM `$unique_id_me cov_pic` WHERE `id`='$Deleteid'";
$run2 = mysqli_query($connection_info,$SQL2);
$data2 = mysqli_fetch_assoc($run2);
$cov_pic = $data2['cov_pic'];

if ($cov_pic != "cov_pic.jpg") {
    unlink('../../pro_pic/cov_pic/'.$cov_pic);
}

$SQL1 = "DELETE FROM `$unique_id_me cov_pic` WHERE `id`='$Deleteid'";
mysqli_query($connection_info, $SQL1);


