<?php
include './header.php';

?>




<!-- main page -->
<a target="_self" style="position: fixed;right:174px;top: 91px;z-index:20;font-weight: 600;" href="my_notes.php?type=my_notes" class="btn btn-success">Refresh Page</a>


<div class="container" style="margin-top: 150px">

    <div class="row">
        <div class="col-md-12">
            <h4 class="text-center">My Notes</h4>
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

                messageCloseBtn.click();

                image.value = "";
                message.value = "";
            },
            error: function(err) {
                console.log(err);
            }
        });

    })


    const makeTr = (message, unique_id_me) => {
        let tr = `<tr>
					<div class="float-end" style="width: 590px;border: none;">
						<img width="590px" src="../note_image/${message.image}">
						
						<h5 style="border-radius: 35px" class="response float-end py-2 px-3 bg-success">${message.message}</h5>
						
						<button onclick="deleteSelfMsg(${message.id}, ${unique_id_me}, this)"
								class="btn btn-sm btn-dark float-end mb-2" title="Unsend"><i class="fas fa-trash-alt"></i></button>
					</div>
				</tr>`
        return tr;
    }


    const deleteSelfMsg = (id_lll, unique_id_me, elm_ppp) => {
        let message = {};

        message.id = id_lll;
        message.unique_id_me = unique_id_me;

        axios.post("../api/my_notes/delete_my_notes.php",
                message, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {
                // console.log(res.data);

                if (res.data == '1') {
                    toastr.error('Message Deleted')
                }
                // console.log(elm_ppp.parentElement);

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
