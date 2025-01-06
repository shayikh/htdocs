<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);


$page_no = $data['page_no'];
$unique_id_me = $data['unique_id_me'];



$limit = 10;
$row = ($page_no - 1)*$limit;

$SQL2 = "SELECT * FROM `dislike_post` WHERE `unique_id`='$unique_id_me' ORDER BY `id` DESC LIMIT $row,$limit";
$run2 = mysqli_query($connection, $SQL2);

while ($data2 = mysqli_fetch_assoc($run2)){

    $like_id = $data2['id'];
    $post_id = $data2['post_id'];

    $SQL3 = "SELECT * FROM `post` WHERE `id`='$post_id'";
    $run3 = mysqli_query($connection,$SQL3);
    $data3 = mysqli_fetch_assoc($run3);

    ?>

    <tr>
        <td class="text-center">
            <img width="200px" src="../post_image/<?php echo $data3['image'] ?>">
        </td>
        <td class="text-center">
            <h3 class="text-dark" style="margin-top: 35px"><?php echo $data3['post'] ?></h3>
        </td>
        <td class="text-center text-dark">
            <a href="./singlePost.php?type&post_id=<?php echo $post_id ?>" class="btn btn-success" target="_blank" style="margin-top: 35px">Show Post</a>
        </td>
        <td class="text-center">
            <i class="fas fa-trash ms-4 me-4 text-dark" style="cursor: pointer; margin-top: 45px" onclick="removeDisLikefn(<?php echo $like_id ?>, this)"></i>
        </td>
        
    </tr>

<?php } ?>