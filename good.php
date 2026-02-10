<?php
include '../connection.php';


for($i=1; $i<=30; $i++){

    $SQL2 = "UPDATE `$i chats` SET `unique_id_fr`='$i' WHERE `chat_type`='1';";
    mysqli_query($connection_info, $SQL2);

}