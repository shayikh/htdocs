<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);


$like_id = $data['like_id'];

$SQL2 = "DELETE FROM `like_post` WHERE `id`='$like_id'";
mysqli_query($connection, $SQL2);

echo "1";
