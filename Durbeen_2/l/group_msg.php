<?php
include './header.php';

$grp_id = $_GET['grp_id'];

$SQL110 = "SELECT * FROM `group $grp_id members` WHERE `memberId`='$unique_id_me'";
$run110 = mysqli_query($connection_message, $SQL110);
$count110 = mysqli_num_rows($run110);

if ($count110 == 0) {
    echo "<script>window.location = 'homepage.php?type'</script>";
}

$SQLgrp = "SELECT * FROM `groups` WHERE `id`='$grp_id'";
$rungrp = mysqli_query($connection, $SQLgrp);
$datagrp = mysqli_fetch_assoc($rungrp);
$grpName = $datagrp['grp_name'];

?>


<!-- main page -->
<a target="_self" style="position: fixed;right:174px;top:91px;z-index:20;font-weight: 600;" href="group_msg.php?type&grp_id=<?php echo $grp_id ?>" class="btn btn-success">Refresh Page</a>

<a style="position: fixed;right:298px;top:91px;z-index:20;font-weight: 600;" href="grp_settings.php?type&grp_id=<?php echo $grp_id ?>" class="btn btn-success">Settings</a>




<div class="container" style="margin-top: 150px">

    <div class="row mb-4">
        <div class="col-md-2"></div>

        <div class="col-md-8">
            <h4 class="text-center"><?php echo $grpName ?></h4>
            <!-- Status Bar -->
            <div class="card-new" style="margin-top: 24px;">

                <div class="title text-white">Send Message</div>

                <textarea id="contentID" placeholder="What's on your mind?"></textarea>

                <div class="dropzone" id="dropZone">
                    Drag & Drop • Paste • Click to Add Images
                </div>

                <input type="file" id="fileInput" multiple hidden accept="image/png, image/bmp, image/gif, image/jpg, image/avif, image/jpeg, image/jfif, image/pjpeg, image/pjp, image/apng, image/svg, image/webp">

                <div id="preview"></div>

                <button class="button-new" onclick="grpMsgAdd(<?php echo $unique_id_me?>, <?php echo $grp_id ?>)">Send Message</button>

                <div class="small">Smooth UI • No layout shift • Modern interactions</div>

            </div>
            <!-- Status Bar end -->
        </div>
        <div class="col-md-2"></div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table mt-4">
                <tbody id="tbodyID">
                    <tr>
                    </tr>
                </tbody>
            </table>


            <span id="appendID"></span>
        </div>
    </div>

</div>




<!-- Message Forward Modal -->
<div class="modal fade" id="messageforwardModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true" modal-dialog modal-dialog-scrollable>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="staticBackdropLabel2">Forward Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="clearMsgForwardModal()"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6">
                        <form action="" method="post" id="forwardFormID_all_frID" enctype="multipart/form-data">

                            <input type="hidden" name="typical_id" value="2">
                            <input type="hidden" name="hidden_message_id" id="hidden_message_id_all_frID" value="">
                            <input type="hidden" name="unique_id_me" value="<?php echo $unique_id_me?>">
                            <input type="hidden" name="from_id" value="<?php echo $grp_id ?>">


                            <input name="forwardBtn" value="FORWARD TO ALL FRIENDS" class="form-control btn btn-success" type="submit">

                        </form>
                    </div>
                    <div class="col-lg-6">
                        <form action="" method="post" id="forwardFormID_all_grpID" enctype="multipart/form-data">

                            <input type="hidden" name="typical_id" value="2">
                            <input type="hidden" name="hidden_message_id" id="hidden_message_id_all_grpID" value="">
                            <input type="hidden" name="unique_id_me" value="<?php echo $unique_id_me?>">
                            <input type="hidden" name="from_id" value="<?php echo $grp_id ?>">


                            <input name="forwardBtn" value="FORWARD TO ALL GROUPS" class="form-control btn btn-success" type="submit">

                        </form>
                    </div>
                </div>

                <form action="" method="post" id="forwardFormID" enctype="multipart/form-data">

                    <input type="hidden" name="hidden_message_id" id="hidden_message_id" value="">
                    <input type="hidden" name="unique_id_me" value="<?php echo $unique_id_me?>">
                    <input type="hidden" name="from_grp_id" value="<?php echo $grp_id ?>">
                    
                    <div class="row mt-3">
                        <div class="col-lg-6">
                            <input style="background-color: #F3F3F3;color: #000" name="search" id="searchID" class="form-control mb-2" type="text" placeholder="Friend Name">
                        </div>
                        <div class="col-lg-6">
                            <input name="searchBtn" value="SEARCH" class="form-control btn btn-danger" type="submit">
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
                    <tbody id="messageForwardID">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearMsgForwardModal()">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    let tbody = document.querySelector("#tbodyID");
    let appendData = document.querySelector("#appendID");

    let form = document.querySelector("#formID");
    let image = document.querySelector("#imageID");
    let message = document.querySelector("#messageID");
    let button = document.querySelector("#buttonID");

    let messageForwardTbody = document.querySelector("#messageForwardID");
    let forwardForm = document.querySelector("#forwardFormID");
    let searchValue = document.querySelector("#searchID");
    let hidden_message_id_number = document.querySelector("#hidden_message_id");


    let hidden_message_id_all_fr = document.querySelector("#hidden_message_id_all_frID");
    let hidden_message_id_all_grp = document.querySelector("#hidden_message_id_all_grpID");
    
    let forwardFormID_all_fr = document.querySelector("#forwardFormID_all_frID");
    let forwardFormID_all_grp = document.querySelector("#forwardFormID_all_grpID");


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

        let msgData = {};

        msgData.page_no = page_no;
        msgData.unique_id_me = <?php echo $unique_id_me ?>;
        msgData.grp_id = <?php echo $grp_id ?>;

        axios.post("../api/group_msg/loadmoreGroupMsg.php",
                msgData, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {
                if (res.data == 0) {
                    toastr.info('You are at the End');
                } else {
                    appendData.innerHTML = appendData.innerHTML + res.data;
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
            url: "../api/messageForward/forwardLoop/forwardAllFr.php",
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
                toastr.success('Messages Forwarded to All Friends');
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
            url: "../api/messageForward/forwardLoop/forwardAllGrp.php",
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
                toastr.success('Messages Forwarded to All Groups');
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
                url: "../api/messageForward/searchFriend2.php",
                type: "POST",
                data: forwardFormdata,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    // alert('ok')
                },
                success: function(data) {

                    // console.log(data);


                    if (data == 0) {
                        messageForwardTbody.innerHTML = "";
                        toastr.error('Friends Not Found');
                    } else {
                        messageForwardTbody.innerHTML = data;
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


    const showMessageForwardfn = (message_id, grp_id) => {

        forwardFormID_all_fr.classList.remove("d-none");
        forwardFormID_all_grpID.classList.remove("d-none");
        
        hidden_message_id_all_fr.value = message_id;
        hidden_message_id_all_grp.value = message_id;

        hidden_message_id_number.value = message_id;

        let messageForward = {};

        messageForward.unique_id_me = <?php echo $unique_id_me ?>;
        messageForward.message_id = message_id;
        messageForward.from_grp_id = grp_id;

        axios.post("../api/messageForward/friendList2.php",
        messageForward, {
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(res => {

            // console.log(res.data);
            messageForwardTbody.innerHTML = res.data;

        })
        .catch(err => {
            console.log(err);
        })

    }


    const makeTr = (message, grp_id) => {
        let tr = `<tr>
                        <div class="float-end" style="width: 590px;border: none;">
                            <img width="590px" src="../grp_image/${message.image}">
                            
                            <h5 style="border-radius: 35px" class="response float-end py-2 px-3 bg-success">${message.message}</h5>
                            
                            <button onclick="showMessageForwardfn(${message.id}, ${grp_id})" class="btn btn-sm btn-dark float-end mb-2" data-bs-toggle="modal" data-bs-target="#messageforwardModal"><i class="fas fa-forward"></i></button>
                            <button onclick="unsendGrpMessage(${message.id}, ${grp_id}, this)"
                                    class="btn btn-sm btn-dark float-end mb-2" title="Unsend"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </tr>`
        return tr;
    }


</script>


<div style="height: 20px"></div>




<?php
include './footer.php'
?>
