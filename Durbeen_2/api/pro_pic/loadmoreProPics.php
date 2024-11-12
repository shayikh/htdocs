<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);


$page_no = $data['page_no'];
$unique_id_me = $data['unique_id_me'];





$SQL1 = "SELECT * FROM `$unique_id_me pro_pic`";
$run1 = mysqli_query($connection_info, $SQL1);
$total_posts = mysqli_num_rows($run1);
$total_pages = ceil($total_posts / 10);

if($page_no > $total_pages){
    echo 1;
}






$limit = 10;
$row = ($page_no - 1)*$limit;

$SQL2 = "SELECT * FROM `$unique_id_me pro_pic` ORDER BY `id` DESC LIMIT $row,$limit";

$run2 = mysqli_query($connection_info, $SQL2);

while ($data2 = mysqli_fetch_assoc($run2)){

?>

    <tr>
        <td class="text-center">
            <img height="500px" src="../pro_pic/<?php echo $data2['pro_pic'] ?>">
        </td>
        <td class="text-center">
            <button onclick="makeProPic(<?php echo $data2['id'] ?>, <?php echo $unique_id_me ?>, this)" class="btn btn-success" style="margin-top: 50px">Make Profile Picture</button>
        </td>
        <td class="text-center">
            <button onclick="deleteProPic(<?php echo $data2['id'] ?>, <?php echo $unique_id_me ?>, this)" class="btn btn-primary" style="margin-top: 50px"><i class="fas fa-trash-alt"></i></button>
        </td>
    </tr>

<?php } ?>