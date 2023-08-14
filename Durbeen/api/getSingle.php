<?php
include '../connection.php';



$email = $_POST['email'];


$SQL = "SELECT * FROM `registration` WHERE `email`='$email'";
$run = mysqli_query($connection, $SQL);
$Data = mysqli_fetch_assoc($run);

echo json_encode(array("singleUser" => $Data));
















