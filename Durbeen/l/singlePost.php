<?php
include './header.php';


$post_id = $_GET['post_id'];


$SQL = "SELECT * FROM `post` WHERE `id`='$post_id'";
$run = mysqli_query($connection, $SQL);
$data1 = mysqli_fetch_assoc($run);




$unique_id_fr = $data1['unique_id'];


$SQL2 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_fr'";
$run2 = mysqli_query($connection, $SQL2);
$data2 = mysqli_fetch_assoc($run2);


$Postid = $data1['id'];
$comn_count = "SELECT * FROM `comment` WHERE `post_id`='$Postid'";
$runComn_count = mysqli_query($connection, $comn_count);
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




<!-- main page -->


<div class="container" style="margin-top:130px">
    <div class="row mb-5">
        <div class="col-md-2"></div>

        <div class="col-md-8">
            <div class="row justify-content-center">
                <div class="statusp">
                    <div class="col-md-12" style="background-color: #18191A;padding: 10px;border-radius: 3px">
                        <div class="card" style="width: 100%;border: none">
                            <p class="text-white p-2" style="background-color: #18191A;border-radius: 3px 3px 0 0; ">
                                <a href="./people_timeline.php?type&unique_id_fr=<?php echo $data2['unique_id']?>" class="timeline_link">
                                    <img style="border-radius: 50%" width="70px" height="70px" src="../pro_pic/<?php echo $data2['pro_pic']?>">
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

                        <button class="btn btn-sm btn-light text-secondary float-end mb-3" onclick="shareMefn(<?php echo $Postid ?>, <?php echo $unique_id_me ?>)">
                            <i class="fas fa-share"></i>
                        </button>

                        <button onclick="showPostLinkForwardfn(<?php echo $Postid ?>)" class="btn btn-sm btn-primary float-end mb-3" data-bs-toggle="modal" data-bs-target="#postlinkforwardModal"><i class="fas fa-forward"></i></button>
                        <button onclick="showCommentfn(<?php echo $Postid ?>)" class="btn btn-sm btn-success float-end mb-3" data-bs-toggle="modal" data-bs-target="#commentModal"><i class="fas fa-comments"></i></button>
                        <button onclick="commentfn(this, <?php echo $Postid ?>, <?php echo $data1['unique_id'] ?>, <?php echo $unique_id_me ?>)" class="btn btn-sm btn-info text-white float-end mb-3"><i class="fas fa-comment"></i></button>
                        <input type="text" class="ms-5 mt-2">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>



<!-- Comment Modal -->
<div class="modal fade" id="commentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" modal-dialog modal-dialog-scrollable>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Comments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="clearModal()"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center text-dark" scope="col">Picture</th>
                            <th class="text-center text-dark" scope="col" style="min-width: 200px">Name</th>
                            <th class="text-center text-dark" scope="col" style="min-width: 150px">Time</th>
                            <th class="text-center text-dark" scope="col">Comment</th>
                            <th class="text-center text-dark" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="commentTboody">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearModal()">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>


<!-- Post Link Forward Modal -->
<div class="modal fade" id="postlinkforwardModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true" modal-dialog modal-dialog-scrollable>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel2">Comments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="clearModal()"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center text-dark" scope="col">Picture</th>
                            <th class="text-center text-dark" scope="col" style="min-width: 200px">Name</th>
                            <th class="text-center text-dark" scope="col">Forward</th>
                        </tr>
                    </thead>
                    <tbody id="postlinkforwardTboody">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearModal()">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>





<script>
    let commentTboody = document.querySelector("#commentTboody");
    let postlinkforwardTboody = document.querySelector("#postlinkforwardTboody");


    const makeCommentTr = (comment) => {
        let tr = `<tr>
						<td class="text-center">
							<a href="./people_timeline.php?type&unique_id_fr=${comment.comn_giver_id}" target="_blank">
								<img class="text-center rounded-circle" width="70px" height="70px" src="../pro_pic/${comment.pro_pic}">
							</a>
						</td>

						<td class="text-center text-dark">
							<a style="color: blue" href="./people_timeline.php?type&unique_id_fr=${comment.comn_giver_id}" target="_blank">${comment.name}</a>
						</td>

						<td class="text-center text-dark">${comment.time}</td>
						<td class="text-center text-dark">${comment.comment}</td>
						<td class="text-center text-dark">
							<i class="fas fa-trash me-4" style="cursor: pointer" onclick="deleteComment(${comment.id}, <?php echo $unique_id_me ?>, this)"></i>
						</td>
				</tr>`
        return tr;
    }


    
    const showPostLinkForwardfn = (post_id) => {

        let showPostLinkForward = {};

        showPostLinkForward.unique_id_me = <?php echo $unique_id_me ?>;
        showPostLinkForward.post_id = post_id;

        axios.post("../api/postLinkForward/friendList.php",
        showPostLinkForward, {
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(res => {

            // console.log(res.data);
            postlinkforwardTboody.innerHTML = res.data;

        })
        .catch(err => {
            console.log(err);
        })

    }

</script>



<?php
include './footer.php'
?>
