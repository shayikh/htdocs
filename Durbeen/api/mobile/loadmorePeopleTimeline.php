<?php
include '../../connection.php';

header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);
$page_no = $data['page_no'];
$unique_id_me = $data['unique_id_me'];
$unique_id_fr = $data['unique_id_fr'];





$limit = 5;
$row = ($page_no - 1)*$limit;

$SQL = "SELECT * FROM `post` WHERE `unique_id`='$unique_id_fr' ORDER BY `id` DESC limit $row,$limit";
$run = mysqli_query($connection,$SQL);







while ($data1 = mysqli_fetch_assoc($run)){

$SQLfr="SELECT * FROM `registration` WHERE `unique_id`='$unique_id_fr'";
$runfr=mysqli_query($connection,$SQLfr);
$datafr=mysqli_fetch_assoc($runfr);

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
    <div class="col-md-12" style="background-color: #18191A;border-radius: 3px">
        <div class="card" style="width: 100%;border: none;">
            <p class="text-white p-2" style="background-color: #18191A;border-radius: 3px 3px 0 0;">
                <img style="border-radius: 50%" width="45px" height="45px"
                    src="../pro_pic/<?php echo $datafr['pro_pic']?>" alt="">
                <b><?php echo $datafr['name']?></b>
            </p>
            <img width="100%" src="../post_image/<?php echo $data1['image']?>" alt="">
            <div class="card-body" style="background-color: #198754;border-radius: 0 0 3px 3px">
                <h6 class="card-title text-white"><?php echo $data1['time']?></h6>
                <p class="card-text text-white"><?php echo $data1['post']?></p>
            </div>
        </div>



        <p class="float-start me-2" style="color: <?php $countlike == 1 ? printf("#0D6EFD") : printf("") ?>; font-size: 16px; margin-top: 2px; cursor: pointer" onclick="likefn(<?php echo $Postid ?>, <?php echo $unique_id_me ?>, this)"><i class="fas fa-thumbs-up me-1"></i>(<?php echo $countlikeall ?>)</p>
        <p class="float-start me-3" style="color: <?php $countdislike == 1 ? printf("#0D6EFD") : printf("") ?>; font-size: 16px; margin-top: 3px; cursor: pointer" onclick="dislikefn(<?php echo $Postid ?>, <?php echo $unique_id_me ?>, this)"><i class="fas fa-thumbs-down me-1"></i>(<?php echo $countdislikeall ?>)</p>


        <!-- comment button -->
        <button class="btn btn-sm btn-light text-secondary float-end mb-3" onclick="sharefn(<?php echo $Postid ?>, <?php echo $unique_id_me ?>)">
            <i class="fas fa-share"></i>
        </button>

        <button onclick="showCommentfn(<?php echo $Postid ?>)" class="btn btn-sm btn-success float-end mb-3" data-bs-toggle="modal" data-bs-target="#commentModal"><i class="fas fa-comments"></i></button>
        <button onclick="commentfn(this, <?php echo $Postid ?>, <?php echo $data1['unique_id'] ?>, <?php echo $unique_id_me ?>)" class="btn btn-sm btn-info text-white float-end mb-3"><i class="fas fa-comment"></i></button>
        <input type="text" class="mt-1 d-inline float-start">
        <p class="float-end d-inline" style="font-size: 16px;margin-top: -15px"><?php echo $no_comment ?> Comments</p>
    </div>
</div>

<?php } ?>