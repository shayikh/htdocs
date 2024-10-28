<?php
include '../../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$grp_id = $data['grp_id'];
$unique_id_me = $data['unique_id_me'];
$search = strtolower(trim($data['search']));
$search = mysqli_real_escape_string($connection, $search);




$SQL1 = "SELECT * FROM `registration` WHERE `unique_id`!='$unique_id_me' ORDER BY `unique_id` DESC";
$run1 = mysqli_query($connection, $SQL1);




while($data154 = mysqli_fetch_assoc($run1)) {
    $data = strtolower($data154['name']);
    $result = strstr($data, $search);

    if ($result) {
    
        $unique_id_fr = $data154['unique_id'];

        $SQLF154 = "SELECT * FROM `group $grp_id members` WHERE `memberId`='$unique_id_fr'";
        $runF154 = mysqli_query($connection_message,$SQLF154);
        $countF154 = mysqli_num_rows($runF154);
    
        $SQLF155 = "SELECT * FROM `group $grp_id members` WHERE `memberId`='$unique_id_fr' AND `admin`='1'";
        $runF155 = mysqli_query($connection_message,$SQLF155);
        $countF155 = mysqli_num_rows($runF155);
    
        ?>
    
        <tr>
            <td class="text-center">
                <a href="./people_timeline.php?type&unique_id_fr=<?php echo $unique_id_fr ?>">
                    <img height="135px" src="../pro_pic/<?php echo $data154['pro_pic'] ?>">
                </a>
            </td>
            <td class="text-center">
                <a class="text-decoration-none" href="./people_timeline.php?type&unique_id_fr=<?php echo $unique_id_fr ?>">
                    <h3 style="margin-top: 35px"><?php echo $data154['name'] ?></h3>
                    <h6 class="text-success">Durbeen Visited : <?php echo $data154['visit'] ?></h6>
                </a>
            </td>
            <td class="text-center">
                <button onclick="addfn(<?php echo $unique_id_me ?>, <?php echo $unique_id_fr ?>, <?php echo $grp_id ?>, this)" class="btn <?php $countF154 == 0 ? printf("btn-success") : printf("btn-danger") ?>" style="margin-top: 50px">
                    <?php $countF154 == 0 ? printf('<i class="fas fa-user-plus"></i>') : printf('<i class="fas fa-user-minus"></i>') ?>
                </button>
            </td>
            <td class="text-center">
                <button onclick="adminfn(<?php echo $unique_id_me ?>, <?php echo $unique_id_fr ?>, <?php echo $grp_id ?>, this)" class="btn <?php $countF155 == 0 ? printf("btn-success") : printf("btn-danger") ?>" style="margin-top: 50px">
                    <?php $countF155 == 0 ? printf('<i class="fas fa-user-cog"></i>') : printf('<i class="fas fa-users"></i>') ?>
                </button>
            </td>
        </tr>

    <?php 
    }
}









