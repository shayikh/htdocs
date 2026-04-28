<?php
include '../../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);



$grp_id = $data['grp_id'];
$unique_id_me = $data['unique_id_me'];
$search = strtolower(trim($data['search']));
$search = mysqli_real_escape_string($connection, $search);




$SQL1 = "SELECT * FROM `group $grp_id members` ORDER BY `id` DESC";
$run1 = mysqli_query($connection_message, $SQL1);




while($data154 = mysqli_fetch_assoc($run1)) {
    $unique_id_fr = $data154['memberId'];

    $SQLF154 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_fr'";
    $runF154 = mysqli_query($connection,$SQLF154);
    $dataF154 = mysqli_fetch_assoc($runF154);


    $data = strtolower($dataF154['name']);
    $result = strstr($data, $search);

    if ($result) {
    
        $SQLF155 = "SELECT * FROM `group $grp_id members` WHERE `memberId`='$unique_id_fr' AND `admin`='1'";
        $runF155 = mysqli_query($connection_message,$SQLF155);
        $countF155 = mysqli_num_rows($runF155);
    
        ?>
    
        <tr>
            <td class="text-center">
                <a href="./people_timeline.php?type&unique_id_fr=<?php echo $unique_id_fr ?>">
                    <img style="margin-top: 2px" width="90px" src="../pro_pic/<?php echo $dataF154['pro_pic'] ?>">
                </a>
            </td>
            <td class="text-center" style="max-width: 129px">
                <a class="text-decoration-none" href="./people_timeline.php?type&unique_id_fr=<?php echo $unique_id_fr ?>">
                    <p style="font-size: 13px;font-weight: 500"><?php echo $dataF154['name'] ?></p>
                    <p class="text-success" style="font-size: 11px;font-weight: 500">Durbeen Visited : <?php echo $dataF154['visit'] ?></p>
                </a>
            </td>
            <td class="text-center">
                <h6 style="margin-top: 25px"><?php $countF155 > 0 ? printf("Admin") : printf("") ?></h6>
            </td>
        </tr>

    <?php 
    }
}









