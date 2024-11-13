<?php
session_start();
include '../connection.php';

header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);


$unique_id_me = $data['unique_id_me'];

$SQL1 = "UPDATE `registration` SET `active`='0' WHERE `unique_id`='$unique_id_me'";
mysqli_query($connection,$SQL1);


session_unset();
session_destroy();




