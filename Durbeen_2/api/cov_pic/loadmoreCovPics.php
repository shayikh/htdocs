<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);



$page_no = $data['page_no'];
$unique_id_me = $data['unique_id_me'];



$limit = 10;
$row = ($page_no - 1)*$limit;

$SQL2 = "SELECT * FROM `$unique_id_me cov_pic` ORDER BY `id` DESC LIMIT $row,$limit";

$run2 = mysqli_query($connection_info, $SQL2);

while ($data2 = mysqli_fetch_assoc($run2)){

?>

    <tr>
        <td class="text-center">
            <img style="width: 1000px;" src="../pro_pic/cov_pic/<?php echo $data2['cov_pic'] ?>">
        </td>
        <td class="text-center">
            <button onclick="makeCovPic(<?php echo $data2['id'] ?>, <?php echo $unique_id_me ?>, this)" class="btn btn-success" style="margin-top: 50px">Make Cover Photo</button>
        </td>
        <td class="text-center">
            <button onclick="deleteCovPic(<?php echo $data2['id'] ?>, <?php echo $unique_id_me ?>, this)" class="btn btn-primary" style="margin-top: 50px"><i class="fas fa-trash-alt"></i></button>
        </td>
    </tr>

<?php } ?>