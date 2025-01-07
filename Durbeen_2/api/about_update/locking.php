<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);


$unique_id_me = $data['unique_id_me'];


$SQL1 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_me'";
$run1 = mysqli_query($connection,$SQL1);
$data1 = mysqli_fetch_assoc($run1);
$locking = $data1['locking'];


if($locking == 0){
    $SQL2 = "UPDATE `registration` SET `locking`= 1 WHERE `unique_id`='$unique_id_me'";
    echo "11";
}else{
    $SQL2 = "UPDATE `registration` SET `locking`= 0 WHERE `unique_id`='$unique_id_me'";
    echo "10";
}
mysqli_query($connection, $SQL2);
