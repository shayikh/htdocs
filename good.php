<?php

$SQL1 = "SELECT * FROM `registration`";
$run1 = mysqli_query($connection,$SQL1);




for($unique_id = 1; $unique_id <= 16; $unique_id++){

    $SQL10 = "TRUNCATE TABLE `$unique_id allow`";
    mysqli_query($connection_info, $SQL10);

    $SQL10 = "TRUNCATE TABLE `$unique_id follow`";
    mysqli_query($connection_info, $SQL10);
}





for($unique_id = 1; $unique_id <= 16; $unique_id++){

    $SQL400 = "INSERT INTO `$unique_id follow`(`unique_id_fr`) VALUES ('$unique_id')";
    mysqli_query($connection_info, $SQL400);
}




for($unique_id = 2; $unique_id <= 16; $unique_id++){

    $SQL400 = "INSERT INTO `$unique_id follow`(`unique_id_fr`) VALUES ('1')";
    mysqli_query($connection_info, $SQL400);
}







for($unique_id = 2; $unique_id <= 16; $unique_id++){

    $SQL400 = "INSERT INTO `1 allow`(`unique_id_fr`) VALUES ('$unique_id')";
    mysqli_query($connection_info, $SQL400);
}