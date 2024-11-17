<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);



$page_no = $data['page_no'];
$unique_id_me = $data['unique_id_me'];



$limit = 10;
$row = ($page_no - 1)*$limit;

$SQL = "SELECT * FROM `registration` WHERE `unique_id`!='$unique_id_me' ORDER BY `unique_id` DESC LIMIT $row,$limit";
$run = mysqli_query($connection,$SQL);

while ($data1=mysqli_fetch_assoc($run)){

    $unique_id_fr = $data1['unique_id'];


    $SQLF = "SELECT * FROM `$unique_id_me allow` WHERE `unique_id_fr`='$unique_id_fr'";
    $runF = mysqli_query($connection_info,$SQLF);
    $countF = mysqli_num_rows($runF);

    $SQLC = "SELECT * FROM `$unique_id_me follow` WHERE `unique_id_fr`='$unique_id_fr'";
    $runC = mysqli_query($connection_info,$SQLC);
    $countC = mysqli_num_rows($runC);


    ?>

    <tr>
        <td class="text-center">
            <a href="./people_timeline.php?type&unique_id_fr=<?php echo $unique_id_fr ?>">
                <img height="135px" src="../pro_pic/<?php echo $data1['pro_pic'] ?>">
            </a>
        </td>
        <td class="text-center">
            <a class="text-decoration-none" href="./people_timeline.php?type&unique_id_fr=<?php echo $unique_id_fr ?>">
                <h3 style="margin-top: 35px"><?php echo $data1['name'] ?></h3>
                <h6 class="text-success">Durbeen Visited : <?php echo $data1['visit'] ?></h6>
            </a>
        </td>
        <td class="text-center">
            <button onclick="follow_req(<?php echo $unique_id_me ?>, <?php echo $unique_id_fr ?>, this)" class="btn <?php $countC == 0 ? printf('btn-success') : printf("btn-danger") ?>" style="margin-top: 50px">
                <?php $countC == 0 ? printf('<i class="fas fa-user-plus"></i>') : printf('<i class="fas fa-user-slash"></i>') ?>
            </button>
            <button onclick="allowfn(<?php echo $unique_id_me ?>, <?php echo $unique_id_fr ?>, this)" class="btn <?php $countF == 0 ? printf("btn-success") : printf("btn-danger") ?>" style="margin-top: 50px">
                <?php $countF == 0 ? printf('<i class="fas fa-user-check"></i>') : printf('<i class="fas fa-user-times"></i>') ?>
            </button>
        </td>
        <td class="text-center">
            <a href="message.php?type&unique_id_fr=<?php echo $unique_id_fr?>">
                <img width="70px" src="../img/892177.svg" style="margin-top: 35px">
            </a>
        </td>
    </tr>

<?php } ?>