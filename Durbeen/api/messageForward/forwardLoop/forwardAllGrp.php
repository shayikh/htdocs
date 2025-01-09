<?php
include '../../../connection.php';



$typical_id = $_POST['typical_id'];
$unique_id_me = $_POST['unique_id_me'];
$from_id = $_POST['from_id'];
$message_id = $_POST['hidden_message_id'];


$SQLMe = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_me'";
$runMe = mysqli_query($connection, $SQLMe);
$dataMe = mysqli_fetch_assoc($runMe);
$MyName = $dataMe['name'];
$MyProPic = $dataMe['pro_pic'];














if($typical_id == 1){

    $SQL2 = "SELECT * FROM `$unique_id_me to $unique_id_me` WHERE `id`='$message_id'";

    $run1 = mysqli_query($connection_message, $SQL2);
    $data1 = mysqli_fetch_assoc($run1);

    $message = $data1['message'];
    $image = $data1['image'];


    date_default_timezone_set("Asia/Dhaka");
    $time = "The time in " . date_default_timezone_get() . " is " . date("d-M-Y-D-h:i:s a");





    if ($image != ""){
        $extension = pathinfo($image, PATHINFO_EXTENSION);



        $SQL = "SELECT * FROM `$unique_id_me msg_grp`";
        $run = mysqli_query($connection_info,$SQL);

        while ($data1 = mysqli_fetch_assoc($run)){
            $grp_id = $data1['grp_id'];

            $imageNewName = uniqid().'_'.date("d_M_Y_D_h_i_s_a").'_grp_id_'.$grp_id.'.'.$extension;

            $oldPath = "../../../note_image/".$image;
            $newPath = "../../../grp_image/".$imageNewName;
            $copied = copy($oldPath , $newPath);

            $SQL1 = "INSERT INTO `group $grp_id`(`senderName`, `senderId`, `senderProPic`, `message`, `image`, `time`) VALUES ('$MyName','$unique_id_me','$MyProPic','$message','$imageNewName','$time')";
            mysqli_query($connection_message, $SQL1);
        }
    }else{
        $imageNewName = "";

        $SQL = "SELECT * FROM `$unique_id_me msg_grp`";
        $run = mysqli_query($connection_info,$SQL);

        while ($data1 = mysqli_fetch_assoc($run)){
            $grp_id = $data1['grp_id'];

            $SQL1 = "INSERT INTO `group $grp_id`(`senderName`, `senderId`, `senderProPic`, `message`, `image`, `time`) VALUES ('$MyName','$unique_id_me','$MyProPic','$message','$imageNewName','$time')";
            mysqli_query($connection_message, $SQL1);
        }
    }




    




}elseif($typical_id == 2){


    $SQL2 = "SELECT * FROM `group $from_id` WHERE `id`='$message_id'";

    $run1 = mysqli_query($connection_message, $SQL2);
    $data1 = mysqli_fetch_assoc($run1);

    $message = $data1['message'];
    $image = $data1['image'];


    date_default_timezone_set("Asia/Dhaka");
    $time = "The time in " . date_default_timezone_get() . " is " . date("d-M-Y-D-h:i:s a");


    if ($image != ""){
        $extension = pathinfo($image, PATHINFO_EXTENSION);




        $SQL = "SELECT * FROM `$unique_id_me msg_grp`";
        $run = mysqli_query($connection_info,$SQL);

        while ($data1 = mysqli_fetch_assoc($run)){
            $grp_id = $data1['grp_id'];

            $imageNewName = uniqid().'_'.date("d_M_Y_D_h_i_s_a").'_grp_id_'.$grp_id.'.'.$extension;

            $oldPath = "../../../grp_image/".$image;
            $newPath = "../../../grp_image/".$imageNewName;
            $copied = copy($oldPath , $newPath);

            $SQL1 = "INSERT INTO `group $grp_id`(`senderName`, `senderId`, `senderProPic`, `message`, `image`, `time`) VALUES ('$MyName','$unique_id_me','$MyProPic','$message','$imageNewName','$time')";
            mysqli_query($connection_message, $SQL1);
        }
    }else{
        $imageNewName = "";

        $SQL = "SELECT * FROM `$unique_id_me msg_grp`";
        $run = mysqli_query($connection_info,$SQL);

        while ($data1 = mysqli_fetch_assoc($run)){
            $grp_id = $data1['grp_id'];

            $SQL1 = "INSERT INTO `group $grp_id`(`senderName`, `senderId`, `senderProPic`, `message`, `image`, `time`) VALUES ('$MyName','$unique_id_me','$MyProPic','$message','$imageNewName','$time')";
            mysqli_query($connection_message, $SQL1);
        }
    }





}elseif($typical_id == 3){

    if($unique_id_me < $from_id){
        $SQL2 = "SELECT * FROM `$unique_id_me to $from_id` WHERE `id`='$message_id'";
    }else{
        $SQL2 = "SELECT * FROM `$from_id to $unique_id_me` WHERE `id`='$message_id'";
    }
    $run1 = mysqli_query($connection_message, $SQL2);
    $data1 = mysqli_fetch_assoc($run1);

    $message = $data1['message'];
    $image = $data1['image'];

    date_default_timezone_set("Asia/Dhaka");
    $time = "The time in " . date_default_timezone_get() . " is " . date("d-M-Y-D-h:i:s a");









    if ($image != ""){
        $extension = pathinfo($image, PATHINFO_EXTENSION);



        $SQL = "SELECT * FROM `$unique_id_me msg_grp`";
        $run = mysqli_query($connection_info,$SQL);

        while ($data1 = mysqli_fetch_assoc($run)){
            $grp_id = $data1['grp_id'];

            $imageNewName = uniqid().'_'.date("d_M_Y_D_h_i_s_a").'_grp_id_'.$grp_id.'.'.$extension;

            $oldPath = "../../../chat_image/".$image;
            $newPath = "../../../grp_image/".$imageNewName;
            $copied = copy($oldPath , $newPath);

            $SQL1 = "INSERT INTO `group $grp_id`(`senderName`, `senderId`, `senderProPic`, `message`, `image`, `time`) VALUES ('$MyName','$unique_id_me','$MyProPic','$message','$imageNewName','$time')";
            mysqli_query($connection_message, $SQL1);
        }
    }else{
        $imageNewName = "";

        $SQL = "SELECT * FROM `$unique_id_me msg_grp`";
        $run = mysqli_query($connection_info,$SQL);

        while ($data1 = mysqli_fetch_assoc($run)){
            $grp_id = $data1['grp_id'];

            $SQL1 = "INSERT INTO `group $grp_id`(`senderName`, `senderId`, `senderProPic`, `message`, `image`, `time`) VALUES ('$MyName','$unique_id_me','$MyProPic','$message','$imageNewName','$time')";
            mysqli_query($connection_message, $SQL1);
        }
    }

}