<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$unique_id_me = $data['unique_id_me'];



$SQL9 = "SELECT * FROM `$unique_id_me to $unique_id_me`";
$run9 = mysqli_query($connection_message, $SQL9);

while ($data9 = mysqli_fetch_assoc($run9)) {
    $imgNameinDB = $data9['image'];
    if ($imgNameinDB != '') {
        unlink('../../note_image/'.$imgNameinDB);
    }
}

$SQL10 = "TRUNCATE TABLE `$unique_id_me to $unique_id_me`";
mysqli_query($connection_message, $SQL10);


echo "1";
