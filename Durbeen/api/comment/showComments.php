<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$post_id = $data['post_id'];
$unique_id_me = $data['unique_id_me'];


$SQL1 = "SELECT * FROM `comment` WHERE `post_id`='$post_id' ORDER BY `id` DESC";
$run1 = mysqli_query($connection, $SQL1);





while ($data1 = mysqli_fetch_assoc($run1)) {

$comn_giver_id = $data1['comn_giver_id'];

$SQL2 = "SELECT * FROM `registration` WHERE `unique_id`='$comn_giver_id'";
$run2 = mysqli_query($connection, $SQL2);
$data2 = mysqli_fetch_assoc($run2);

?>


<tr>
    <td class="text-center">
        <a href="./people_timeline.php?type&unique_id_fr=<?php echo $comn_giver_id ?>" target="_blank">
            <img class="text-center rounded-circle" width="70px" height="70px" src="../pro_pic/<?php echo $data2['pro_pic'] ?>">
        </a>
    </td>

    <td class="text-center text-dark">
        <a style="color: blue" href="./people_timeline.php?type&unique_id_fr=<?php echo $comn_giver_id ?>" target="_blank"><?php echo $data2['name'] ?></a>
    </td>

    <td class="text-center text-dark"><?php echo $data1['time'] ?></td>
    <td class="text-center text-dark"><?php echo $data1['comment'] ?></td>
    <td class="text-center text-dark">
        <i class="fas fa-trash me-4" style="cursor: pointer" onclick="deleteComment(<?php echo $data1['id'] ?>, <?php echo $unique_id_me ?>, this)"></i>
    </td>
</tr>


<?php 
} 