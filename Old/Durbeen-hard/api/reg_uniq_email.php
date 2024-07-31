<?php
include '../connection.php';

header('Content-Type: application/x-www-form-urlencoded');

$data = file_get_contents('php://input');
$decoded_data = json_decode($data, true);

$email = $decoded_data['email'];

$SQL1 = "SELECT * FROM `registration` WHERE `email`='$email'";
$run1 = mysqli_query($connection,$SQL1);
$count = mysqli_num_rows($run1);

if($count > 0){
  echo "0";
}else{
  echo "1";
}





