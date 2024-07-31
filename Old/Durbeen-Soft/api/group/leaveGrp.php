<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);


$unique_id_me = $data['unique_id_me'];
$grp_id = $data['grp_id'];



$SQL2 = "DELETE FROM `group $grp_id members` WHERE `memberId`='$unique_id_me'";
mysqli_query($connection_message,$SQL2);

$SQL1 = "DELETE FROM `$unique_id_me msg_grp` WHERE `grp_id`='$grp_id'";
mysqli_query($connection_info,$SQL1);


echo "1";








