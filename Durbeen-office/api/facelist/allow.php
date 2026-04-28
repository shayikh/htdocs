<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);



$unique_id_me = $data['unique_id_me'];
$unique_id_fr = $data['unique_id_fr'];




$SQLA = "SELECT * FROM `$unique_id_me allow` WHERE `unique_id_fr`='$unique_id_fr'";
$runA = mysqli_query($connection_info, $SQLA);
$countA = mysqli_num_rows($runA);

$SQLfrF = "SELECT * FROM `$unique_id_fr follow` WHERE `unique_id_fr`='$unique_id_me'";
$runfrF = mysqli_query($connection_info, $SQLfrF);
$countfrF = mysqli_num_rows($runfrF);


$SQL13 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_me'";
$run13 = mysqli_query($connection,$SQL13);
$data13 = mysqli_fetch_assoc($run13);
$locking = $data13['locking'];

if ($locking == 1) {

  if($countA == 0){
    $SQL1 = "INSERT INTO `$unique_id_me allow`(`unique_id_fr`) VALUES ('$unique_id_fr')";
    mysqli_query($connection_info,$SQL1);
    
    echo "1";
  }else{
    $SQL1 = "DELETE FROM `$unique_id_me allow` WHERE `unique_id_fr`='$unique_id_fr'";
    mysqli_query($connection_info, $SQL1);

    if($countfrF == 1){
      $SQL2 = "DELETE FROM `$unique_id_fr follow` WHERE `unique_id_fr`='$unique_id_me'";
      mysqli_query($connection_info, $SQL2);
    }

    echo "2";
  }
}else{
  echo "3";
}










