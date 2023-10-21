<?php
include './header.php';


if (isset($_POST['delete'])) {

    //post delete
    $SQL1 = "SELECT * FROM `post` WHERE `unique_id`='$unique_id_me'";
    $run1 = mysqli_query($connection, $SQL1);

    while ($data1 = mysqli_fetch_assoc($run1)) {
        $imgNameinDB = $data1['image'];

        if ($imgNameinDB != "") {
            unlink('../post_image/'.$imgNameinDB);
        }
    }
    $SQL2 = "DELETE FROM `post` WHERE `unique_id`='$unique_id_me'";
    mysqli_query($connection, $SQL2);

    
    
    

    //self post's comment delete
    $SQL1 = "DELETE FROM `comment` WHERE `post_giver_id`='$unique_id_me'";
    mysqli_query($connection, $SQL1);

    //other's post's comment delete
    $SQL1 = "DELETE FROM `comment` WHERE `comn_giver_id`='$unique_id_me'";
    mysqli_query($connection, $SQL1);
    
    //like delete
    $SQL1 = "DELETE FROM `like_post` WHERE `unique_id`='$unique_id_me'";
    mysqli_query($connection, $SQL1);
    
    //dislike delete
    $SQL1 = "DELETE FROM `dislike_post` WHERE `unique_id`='$unique_id_me'";
    mysqli_query($connection, $SQL1);
    
    
    
    


    //notification table delete
    $SQL4 = "DROP TABLE `$unique_id_me notify`";
    mysqli_query($durbeen_chats, $SQL4);


    //message tables delete
    $SQL5 = "SELECT * FROM `$unique_id_me chats`";
    $run5 = mysqli_query($durbeen_chats, $SQL5);

    while ($data5 = mysqli_fetch_assoc($run5)) {
        $unique_id_fr = $data5['unique_id_fr'];

        $SQL6 = "SELECT * FROM `$unique_id_me to $unique_id_fr`";
        $run = mysqli_query($connection_message, $SQL6);

        if ($run == true) {
            while ($data = mysqli_fetch_assoc($run)) {
                $imgNameinDB = $data['image'];
                if ($imgNameinDB != '') {
                    unlink('../chat_image/'.$imgNameinDB);
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
                    unlink('../chat_image/'.$imgNameinDB);
                }
            }
        }

        $SQL7 = "DROP TABLE IF EXISTS `$unique_id_fr to $unique_id_me`";
        mysqli_query($connection_message, $SQL7);

    }

    //chat friend table delete
    $SQL4 = "DROP TABLE `$unique_id_me chats`";
    mysqli_query($durbeen_chats, $SQL4);
    
    //follow table delete
    $SQL4 = "DROP TABLE `$unique_id_me follow`";
    mysqli_query($durbeen_chats, $SQL4);


    //drop self_msg table
    $SQL6 = "SELECT * FROM `$unique_id_me to $unique_id_me`";
    $run6 = mysqli_query($connection_message, $SQL6);

    if ($run6 == true) {
        while ($data = mysqli_fetch_assoc($run6)) {
            $imgNameinDB = $data['image'];
            if ($imgNameinDB != '') {
                unlink('../chat_image/'.$imgNameinDB);
            }
        }
    }

    $SQL8 = "DROP TABLE IF EXISTS `$unique_id_me to $unique_id_me`";
    mysqli_query($connection_message, $SQL8);




    //about delete
    $SQL4 = "SELECT * FROM `about` WHERE `unique_id`='$unique_id_me'";
    $run4 = mysqli_query($connection, $SQL4);


    $SQL9 = "DELETE FROM `about` WHERE `unique_id`='$unique_id_me'";
    mysqli_query($connection, $SQL9);




    //pro_pic table delete
    $SQL4 = "SELECT * FROM `$unique_id_me pro_pic`";
    $run4 = mysqli_query($durbeen_chats, $SQL4);

    if ($run4 == true) {
        while ($data = mysqli_fetch_assoc($run4)) {
            $pro_pic = $data['pro_pic'];
            
            if ($pro_pic != "red_comet.png") {
                unlink('./pro_pic/'.$pro_pic);
            }
        }
    }

    $SQL4 = "DROP TABLE `$unique_id_me pro_pic`";
    mysqli_query($durbeen_chats, $SQL4);
    
    
    
    
    
    //cov_pic table delete
    $SQL4 = "SELECT * FROM `$unique_id_me cov_pic`";
    $run4 = mysqli_query($durbeen_chats, $SQL4);

    if ($run4 == true) {
        while ($data = mysqli_fetch_assoc($run4)) {
            $cov_pic = $data['cov_pic'];
            
            if ($cov_pic_me != "cov_pic.jpg") {
                unlink('./pro_pic/cov_pic/'.$cov_pic);
            }
        }
    }

    $SQL4 = "DROP TABLE `$unique_id_me cov_pic`";
    mysqli_query($durbeen_chats, $SQL4);
    
    
    



    //account delete
    if ($pro_pic != "red_comet.png") {
        unlink('./pro_pic/'.$pro_pic);
    }
    
    if ($dataMe['cov_pic'] != "cov_pic.jpg") {
        $cov_pic = $dataMe['cov_pic'];
        unlink('./pro_pic/cov_pic/'.$cov_pic);
    }

    $SQL10 = "DELETE FROM `registration` WHERE `unique_id`='$unique_id_me'";
    mysqli_query($connection, $SQL10);


    session_unset();
    session_destroy();
    echo "<script>window.location = './?del'</script>";
}

?>


<!-- main page -->


<div class="container" style="margin-top: 120px">
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-red text-center">ACCOUNT DELETION</h4>
        </div>
        <div class="col-md-12 mt-2">
            <h6 class="text-capitalize" style="line-height: 1.5;">deleting account once will permanently delete all data
                from database and you will never able to
                regain those data, even <span style="font-weight: 500;font-family: mahfuj;" class="text-red">দূরবীন</span> can not able to repair this. be careful
                before you continue.</h6>
            <form method="post" action="./del_acco.php?type"><input onclick="return confirm('Are You Sure You Want to Delete Your Account?')" name="delete" class="btn btn-sm red mt-5 form-control" type="submit" value="&#9762; DELETE ACCOUNT PERMANENTLY &#9785;"></form>
        </div>
    </div>


    <?php if ($unique_id_me == 1) { ?>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered mt-5" style="border-color: #5d5d5d">
                <tr>
                    <td>
                        <h6 class="text-red">All Info</h6>
                    </td>
                    <td>
                        <a href="./all_info.php?type" class="btn btn-sm btn-success">All Info</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6 class="text-red">All Info by Email</h6>
                    </td>
                    <td>
                        <a href="./all_info_email.php?type" class="btn btn-sm btn-success">All Info by Email</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <?php } ?>


</div>


<?php
include './footer.php'
?>
