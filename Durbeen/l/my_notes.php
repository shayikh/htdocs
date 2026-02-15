<?php
include './header.php';


//create my notes table if not exist
$SQLcreateMe = "CREATE TABLE IF NOT EXISTS `$unique_id_me to $unique_id_me` (
    `id` bigint(255) unsigned NOT NULL auto_increment,
    `message` longtext,
    `image` varchar(1000),
    `time` varchar(1000),
    PRIMARY KEY  (`id`)
)";
mysqli_query($connection_message, $SQLcreateMe);



?>




<!-- main page -->
<a target="_self" style="position: fixed;right: 217px;top: 91px;z-index:20;font-weight: 600;" href="my_notes.php?type=my_notes" class="btn btn-success">Refresh Page</a>

<a style="position: fixed;right: 174px;top: 91px;z-index:20;font-weight: 600;" class="btn btn-success" onclick="cleanNotes(<?php echo $unique_id_me ?>)"><i class="fas fa-trash-alt"></i></a>




<div class="container" style="margin-top: 150px">


    <div class="row mb-4">
        <div class="col-md-2"></div>

        <div class="col-md-8">
            <h4 class="text-center">My Notes</h4>
            <!-- Status Bar -->
            <div class="row justify-content-center">
                <div class="statusp">
                    <div class="col-md-12 mt-2 mb-2">
                        <div class="card" style="width: 100%;border: none;">
                            <div class="card-body" style="background-color: #262626;border-radius: 0 0 3px 3px;">

                                <form action="" method="post" id="formID" enctype="multipart/form-data">
                                    <input type="hidden" name="unique_id_me" value="<?php echo $unique_id_me ?>">

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

                            <input type="hidden" name="typical_id" value="1">
                            <input type="hidden" name="hidden_message_id" id="hidden_message_id_all_frID" value="">
                            <input type="hidden" name="unique_id_me" value="<?php echo $unique_id_me?>">
                            <input type="hidden" name="from_id" value="<?php echo $unique_id_me ?>">


                            <input name="forwardBtn" value="FORWARD TO ALL FRIENDS" class="form-control btn btn-success" type="submit">

                        </form>
                    </div>
                    <div class="col-lg-6">
                        <form action="" method="post" id="forwardFormID_all_grpID" enctype="multipart/form-data">

                            <input type="hidden" name="typical_id" value="1">
                            <input type="hidden" name="hidden_message_id" id="hidden_message_id_all_grpID" value="">
                            <input type="hidden" name="unique_id_me" value="<?php echo $unique_id_me?>">
                            <input type="hidden" name="from_id" value="<?php echo $unique_id_me ?>">


                            <input name="forwardBtn" value="FORWARD TO ALL GROUPS" class="form-control btn btn-success" type="submit">

                        </form>
                    </div>
                </div>

                <form action="" method="post" id="forwardFormID" enctype="multipart/form-data">

                    <input type="hidden" name="hidden_message_id" id="hidden_message_id" value="">
                    <input type="hidden" name="unique_id_me" value="<?php echo $unique_id_me?>">
                    <input type="hidden" name="from_unique_id_me" value="<?php echo $unique_id_me ?>">
                    
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

        let selfMsgData = {};

        selfMsgData.page_no = page_no;
        selfMsgData.unique_id_me = <?php echo $unique_id_me ?>;

        axios.post("../api/my_notes/loadmoreMyNotes.php",
                selfMsgData, {
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
                url: "../api/messageForward/searchFriend1.php",
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



    const showMessageForwardfn = (message_id, unique_id_me) => {

        forwardFormID_all_fr.classList.remove("d-none");
        forwardFormID_all_grpID.classList.remove("d-none");

        hidden_message_id_all_fr.value = message_id;
        hidden_message_id_all_grp.value = message_id;

        hidden_message_id_number.value = message_id;

        let messageForward = {};

        messageForward.unique_id_me = <?php echo $unique_id_me ?>;
        messageForward.message_id = message_id;
        messageForward.from_unique_id_me = <?php echo $unique_id_me ?>;

        axios.post("../api/messageForward/friendList1.php",
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
                url: "../api/my_notes/my_notes_add.php",
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

                    let unique_id_me = json.unique_id_me;
                    let newMessage = json.newMessage;


                    tbody.innerHTML = makeTr(newMessage, unique_id_me) + tbody.innerHTML;


                    image.value = "";
                    message.value = "";
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }


    })


    const makeTr = (message, unique_id_me) => {
        let tr = `<tr>
					<div class="float-end" style="width: 590px;border: none;">
						<img width="590px" src="../note_image/${message.image}">
						
						<h5 style="border-radius: 35px" class="response float-end py-2 px-3 bg-success">${message.message}</h5>
						
                        <button onclick="showMessageForwardfn(${message.id}, ${unique_id_me})" class="btn btn-sm btn-dark float-end mb-2" data-bs-toggle="modal" data-bs-target="#messageforwardModal"><i class="fas fa-forward"></i></button>
						<button onclick="deleteMyNotes(${message.id}, ${unique_id_me}, this)"
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
