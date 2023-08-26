<?php

include '../../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);


$unique_id_me = $data['unique_id_me'];
$unique_id_fr = $data['unique_id_fr'];



$SQLF = "SELECT * FROM `$unique_id_me follow` WHERE `unique_id_fr`='$unique_id_fr'";
$runF = mysqli_query($durbeen_chats,$SQLF);
$countF = mysqli_num_rows($runF);



if($countF == 0){
  $SQL1 = "INSERT INTO `$unique_id_me follow`(`unique_id_fr`) VALUES ('$unique_id_fr')";
  mysqli_query($durbeen_chats,$SQL1);
  echo "1";
}else{
  $SQL2 = "DELETE FROM `$unique_id_me follow` WHERE `unique_id_fr`='$unique_id_fr'";
	mysqli_query($durbeen_chats,$SQL2);
  echo "0";
}







