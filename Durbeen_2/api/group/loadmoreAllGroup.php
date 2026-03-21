<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);


$page_no = $data['page_no'];
$unique_id_me = $data['unique_id_me'];






$limit = 10;
$row = ($page_no - 1)*$limit;

$SQL = "SELECT * FROM `groups` ORDER BY `id` DESC LIMIT $row,$limit";
$run = mysqli_query($connection,$SQL);

while ($data = mysqli_fetch_assoc($run)){
    ?>

    <tr>
        <td class="text-center">
            <a href="./all_group_msg.php?type&grp_id=<?php echo $data['id'] ?>">
                <img height="135px" src="../pro_pic/<?php echo $data['pro_pic'] ?>">
            </a>
        </td>
        <td class="text-center">
            <a class="text-decoration-none" href="./all_group_msg.php?type&grp_id=<?php echo $data['id'] ?>">
                <h3 style="margin-top: 45px"><?php echo $data['grp_name'] ?></h3>
            </a>
        </td>
    </tr>

<?php } ?>