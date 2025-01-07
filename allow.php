<?php
include './connection.php';



$SQL1 = "SELECT * FROM `registration`";
$run1 = mysqli_query($connection,$SQL1);




while ($data1 = mysqli_fetch_assoc($run1)){
    $unique_id = $data1['unique_id'];



    $SQLcreate = "CREATE TABLE IF NOT EXISTS `$unique_id allow` (
        `id` bigint(255) unsigned NOT NULL auto_increment,
        `unique_id_fr` bigint(255),
        PRIMARY KEY  (`id`)
    )";
    mysqli_query($connection_info, $SQLcreate);

}




for($i = 1; $i <= 10; $i++){
    echo 1;
}





