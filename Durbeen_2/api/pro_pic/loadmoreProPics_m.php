<?php
include '../../connection.php';

header('Content-Type: application/x-www-form-urlencoded');


$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);
$page_no = $data['page_no'];
$unique_id_me = $data['unique_id_me'];





$SQL1 = "SELECT * FROM `$unique_id_me pro_pic`";
$run1 = mysqli_query($durbeen_chats, $SQL1);
$total_posts = mysqli_num_rows($run1);
$total_pages = ceil($total_posts / 10) + 1;

if($page_no >= $total_pages){
    echo '0';
}







$limit = 10;
$row = ($page_no - 1)*$limit;

$SQL2 = "SELECT * FROM `$unique_id_me pro_pic` ORDER BY `id` DESC LIMIT $row,$limit";

$run2 = mysqli_query($durbeen_chats, $SQL2);

while ($data2 = mysqli_fetch_assoc($run2)){

?>

    <tr>
        <td class="text-center">
            <img width="130px" src="../pro_pic/<?php echo $data2['pro_pic'] ?>">
        </td>
        <td class="text-center">
            <button onclick="makeProPic(<?php echo $data2['id'] ?>, <?php echo $unique_id_me ?>, this)" class="btn btn-sm btn-success" style="margin-top: 20px">Make Profile Picture</button>
        </td>
        <td class="text-center">
            <button onclick="deleteProPic(<?php echo $data2['id'] ?>, <?php echo $unique_id_me ?>, this)" class="btn btn-sm btn-danger" style="margin-top: 30px">Delete</button>
        </td>
    </tr>

<?php } ?>