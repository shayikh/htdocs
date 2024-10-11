<?php
include '../../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);
$page_no = $data['page_no'];
$unique_id_me = $data['unique_id_me'];





$SQL3 = "SELECT * FROM `$unique_id_me msg_grp`";
$run3 = mysqli_query($connection_info, $SQL3);
$total_posts = mysqli_num_rows($run3);
$total_pages = ceil($total_posts / 10);

if($page_no > $total_pages){
    echo 1;
}





$limit = 10;
$row = ($page_no - 1)*$limit;

$SQL = "SELECT * FROM `$unique_id_me msg_grp` ORDER BY `id` DESC LIMIT $row,$limit";
$run = mysqli_query($connection_info,$SQL);

while ($data = mysqli_fetch_assoc($run)){
$grp_id = $data['grp_id'];

$SQL1 = "SELECT * FROM `groups` WHERE `id`='$grp_id'";
$run1 = mysqli_query($connection,$SQL1);
$data1 = mysqli_fetch_assoc($run1)

    
    ?>

    <tr>
        <td class="text-center">
            <a href="./group_msg.php?type&grp_id=<?php echo $data1['id'] ?>">
                <img height="135px" src="../pro_pic/<?php echo $data1['pro_pic'] ?>">
            </a>
        </td>
        <td class="text-center">
            <a class="text-decoration-none" href="./group_msg.php?type&grp_id=<?php echo $data1['id'] ?>">
                <h3 style="margin-top: 45px"><?php echo $data1['grp_name'] ?></h3>
            </a>
        </td>
    </tr>

<?php } ?>