<?php

include '../../connection.php';

$unique_id_me = $_POST['unique_id'];

$SQLabout = "SELECT * FROM `about` WHERE `unique_id`='$unique_id_me'";
$runAbout = mysqli_query($connection,$SQLabout);
$dataAbout = mysqli_fetch_assoc($runAbout);


$answer_one = trim($_POST['answer_one']);
$answer_two = trim($_POST['answer_two']);
$answer_three = trim($_POST['answer_three']);

$SQL1 = "SELECT * FROM `about` WHERE `answer_one`='$answer_one' AND `answer_two`='$answer_two' AND `answer_three`='$answer_three'";
$run1 = mysqli_query($connection,$SQL1);
$count = mysqli_num_rows($run1);



if ($count > 0){
  $SQL1 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_me'";
  $run1 = mysqli_query($connection,$SQL1);
  $data1 = mysqli_fetch_assoc($run1);
  $password = $data1['password'];

  echo json_encode(["password" => $password]);
}else{
  echo json_encode(["password" => "Wrong Answer"]);
}

