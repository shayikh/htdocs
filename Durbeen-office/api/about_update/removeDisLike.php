<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);


$dislike_id = $data['dislike_id'];

$SQL2 = "DELETE FROM `dislike_post` WHERE `id`='$dislike_id'";
mysqli_query($connection, $SQL2);

echo "1";
