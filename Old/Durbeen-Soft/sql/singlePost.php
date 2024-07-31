<?php

include '../../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);


$post_id = $data['post_id'];


$SQL1 = "SELECT * FROM `post` WHERE `id`='$post_id'";
$run1 = mysqli_query($connection, $SQL1);
$post = mysqli_fetch_assoc($run1);



echo json_encode(["post" => $post]);


















