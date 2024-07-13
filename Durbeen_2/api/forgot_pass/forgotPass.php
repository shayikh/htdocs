<?php
include '../../connection.php';


$EmailMe = $_POST['email'];

$SQL1 = "SELECT * FROM `registration` WHERE `email`='$EmailMe'";
$run1 = mysqli_query($connection,$SQL1);
$data1 = mysqli_fetch_assoc($run1);
$count = mysqli_num_rows($run1);



if ($count > 0){
  $pro_pic = $data1['pro_pic'];
  $unique_id_me = $data1['unique_id'];

  $SQLabout = "SELECT * FROM `about` WHERE `unique_id`='$unique_id_me'";
  $runAbout = mysqli_query($connection,$SQLabout);
  $dataAbout = mysqli_fetch_assoc($runAbout);

  echo json_encode(["questions" => $dataAbout, "pro_pic" => $pro_pic]);
}
else{
  echo json_encode(["questions" => "Account Not Found"]);
}











