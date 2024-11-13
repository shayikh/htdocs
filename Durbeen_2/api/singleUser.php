<?php
include '../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);


$email = $data['email'];

$SQL = "SELECT * FROM `registration` WHERE `email`='$email'";
$run = mysqli_query($connection, $SQL);
$data = mysqli_fetch_assoc($run);
$count = mysqli_num_rows($run);

if($count == 0){
    echo "0";
}else{
    echo json_encode(array("singleUser" => $data));
}


















