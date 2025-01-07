<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);


$page_no = $data['page_no'];
$unique_id_me = $data['unique_id_me'];



$limit = 10;
$row = ($page_no - 1)*$limit;

$SQL2 = "SELECT * FROM `$unique_id_me follow` WHERE `unique_id_fr`!='$unique_id_me' ORDER BY `id` DESC LIMIT $row,$limit";
$run2 = mysqli_query($connection_info, $SQL2);

while ($data2 = mysqli_fetch_assoc($run2)){

    $fr_id = $data2['unique_id_fr'];

    $SQL3="SELECT * FROM `registration` WHERE `unique_id`='$fr_id'";
    $run3=mysqli_query($connection,$SQL3);
    $data3=mysqli_fetch_assoc($run3);

    ?>

    <tr>
        <td class="text-center">
            <a href="./people_timeline.php?type&unique_id_fr=<?php echo $data3['unique_id']?>">
                <img style="margin-top: 2px" src="../pro_pic/<?php echo $data3['pro_pic'] ?>">
            </a>
        </td>
        <td class="text-center" style="max-width: 129px">
            <a class="text-decoration-none" href="./people_timeline.php?type&unique_id_fr=<?php echo $data3['unique_id']?>">
                <p style="font-size: 13px;font-weight: 500"><?php echo $data3['name'] ?></h6>
                <p class="text-success" style="font-size: 11px;font-weight: 500">Durbeen Visited : <?php echo $data3['visit'] ?></p>
            </a>
        </td>
        <td class="text-center">
            <button onclick="followfn(<?php echo $unique_id_me ?>, <?php echo $fr_id ?>, this)" class="btn btn-sm btn-danger" style="margin-top: 30px"><i class="fas fa-user-slash"></i></button>
        </td>
    </tr>

<?php } ?>