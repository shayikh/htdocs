<?php
include '../../connection.php';


$post = $_POST['editPost'];
$post = mysqli_real_escape_string($connection, $post);
$unique_id_me = $_POST['edit_unique_id_me'];
$post_id = $_POST['edit_post_id'];


$SQL1 = "SELECT * FROM `post` WHERE `id`='$post_id'";
$run1 = mysqli_query($connection, $SQL1);
$data1 = mysqli_fetch_assoc($run1);


$user_id = $data1['unique_id'];

if ($user_id == $unique_id_me) {
    $imgNameinDB = $data1['image'];


    date_default_timezone_set("Asia/Dhaka");
    $time = date_default_timezone_get() . ' time: ' . date("d-M-Y-D-h:i:s a");

    if ($_FILES['editImage']['name']) {
        if ($imgNameinDB != ""){
            unlink('../../post_image/' . $imgNameinDB);
        }

        $imageOldName = $_FILES['editImage']['name'];
        $imageNewName = uniqid() . '_' . date("Y-M-H-i-s") . '_' . $imageOldName;
        $image_tmp = $_FILES['editImage']['tmp_name'];
        move_uploaded_file($image_tmp, '../../post_image/' . $imageNewName);
    } else {
        $imageNewName = $imgNameinDB;
    }


    $SQL2 = "UPDATE `post` SET `image`='$imageNewName',`time`='$time',`post`='$post' WHERE `id`='$post_id' AND `unique_id`='$unique_id_me'";
    mysqli_query($connection, $SQL2);


    $SQL3 = "SELECT * FROM `post` WHERE `id`='$post_id' AND `unique_id`='$unique_id_me'";
    $run3 = mysqli_query($connection, $SQL3);
    $latestData = mysqli_fetch_assoc($run3);

    echo json_encode(["unique_id_me" => $unique_id_me, "updatedPost" => $latestData]);

}

















