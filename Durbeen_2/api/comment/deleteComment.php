<?php
include '../../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);

$Deleteid = $data['comment_id'];
$unique_id_me = $data['unique_id_me'];



$SQL1 = "SELECT * FROM `comment` WHERE `id`='$Deleteid'";
$run1 = mysqli_query($connection, $SQL1);
$targetComment = mysqli_fetch_assoc($run1);
$comn_giver_id = $targetComment['comn_giver_id'];


if($comn_giver_id == $unique_id_me){

  $SQL2 = "DELETE FROM `comment` WHERE `id`='$Deleteid'";
  mysqli_query($connection, $SQL2);
  echo "1";

}else{

  echo "0";

}


