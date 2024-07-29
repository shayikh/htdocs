<?php
include '../../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);
$page_no = $data['page_no'];
$unique_id_me = $data['unique_id_me'];
$grp_id = $data['grp_id'];




$SQL3 = "SELECT * FROM `registration` WHERE `unique_id`!='$unique_id_me'";
$run3 = mysqli_query($connection, $SQL3);
$total_posts = mysqli_num_rows($run3);
$total_pages = ceil($total_posts / 10) + 1;

if($page_no >= $total_pages){
    echo '0';
}





$limit = 10;
$row = ($page_no - 1)*$limit;



$SQL = "SELECT * FROM `group $grp_id members` ORDER BY `id` DESC LIMIT $row,$limit";
$run = mysqli_query($connection_message,$SQL);

while ($data154=mysqli_fetch_assoc($run)){

    $unique_id_fr = $data154['memberId'];

    $SQLF154 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_fr'";
    $runF154 = mysqli_query($connection,$SQLF154);
    $dataF154 = mysqli_fetch_assoc($runF154);

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
            <h6 style="margin-top: 25px"><?php $data154['admin'] == 1 ? printf("Admin") : printf("") ?></h6>
        </td>
    </tr>
<?php } ?>