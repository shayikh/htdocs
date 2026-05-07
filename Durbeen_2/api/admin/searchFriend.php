<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);


$unique_id_me = $data['unique_id_me'];
$search = strtolower(trim($data['search']));
$search = mysqli_real_escape_string($connection, $search);




$SQL1 = "SELECT * FROM `registration` WHERE `unique_id`!='$unique_id_me' AND `unique_id`!='1' ORDER BY `unique_id` DESC";
$run1 = mysqli_query($connection, $SQL1);




while($data1 = mysqli_fetch_assoc($run1)) {
    $data = strtolower($data1['name']);
    $result = strstr($data, $search);

    if ($result) {
    
        $unique_id_fr = $data1['unique_id'];

        $SQL2 = "SELECT * FROM `admin` WHERE `unique_id`='$unique_id_fr'";
        $run2 = mysqli_query($connection,$SQL2);
        $count2 = mysqli_num_rows($run2);
    
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
                <button onclick="addAdminfn(<?php echo $unique_id_fr ?>, this)" class="btn <?php $count2 == 0 ? printf("btn-success") : printf("btn-danger") ?>" style="margin-top: 50px">
                    <?php $count2 == 0 ? printf('<i class="fas fa-user-cog"></i>') : printf('<i class="fas fa-users"></i>') ?>
                </button>
            </td>
        </tr>

    <?php 
    }
}









