<?php
include '../../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);
$page_no = $data['page_no'];
$unique_id_me = $data['unique_id_me'];



$SQL3 = "SELECT * FROM `registration` WHERE `unique_id`!='$unique_id_me'";
$run3 = mysqli_query($connection, $SQL3);
$total_posts = mysqli_num_rows($run3);
$total_pages = ceil($total_posts / 10) + 1;

if($page_no >= $total_pages){
    echo '0';
}





$limit = 10;
$row = ($page_no - 1)*$limit;


$SQL = "SELECT * FROM `registration` WHERE `unique_id`!='$unique_id_me' ORDER BY `unique_id` DESC LIMIT $row,$limit";
$run = mysqli_query($connection,$SQL);

while ($data = mysqli_fetch_assoc($run)){

    $unique_id_fr = $data['unique_id'];

    $SQL2 = "SELECT * FROM `admin` WHERE `unique_id`='$unique_id_fr'";
    $run2 = mysqli_query($connection,$SQL2);
    $count2 = mysqli_num_rows($run2);

    ?>

    <tr>
        <td class="text-center">
            <a href="./people_timeline.php?type&unique_id_fr=<?php echo $unique_id_fr ?>">
                <img height="135px" src="../pro_pic/<?php echo $data['pro_pic'] ?>">
            </a>
        </td>
        <td class="text-center">
            <a class="text-decoration-none" href="./people_timeline.php?type&unique_id_fr=<?php echo $unique_id_fr ?>">
                <h3 style="margin-top: 35px"><?php echo $data['name'] ?></h3>
                <h6 class="text-success">Durbeen Visited : <?php echo $data['visit'] ?></h6>
            </a>
        </td>
        <td class="text-center">
            <button onclick="addAdminfn(<?php echo $unique_id_fr ?>, this)" class="btn <?php $count2 == 0 ? printf("btn-success") : printf("btn-danger") ?>" style="margin-top: 50px">
                <?php $count2 == 0 ? printf("Make Admin") : printf('<i class="fas fa-user-slash"></i>') ?>
            </button>
        </td>
    </tr>
<?php } ?>


