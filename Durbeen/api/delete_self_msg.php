<?php
include '../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);

$Deleteid = $data['id'];
$unique_id_me = $data['unique_id_me'];


$SQL1 = "SELECT * FROM `$unique_id_me to $unique_id_me` WHERE `id`='$Deleteid'";
$run1 = mysqli_query($connection_message, $SQL1);
$data1 = mysqli_fetch_assoc($run1);


$imgNameinDB = $data1['image'];

if($imgNameinDB!=''){
  unlink('../chat_image/'.$imgNameinDB);
}
    
$SQL6 = "DELETE FROM `$unique_id_me to $unique_id_me` WHERE `id`='$Deleteid'";
mysqli_query($connection_message, $SQL6);

echo '1';















