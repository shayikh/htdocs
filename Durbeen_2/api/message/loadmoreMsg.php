<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);


$page_no = $data['page_no'];
$unique_id_me = $data['unique_id_me'];
$unique_id_fr = $data['unique_id_fr'];

$SQLfr = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_fr'";
$runfr = mysqli_query($connection, $SQLfr);
$datafr = mysqli_fetch_assoc($runfr);
$pro_pic_fr = $datafr['pro_pic'];




if($unique_id_me < $unique_id_fr){
    $SQL3 = "SELECT * FROM `$unique_id_me to $unique_id_fr`";
}else{
    $SQL3 = "SELECT * FROM `$unique_id_fr to $unique_id_me`";
}


$run3 = mysqli_query($connection_message, $SQL3);
$total_posts = mysqli_num_rows($run3);
$total_pages = ceil($total_posts / 20);

if($page_no > $total_pages){
    echo 1;
}





$limit = 20;
$row = ($page_no - 1) * $limit;




if($unique_id_me < $unique_id_fr){
    $SQL = "SELECT * FROM `$unique_id_me to $unique_id_fr` ORDER BY `id` DESC LIMIT $row,$limit";
}else{
    $SQL = "SELECT * FROM `$unique_id_fr to $unique_id_me` ORDER BY `id` DESC LIMIT $row,$limit";
}
$run = mysqli_query($connection_message, $SQL);


while ($data3 = mysqli_fetch_assoc($run)) { ?>

    <table class="table mt-4">
        <tbody>
        <tr>
            <?php if ($data3['sender'] == $unique_id_fr) { ?>

                <div class="float-start" style="width: 590px;border: none;">
                    <img class="float-start" style="border-radius: 50%" width="40px" height="40px"
                         src="../pro_pic/<?php echo $pro_pic_fr ?>">

                    <?php if ($data3['image'] != "") { ?>
                        <img title="<?php echo $data3['time'] ?>" width="590px"
                            src="../chat_image/<?php echo $data3['image'] ?>">
                    <?php } ?>

                    <?php if ($data3['message'] != "") { ?>
                        <h5 title="<?php echo $data3['time'] ?>" style="border-radius: 35px;background-color: #265d94"
                            class="response float-start py-2 px-3"><?php echo $data3['message'] ?></h5>
                    <?php } ?>
                </div>

            <?php } else { ?>

                <div class="float-end" style="width: 590px;border: none;">
                    <?php if ($data3['image'] != "") { ?>
                        <img title="<?php echo $data3['time'] ?>" width="590px" src="../chat_image/<?php echo $data3['image'] ?>">
                    <?php } ?>

                    <?php if ($data3['message'] != "") { ?>
                        <h5 title="<?php echo $data3['time'] ?>" style="border-radius: 35px"
                            class="response float-end py-2 px-3 bg-success"><?php echo $data3['message'] ?></h5>
                    <?php } ?>

                    <button onclick="unsendMessage(<?php echo $data3['id'] ?>, <?php echo $unique_id_me ?>, <?php echo $unique_id_fr ?>, this)"
                            class="btn btn-sm btn-dark float-end mb-2" title="Unsend"><i class="fas fa-trash-alt"></i>
                    </button>
                    <button class="btn btn-sm btn-dark float-end"><?php $data3['seen'] == 'Seen' ? printf("<i class='fas fa-eye'></i>") : printf("<i class='fas fa-eye-slash'></i>") ?></button>
                </div>

            <?php } ?>

        </tr>
        </tbody>
    </table>

<?php } ?>