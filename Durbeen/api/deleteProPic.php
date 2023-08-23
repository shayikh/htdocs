<?php
include '../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);

$Deleteid = $data['pro_pic_id'];
$unique_id_me = $data['unique_id_me'];





$SQL1 = "DELETE FROM `$unique_id_me pro_pic` WHERE `id`='$Deleteid'";
mysqli_query($durbeen_chats, $SQL1);



