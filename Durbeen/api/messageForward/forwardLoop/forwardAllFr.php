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



        $SQL = "SELECT * FROM `$unique_id_me chats`";
        $run = mysqli_query($connection_info,$SQL);

        while ($data1 = mysqli_fetch_assoc($run)){
            $to_unique_id_fr = $data1['unique_id_fr'];

            $imageNewName = uniqid().'_'.date("d_M_Y_D_h_i_s_a").'_fr_id_'.$to_unique_id_fr.'.'.$extension;

            $oldPath = "../../../note_image/".$image;
            $newPath = "../../../chat_image/".$imageNewName;
            $copied = copy($oldPath , $newPath);


            if($unique_id_me < $to_unique_id_fr){
                $SQL1 = "INSERT INTO `$unique_id_me to $to_unique_id_fr`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('$unique_id_me','$message','$imageNewName','$time','Unseen')";
            }else{
                $SQL1 = "INSERT INTO `$to_unique_id_fr to $unique_id_me`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('$unique_id_me','$message','$imageNewName','$time','Unseen')";
            }
            mysqli_query($connection_message, $SQL1);
        
        
            //notification sql
        
            $SQL3 = "INSERT INTO `$to_unique_id_fr notify`(`sender`, `sender_id`, `seen`) VALUES ('$MyName','$unique_id_me','0')";
            mysqli_query($connection_info, $SQL3);
        }
    }else{
        $imageNewName = "";


        $SQL = "SELECT * FROM `$unique_id_me chats`";
        $run = mysqli_query($connection_info,$SQL);

        while ($data1 = mysqli_fetch_assoc($run)){
            $to_unique_id_fr = $data1['unique_id_fr'];

            if($unique_id_me < $to_unique_id_fr){
                $SQL1 = "INSERT INTO `$unique_id_me to $to_unique_id_fr`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('$unique_id_me','$message','$imageNewName','$time','Unseen')";
            }else{
                $SQL1 = "INSERT INTO `$to_unique_id_fr to $unique_id_me`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('$unique_id_me','$message','$imageNewName','$time','Unseen')";
            }
            mysqli_query($connection_message, $SQL1);
        
        
            //notification sql
        
            $SQL3 = "INSERT INTO `$to_unique_id_fr notify`(`sender`, `sender_id`, `seen`) VALUES ('$MyName','$unique_id_me','0')";
            mysqli_query($connection_info, $SQL3);
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



        $SQL = "SELECT * FROM `$unique_id_me chats`";
        $run = mysqli_query($connection_info,$SQL);

        while ($data1 = mysqli_fetch_assoc($run)){
            $to_unique_id_fr = $data1['unique_id_fr'];

            $imageNewName = uniqid().'_'.date("d_M_Y_D_h_i_s_a").'_fr_id_'.$to_unique_id_fr.'.'.$extension;

            $oldPath = "../../../grp_image/".$image;
            $newPath = "../../../chat_image/".$imageNewName;
            $copied = copy($oldPath , $newPath);


            if($unique_id_me < $to_unique_id_fr){
                $SQL1 = "INSERT INTO `$unique_id_me to $to_unique_id_fr`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('$unique_id_me','$message','$imageNewName','$time','Unseen')";
            }else{
                $SQL1 = "INSERT INTO `$to_unique_id_fr to $unique_id_me`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('$unique_id_me','$message','$imageNewName','$time','Unseen')";
            }
            mysqli_query($connection_message, $SQL1);
        
        
            //notification sql
        
            $SQL3 = "INSERT INTO `$to_unique_id_fr notify`(`sender`, `sender_id`, `seen`) VALUES ('$MyName','$unique_id_me','0')";
            mysqli_query($connection_info, $SQL3);
        }
    }else{
        $imageNewName = "";


        $SQL = "SELECT * FROM `$unique_id_me chats`";
        $run = mysqli_query($connection_info,$SQL);

        while ($data1 = mysqli_fetch_assoc($run)){
            $to_unique_id_fr = $data1['unique_id_fr'];

            if($unique_id_me < $to_unique_id_fr){
                $SQL1 = "INSERT INTO `$unique_id_me to $to_unique_id_fr`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('$unique_id_me','$message','$imageNewName','$time','Unseen')";
            }else{
                $SQL1 = "INSERT INTO `$to_unique_id_fr to $unique_id_me`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('$unique_id_me','$message','$imageNewName','$time','Unseen')";
            }
            mysqli_query($connection_message, $SQL1);
        
        
            //notification sql
        
            $SQL3 = "INSERT INTO `$to_unique_id_fr notify`(`sender`, `sender_id`, `seen`) VALUES ('$MyName','$unique_id_me','0')";
            mysqli_query($connection_info, $SQL3);
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




        $SQL = "SELECT * FROM `$unique_id_me chats`";
        $run = mysqli_query($connection_info,$SQL);

        while ($data1 = mysqli_fetch_assoc($run)){
            $to_unique_id_fr = $data1['unique_id_fr'];

            $imageNewName = uniqid().'_'.date("d_M_Y_D_h_i_s_a").'_fr_id_'.$to_unique_id_fr.'.'.$extension;
            
            $oldPath = "../../../chat_image/".$image;
            $newPath = "../../../chat_image/".$imageNewName;
            $copied = copy($oldPath , $newPath);


            if($unique_id_me < $to_unique_id_fr){
                $SQL1 = "INSERT INTO `$unique_id_me to $to_unique_id_fr`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('$unique_id_me','$message','$imageNewName','$time','Unseen')";
            }else{
                $SQL1 = "INSERT INTO `$to_unique_id_fr to $unique_id_me`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('$unique_id_me','$message','$imageNewName','$time','Unseen')";
            }
            mysqli_query($connection_message, $SQL1);
        
        
            //notification sql
        
            $SQL3 = "INSERT INTO `$to_unique_id_fr notify`(`sender`, `sender_id`, `seen`) VALUES ('$MyName','$unique_id_me','0')";
            mysqli_query($connection_info, $SQL3);
        }
    }else{
        $imageNewName = "";


        $SQL = "SELECT * FROM `$unique_id_me chats`";
        $run = mysqli_query($connection_info,$SQL);

        while ($data1 = mysqli_fetch_assoc($run)){
            $to_unique_id_fr = $data1['unique_id_fr'];

            if($unique_id_me < $to_unique_id_fr){
                $SQL1 = "INSERT INTO `$unique_id_me to $to_unique_id_fr`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('$unique_id_me','$message','$imageNewName','$time','Unseen')";
            }else{
                $SQL1 = "INSERT INTO `$to_unique_id_fr to $unique_id_me`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('$unique_id_me','$message','$imageNewName','$time','Unseen')";
            }
            mysqli_query($connection_message, $SQL1);
        
        
            //notification sql
        
            $SQL3 = "INSERT INTO `$to_unique_id_fr notify`(`sender`, `sender_id`, `seen`) VALUES ('$MyName','$unique_id_me','0')";
            mysqli_query($connection_info, $SQL3);
        }
    }




}