<?php
include '../connection.php';

header('Content-Type: application/x-www-form-urlencoded');

$data = file_get_contents('php://input');
$decoded_data = json_decode($data, true);

$email = $decoded_data['email'];



$SQL = "SELECT * FROM `registration` WHERE `email`='$email'";
$run = mysqli_query($connection, $SQL);
$data = mysqli_fetch_assoc($run);
$count = mysqli_num_rows($run);

if($count == 0){
    echo "0";
}else{
    echo json_encode(array("singleUser" => $data));
}


















