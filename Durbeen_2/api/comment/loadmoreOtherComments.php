<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);


$page_no = $data['page_no'];
$unique_id_me = $data['unique_id_me'];



$limit = 10;
$row = ($page_no - 1)*$limit;

$SQL1 = "SELECT * FROM `comment` WHERE `post_giver_id`='$unique_id_me' AND `comn_giver_id`!='$unique_id_me' ORDER BY `id` DESC LIMIT $row,$limit";
$run1 = mysqli_query($connection,$SQL1);





while ($data1 = mysqli_fetch_assoc($run1)) {

$comn_giver_id = $data1['comn_giver_id'];

$SQL2 = "SELECT * FROM `registration` WHERE `unique_id`='$comn_giver_id'";
$run2 = mysqli_query($connection, $SQL2);
$data2 = mysqli_fetch_assoc($run2);




?>

<tr>
    <td class="text-center">
        <a href="./people_timeline.php?type&unique_id_fr=<?php echo $comn_giver_id ?>" target="_blank">
            <img class="text-center rounded-circle" width="50px" height="50px" src="../pro_pic/<?php echo $data2['pro_pic'] ?>">
        </a>
    </td>

    <td class="text-center" style="min-width: 150px">
        <a style="color: blue" href="./people_timeline.php?type&unique_id_fr=<?php echo $comn_giver_id ?>" target="_blank"><?php echo $data2['name'] ?></a>
    </td>
    <td class="text-center text-dark" style="min-width: 180px"><?php echo $data1['time'] ?></td>
    <td class="text-center text-dark" style="min-width: 200px"><?php echo $data1['comment'] ?></td>
    <td class="text-center text-dark" style="min-width: 150px">
        <a href="./singlePost.php?type&amp;post_id=<?php echo $data1['post_id'] ?>" class="btn btn-success" target="_blank">Show Post</a>
    </td>
</tr>


<?php 
}

