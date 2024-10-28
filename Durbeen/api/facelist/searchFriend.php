<?php
include '../../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$unique_id_me = $data['unique_id_me'];
$search = strtolower(trim($data['search']));
$search = mysqli_real_escape_string($connection, $search);




$SQL1 = "SELECT * FROM `registration` WHERE `unique_id`!='$unique_id_me' ORDER BY `unique_id` DESC";
$run1 = mysqli_query($connection, $SQL1);




while($data1 = mysqli_fetch_assoc($run1)) {
    $data = strtolower($data1['name']);
    $result = strstr($data, $search);

    if ($result) {
    
        $unique_id_fr = $data1['unique_id'];


        $SQLF = "SELECT * FROM `$unique_id_me follow` WHERE `unique_id_fr`='$unique_id_fr'";
        $runF = mysqli_query($connection_info,$SQLF);
        $countF = mysqli_num_rows($runF);


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
                <button onclick="followfn(<?php echo $unique_id_me ?>, <?php echo $unique_id_fr ?>, this)" class="btn <?php $countF == 0 ? printf("btn-success") : printf("btn-danger") ?>" id="followBtn" style="margin-top: 50px">
                    <?php $countF == 0 ? printf('<i class="fas fa-user-plus"></i>') : printf('<i class="fas fa-user-slash"></i>') ?>
                </button>
            </td>
            <td class="text-center">
                <a href="message.php?type&unique_id_fr=<?php echo $unique_id_fr?>">
                    <img width="70px" src="../img/892177.svg" style="margin-top: 35px">
                </a>
            </td>
        </tr>

    <?php 
    }
}









