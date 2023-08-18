<?php
session_start();

echo '<title>দূরবীন</title>';
echo '<link rel="shortcut icon" href="./img/telescope.png" />';

include './connection.php';
$unique_id_me = $_SESSION['unique_id_me'];

$SQL1 = "UPDATE `registration` SET `active`='0' WHERE `unique_id`='$unique_id_me'";
mysqli_query($connection,$SQL1);


session_unset();
session_destroy();


echo "<script>window.location = './index.php?out'</script>";
?>