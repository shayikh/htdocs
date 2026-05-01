<?php
include './header.php';

$cov_pic = $dataMe['cov_pic'];

$SQLabout = "SELECT * FROM `about` WHERE `unique_id`='$unique_id_me'";
$runAbout = mysqli_query($connection, $SQLabout);
$dataAbout = mysqli_fetch_assoc($runAbout);


?>


<!-- main page -->
<div class="container" style="margin-top: 99px">

    <div class="row">

        <div class="col-md-12">
            <img width="335px" src="../pro_pic/cov_pic/<?php echo $dataMe['cov_pic'] ?>">
        </div>

        <div class="col-md-12 text-center mt-4">
            <img style="border-radius: 50%;border: 2px solid #fff;margin-top: 17px;margin-bottom: 10px" width="120px" height="120px" src="../pro_pic/<?php echo $dataMe['pro_pic'] ?>">
        </div>

        <div class="col-md-12 text-center" style="margin-top: -170px;">
            <p class="text-white" style="font-size: 25px" id="name"><?php echo $dataMe['name'] ?></p>
        </div>

    </div>


    <div class="row mb-5">
        <div class="col-md-2"></div>

        <div class="col-md-8">
            <!-- Status Bar -->
			<div class="row justify-content-center">
                <div class="card-new">

                    <div class="title text-white">Create Post</div>

                    <textarea id="contentID" placeholder="What's on your mind?"></textarea>

                    <div class="dropzone" id="dropZone">
                        Drag & Drop • Paste • Click to Add Images
                    </div>

                    <input type="file" id="fileInput" multiple hidden accept="image/png, image/bmp, image/gif, image/jpg, image/avif, image/jpeg, image/jfif, image/pjpeg, image/pjp, image/apng, image/svg, image/webp">

                    <div id="preview"></div>

                    <button class="button-new" onclick="postAdd(<?php echo $unique_id_me?>)">Publish Post</button>

                </div>
			</div>
            <!-- Status Bar end -->
            <div class="row justify-content-center" id="tbodyID">

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
                <h5 class="modal-title text-dark" id="staticBackdropLabel">Comments</h5>
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
                    <tbody id="commentTbody">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" onclick="clearModal()">
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

                    <input name="updateBtn" id="editButtonID" value="UPDATE" class="mt-2 float-end btn btn-sm red" type="submit">
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Post Link Forward Modal -->
<div class="modal fade" id="postlinkforwardModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true" modal-dialog modal-dialog-scrollable>
    <div class="modal-dialog modal-fullscreen">
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

                            <input name="forwardBtn" value="FORWARD TO ALL FRIENDS" class="form-control btn btn-sm btn-success" type="submit">

                        </form>
                    </div>
                    <div class="col-lg-6">
                        <form action="" method="post" id="forwardFormID_all_grpID" enctype="multipart/form-data">

                            <input type="hidden" name="hidden_post_id" id="hidden_post_id_all_grpID" value="">
                            <input type="hidden" name="unique_id_me" value="<?php echo $unique_id_me?>">

                            <input name="forwardBtn" value="FORWARD TO ALL GROUPS" class="form-control btn btn-sm btn-success mt-2" type="submit">

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
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" onclick="clearModal()">
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
    
    var page_no = 1;
    var returned = 1;

    showdata();

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
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

        axios.post("../api/post/loadmoreTimeline_m.php",
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

                let unique_id_me = json.unique_id_me;
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
        editPost.value = elm.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.firstElementChild.nextElementSibling.nextElementSibling.firstElementChild.nextElementSibling.innerText;
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



    const makeTr = (post, unique_id_me) => {
        let tr = `<div class="statusp">
                            <div class="col-md-12" style="background-color: #18191A;border-radius: 3px">
                                <div class="card" style="width: 100%;border: none">

                                    <p class="text-white p-2" style="background-color: #18191A;border-radius: 3px 3px 0 0; ">
                                        <a href="./people_timeline.php?type&amp;unique_id_fr=${unique_id_me}" class="timeline_link">
                                            <img style="border-radius: 50%" width="45px" height="45px" src="../pro_pic/<?php echo $pro_pic_me?>">
                                            <b><?php echo $dataMe['name'] ?></b>
                                        </a>
                                    </p>
                                    <img width="100%" src="../post_image/${post.image}">
                                    <div class="card-body" style="background-color: #198754;border-radius: 0 0 3px 3px">
                                        <p class="card-title text-white">${post.time}</p>
                                        <p class="card-text text-white">${post.post}</p>
                                    </div>

                                </div>

                                <p class="float-start me-2" style="color: ; font-size: 16px; margin-top: 2px; cursor: pointer" onclick="likefn(${post.id}, ${unique_id_me}, this)"><i class="fas fa-thumbs-up me-1"></i>(0)</p>
                                <p class="float-start me-3" style="color: ; font-size: 16px; margin-top: 3px; cursor: pointer" onclick="dislikefn(${post.id}, ${unique_id_me}, this)"><i class="fas fa-thumbs-down me-1"></i>(0)</p>

                                <button onclick="deletePost(${post.id}, ${unique_id_me}, this)" class="btn btn-sm btn-danger float-end mb-2">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <button onclick="editfn(${post.id}, this)" class="btn btn-sm btn-primary float-end mb-3" data-bs-toggle="modal" data-bs-target="#postEditModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a class="btn btn-sm btn-light text-secondary float-end mb-3" onclick="sharefn(${post.id}, ${unique_id_me})">
                                <i class="fas fa-share"></i>
                                </a>
                                <button onclick="showPostLinkForwardfn(${post.id})" class="btn btn-sm btn-primary float-end mb-3" data-bs-toggle="modal" data-bs-target="#postlinkforwardModal"><i class="fas fa-forward"></i></button>
                                <button onclick="showCommentfn(${post.id}, ${unique_id_me})" class="btn btn-sm btn-success float-end mb-3" data-bs-toggle="modal" data-bs-target="#commentModal"><i class="fas fa-comments"></i></button>
                                <button onclick="commentfn(this, ${post.id}, ${post.unique_id}, ${unique_id_me})" class="btn btn-sm btn-info text-white float-end mb-3"><i class="fas fa-comment"></i></button>
                                <input type="text" class="float-start" style="margin-top: -15px>
                                <p class="float-end" style="font-size: 16px;margin-top: -15px">0 Comments</p>
                            </div>
                        </div>`
        return tr;
    }


</script>



<?php
include './footer.php'
?>
