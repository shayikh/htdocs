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

    <div class="row">
        <div class="col-md-12">
            <h4 class="text-center"><?php echo $grpName ?></h4>
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


<!-- Message Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button id="messageCloseBtn" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formID" enctype="multipart/form-data">

                    <input type="hidden" name="unique_id_me" value="<?php echo $unique_id_me ?>">
                    <input type="hidden" name="grp_id" value="<?php echo $grp_id ?>">
                    <input type="hidden" name="my_name" value="<?php echo $dataMe['name'] ?>">
                    <input type="hidden" name="myProPic" value="<?php echo $dataMe['pro_pic'] ?>">

                    <textarea style="background-color: #F3F3F3;color: #000" name="message" id="messageID" rows="5" class="form-control mb-2" type="text"></textarea>

                    <input style="background-color: #F3F3F3;" name="image_khan_bahadur" class="form-control" id="imageID" type="file" accept="image/png, image/bmp, image/gif, image/jpg, image/avif, image/jpeg, image/jfif, image/pjpeg, image/pjp, image/apng, image/svg, image/webp">

                    <input name="send" id="buttonID" value="SEND" class="mt-2 float-end btn btn-sm red" type="submit" aria-label="Close">
                </form>
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
    let messageCloseBtn = document.querySelector("#messageCloseBtn");


    var page_no = 1;

    showdata();

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 5) {
            showdata();
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
                if (res.data == 1) {
                    toastr.info('You are at the End');
                } else {
                    appendData.innerHTML = appendData.innerHTML + res.data;
                    page_no++;
                }
            })
            .catch(err => {
                console.log(err);
            })
    }


    form.addEventListener('submit', (e) => {
        e.preventDefault();


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

                let unique_id_me = json.unique_id_me;
                let newMessage = json.newMessage;


                tbody.innerHTML = makeTr(newMessage, unique_id_me) + tbody.innerHTML;

                messageCloseBtn.click();

                image.value = "";
                message.value = "";
            },
            error: function(err) {
                console.log(err);
            }
        });

    })


    const makeTr = (message) => {
        let tr = `<tr>
                        <div class="float-end" style="width: 590px;border: none;">
                            <img width="590px" src="../grp_image/${message.image}">
                            
                            <h5 style="border-radius: 35px" class="response float-end py-2 px-3 bg-success">${message.message}</h5>
                            
                            <button onclick="unsendMessage(${message.id}, <?php echo $grp_id ?>, this)"
                                    class="btn btn-sm btn-dark float-end mb-2" title="Unsend"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </tr>`
        return tr;
    }


    const unsendMessage = (id_msg, grp_id, elm_ppp) => {

        let unsendData = {};

        unsendData.id_msg = id_msg;
        unsendData.grp_id = grp_id;

        axios.post("../api/group_msg/unsend.php",
                unsendData, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {
                // console.log(res.data);

                if (res.data == '1') {
                    toastr.error('Message Deleted For Everyone')
                }else{
                    toastr.error('Message not deleted')
                }

                elm_ppp.parentElement.remove();

            })
            .catch(err => {
                console.log(err);
            })


    }


</script>


<div style="height: 20px"></div>


<button style="position: fixed;right:10px;bottom: 10px" class="btn btn-primary float-end mb-3" data-bs-toggle="modal" data-bs-target="#messageModal">
    <i class="fas fa-plus"></i>
</button>


<?php
include './footer.php'
?>
