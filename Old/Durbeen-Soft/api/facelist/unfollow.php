<?php

include '../../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);

$unique_id_me = $data['unique_id_me'];
$unique_id_fr = $data['unique_id_fr'];



$SQL1 = "DELETE FROM `$unique_id_me follow` WHERE `unique_id_fr`='$unique_id_fr'";
mysqli_query($connection_info,$SQL1);

echo "0";








