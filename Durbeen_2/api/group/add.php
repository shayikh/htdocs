<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);


$unique_id_me = $data['unique_id_me'];
$unique_id_fr = $data['unique_id_fr'];
$grp_id = $data['grp_id'];


$SQLF = "SELECT * FROM `group $grp_id members` WHERE `memberId`='$unique_id_fr'";
$runF = mysqli_query($connection_message,$SQLF);
$countF = mysqli_num_rows($runF);






if($countF == 0){
  $SQL1 = "INSERT INTO `group $grp_id members`(`memberId`) VALUES ('$unique_id_fr')";
  mysqli_query($connection_message,$SQL1);


  $SQL1 = "INSERT INTO `$unique_id_fr msg_grp`(`grp_id`) VALUES ('$grp_id')";
  mysqli_query($connection_info,$SQL1);


  echo "1";
}else{
  $SQL2 = "DELETE FROM `group $grp_id members` WHERE `memberId`='$unique_id_fr'";
	mysqli_query($connection_message,$SQL2);

  $SQL1 = "DELETE FROM `$unique_id_fr msg_grp` WHERE `grp_id`='$grp_id'";
  mysqli_query($connection_info,$SQL1);


  echo "0";
}







