<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);


$unique_id_me = $data['unique_id_me'];
$unique_id_fr = $data['unique_id_fr'];



$SQL1 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_fr'";
$run1 = mysqli_query($connection,$SQL1);
$data1 = mysqli_fetch_assoc($run1);
$frlocking = $data1['locking'];




$SQL2 = "DELETE FROM `$unique_id_me follow` WHERE `unique_id_fr`='$unique_id_fr'";
mysqli_query($connection_info,$SQL2);

echo "3";


