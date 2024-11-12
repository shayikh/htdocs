<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);


$Deleteid = $data['id_msg'];
$grp_id = $data['grp_id'];



$SQL1 = "SELECT * FROM `group $grp_id` WHERE `id`='$Deleteid'";
$run1 = mysqli_query($connection_message, $SQL1);
$data1 = mysqli_fetch_assoc($run1);

$imgNameinDB = $data1['image'];

if($imgNameinDB!=''){
  unlink('../../grp_image/'.$imgNameinDB);
}
    
$SQL2 = "DELETE FROM `group $grp_id` WHERE `id`='$Deleteid'";
mysqli_query($connection_message, $SQL2);


echo '1';















