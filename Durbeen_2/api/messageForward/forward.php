<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);



$typical_id = $data['typical_id'];
$unique_id_me = $data['unique_id_me'];
$from_id = $data['from_id'];
$to_id = $data['to_id'];
$message_id = $data['message_id'];


$SQLMe = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_me'";
$runMe = mysqli_query($connection, $SQLMe);
$dataMe = mysqli_fetch_assoc($runMe);
$MyName = $dataMe['name'];
$MyProPic = $dataMe['pro_pic'];









































if($typical_id == 33){
    
    //create two table if not exist
    if($unique_id_me < $to_id){
        $SQLcreateMe = "CREATE TABLE IF NOT EXISTS `$unique_id_me to $to_id` (
            `id` bigint(255) unsigned NOT NULL auto_increment,
            `sender` bigint(255),
            `message` longtext,
            `image` varchar(1000),
            `time` varchar(1000),
            `seen` varchar(1000),
            PRIMARY KEY  (`id`)
        )";
    }else{
        $SQLcreateMe = "CREATE TABLE IF NOT EXISTS `$to_id to $unique_id_me` (
            `id` bigint(255) unsigned NOT NULL auto_increment,
            `sender` bigint(255),
            `message` longtext,
            `image` varchar(1000),
            `time` varchar(1000),
            `seen` varchar(1000),
            PRIMARY KEY  (`id`)
        )";
    }
    mysqli_query($connection_message, $SQLcreateMe);
    //table creation end


    //chat friend start
    $SQL3 = "SELECT * FROM `$unique_id_me chats` WHERE `unique_id_fr`='$to_id' AND `chat_type`='3'";
    $run3 = mysqli_query($connection_info, $SQL3);
    $count3 = mysqli_num_rows($run3);

    if ($count3 == 0) {
        $SQL16 = "INSERT INTO `$unique_id_me chats`(`unique_id_fr`, `chat_type`) VALUES ('$to_id', '3')";
        mysqli_query($connection_info, $SQL16);
    }


    $SQL4 = "SELECT * FROM `$to_id chats` WHERE `unique_id_fr`='$unique_id_me' AND `chat_type`='3'";
    $run4 = mysqli_query($connection_info, $SQL4);
    $count4 = mysqli_num_rows($run4);

    if ($count4 == 0) {
        $SQL5 = "INSERT INTO `$to_id chats`(`unique_id_fr`, `chat_type`) VALUES ('$unique_id_me', '3')";
        mysqli_query($connection_info, $SQL5);
    }








    if($unique_id_me < $from_id){
        $SQL2 = "SELECT * FROM `$unique_id_me to $from_id` WHERE `id`='$message_id'";
    }else{
        $SQL2 = "SELECT * FROM `$from_id to $unique_id_me` WHERE `id`='$message_id'";
    }
    $run1 = mysqli_query($connection_message, $SQL2);
    $data1 = mysqli_fetch_assoc($run1);

    $message = $data1['message'];
    $message = mysqli_real_escape_string($connection_message, $message);
    $image = $data1['image'];


    date_default_timezone_set("Asia/Dhaka");
    $time = "The time in " . date_default_timezone_get() . " is " . date("d-M-Y-D-h:i:s a");


    if ($image != ""){
        $extension = pathinfo($image, PATHINFO_EXTENSION);
        $imageNewName = uniqid().'_'.date("d_M_Y_D_h_i_s_a").'.'.$extension;
        $oldPath = "../../chat_image/".$image;
        $newPath = "../../chat_image/".$imageNewName;

        $copied = copy($oldPath , $newPath);
    }else{
        $imageNewName = "";
    }







    if($unique_id_me < $to_id){
        $SQL1 = "INSERT INTO `$unique_id_me to $to_id`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('$unique_id_me','$message','$imageNewName','$time','Unseen')";
    }else{
        $SQL1 = "INSERT INTO `$to_id to $unique_id_me`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('$unique_id_me','$message','$imageNewName','$time','Unseen')";
    }
    mysqli_query($connection_message, $SQL1);



    //notification sql

    $SQL3 = "INSERT INTO `$to_id notify`(`sender`, `sender_id`, `seen`) VALUES ('$MyName','$unique_id_me','0')";
    mysqli_query($connection_info, $SQL3);




    echo "3";
}elseif($typical_id == 32){




    if($unique_id_me < $from_id){
        $SQL2 = "SELECT * FROM `$unique_id_me to $from_id` WHERE `id`='$message_id'";
    }else{
        $SQL2 = "SELECT * FROM `$from_id to $unique_id_me` WHERE `id`='$message_id'";
    }
    $run1 = mysqli_query($connection_message, $SQL2);
    $data1 = mysqli_fetch_assoc($run1);

    $message = $data1['message'];
    $message = mysqli_real_escape_string($connection_message, $message);
    $image = $data1['image'];


    date_default_timezone_set("Asia/Dhaka");
    $time = "The time in " . date_default_timezone_get() . " is " . date("d-M-Y-D-h:i:s a");


    if ($image != ""){
        $extension = pathinfo($image, PATHINFO_EXTENSION);
        $imageNewName = uniqid().'_'.date("d_M_Y_D_h_i_s_a").'.'.$extension;
        $oldPath = "../../chat_image/".$image;
        $newPath = "../../grp_image/".$imageNewName;

        $copied = copy($oldPath , $newPath);
    }else{
        $imageNewName = "";
    }








    $SQL1 = "INSERT INTO `group $to_id`(`senderName`, `senderId`, `senderProPic`, `message`, `image`, `time`) VALUES ('$MyName','$unique_id_me','$MyProPic','$message','$imageNewName','$time')";
    mysqli_query($connection_message, $SQL1);


    echo "2";


}elseif($typical_id == 31){


    if($unique_id_me < $from_id){
        $SQL2 = "SELECT * FROM `$unique_id_me to $from_id` WHERE `id`='$message_id'";
    }else{
        $SQL2 = "SELECT * FROM `$from_id to $unique_id_me` WHERE `id`='$message_id'";
    }
    $run1 = mysqli_query($connection_message, $SQL2);
    $data1 = mysqli_fetch_assoc($run1);

    $message = $data1['message'];
    $message = mysqli_real_escape_string($connection_message, $message);
    $image = $data1['image'];


    date_default_timezone_set("Asia/Dhaka");
    $time = "The time in " . date_default_timezone_get() . " is " . date("d-M-Y-D-h:i:s a");


    if ($image != ""){
        $extension = pathinfo($image, PATHINFO_EXTENSION);
        $imageNewName = uniqid().'_'.date("d_M_Y_D_h_i_s_a").'.'.$extension;
        $oldPath = "../../chat_image/".$image;
        $newPath = "../../note_image/".$imageNewName;

        $copied = copy($oldPath , $newPath);
    }else{
        $imageNewName = "";
    }








    $SQL1 = "INSERT INTO `$unique_id_me to $unique_id_me`(`message`, `image`, `time`) VALUES ('$message','$imageNewName','$time')";
    mysqli_query($connection_message, $SQL1);



    echo "1";
}



































elseif($typical_id == 23){
    
    //create two table if not exist
    if($unique_id_me < $to_id){
        $SQLcreateMe = "CREATE TABLE IF NOT EXISTS `$unique_id_me to $to_id` (
            `id` bigint(255) unsigned NOT NULL auto_increment,
            `sender` bigint(255),
            `message` longtext,
            `image` varchar(1000),
            `time` varchar(1000),
            `seen` varchar(1000),
            PRIMARY KEY  (`id`)
        )";
    }else{
        $SQLcreateMe = "CREATE TABLE IF NOT EXISTS `$to_id to $unique_id_me` (
            `id` bigint(255) unsigned NOT NULL auto_increment,
            `sender` bigint(255),
            `message` longtext,
            `image` varchar(1000),
            `time` varchar(1000),
            `seen` varchar(1000),
            PRIMARY KEY  (`id`)
        )";
    }
    mysqli_query($connection_message, $SQLcreateMe);
    //table creation end


    //chat friend start
    $SQL3 = "SELECT * FROM `$unique_id_me chats` WHERE `unique_id_fr`='$to_id' AND `chat_type`='3'";
    $run3 = mysqli_query($connection_info, $SQL3);
    $count3 = mysqli_num_rows($run3);

    if ($count3 == 0) {
        $SQL16 = "INSERT INTO `$unique_id_me chats`(`unique_id_fr`, `chat_type`) VALUES ('$to_id', '3')";
        mysqli_query($connection_info, $SQL16);
    }


    $SQL4 = "SELECT * FROM `$to_id chats` WHERE `unique_id_fr`='$unique_id_me' AND `chat_type`='3'";
    $run4 = mysqli_query($connection_info, $SQL4);
    $count4 = mysqli_num_rows($run4);

    if ($count4 == 0) {
        $SQL5 = "INSERT INTO `$to_id chats`(`unique_id_fr`, `chat_type`) VALUES ('$unique_id_me', '3')";
        mysqli_query($connection_info, $SQL5);
    }









    $SQL2 = "SELECT * FROM `group $from_id` WHERE `id`='$message_id'";

    $run1 = mysqli_query($connection_message, $SQL2);
    $data1 = mysqli_fetch_assoc($run1);

    $message = $data1['message'];
    $message = mysqli_real_escape_string($connection_message, $message);
    $image = $data1['image'];


    date_default_timezone_set("Asia/Dhaka");
    $time = "The time in " . date_default_timezone_get() . " is " . date("d-M-Y-D-h:i:s a");


    if ($image != ""){
        $extension = pathinfo($image, PATHINFO_EXTENSION);
        $imageNewName = uniqid().'_'.date("d_M_Y_D_h_i_s_a").'.'.$extension;
        $oldPath = "../../grp_image/".$image;
        $newPath = "../../chat_image/".$imageNewName;

        $copied = copy($oldPath , $newPath);
    }else{
        $imageNewName = "";
    }







    if($unique_id_me < $to_id){
        $SQL1 = "INSERT INTO `$unique_id_me to $to_id`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('$unique_id_me','$message','$imageNewName','$time','Unseen')";
    }else{
        $SQL1 = "INSERT INTO `$to_id to $unique_id_me`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('$unique_id_me','$message','$imageNewName','$time','Unseen')";
    }
    mysqli_query($connection_message, $SQL1);



    //notification sql

    $SQL3 = "INSERT INTO `$to_id notify`(`sender`, `sender_id`, `seen`) VALUES ('$MyName','$unique_id_me','0')";
    mysqli_query($connection_info, $SQL3);




    echo "3";
}elseif($typical_id == 22){


    $SQL2 = "SELECT * FROM `group $from_id` WHERE `id`='$message_id'";

    $run1 = mysqli_query($connection_message, $SQL2);
    $data1 = mysqli_fetch_assoc($run1);

    $message = $data1['message'];
    $message = mysqli_real_escape_string($connection_message, $message);
    $image = $data1['image'];


    date_default_timezone_set("Asia/Dhaka");
    $time = "The time in " . date_default_timezone_get() . " is " . date("d-M-Y-D-h:i:s a");


    if ($image != ""){
        $extension = pathinfo($image, PATHINFO_EXTENSION);
        $imageNewName = uniqid().'_'.date("d_M_Y_D_h_i_s_a").'.'.$extension;
        $oldPath = "../../grp_image/".$image;
        $newPath = "../../grp_image/".$imageNewName;

        $copied = copy($oldPath , $newPath);
    }else{
        $imageNewName = "";
    }








    $SQL1 = "INSERT INTO `group $to_id`(`senderName`, `senderId`, `senderProPic`, `message`, `image`, `time`) VALUES ('$MyName','$unique_id_me','$MyProPic','$message','$imageNewName','$time')";
    mysqli_query($connection_message, $SQL1);


    echo "2";


}elseif($typical_id == 21){


    $SQL2 = "SELECT * FROM `group $from_id` WHERE `id`='$message_id'";

    $run1 = mysqli_query($connection_message, $SQL2);
    $data1 = mysqli_fetch_assoc($run1);

    $message = $data1['message'];
    $message = mysqli_real_escape_string($connection_message, $message);
    $image = $data1['image'];


    date_default_timezone_set("Asia/Dhaka");
    $time = "The time in " . date_default_timezone_get() . " is " . date("d-M-Y-D-h:i:s a");


    if ($image != ""){
        $extension = pathinfo($image, PATHINFO_EXTENSION);
        $imageNewName = uniqid().'_'.date("d_M_Y_D_h_i_s_a").'.'.$extension;
        $oldPath = "../../grp_image/".$image;
        $newPath = "../../note_image/".$imageNewName;

        $copied = copy($oldPath , $newPath);
    }else{
        $imageNewName = "";
    }








    $SQL1 = "INSERT INTO `$unique_id_me to $unique_id_me`(`message`, `image`, `time`) VALUES ('$message','$imageNewName','$time')";
    mysqli_query($connection_message, $SQL1);


    echo "1";
}



































elseif($typical_id == 13){
    
    //create two table if not exist
    if($unique_id_me < $to_id){
        $SQLcreateMe = "CREATE TABLE IF NOT EXISTS `$unique_id_me to $to_id` (
            `id` bigint(255) unsigned NOT NULL auto_increment,
            `sender` bigint(255),
            `message` longtext,
            `image` varchar(1000),
            `time` varchar(1000),
            `seen` varchar(1000),
            PRIMARY KEY  (`id`)
        )";
    }else{
        $SQLcreateMe = "CREATE TABLE IF NOT EXISTS `$to_id to $unique_id_me` (
            `id` bigint(255) unsigned NOT NULL auto_increment,
            `sender` bigint(255),
            `message` longtext,
            `image` varchar(1000),
            `time` varchar(1000),
            `seen` varchar(1000),
            PRIMARY KEY  (`id`)
        )";
    }
    mysqli_query($connection_message, $SQLcreateMe);
    //table creation end


    //chat friend start
    $SQL3 = "SELECT * FROM `$unique_id_me chats` WHERE `unique_id_fr`='$to_id' AND `chat_type`='3'";
    $run3 = mysqli_query($connection_info, $SQL3);
    $count3 = mysqli_num_rows($run3);

    if ($count3 == 0) {
        $SQL16 = "INSERT INTO `$unique_id_me chats`(`unique_id_fr`, `chat_type`) VALUES ('$to_id', '3')";
        mysqli_query($connection_info, $SQL16);
    }


    $SQL4 = "SELECT * FROM `$to_id chats` WHERE `unique_id_fr`='$unique_id_me' AND `chat_type`='3'";
    $run4 = mysqli_query($connection_info, $SQL4);
    $count4 = mysqli_num_rows($run4);

    if ($count4 == 0) {
        $SQL5 = "INSERT INTO `$to_id chats`(`unique_id_fr`, `chat_type`) VALUES ('$unique_id_me', '3')";
        mysqli_query($connection_info, $SQL5);
    }









    $SQL2 = "SELECT * FROM `$unique_id_me to $unique_id_me` WHERE `id`='$message_id'";

    $run1 = mysqli_query($connection_message, $SQL2);
    $data1 = mysqli_fetch_assoc($run1);

    $message = $data1['message'];
    $message = mysqli_real_escape_string($connection_message, $message);
    $image = $data1['image'];


    date_default_timezone_set("Asia/Dhaka");
    $time = "The time in " . date_default_timezone_get() . " is " . date("d-M-Y-D-h:i:s a");


    if ($image != ""){
        $extension = pathinfo($image, PATHINFO_EXTENSION);
        $imageNewName = uniqid().'_'.date("d_M_Y_D_h_i_s_a").'.'.$extension;
        $oldPath = "../../note_image/".$image;
        $newPath = "../../chat_image/".$imageNewName;

        $copied = copy($oldPath , $newPath);
    }else{
        $imageNewName = "";
    }







    if($unique_id_me < $to_id){
        $SQL1 = "INSERT INTO `$unique_id_me to $to_id`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('$unique_id_me','$message','$imageNewName','$time','Unseen')";
    }else{
        $SQL1 = "INSERT INTO `$to_id to $unique_id_me`(`sender`, `message`, `image`, `time`, `seen`) VALUES ('$unique_id_me','$message','$imageNewName','$time','Unseen')";
    }
    mysqli_query($connection_message, $SQL1);



    //notification sql

    $SQL3 = "INSERT INTO `$to_id notify`(`sender`, `sender_id`, `seen`) VALUES ('$MyName','$unique_id_me','0')";
    mysqli_query($connection_info, $SQL3);




    echo "3";
}elseif($typical_id == 12){


    $SQL2 = "SELECT * FROM `$unique_id_me to $unique_id_me` WHERE `id`='$message_id'";

    $run1 = mysqli_query($connection_message, $SQL2);
    $data1 = mysqli_fetch_assoc($run1);

    $message = $data1['message'];
    $message = mysqli_real_escape_string($connection_message, $message);
    $image = $data1['image'];


    date_default_timezone_set("Asia/Dhaka");
    $time = "The time in " . date_default_timezone_get() . " is " . date("d-M-Y-D-h:i:s a");


    if ($image != ""){
        $extension = pathinfo($image, PATHINFO_EXTENSION);
        $imageNewName = uniqid().'_'.date("d_M_Y_D_h_i_s_a").'.'.$extension;
        $oldPath = "../../note_image/".$image;
        $newPath = "../../grp_image/".$imageNewName;

        $copied = copy($oldPath , $newPath);
    }else{
        $imageNewName = "";
    }








    $SQL1 = "INSERT INTO `group $to_id`(`senderName`, `senderId`, `senderProPic`, `message`, `image`, `time`) VALUES ('$MyName','$unique_id_me','$MyProPic','$message','$imageNewName','$time')";
    mysqli_query($connection_message, $SQL1);


    echo "2";


}elseif($typical_id == 11){


    $SQL2 = "SELECT * FROM `$unique_id_me to $unique_id_me` WHERE `id`='$message_id'";

    $run1 = mysqli_query($connection_message, $SQL2);
    $data1 = mysqli_fetch_assoc($run1);

    $message = $data1['message'];
    $message = mysqli_real_escape_string($connection_message, $message);
    $image = $data1['image'];


    date_default_timezone_set("Asia/Dhaka");
    $time = "The time in " . date_default_timezone_get() . " is " . date("d-M-Y-D-h:i:s a");


    if ($image != ""){
        $extension = pathinfo($image, PATHINFO_EXTENSION);
        $imageNewName = uniqid().'_'.date("d_M_Y_D_h_i_s_a").'.'.$extension;
        $oldPath = "../../note_image/".$image;
        $newPath = "../../note_image/".$imageNewName;

        $copied = copy($oldPath , $newPath);
    }else{
        $imageNewName = "";
    }








    $SQL1 = "INSERT INTO `$unique_id_me to $unique_id_me`(`message`, `image`, `time`) VALUES ('$message','$imageNewName','$time')";
    mysqli_query($connection_message, $SQL1);



    echo "1";
}











