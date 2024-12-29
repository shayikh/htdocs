<?php
include './header.php';

$cov_pic = $dataMe['cov_pic'];

$SQLabout = "SELECT * FROM `about` WHERE `unique_id`='$unique_id_me'";
$runAbout = mysqli_query($connection, $SQLabout);
$dataAbout = mysqli_fetch_assoc($runAbout);


?>


<!-- main page -->
<div class="container" style="margin-top: 133px">

    <div class="row">

        <div class="col-md-12">
            <img width="1294px" src="../pro_pic/cov_pic/<?php echo $dataMe['cov_pic'] ?>">
        </div>

        <div class="col-md-12 mt-4">
            <img style="border-radius: 50%;border: 3px solid #fff" width="220px" height="220px" src="../pro_pic/<?php echo $dataMe['pro_pic'] ?>">
        </div>

        <div class="col-md-12 text-center" style="margin-top: -146px;">
            <p class="text-white" style="font-size: 39px"><?php echo $dataMe['name'] ?></p>
        </div>

    </div>


    <div class="row mb-5">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="row justify-content-center" id="tbodyID">

            </div>
        </div>
        <div class="col-md-2"></div>
    </div>

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
                            <th class="text-center text-dark" scope="col">Name</th>
                            <th class="text-center text-dark" scope="col">Time</th>
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


<!-- Edit Modal -->
<div class="modal fade" id="postEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-dark" class="modal-title" id="exampleModalLabel">Edit Post</h5>
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
    let tbody = document.querySelector("#tbodyID");

    let editForm = document.querySelector("#editFormID");
    let editPost = document.querySelector("#editPostID");
    let editImage = document.querySelector("#editImageID");
    let editButton = document.querySelector("#editButtonID");
    let edit_post_id = document.querySelector("#edit_post_id");
    let editCloseBtn = document.querySelector("#editCloseBtn");
    let targetTr = null;

    let form = document.querySelector("#formID");
    let image = document.querySelector("#imageID");
    let post = document.querySelector("#postID");
    let button = document.querySelector("#buttonID");
    let postCloseBtn = document.querySelector("#postCloseBtn");

    let commentTboody = document.querySelector("#commentTboody");


    var page_no = 1;
    var returned = 1;

    showdata();

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 5) {
            if(returned == 1){
                returned = 0;
                showdata();
            }
        }
    })


    function showdata() {

        let postData = {};

        postData.page_no = page_no;
        postData.unique_id_me = <?php echo $unique_id_me ?>;

        axios.post("../api/post/loadmoreTimeline.php",
                postData, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {
                if (res.data == 0) {
                    toastr.info('You Are at The End');
                } else {
                    tbody.innerHTML = tbody.innerHTML + res.data;
                    page_no++;
                    returned = 1;
                }
            })
            .catch(err => {
                console.log(err);
            })
    }


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


    form.addEventListener('submit', (e) => {
        e.preventDefault();

        if (image.value == "" && post.value == "") {
            toastr.error('Post and Image Both Fields are Empty');
        } else {
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
        }
        

    })



    const makeTr = (post, unique_id_me) => {
        let tr = `<div class="statusp">
                        <div class="col-md-12" style="background-color: #18191A;padding: 10px;border-radius: 3px">
                            <div class="card" style="width: 100%;border: none">

                                <p class="text-white p-2" style="background-color: #18191A;border-radius: 3px 3px 0 0; ">
                                    <img style="border-radius: 50%" width="70px" height="70px" src="../pro_pic/<?php echo $pro_pic_me ?>">
                                    <b><?php echo $dataMe['name'] ?></b>
                                </p>
                                <img width="100%" src="../post_image/${post.image}">
                                <div class="card-body" style="background-color: #198754;border-radius: 0 0 3px 3px">
                                    <h6 class="card-title text-white">${post.time}</h6>
                                    <p class="card-text text-white">${post.post}</p>
                                </div>

                            </div>

                            <p class="float-start mt-2 me-3" style="color: ; font-size: 18px; cursor: pointer" onclick="likefn(${post.id}, ${unique_id_me}, this)">Like</p>
                            <p class="float-start mt-2 me-5" style="color: ; font-size: 18px; cursor: pointer" onclick="dislikefn(${post.id}, ${unique_id_me}, this)">Dislike</p>
                            <p class="float-start mt-2 me-3" style="font-size: 18px"><i class="fas fa-thumbs-up me-1"></i>0</p>
                            <p class="float-start mt-2 me-5" style="font-size: 18px"><i class="fas fa-thumbs-down me-1"></i>0</p>
                            <p class="float-start mt-2" style="font-size: 18px">0 Comments</p>

                            <button onclick="deletePost(${post.id}, ${unique_id_me}, this)" class="btn btn-sm btn-danger float-end mb-2">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <button onclick="editfn(${post.id}, this)" class="btn btn-sm btn-primary float-end mb-3" data-bs-toggle="modal" data-bs-target="#postEditModal">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-light text-secondary float-end mb-3" onclick="sharefn(${post.id}, ${unique_id_me})">
                                <i class="fas fa-share"></i>
                            </button>
                            <button onclick="showPostLinkForwardfn(${post.id})" class="btn btn-sm btn-primary float-end mb-3" data-bs-toggle="modal" data-bs-target="#postlinkforwardModal"><i class="fas fa-forward"></i></button>
                            <button onclick="showCommentfn(${post.id})" class="btn btn-sm btn-success float-end mb-3" data-bs-toggle="modal" data-bs-target="#commentModal"><i class="fas fa-comments"></i></button>
                            <button onclick="commentfn(this, ${post.id}, ${post.unique_id}, ${unique_id_me})" class="btn btn-sm btn-info text-white float-end mb-3"><i class="fas fa-comment"></i></button>
                            <input type="text" class="ms-5 mt-2">

                        </div>
                    </div>`
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

<button style="position: fixed;right:10px;bottom: 10px" class="btn btn-primary float-end mb-3" data-bs-toggle="modal" data-bs-target="#postModal">
    <i class="fas fa-plus"></i>
</button>


<?php
include './footer.php'
?>
