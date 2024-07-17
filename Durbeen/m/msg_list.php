<?php
include './header.php';




//message notification
$SQLnotify = "SELECT * FROM `$unique_id_me notify` WHERE `seen`='0'";
$runnotify = mysqli_query($durbeen_chats, $SQLnotify);

$number = mysqli_num_rows($runnotify);

if ($number > 0) {
    ?>
<a style="position: fixed;left: 1%;top: 61px;z-index: 15" href="./all_msg.php?type=all_msg" class="btn btn-sm btn-danger">You
    Have
    <?php echo $number ?> New Messages</a>

<?php } ?>










<!-- main page -->

<div class="container" style="margin-top: 112px">
    <h6 class="text-center">Message List</h6>

    <!-- Chatbar start -->

    <ul style="list-style-type: none">
        <?php
        $SQL11 = "SELECT * FROM `$unique_id_me chats` ORDER BY `id` DESC";
        $run11 = mysqli_query($durbeen_chats, $SQL11);

        while ($data11 = mysqli_fetch_assoc($run11)) {

            $unique_id_fr_chats = $data11['unique_id_fr'];

            $SQL21 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_fr_chats'";
            $run21 = mysqli_query($connection, $SQL21);
            $data21 = mysqli_fetch_assoc($run21);


            ?>

        <li style="margin-bottom: 5px">
            <a class="text-decoration-none" href="message.php?type&unique_id_fr=<?php echo $data21['unique_id'] ?>">
                <div class="hover_chatbar_mobile">

                    <img class="float-start me-3" style="border-radius: 50%" width="50px" height="50px" src="../pro_pic/<?php echo $data21['pro_pic'] ?>" alt="">
                    <img src="../img/<?php $data21['active'] == 1 ? printf("green_dot.png") : printf("red_dot.jpg") ?>" style="border: 1px solid black;border-radius: 50%;margin-top: 37px;margin-left: -31px" width="12px" alt="">
                    <h5 class="text-" style="margin-top: -37px;margin-left: 68px">
                        <?php echo $data21['name'] ?>
                    </h5>

                </div>
            </a>
        </li>

        <?php } ?>

    </ul>

    <!-- Chatbar end -->






    <script>

    </script>

</div>










<?php
include './footer.php'
?>
