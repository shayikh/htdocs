<?php
include './header.php';

$SQL1 = "SELECT * FROM `$unique_id_me notify` ORDER BY `id` DESC";
$run1 = mysqli_query($con_notification, $SQL1);

?>





<!-- main page -->
<div class="container" style="margin-top:170px">
    <p style="font-size: 20px;" class="text-center">Latest Messages From Your Friends</p><br>
    <?php
    while ($data1 = mysqli_fetch_assoc($run1)) {
        $friend_name = $data1['sender'];
        $unique_id_fr = $data1['sender_id'];
        $seen = $data1['seen'];

        $SQL2 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_fr'";
        $run2 = mysqli_query($connection, $SQL2);
        $data2 = mysqli_fetch_assoc($run2);

        $pro_pic_fr = $data2['pro_pic'];

        ?>

    <img class="float-start" style="border-radius: 50%; margin-top: -5px" width="40px" height="40px" src="./pro_pic/<?php echo $pro_pic_fr ?>" alt="">
    <a href="message.php?type&unique_id_fr=<?php echo $unique_id_fr ?>" class="text-decoration-none">
        <p style="font-size: 18px;padding: 1px 15px;<?php $data1['seen'] == 0 ? printf("background-color: #377655;padding: 10px 15px;") : "" ?>">
            <span class="text-white"><?php $data1['seen'] == 1 ? printf("(Seen) ") : printf("(Unseen) ") ?></span><span class="text-white"><?php echo $friend_name ?></span><span class="text-<?php $data2['active'] == 1 ? printf("green") : printf("red") ?>"><?php $data2['active'] == 1 ? printf(" (Active)") : printf(" (Inactive)") ?></span><span class="text-white"> sent you a message</span>
        </p>
    </a>
    <br>


    <?php } ?>


    <?php
    include './footer.php'
    ?>
