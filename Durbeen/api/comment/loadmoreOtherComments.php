<?php
include '../../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);
$page_no = $data['page_no'];
$unique_id_me = $data['unique_id_me'];





$limit = 10;
$row = ($page_no - 1)*$limit;

$SQL = "SELECT * FROM `comment` WHERE `post_giver_id`='$unique_id_me' AND `comn_giver_id`!='$unique_id_me' ORDER BY `id` DESC LIMIT $row,$limit";
$run = mysqli_query($connection,$SQL);


$comments = [];

while ($singleComment = mysqli_fetch_assoc($run)) {
    array_push($comments, $singleComment);
}
echo json_encode($comments);



?>







