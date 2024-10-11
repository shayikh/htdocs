<?php
include '../../connection.php';

header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);
$page_no = $data['page_no'];
$unique_id_me = $data['unique_id_me'];




$SQL3 = "SELECT * FROM `post`";
$run3 = mysqli_query($connection, $SQL3);
$total_posts = mysqli_num_rows($run3);
$total_pages = ceil($total_posts / 10);

if($page_no > $total_pages){
    echo 1;
}







$limit = 10;
$row = ($page_no - 1)*$limit;

$SQL = "SELECT * FROM `post` ORDER BY `id` DESC limit $row,$limit";
$run = mysqli_query($connection, $SQL);



while ($data1 = mysqli_fetch_assoc($run)){

$unique_id_fr = $data1['unique_id'];


$SQLF="SELECT * FROM `$unique_id_me follow` WHERE `unique_id_fr`='$unique_id_fr'";
$runF=mysqli_query($connection_info,$SQLF);
$countF = mysqli_num_rows($runF);


if($countF >= 1){
    $SQL2 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_fr'";
    $run2 = mysqli_query($connection,$SQL2);
    $data2 = mysqli_fetch_assoc($run2);


    $Postid = $data1['id'];
    $comn_count = "SELECT * FROM `comment` WHERE `post_id`='$Postid'";
    $runComn_count = mysqli_query($connection,$comn_count);
    $no_comment = mysqli_num_rows($runComn_count);

    $SQLlike = "SELECT * FROM `like_post` WHERE `post_id`='$Postid' AND `unique_id`='$unique_id_me'";
    $runlike = mysqli_query($connection, $SQLlike);
    $countlike = mysqli_num_rows($runlike);

    $SQLdislike = "SELECT * FROM `dislike_post` WHERE `post_id`='$Postid' AND `unique_id`='$unique_id_me'";
    $rundislike = mysqli_query($connection, $SQLdislike);
    $countdislike = mysqli_num_rows($rundislike);

    $SQLlikeall = "SELECT * FROM `like_post` WHERE `post_id`='$Postid'";
    $runlikeall = mysqli_query($connection, $SQLlikeall);
    $countlikeall = mysqli_num_rows($runlikeall);

    $SQLdislikeall = "SELECT * FROM `dislike_post` WHERE `post_id`='$Postid'";
    $rundislikeall = mysqli_query($connection, $SQLdislikeall);
    $countdislikeall = mysqli_num_rows($rundislikeall);



?>

<div class="statusp">
    <div class="col-md-12" style="background-color: #18191A;padding: 10px;border-radius: 3px">
        <div class="card" style="width: 100%;border: none">
            <p class="text-white p-2" style="background-color: #18191A;border-radius: 3px 3px 0 0; ">
                <a href="./people_timeline.php?type&unique_id_fr=<?php echo $data2['unique_id']?>" class="timeline_link">
                    <img style="border-radius: 50%" width="70px" height="70px"
                        src="../pro_pic/<?php echo $data2['pro_pic']?>">
                    <b><?php echo $data2['name']?></b>
                </a>
            </p>
            <img width="100%" src="../post_image/<?php echo $data1['image']?>">
            <div class="card-body" style="background-color: #198754;border-radius: 0 0 3px 3px">
                <h6 class="card-title text-white"><?php echo $data1['time']?></h6>
                <p class="card-text text-white"><?php echo $data1['post']?></p>
            </div>
        </div>

        <p class="float-start mt-2 me-3" style="color: <?php $countlike == 1 ? printf("#0D6EFD") : printf("") ?>; font-size: 18px; cursor: pointer" onclick="likefn(<?php echo $Postid ?>, <?php echo $unique_id_me ?>, this)">Like</p>
        <p class="float-start mt-2 me-5" style="color: <?php $countdislike == 1 ? printf("#0D6EFD") : printf("") ?>; font-size: 18px; cursor: pointer" onclick="dislikefn(<?php echo $Postid ?>, <?php echo $unique_id_me ?>, this)">Dislike</p>
        <p class="float-start mt-2 me-3" style="font-size: 18px"><i class="fas fa-thumbs-up me-1"></i><?php echo $countlikeall ?></p>
        <p class="float-start mt-2 me-5" style="font-size: 18px"><i class="fas fa-thumbs-down me-1"></i><?php echo $countdislikeall ?></p>
        <p class="float-start mt-2" style="font-size: 18px"><?php echo $no_comment ?> Comments</p>

        <a class="btn btn-sm btn-light text-secondary float-end mb-3" onclick="sharefn(<?php echo $Postid ?>, <?php echo $unique_id_me ?>)">
            <i class="fas fa-share"></i>
        </a>
        <button onclick="showCommentfn(<?php echo $Postid ?>)" class="btn btn-sm btn-success float-end mb-3" data-bs-toggle="modal" data-bs-target="#commentModal"><i class="fas fa-comments"></i></button>
        <button onclick="commentfn(this, <?php echo $Postid ?>, <?php echo $data1['unique_id'] ?>, <?php echo $unique_id_me ?>)" class="btn btn-sm btn-info text-white float-end mb-3"><i class="fas fa-comment"></i></button>
        <input type="text" class="ms-5 mt-2">
    </div>
</div>



<?php } } ?>








