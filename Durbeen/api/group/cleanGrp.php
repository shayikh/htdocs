<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$grp_id = $data['grp_id'];



$SQL9 = "SELECT * FROM `group $grp_id`";
$run9 = mysqli_query($connection_message, $SQL9);

while ($data9 = mysqli_fetch_assoc($run9)) {
    $imgNameinDB = $data9['image'];
    if ($imgNameinDB != '') {
        unlink('../../grp_image/'.$imgNameinDB);
    }
}

$SQL10 = "TRUNCATE TABLE `group $grp_id`";
mysqli_query($connection_message, $SQL10);


echo "1";
