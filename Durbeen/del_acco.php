<?php
include './header.php';


if (isset($_POST['delete'])) {

    //post delete
    $SQL1 = "SELECT * FROM `post` WHERE `unique_id`='$unique_id_me'";
    $run1 = mysqli_query($connection, $SQL1);
    while ($data1 = mysqli_fetch_assoc($run1)) {
        $imgNameinDB = $data1['image'];
        unlink('./post_image/' . $imgNameinDB);

        $SQL2 = "DELETE FROM `post` WHERE `image`='$imgNameinDB'";
        mysqli_query($connection, $SQL2);
    }

    //self post comment delete 
    $SQL1 = "DELETE FROM `comment` WHERE `unique_id`='$unique_id_me'";
    $run1 = mysqli_query($connection, $SQL1);

    //other's post comment delete 
    $SQL1 = "DELETE FROM `comment` WHERE `unique_id_comn`='$unique_id_me'";
    $run1 = mysqli_query($connection, $SQL1);


    //notification table delete
    $SQL4 = "DROP TABLE `$unique_id_me notify`";
    mysqli_query($con_notification, $SQL4);

    //chat friend table delete
    $SQL4 = "DROP TABLE `$unique_id_me chats`";
    mysqli_query($durbeen_chats, $SQL4);


    //chat tables delete
    $SQL5 = "SELECT * FROM `registration` WHERE `unique_id`!='$unique_id_me'";
    $run5 = mysqli_query($connection, $SQL5);

    while ($data5 = mysqli_fetch_assoc($run5)) {

        $unique_id_fr = $data5['unique_id'];


        $SQL6 = "SELECT * FROM `$unique_id_me to $unique_id_fr`";
        $run = mysqli_query($connection_message, $SQL6);

        if ($run == true) {
            while ($data = mysqli_fetch_assoc($run)) {
                $imgNameinDB = $data['image'];
                if ($imgNameinDB != '') {
                    unlink('./chat_image/' . $imgNameinDB);
                }
            }
        }

        $SQL6 = "DROP TABLE IF EXISTS `$unique_id_me to $unique_id_fr`";
        mysqli_query($connection_message, $SQL6);


        $SQL6 = "SELECT * FROM `$unique_id_fr to $unique_id_me`";
        $run = mysqli_query($connection_message, $SQL6);

        if ($run == true) {
            while ($data = mysqli_fetch_assoc($run)) {
                $imgNameinDB = $data['image'];
                if ($imgNameinDB != '') {
                    unlink('./chat_image/' . $imgNameinDB);
                }
            }
        }

        $SQL7 = "DROP TABLE IF EXISTS `$unique_id_fr to $unique_id_me`";
        mysqli_query($connection_message, $SQL7);

    }


    //drop self msg table
    $SQL6 = "SELECT * FROM `$unique_id_me to $unique_id_me`";
    $run = mysqli_query($connection_message, $SQL6);

    if ($run == true) {
        while ($data = mysqli_fetch_assoc($run)) {
            $imgNameinDB = $data['image'];
            if ($imgNameinDB != '') {
                unlink('./chat_image/' . $imgNameinDB);
            }
        }
    }

    $SQL8 = "DROP TABLE IF EXISTS `$unique_id_me to $unique_id_me`";
    mysqli_query($connection_message, $SQL8);


    //about delete
    $SQL9 = "DELETE FROM `about` WHERE `unique_id`='$unique_id_me'";
    mysqli_query($connection, $SQL9);

    //account delete
    if ($dataMe['pro_pic'] != "red_comet.png") {
        $pro_pic_me = $dataMe['pro_pic'];
        unlink('./pro_pic/' . $pro_pic_me);
    }

    $SQL10 = "DELETE FROM `registration` WHERE `unique_id`='$unique_id_me'";
    mysqli_query($connection, $SQL10);


    session_unset();
    session_destroy();
    echo "<script>window.location = 'index.php'</script>";
}

?>


<!-- main page -->


<div class="container" style="margin-top: 170px">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-red text-center">ACCOUNT DELETION</h1>
        </div>
        <div class="col-md-12 mt-2">
            <h4 class="text-capitalize" style="line-height: 1.5;">deleting account once will permanently delete all data
                from database and you will never able to
                regain those data, even <span style="font-weight: 500;font-family: mahfuj;"
                                              class="text-red">দূরবীন</span> can not able to repair this. be careful
                before you continue.</h4>
            <!-- <form method="post" action="./del_acco.php?type=no"><input onclick="return confirm('Are You Sure You Want to Delete Your Account?')" name="delete" class="btn red mt-5 form-control" type="submit" value="&#9762; DELETE ACCOUNT PERMANENTLY &#9785;"></form> -->
        </div>
    </div>


    <?php if ($unique_id_me == 1) { ?>
        <div class="row" style="margin-bottom: 100px">
            <table class="table table-bordered mt-5 pt-5" style="border-color: #5d5d5d">
                <tr>
                    <td style="width: 300px">
                        <h5 class="text-red">All Info</h5>
                    </td>
                    <td>
                        <a href="./all_info.php?type" class="btn btn-success">All Info</a>
                    </td>
                </tr>
                <tr>
                    <td style="width: 300px">
                        <h5 class="text-red">All Info by Email</h5>
                    </td>
                    <td>
                        <a href="./all_info_email.php?type" class="btn btn-success">All Info by Email</a>
                    </td>
                </tr>
            </table>
        </div>
    <?php } ?>


</div>


<?php
include './footer.php'
?>












