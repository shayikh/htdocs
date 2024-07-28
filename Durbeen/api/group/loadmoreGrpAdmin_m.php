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



$SQL = "SELECT * FROM `registration` WHERE `unique_id`!='$unique_id_me' ORDER BY `unique_id` DESC";
$run = mysqli_query($connection,$SQL);

while ($data154=mysqli_fetch_assoc($run)){

    $unique_id_fr = $data154['unique_id'];

    $SQLF154 = "SELECT * FROM `group $grp_id members` WHERE `memberId`='$unique_id_fr'";
    $runF154 = mysqli_query($connection_message,$SQLF154);
    $countF154 = mysqli_num_rows($runF154);

    $SQLF155 = "SELECT * FROM `group $grp_id members` WHERE `memberId`='$unique_id_fr' AND `admin`='1'";
    $runF155 = mysqli_query($connection_message,$SQLF155);
    $countF155 = mysqli_num_rows($runF155);

    ?>

    <tr>

        <td class="text-center" style="max-width: 129px">
            <a class="text-decoration-none" href="./people_timeline.php?type&unique_id_fr=<?php echo $unique_id_fr ?>">
                <p style="font-weight: 500"><?php echo $data154['name'] ?></p>
                <p class="text-success" style="font-size: 11px;font-weight: 500">Durbeen Visited : <?php echo $data154['visit'] ?></p>
            </a>
        </td>
        <td class="text-center">
            <button onclick="addfn(<?php echo $unique_id_me ?>, <?php echo $unique_id_fr ?>, <?php echo $grp_id ?>, this)" class="btn btn-sm <?php $countF154 == 0 ? printf("btn-success") : printf("btn-danger") ?>" style="margin-top: 5px">
                <?php $countF154 == 0 ? printf("Add") : printf("Remove") ?>
            </button>
        </td>
        <td class="text-center">
            <button onclick="adminfn(<?php echo $unique_id_me ?>, <?php echo $unique_id_fr ?>, <?php echo $grp_id ?>, this)" class="btn btn-sm <?php $countF155 == 0 ? printf("btn-success") : printf("btn-danger") ?>" style="margin-top: 5px">
                <?php $countF155 == 0 ? printf("Admin") : printf("Remove") ?>
            </button>
        </td>
    </tr>
<?php } ?>


