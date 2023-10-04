<?php
include '../../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);

$Deleteid = $data['cov_pic_id'];
$unique_id_me = $data['unique_id_me'];





$SQL1 = "UPDATE `$unique_id_me cov_pic` SET `watch`='0' WHERE `id`='$Deleteid'";
mysqli_query($durbeen_chats, $SQL1);



