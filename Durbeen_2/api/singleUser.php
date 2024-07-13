<?php
include '../connection.php';



$email = $_POST['email'];


$SQL = "SELECT * FROM `registration` WHERE `email`='$email'";
$run = mysqli_query($connection, $SQL);
$data = mysqli_fetch_assoc($run);
$count = mysqli_num_rows($run);

if($count == 0){
    echo "0";
}else{
    echo json_encode(array("singleUser" => $data));
}


















