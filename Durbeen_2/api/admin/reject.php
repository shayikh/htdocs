<?php
include '../../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$Deleteid = $data['id'];

$SQL1 = "SELECT * FROM `account` WHERE `id`='$id'";
$run1 = mysqli_query($connection, $SQL1);
$data1 = mysqli_fetch_assoc($run1);


$pro_pic = $data1['pro_pic'];
if($pro_pic!=''){
    unlink('../../pro_pic/'.$pro_pic);
}


$SQL2 = "DELETE FROM `account` WHERE `id`='$Deleteid'";
mysqli_query($connection, $SQL2);
  
  
echo "0";







