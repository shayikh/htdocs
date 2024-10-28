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
                    <img style="margin-top: 2px" width="90px" src="../pro_pic/<?php echo $data1['pro_pic'] ?>">
                </a>
            </td>
            <td class="text-center" style="max-width: 129px">
                <a class="text-decoration-none" href="./people_timeline.php?type&unique_id_fr=<?php echo $unique_id_fr ?>">
                    <p style="font-size: 13px;font-weight: 500"><?php echo $data1['name'] ?></p>
                    <p class="text-success" style="font-size: 11px;font-weight: 500">Durbeen Visited : <?php echo $data1['visit'] ?></p>
                </a>
            </td>
            <td class="text-center">
                <button onclick="followfn(<?php echo $unique_id_me ?>, <?php echo $unique_id_fr ?>, this)" class="btn btn-sm <?php $countF == 0 ? printf("btn-success") : printf("btn-danger") ?>" id="followBtn" style="margin-top: 2px">
                    <?php $countF == 0 ? printf('<i class="fas fa-user-plus"></i>') : printf('<i class="fas fa-user-slash"></i>') ?>
                </button>
                <br>
                <a href="message.php?type&unique_id_fr=<?php echo $unique_id_fr?>">
                    <img width="40px" src="../img/892177.svg" style="margin-top: 15px">
                </a>
            </td>
        </tr>


    <?php 
    }
}



