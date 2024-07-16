<?php

include '../../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);
$unique_id_fr = $data['unique_id_fr'];


$SQLF = "SELECT * FROM `admin` WHERE `unique_id`='$unique_id_fr'";
$runF = mysqli_query($connection,$SQLF);
$countF = mysqli_num_rows($runF);




if($countF == 0){
    $SQL1 = "INSERT INTO `admin`(`unique_id`) VALUES ('$unique_id_fr')";
    mysqli_query($connection,$SQL1);


    echo "1";
}else{
    $SQL2 = "DELETE FROM `admin` WHERE `unique_id`='$unique_id_fr'";
    mysqli_query($connection,$SQL2);


    echo "0";
}







