<?php

include '../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);


$postid = $data['postid'];


$SQL = "SELECT * FROM `comment` WHERE `post_id`='$postid' ORDER BY `id` DESC";
$run = mysqli_query($connection, $SQL);

$comments = [];

while ($singleComment = mysqli_fetch_assoc($run)) {
    array_push($comments, $singleComment);
}
echo json_encode($comments);











