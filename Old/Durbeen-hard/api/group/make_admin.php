<?php

include '../../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);


$unique_id_me = $data['unique_id_me'];
$unique_id_fr = $data['unique_id_fr'];
$grp_id = $data['grp_id'];


$SQLF = "SELECT * FROM `group $grp_id members` WHERE `memberId`='$unique_id_fr' AND `admin`='1'";
$runF = mysqli_query($connection_message,$SQLF);
$countF = mysqli_num_rows($runF);




if($countF == 0){
    $SQL1 = "UPDATE `group $grp_id members` SET `admin`='1' WHERE `memberId`='$unique_id_fr'";
    mysqli_query($connection_message,$SQL1);


    echo "1";
}else{
    $SQL2 = "UPDATE `group $grp_id members` SET `admin`='0' WHERE `memberId`='$unique_id_fr'";
    mysqli_query($connection_message,$SQL2);


    echo "0";
}







