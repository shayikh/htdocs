<?php
include './Durbeen/connection.php';

$SQL1 = "SELECT * FROM `registration`";
$run1 = mysqli_query($connection,$SQL1);




for($unique_id = 1; $unique_id <= 100; $unique_id++){

    $my_name = "Md Mehrab Alam Shayikh";
    $unique_id_me = 1;
    $unique_id_fr = 2;

    //notification sql
    
    $SQL3 = "INSERT INTO `$unique_id_fr notify`(`sender`, `sender_id`, `seen`) VALUES ('$my_name','$unique_id_me','0')";
    mysqli_query($connection_info, $SQL3);
}

