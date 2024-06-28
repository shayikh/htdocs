<?php
include '../../connection.php';

header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$page_no = $data['page_no'];
$unique_id_me = $data['unique_id_me'];
$grp_id = $data['grp_id'];



$SQL3 = "SELECT * FROM `group $grp_id`";
$run3 = mysqli_query($connection_message, $SQL3);
$total_posts = mysqli_num_rows($run3);
$total_pages = ceil($total_posts / 5) + 1;

if($page_no >= $total_pages){
    echo '0';
}





$limit = 5;
$row = ($page_no - 1) * $limit;


$SQL = "SELECT * FROM `group $grp_id` ORDER BY `id` DESC LIMIT $row,$limit";
$run = mysqli_query($connection_message, $SQL);


while ($data3 = mysqli_fetch_assoc($run)) { ?>

    <table class="table mt-4">
        <tbody>
        <tr>
            <?php if ($data3['senderId'] != $unique_id_me) { ?>

                <div class="float-start" style="border: none;">
                    <a target="_blank" href="./people_timeline.php?type&unique_id_fr=<?php echo $data3['senderId'] ?>">
                        <img class="float-start" style="border-radius: 50%" width="40px" height="40px"
                            src="../pro_pic/<?php echo $data3['senderProPic'] ?>">
                    </a>

                    <br><br>

                    <?php if ($data3['image'] != "") { ?>
                        <img title="<?php echo $data3['time'] ?>" width="290px"
                            src="../chat_image/<?php echo $data3['image'] ?>">
                    <?php } ?>


                    <?php if ($data3['message'] != "") { ?>
                        <h6 title="<?php echo $data3['time'] ?>" style="border-radius: 35px;background-color: #265d94"
                            class="response float-start py-2 px-3"><?php echo $data3['message'] ?></h6>
                    <?php } ?>
                </div>

            <?php } else { ?>

                <div class="float-end" style="border: none;">
                    <?php if ($data3['image'] != "") { ?>
                        <img class="float-end" title="<?php echo $data3['time'] ?>" width="290px" src="../chat_image/<?php echo $data3['image'] ?>">
                    <?php } ?>
                    
                    <?php if ($data3['message'] != "") { ?>
                        <h6 title="<?php echo $data3['time'] ?>" style="border-radius: 35px"
                            class="response float-end py-2 px-3 bg-success"><?php echo $data3['message'] ?></h6>
                    <?php } ?>
                    <br>
                    <button onclick="unsendMessage(<?php echo $data3['id'] ?>, <?php echo $grp_id ?>, this)"
                            class="btn btn-sm btn-danger float-end mb-2" title="Unsend"><i class="fas fa-trash-alt"></i>
                    </button>
                </div>

            <?php } ?>

        </tr>
        </tbody>
    </table>

<?php } ?>


