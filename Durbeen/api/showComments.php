<?php

include '../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);


$postid = $data['postid'];


$SQL1 = "SELECT * FROM `comment` WHERE `post_id`='$postid' ORDER BY `id` DESC";
$run1 = mysqli_query($connection, $SQL1);

$comments = [];

while ($singleComment = mysqli_fetch_assoc($run1)) {
    array_push($comments, $singleComment);
}
echo json_encode($comments);











