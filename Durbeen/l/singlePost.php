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
                                <p class="card-title text-white"><?php echo $data1['time']?></p>
                                <p class="card-text text-white"><?php echo $data1['post']?></p>
                            </div>
                        </div>

                        <p class="float-start mt-2 me-3" style="color: <?php $countlike == 1 ? printf("#0D6EFD") : printf("") ?>; font-size: 18px; cursor: pointer" onclick="likefn(<?php echo $Postid ?>, <?php echo $unique_id_me ?>, this)">Like</p>
                        <p class="float-start mt-2 me-5" style="color: <?php $countdislike == 1 ? printf("#0D6EFD") : printf("") ?>; font-size: 18px; cursor: pointer" onclick="dislikefn(<?php echo $Postid ?>, <?php echo $unique_id_me ?>, this)">Dislike</p>
                        <p class="float-start mt-2 me-3" style="font-size: 18px"><i class="fas fa-thumbs-up me-1"></i><?php echo $countlikeall ?></p>
                        <p class="float-start mt-2 me-5" style="font-size: 18px"><i class="fas fa-thumbs-down me-1"></i><?php echo $countdislikeall ?></p>
                        <p class="float-start mt-2" style="font-size: 18px"><?php echo $no_comment ?> Comments</p>
]

                        <?php if($unique_id_fr == $unique_id_me) {?>
                        <button onclick="deletePost(<?php echo $Postid ?>, <?php echo $unique_id_me ?>, this)" class="btn btn-sm btn-danger float-end mb-2"><i class="fas fa-trash-alt"></i></button>

                        <button onclick="editfn(<?php echo $Postid ?>, this)" class="btn btn-sm btn-primary float-end mb-3" data-bs-toggle="modal" data-bs-target="#postEditModal">
                            <i class="fas fa-edit"></i>
                        </button>
                        <?php } ?>

                        <button class="btn btn-sm btn-light text-secondary float-end mb-3" onclick="shareMefn(<?php echo $Postid ?>, <?php echo $unique_id_me ?>)">
                            <i class="fas fa-share"></i>
                        </button>

                        <button onclick="showPostLinkForwardfn(<?php echo $Postid ?>)" class="btn btn-sm btn-primary float-end mb-3" data-bs-toggle="modal" data-bs-target="#postlinkforwardModal"><i class="fas fa-forward"></i></button>
                        <button onclick="showCommentfn(<?php echo $Postid ?>, <?php echo $unique_id_me ?>)" class="btn btn-sm btn-success float-end mb-3" data-bs-toggle="modal" data-bs-target="#commentModal"><i class="fas fa-comments"></i></button>
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
                    <tbody id="commentTbody">

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

<!-- Edit Modal -->
<div class="modal fade" id="postEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Post</h5>
                <button id="editCloseBtn" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="editFormID" enctype="multipart/form-data">
                    <input type="hidden" name="edit_unique_id_me" value="<?php echo $unique_id_me ?>">
                    <input type="hidden" name="edit_post_id" id="edit_post_id" value="">

                    <textarea style="background-color: #F3F3F3;color: #000" name="editPost" id="editPostID" rows="5" class="form-control mb-2" type="text"></textarea>

                    <input style="background-color: #F3F3F3;" name="editImage" class="form-control" id="editImageID" type="file" accept="image/png, image/bmp, image/gif, image/jpg, image/avif, image/jpeg, image/jfif, image/pjpeg, image/pjp, image/apng, image/svg, image/webp">

                    <input name="updateBtn" id="editButtonID" value="UPDATE" class="mt-2 float-end btn btn-sm red" type="submit" aria-label="Close">
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Post Link Forward Modal -->
<div class="modal fade" id="postlinkforwardModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true" modal-dialog modal-dialog-scrollable>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="staticBackdropLabel2">Forward Post Link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="clearModal()"></button>
            </div>
            <div class="modal-body">


                <div class="row">
                    <div class="col-lg-6">
                        <form action="" method="post" id="forwardFormID_all_frID" enctype="multipart/form-data">

                            <input type="hidden" name="hidden_post_id" id="hidden_post_id_all_frID" value="">
                            <input type="hidden" name="unique_id_me" value="<?php echo $unique_id_me?>">

                            <input name="forwardBtn" value="FORWARD TO ALL FRIENDS" class="form-control btn btn-success" type="submit">

                        </form>
                    </div>
                    <div class="col-lg-6">
                        <form action="" method="post" id="forwardFormID_all_grpID" enctype="multipart/form-data">

                            <input type="hidden" name="hidden_post_id" id="hidden_post_id_all_grpID" value="">
                            <input type="hidden" name="unique_id_me" value="<?php echo $unique_id_me?>">

                            <input name="forwardBtn" value="FORWARD TO ALL GROUPS" class="form-control btn btn-success" type="submit">

                        </form>
                    </div>
                </div>

                <form action="" method="post" id="forwardFormID" enctype="multipart/form-data">

                    <input type="hidden" name="hidden_post_id" id="hidden_post_id" value="">
                    <input type="hidden" name="unique_id_me" value="<?php echo $unique_id_me?>">
                    
                    <div class="row mt-3">
                        <div class="col-lg-6">
                            <input style="background-color: #F3F3F3;color: #000" name="search" id="searchID" class="form-control mb-2" type="text" placeholder="Friend Name">
                        </div>
                        <div class="col-lg-6">
                            <input name="searchBtn" id="searchBtnID" value="SEARCH" class="form-control btn btn-danger" type="submit" aria-label="Close">
                        </div>
                    </div>
                </form>


                <table class="table table-striped table-hover table-bordered mt-2">
                    <thead>
                        <tr>
                            <th class="text-center text-dark" scope="col">Picture</th>
                            <th class="text-center text-dark" scope="col" style="min-width: 200px">Name</th>
                            <th class="text-center text-dark" scope="col">Forward</th>
                        </tr>
                    </thead>
                    <tbody id="postlinkforwardTboodyID">

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
    let editForm = document.querySelector("#editFormID");
    let editPost = document.querySelector("#editPostID");
    let editImage = document.querySelector("#editImageID");
    let editButton = document.querySelector("#editButtonID");
    let edit_post_id = document.querySelector("#edit_post_id");
    let editCloseBtn = document.querySelector("#editCloseBtn");
    let targetTr = null;

    let commentTbody = document.querySelector("#commentTbody");
    let postlinkforwardTboody = document.querySelector("#postlinkforwardTboodyID");

    let forwardForm = document.querySelector("#forwardFormID");
    let searchValue = document.querySelector("#searchID");
    let searchButton = document.querySelector("#searchBtnID");
    let hidden_post_id_number = document.querySelector("#hidden_post_id");


    let hidden_post_id_all_fr = document.querySelector("#hidden_post_id_all_frID");
    let hidden_post_id_all_grp = document.querySelector("#hidden_post_id_all_grpID");
    
    let forwardFormID_all_fr = document.querySelector("#forwardFormID_all_frID");
    let forwardFormID_all_grp = document.querySelector("#forwardFormID_all_grpID");


    forwardFormID_all_fr.addEventListener('submit', (e) => {
        e.preventDefault();


        var forwardFormdata_all_fr = new FormData(forwardFormID_all_fr);

        $.ajax({
            url: "../api/postLinkForward/forwardLoop/forwardAllFr.php",
            type: "POST",
            data: forwardFormdata_all_fr,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                // alert('ok')
            },
            success: function(data) {

                // console.log(data);
                forwardFormID_all_fr.classList.add("d-none");
                toastr.success('Post Link Forwarded to All Friends');
            },
            error: function(err) {
                console.log(err);
            }
        });

    })


    
    forwardFormID_all_grpID.addEventListener('submit', (e) => {
        e.preventDefault();


        var forwardFormdata_all_grp = new FormData(forwardFormID_all_grpID);

        $.ajax({
            url: "../api/postLinkForward/forwardLoop/forwardAllGrp.php",
            type: "POST",
            data: forwardFormdata_all_grp,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                // alert('ok')
            },
            success: function(data) {

                // console.log(data);
                forwardFormID_all_grpID.classList.add("d-none");
                toastr.success('Post Link Forwarded to All Groups');
            },
            error: function(err) {
                console.log(err);
            }
        });

    })
    


    forwardForm.addEventListener('submit', (e) => {
        e.preventDefault();

        if (searchValue.value == "") {
            toastr.error('Search Field is Empty');
        } else {
            var forwardFormdata = new FormData(forwardForm);

            $.ajax({
                url: "../api/postLinkForward/searchFriend.php",
                type: "POST",
                data: forwardFormdata,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    // alert('ok')
                },
                success: function(data) {

                    // let json = JSON.parse(data);

                    // console.log(data);


                    if (data == 0) {
                        postlinkforwardTboody.innerHTML = "";
                        toastr.error('Friends Not Found');
                    } else {
                        postlinkforwardTboody.innerHTML = data;
                        searchValue.value = "";
                        toastr.success('Friends Found');
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }
    })

    
    editForm.addEventListener('submit', (e) => {
        e.preventDefault();


        var editformdata = new FormData(editForm);

        $.ajax({
            url: "../api/post/updatePost.php",
            type: "POST",
            data: editformdata,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                // alert('ok')
            },
            success: function(data) {

                let json = JSON.parse(data);

                let updatedPost = json.updatedPost;

                targetTr.firstElementChild.firstElementChild.firstElementChild.nextElementSibling.src = "../post_image/" + updatedPost.image;
                targetTr.firstElementChild.firstElementChild.firstElementChild.nextElementSibling.nextElementSibling.firstElementChild.innerText = updatedPost.time;
                targetTr.firstElementChild.firstElementChild.firstElementChild.nextElementSibling.nextElementSibling.firstElementChild.nextElementSibling.innerText = updatedPost.post;

                editImage.value = "";
                editPost.value = "";

                toastr.success('Post Updated');

                editCloseBtn.click();
                targetTr = null;
            },
            error: function(err) {
                console.log(err);
            }
        });

    })


    const editfn = (post_id, elm) => {
        editPost.value = elm.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.firstElementChild.nextElementSibling.nextElementSibling.firstElementChild.nextElementSibling.innerText;
        edit_post_id.value = post_id;

        targetTr = elm.parentElement.parentElement;
    }
    
    const showPostLinkForwardfn = (post_id) => {

        forwardFormID_all_fr.classList.remove("d-none");
        forwardFormID_all_grpID.classList.remove("d-none");
        
        hidden_post_id_all_fr.value = post_id;
        hidden_post_id_all_grp.value = post_id;
        
        hidden_post_id_number.value = post_id;

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
