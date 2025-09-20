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
<a target="_self" style="position: fixed;left: 5px;top: 62px;z-index:20;font-weight: 600;" href="group_msg.php?type&grp_id=<?php echo $grp_id ?>" class="btn btn-sm btn-success">Refresh</a>

<a style="position: fixed;left: 73px;top: 62px;z-index:20;font-weight: 600;" href="grp_settings.php?type&grp_id=<?php echo $grp_id ?>" class="btn btn-sm btn-success">Settings</a>




<div class="container" style="margin-top: 110px">



<div class="row mb-4">
        <div class="col-md-2"></div>

        <div class="col-md-8">
            <h6 class="text-center"><?php echo $grpName ?></h6>
            <!-- Status Bar -->
            <div class="row justify-content-center">
                <div class="statusp">
                    <div class="col-md-12 mt-2 mb-2">
                        <div class="card" style="width: 100%;border: none;">
                            <div class="card-body" style="background-color: #262626;border-radius: 0 0 3px 3px;">

                                <form action="" method="post" id="formID" enctype="multipart/form-data">
                                    
                                    <input type="hidden" name="unique_id_me" value="<?php echo $unique_id_me ?>">
                                    <input type="hidden" name="grp_id" value="<?php echo $grp_id ?>">
                                    <input type="hidden" name="my_name" value="<?php echo $dataMe['name'] ?>">
                                    <input type="hidden" name="myProPic" value="<?php echo $dataMe['pro_pic'] ?>">

                                    <textarea style="background-color: #F3F3F3;color: #000" name="message" id="messageID" rows="4" class="form-control mb-2" placeholder="Type Message"></textarea>
                                        
                                    <input style="background-color: #F3F3F3;" name="image_khan_bahadur" class="form-control" id="imageID" type="file" accept="image/png, image/bmp, image/gif, image/jpg, image/avif, image/jpeg, image/jfif, image/pjpeg, image/pjp, image/apng, image/svg, image/webp">

                                    <input name="send" id="buttonID" value="SEND" class="mt-2 float-end btn btn-sm red" type="submit">
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Status Bar end -->
        </div>
        <div class="col-md-2"></div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <table class="table">
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
    <div class="modal-dialog modal-fullscreen">
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


                            <input name="forwardBtn" value="FORWARD TO ALL FRIENDS" class="form-control btn btn-sm btn-success" type="submit">

                        </form>
                    </div>
                    <div class="col-lg-6">
                        <form action="" method="post" id="forwardFormID_all_grpID" enctype="multipart/form-data">

                            <input type="hidden" name="typical_id" value="2">
                            <input type="hidden" name="hidden_message_id" id="hidden_message_id_all_grpID" value="">
                            <input type="hidden" name="unique_id_me" value="<?php echo $unique_id_me?>">
                            <input type="hidden" name="from_id" value="<?php echo $grp_id ?>">


                            <input name="forwardBtn" value="FORWARD TO ALL GROUPS" class="form-control btn btn-sm btn-success mt-2" type="submit">

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
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" onclick="clearMsgForwardModal()">
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
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
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

        axios.post("../api/group_msg/loadmoreGroupMsg_m.php",
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

                    // let json = JSON.parse(data);

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

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        if (image.value == "" && message.value == "") {
            toastr.error('Message and Image Both Fields are Empty');
        } else {
            var formdata = new FormData(form);

            $.ajax({
                url: "../api/group_msg/GroupMsgAdd.php",
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

                    let newMessage = json.newMessage;
                    let grp_id = json.grp_id;


                    tbody.innerHTML = makeTr(newMessage, grp_id) + tbody.innerHTML;

                    toastr.success('Message Sent');

                    image.value = "";
                    message.value = "";
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }

    })


    const makeTr = (message, grp_id) => {
        let tr = `<tr>
                        <div class="float-end" style="border: none;">
                            <img class="float-end" width="290px" src="../grp_image/${message.image}">
                            
                            <h6 style="border-radius: 35px" class="response float-end py-2 px-3 bg-success">${message.message}</h6>
                            <br>
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
