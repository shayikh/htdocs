<?php
include '../../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$Deleteid = $data['pro_pic_id'];
$unique_id_me = $data['unique_id_me'];



$SQL2 = "SELECT * FROM `$unique_id_me pro_pic` WHERE `id`='$Deleteid'";
$run2 = mysqli_query($connection_info,$SQL2);
$data2 = mysqli_fetch_assoc($run2);
$pro_pic = $data2['pro_pic'];

if ($pro_pic != "red_comet.png") {
    unlink('../../pro_pic/'.$pro_pic);
}

$SQL1 = "DELETE FROM `$unique_id_me pro_pic` WHERE `id`='$Deleteid'";
mysqli_query($connection_info, $SQL1);



