<?php
include './header.php';

$unique_id_fr = $_GET['unique_id_fr'];

if ($unique_id_fr == $unique_id_me) {
    echo "<script>window.location = 'timeline.php?type=timeline'</script>";
}


$SQLA = "SELECT * FROM `$unique_id_me allow` WHERE `unique_id_fr`='$unique_id_fr'";
$runA = mysqli_query($connection_info, $SQLA);
$countA = mysqli_num_rows($runA);

$SQL2 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_me'";
$run2 = mysqli_query($connection,$SQL2);
$data2 = mysqli_fetch_assoc($run2);
$locking = $data2['locking'];


$SQL1 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_fr'";
$run1 = mysqli_query($connection,$SQL1);
$data1 = mysqli_fetch_assoc($run1);
$frlocking = $data1['locking'];

$SQLF = "SELECT * FROM `$unique_id_fr allow` WHERE `unique_id_fr`='$unique_id_me'";
$runF = mysqli_query($connection_info, $SQLF);
$countF = mysqli_num_rows($runF);

if ($countF == 0 && $frlocking == 1) {
    echo "<script>window.location = 'facelist.php?type=facelist&nofollow'</script>";
}



$SQLF = "SELECT * FROM `$unique_id_me follow` WHERE `unique_id_fr`='$unique_id_fr'";
$runF = mysqli_query($connection_info, $SQLF);
$countF = mysqli_num_rows($runF);


$SQL1 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_fr'";
$run1 = mysqli_query($connection, $SQL1);
$data1 = mysqli_fetch_assoc($run1);

$SQLabout = "SELECT * FROM `about` WHERE `unique_id`='$unique_id_fr'";
$runAbout = mysqli_query($connection, $SQLabout);
$dataAbout = mysqli_fetch_assoc($runAbout);

?>


<!-- main page -->
<div class="container" style="margin-top: 99px">
    <div class="row">

        <div class="col-md-12">
            <img width="335px" src="../pro_pic/cov_pic/<?php echo $data1['cov_pic'] ?>">
        </div>

        <div class="col-md-12 text-center mt-4">
            <img style="border-radius: 50%;border: 2px solid #fff;margin-top: 17px;margin-bottom: 10px" width="120px" height="120px" src="../pro_pic/<?php echo $data1['pro_pic'] ?>">
        </div>

        <div class="col-md-12 text-center" style="margin-top: -170px">
            <p class="text-white" style="font-size: 25px"><?php echo $data1['name'] ?></p>
        </div>

    </div>



    <div class="row">
        <div class="col-md-12">
            <a href="./about_people.php?type&unique_id_fr=<?php echo $data1['unique_id'] ?>" class="btn btn-sm btn-success float-end ms-1">Profile</a>

            <a href="./message.php?type&unique_id_fr=<?php echo $data1['unique_id'] ?>" class="btn btn-sm btn-success float-end ms-1">Send Message</a>
            
            <?php if($locking == 1) {?>
            <button onclick="allowfn(<?php echo $unique_id_me ?>, <?php echo $unique_id_fr ?>, this)" class="btn btn-sm <?php $countA == 0 ? printf("btn-success") : printf("btn-danger") ?> float-end ms-1">
                <?php $countA == 0 ? printf('<i class="fas fa-user-check"></i>') : printf('<i class="fas fa-user-times"></i>') ?>
            </button>
            <?php } ?>
            
            <button onclick="followfn(<?php echo $unique_id_me ?>, <?php echo $unique_id_fr ?>, this)" class="btn btn-sm <?php $countF == 0 ? printf("btn-success") : printf("btn-danger") ?> float-end">
                <?php $countF == 0 ? printf('<i class="fas fa-user-plus"></i>') : printf('<i class="fas fa-user-slash"></i>') ?>
            </button>
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
    let postCloseBtn = document.querySelector("#postCloseBtn");
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
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 60) {
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
        postData.unique_id_fr = <?php echo $unique_id_fr ?>;

        axios.post("../api/post/loadmorePeopleTimeline_m.php",
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


    const makeCommentTr = (comment) => {
        let tr = `<tr>
                            <td class="text-center">
                                <a href="./people_timeline.php?type&unique_id_fr=${comment.comn_giver_id}">
                                    <img class="text-center rounded-circle" width="50px" height="50px" src="../pro_pic/${comment.pro_pic}">
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


</script>


<?php
include './footer.php'
?>
