<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);



$unique_id_me = $data['unique_id_me'];
$grp_id = $data['grp_id'];

$SQL4 = "SELECT * FROM `group $grp_id members` WHERE `memberId`='$unique_id_me' AND `admin`='1'";
$run4 = mysqli_query($connection_message, $SQL4);
$count4 = mysqli_num_rows($run4);

$SQL3 = "SELECT * FROM `group $grp_id members` WHERE `admin`='1'";
$run3 = mysqli_query($connection_message, $SQL3);
$count3 = mysqli_num_rows($run3);



if($count4 == 1 && $count3 == 1) {

    echo "0";

}else {

    $SQL2 = "DELETE FROM `group $grp_id members` WHERE `memberId`='$unique_id_me'";
    mysqli_query($connection_message,$SQL2);

    $SQL1 = "DELETE FROM `$unique_id_me msg_grp` WHERE `grp_id`='$grp_id'";
    mysqli_query($connection_info,$SQL1);

    $SQL3 = "DELETE FROM `$unique_id_me chats` WHERE `unique_id_fr`='$grp_id' AND `chat_type`='2'";
    mysqli_query($connection_info,$SQL3);

    echo "1";

}










