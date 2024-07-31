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


<div class="container" style="margin-top: 99px">
    <div class="row mb-5">
        <div class="col-md-2"></div>

        <div class="col-md-8">
            <div class="row justify-content-center">
                <div class="statusp">
                    <div class="col-md-12" style="background-color: #18191A;border-radius: 3px">
                        <div class="card" style="width: 100%;border: none">
                            <p class="text-white p-2" style="background-color: #18191A;border-radius: 3px 3px 0 0; ">
                                <a href="./people_timeline.php?type&unique_id_fr=<?php echo $data2['unique_id']?>" class="timeline_link">
                                    <img style="border-radius: 50%" width="45px" height="45px" src="../pro_pic/<?php echo $data2['pro_pic']?>">
                                    <b><?php echo $data2['name']?></b>
                                </a>
                            </p>
                            <img width="100%" src="../post_image/<?php echo $data1['image']?>">
                            <div class="card-body" style="background-color: #198754;border-radius: 0 0 3px 3px">
                                <h6 class="card-title text-white"><?php echo $data1['time']?></h6>
                                <p class="card-text text-white"><?php echo $data1['post']?></p>
                            </div>
                        </div>


                        <p class="float-start me-2" style="color: <?php $countlike == 1 ? printf("#0D6EFD") : printf("") ?>; font-size: 16px; margin-top: 2px; cursor: pointer" onclick="likefn(<?php echo $Postid ?>, <?php echo $unique_id_me ?>, this)"><i class="fas fa-thumbs-up me-1"></i>(<?php echo $countlikeall ?>)</p>
                        <p class="float-start me-3" style="color: <?php $countdislike == 1 ? printf("#0D6EFD") : printf("") ?>; font-size: 16px; margin-top: 3px; cursor: pointer" onclick="dislikefn(<?php echo $Postid ?>, <?php echo $unique_id_me ?>, this)"><i class="fas fa-thumbs-down me-1"></i>(<?php echo $countdislikeall ?>)</p>


                        <button class="btn btn-sm btn-light text-secondary float-end mb-3" onclick="shareMefn(<?php echo $Postid ?>, <?php echo $unique_id_me ?>)">
                            <i class="fas fa-share"></i>
                        </button>
                        <button onclick="showCommentfn(<?php echo $Postid ?>)" class="btn btn-sm btn-success float-end mb-3" data-bs-toggle="modal" data-bs-target="#commentModal"><i class="fas fa-comments"></i></button>
                        <button onclick="commentfn(this, <?php echo $Postid ?>, <?php echo $data1['unique_id'] ?>, <?php echo $unique_id_me ?>)" class="btn btn-sm btn-info text-white float-end mb-3"><i class="fas fa-comment"></i></button>
                        <input type="text" class="mt-1 d-inline float-start">
                        <p class="float-end d-inline" style="font-size: 16px;margin-top: -15px"><?php echo $no_comment ?> Comments</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>



<!-- Comment Modal -->
<div class="modal fade" id="commentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" modal-dialog modal-dialog-scrollable>
    <div class="modal-dialog modal-fullscreen">
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





<script>
    let commentTboody = document.querySelector("#commentTboody");


    const deleteComment = (comment_id, unique_id_me, elm) => {

        let delComment = {};

        delComment.comment_id = comment_id;
        delComment.unique_id_me = unique_id_me;

        axios.post("../api/comment/deleteComment.php",
                delComment, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {
                // console.log(res.data);

                if (res.data == 1) {
                    elm.parentElement.parentElement.remove();
                    toastr.info('Comment Deleted');
                } else {
                    toastr.warning('This is not Your Post');
                }

            })
            .catch(err => {
                console.log(err);
            })

    }


    const clearModal = () => {
        commentTboody.innerHTML = "";
    }


    const showCommentfn = (post_id) => {

        let showComment = {};

        showComment.post_id = post_id;

        axios.post("../api/comment/showComments.php",
                showComment, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {

                // console.log(res.data);

                let all = res.data;

                all.forEach(comment => {
                    commentTboody.innerHTML = commentTboody.innerHTML + makeCommentTr(comment);
                })


            })
            .catch(err => {
                console.log(err);
            })

    }


    const makeCommentTr = (comment) => {
        let tr = `<tr>
                            <td class="text-center">
                                <a href="./people_timeline.php?type&unique_id_fr=${comment.comn_giver_id}" target="_blank">
                                    <img class="text-center rounded-circle mt-3" width="50px" height="50px" src="../pro_pic/${comment.pro_pic}">
                                </a>
                            </td>

                            <td class="text-center" style="min-width: 100px">
                                <a style="color: blue" href="./people_timeline.php?type&unique_id_fr=${comment.comn_giver_id}" target="_blank">${comment.name}</a>
                            </td>

                            <td class="text-center text-dark" style="min-width: 130px">${comment.time}</td>
                            <td class="text-center text-dark" style="min-width: 250px">${comment.comment}</td>
                            <td class="text-center text-dark">
                                <i class="fas fa-trash m8-4" style="cursor: pointer" onclick="deleteComment(${comment.id}, <?php echo $unique_id_me ?>, this)"></i>
                            </td>
                        </tr>`
        return tr;
    }


    const commentfn = (elm, post_id, post_giver_id, comn_giver_id) => {

        let comment = elm.nextElementSibling.value;

        if (comment == "") {
            toastr.error("Comment is Empty");
        } else {


            let commentp = {};

            commentp.comment = comment;
            commentp.post_id = post_id;
            commentp.post_giver_id = post_giver_id;
            commentp.comn_giver_id = comn_giver_id;


            axios.post("../api/comment/comment.php",
                    commentp, {
                        headers: {
                            "Content-Type": "application/json"
                        }
                    })
                .then(res => {
                    // console.log(elm);

                    if (res.data == 1) {
                        elm.nextElementSibling.value = '';
                        toastr.success("Comment Done");
                    }


                })
                .catch(err => {
                    console.log(err);
                })

        }


    }




    const likefn = (post_id, unique_id_me, elm) => {
        let likep = {};

        likep.post_id = post_id;
        likep.unique_id_me = unique_id_me;

        axios.post("../api/post/like_post.php",
                likep, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {
                // console.log(elm);

                if (res.data == 1) {
                    elm.style.color = '#0D6EFD';
                    elm.nextElementSibling.style.color = '#fff';
                } else {
                    elm.style.color = '#fff';
                }


            })
            .catch(err => {
                console.log(err);
            })
    }


    const dislikefn = (post_id, unique_id_me, elm) => {
        let dislikep = {};

        dislikep.post_id = post_id;
        dislikep.unique_id_me = unique_id_me;

        axios.post("../api/post/dislike_post.php",
                dislikep, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {
                // console.log(elm);

                if (res.data == 1) {
                    elm.style.color = '#0D6EFD';
                    elm.previousElementSibling.style.color = '#fff';
                } else {
                    elm.style.color = '#fff';
                }


            })
            .catch(err => {
                console.log(err);
            })
    }

    const shareMefn = (post_id, unique_id_me) => {
        let confirm = window.confirm("Do You Want to Share?");

        if (confirm) {
            let sharep = {};

            sharep.post_id = post_id;
            sharep.unique_id_me = unique_id_me;

            axios.post("../api/post/share.php",
                    sharep, {
                        headers: {
                            "Content-Type": "application/json"
                        }
                    })
                .then(res => {

                    toastr.success('Post Shared to Your Timeline');

                })
                .catch(err => {
                    console.log(err);
                })

        } else {
            return;
        }

    }

</script>



<?php
include './footer.php'
?>
