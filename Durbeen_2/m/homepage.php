<?php
include './header.php';



$SQL2 = "SELECT * FROM `admin` WHERE `unique_id`='$unique_id_me'";
$run2 = mysqli_query($connection, $SQL2);
$count2 = mysqli_num_rows($run2);

$SQL3 = "SELECT * FROM `account`";
$run3 = mysqli_query($connection, $SQL3);
$count3 = mysqli_num_rows($run3);


// message notification
$SQLnotify = "SELECT * FROM `$unique_id_me notify` WHERE `seen`='0'";
$runnotify = mysqli_query($connection_info, $SQLnotify);
$number = mysqli_num_rows($runnotify);

if ($number > 0) { ?>
<a style="position: fixed;left: 3px;top: 61px;z-index: 15;font-weight: 600;" href="./notification.php?type=notification" class="btn btn-sm btn-danger">You Have <?php echo $number ?> New Messages</a>
<?php } 



if ($count2 > 0 && $count3 > 0) { ?>
<a style="position: fixed;left: 3px;top: 99px;z-index:15;font-weight: 600;" href="./register_confirm.php?type" class="btn btn-sm btn-danger"><?php echo $count3 ?> New Account Requests</a>
<?php } ?>




<!-- NEWS FEED -->

<div class="container" style="margin-top: 99px">

    <div class="row mb-5">
        <div class="col-md-2"></div>

        <div class="col-md-8">
            <div class="row justify-content-center" id="tbodyID">


            </div>
        </div>
        <div class="col-md-2"></div>
    </div>


    <!-- Post Modal -->
    <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-dark" class="modal-title" id="postModalLabel">Make Post</h5>
                    <button id="postCloseBtn" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="formID" enctype="multipart/form-data">
                        <input type="hidden" name="unique_id_me" value="<?php echo $unique_id_me ?>">

                        <textarea style="background-color: #F3F3F3;color: #000" name="post" id="postID" rows="5" class="form-control mb-2" type="text"></textarea>

                        <input style="background-color: #F3F3F3;" name="image_khan_bahadur" class="form-control" id="imageID" type="file" accept="image/png, image/bmp, image/gif, image/jpg, image/avif, image/jpeg, image/jfif, image/pjpeg, image/pjp, image/apng, image/svg, image/webp">

                        <input name="saveBtn" id="buttonID" value="POST" class="mt-2 float-end btn btn-sm red" type="submit" aria-label="Close">
                    </form>
                </div>
            </div>
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
        let tbody = document.querySelector("#tbodyID");

        let form = document.querySelector("#formID");
        let image = document.querySelector("#imageID");
        let post = document.querySelector("#postID");
        let button = document.querySelector("#buttonID");
        let postCloseBtn = document.querySelector("#postCloseBtn");

        let commentTboody = document.querySelector("#commentTboody");


        var page_no = 1;

        showdata();

        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() > $(document).height() - 60) {
                showdata();
            }
        })


        function showdata() {

            let postData = {};

            postData.page_no = page_no;
            postData.unique_id_me = <?php echo $unique_id_me ?>;

            axios.post("../api/post/loadmoreHomePage_m.php",
                    postData, {
                        headers: {
                            "Content-Type": "application/json"
                        }
                    })
                .then(res => {
                    if (res.data == 0) {
                        console.log("You Are at The End");
                        page_no++;
                        showdata();
                    } else {
                        tbody.innerHTML = tbody.innerHTML + res.data;
                        page_no++;
                    }
                })
                .catch(err => {
                    console.log(err);
                })
        }


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
                        toastr.warning("You Can not Delete Other's Comment in Other's Post");
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
                                <a href="./people_timeline.php?type&unique_id_fr=${comment.comn_giver_id}">
                                    <img class="text-center rounded-circle mt-3" width="50px" height="50px" src="../pro_pic/${comment.pro_pic}">
                                </a>
                            </td>

                            <td class="text-center" style="min-width: 100px">
                                <a style="color: blue" href="./people_timeline.php?type&unique_id_fr=${comment.comn_giver_id}">${comment.name}</a>
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


        form.addEventListener('submit', (e) => {
            e.preventDefault();


            var formdata = new FormData(form);

            $.ajax({
                url: "../api/post/postAdd.php",
                type: "POST",
                data: formdata,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    // alert('ok')
                },
                success: function(data) {

                    let json = JSON.parse(data);

                    // console.log(json);


                    let unique_id_me = json.unique_id_me;
                    let newPost = json.newPost;

                    tbody.innerHTML = makeTr(newPost, unique_id_me) + tbody.innerHTML;

                    postCloseBtn.click();

                    image.value = "";
                    post.value = "";

                    toastr.success('Post Created');
                },
                error: function(err) {
                    console.log(err);
                }
            });

        })


        const makeTr = (post, unique_id_me) => {
            let tr = `<div class="statusp">
                            <div class="col-md-12" style="background-color: #18191A;border-radius: 3px">
                                <div class="card" style="width: 100%;border: none">

                                    <p class="text-white p-2" style="background-color: #18191A;border-radius: 3px 3px 0 0; ">
                                        <a href="./people_timeline.php?type&amp;unique_id_fr=${unique_id_me}" class="timeline_link">
                                            <img style="border-radius: 50%" width="45px" height="45px" src="../pro_pic/<?php echo $dataMe['pro_pic'] ?>">
                                            <b><?php echo $dataMe['name'] ?></b>
                                        </a>
                                    </p>
                                    <img width="100%" src="../post_image/${post.image}">
                                    <div class="card-body" style="background-color: #198754;border-radius: 0 0 3px 3px">
                                        <h6 class="card-title text-white">${post.time}</h6>
                                        <p class="card-text text-white">${post.post}</p>
                                    </div>

                                </div>

                                <p class="float-start me-2" style="color: ; font-size: 16px; margin-top: 2px; cursor: pointer" onclick="likefn(${post.id}, ${unique_id_me}, this)"><i class="fas fa-thumbs-up me-1"></i>(0)</p>
                                <p class="float-start me-3" style="color: ; font-size: 16px; margin-top: 3px; cursor: pointer" onclick="dislikefn(${post.id}, ${unique_id_me}, this)"><i class="fas fa-thumbs-down me-1"></i>(0)</p>

                                <a class="btn btn-sm btn-light text-secondary float-end mb-3" onclick="sharefn(${post.id}, ${unique_id_me})">
                                <i class="fas fa-share"></i>
                                </a>
                                <button onclick="showCommentfn(${post.id})" class="btn btn-sm btn-success float-end mb-3" data-bs-toggle="modal" data-bs-target="#commentModal"><i class="fas fa-comments"></i></button>
                                <button onclick="commentfn(this, ${post.id}, ${post.unique_id}, ${unique_id_me})" class="btn btn-sm btn-info text-white float-end mb-3"><i class="fas fa-comment"></i></button>
                                <input type="text" class="mt-1 float-start">
                                <p class="float-end" style="font-size: 16px;margin-top: -15px">0 Comments</p>
                            </div>
                        </div>`
            return tr;
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


        const sharefn = (post_id, unique_id_me) => {
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

                        let json = res.data;

                        let unique_id_me = json.unique_id_me;
                        let newPost = json.newPost;

                        tbody.innerHTML = makeTr(newPost, unique_id_me) + tbody.innerHTML;

                        toastr.success('Post Shared');


                    })
                    .catch(err => {
                        console.log(err);
                    })

            } else {
                return;
            }

        }

    </script>


    <button style="position: fixed;right:10px;bottom: 10px" class="btn btn-primary float-end mb-3" data-bs-toggle="modal" data-bs-target="#postModal">
        <i class="fas fa-plus"></i>
    </button>


</div>


<?php
include './footer.php'
?>
