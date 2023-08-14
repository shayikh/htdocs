<?php
include '../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);

$Deleteid = $data['id'];
$unique_id_me = $data['unique_id_me'];
$unique_id_fr = $data['unique_id_fr'];


$SQL1 = "SELECT * FROM `$unique_id_me to $unique_id_fr` WHERE `id`='$Deleteid'";
$runAll = mysqli_query($connection_message, $SQL1);
$dataAll = mysqli_fetch_assoc($runAll);


$imgNameinDB = $dataAll['image'];

if($imgNameinDB!=''){
  unlink('../chat_image/'.$imgNameinDB);
}
    
$SQL6 = "DELETE FROM `$unique_id_me to $unique_id_fr` WHERE `id`='$Deleteid'";
mysqli_query($connection_message, $SQL6);

$SQL7 = "DELETE FROM `$unique_id_fr to $unique_id_me` WHERE `id`='$Deleteid'";
mysqli_query($connection_message, $SQL7);

echo '1';















