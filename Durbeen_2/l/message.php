<?php
include './header.php';

$unique_id_fr = $_GET['unique_id_fr'];

$SQLtest = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_fr'";
$runtest = mysqli_query($connection, $SQLtest);
$countTest = mysqli_num_rows($runtest);

if ($countTest == 0) {
    echo "<script>window.location = 'homepage.php?type'</script>";
} else {


    if ($unique_id_fr == $unique_id_me) {
        echo "<script>window.location = 'my_notes.php?type=my_notes'</script>";
    } elseif ($unique_id_fr == "") {
        echo "<script>window.location = 'my_notes.php?type=my_notes'</script>";
    } else {
        //seen from notify db
        $SQL99 = "UPDATE `$unique_id_me notify` SET `seen`='1' WHERE `sender_id`='$unique_id_fr'";
        mysqli_query($durbeen_chats, $SQL99);

        //delete from notify db

        $SQL1 = "SELECT * FROM `$unique_id_me notify` WHERE `seen`='1'";
        $run1 = mysqli_query($durbeen_chats, $SQL1);
        $count1 = mysqli_num_rows($run1);

        if ($count1 > 50) {
            $delete = $count1 - 50;

            //50 is the minumum number of messages

            $SQL2 = "DELETE FROM `$unique_id_me notify` WHERE `seen`='1' ORDER BY `id` ASC LIMIT $delete";
            mysqli_query($durbeen_chats, $SQL2);
        }


        //create two table if not exist
        $SQLcreateMe = "CREATE TABLE IF NOT EXISTS `$unique_id_me to $unique_id_fr` (
			`id` int(255) unsigned NOT NULL auto_increment,
			`sender` varchar(255),
			`message` text,
			`image` varchar(1000),
			`time` varchar(1000),
			`seen` varchar(1000),
			PRIMARY KEY  (`id`)
		)";
        mysqli_query($connection_message, $SQLcreateMe);

        $SQLcreateFr = "CREATE TABLE IF NOT EXISTS `$unique_id_fr to $unique_id_me` (
			`id` int(255) unsigned NOT NULL auto_increment,
			`sender` varchar(255),
			`message` text,
			`image` varchar(1000),
			`time` varchar(1000),
			`seen` varchar(1000),
			PRIMARY KEY  (`id`)
		)";
        mysqli_query($connection_message, $SQLcreateFr);
        //table creation end


        //chat friend start
        $SQL3 = "SELECT * FROM `$unique_id_me chats` WHERE `unique_id_fr`='$unique_id_fr'";
        $run3 = mysqli_query($durbeen_chats, $SQL3);
        $count3 = mysqli_num_rows($run3);

        if ($count3 == 0) {
            $SQL16 = "INSERT INTO `$unique_id_me chats`(`unique_id_fr`) VALUES ('$unique_id_fr')";
            mysqli_query($durbeen_chats, $SQL16);
        }


        $SQL4 = "SELECT * FROM `$unique_id_fr chats` WHERE `unique_id_fr`='$unique_id_me'";
        $run4 = mysqli_query($durbeen_chats, $SQL4);
        $count4 = mysqli_num_rows($run4);

        if ($count4 == 0) {
            $SQL5 = "INSERT INTO `$unique_id_fr chats`(`unique_id_fr`) VALUES ('$unique_id_me')";
            mysqli_query($durbeen_chats, $SQL5);
        }


        // seen all message
        $SQL6 = "UPDATE `$unique_id_me to $unique_id_fr` SET `seen`='Seen' WHERE `sender`='fr'";
        mysqli_query($connection_message, $SQL6);
        $SQL7 = "UPDATE `$unique_id_fr to $unique_id_me` SET `seen`='Seen' WHERE `sender`='me'";
        mysqli_query($connection_message, $SQL7);


        $SQL8 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_fr'";
        $run8 = mysqli_query($connection, $SQL8);
        $data8 = mysqli_fetch_assoc($run8);

        $friendName = $data8['name'];


    }
}

?>





<!-- main page -->
<a target="_self" style="position: fixed;right: 174px;top: 91px;z-index:20;font-weight: 600;" href="message.php?type&unique_id_fr=<?php echo $unique_id_fr ?>" class="btn btn-success">Refresh Page</a>






<div class="container" style="margin-top: 270px">

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
                    <input type="hidden" name="unique_id_fr" value="<?php echo $unique_id_fr ?>">
                    <input type="hidden" name="my_name" value="<?php echo $dataMe['name'] ?>">

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
        msgData.unique_id_fr = <?php echo $unique_id_fr ?>;

        axios.post("../api/message/loadmoreMsg.php",
                msgData, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {
                if (res.data == 0) {
                    toastr.error('You are at the End');
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
            url: "../api/message/messageAdd.php",
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
                let unique_id_fr = json.unique_id_fr;
                let newMessage = json.newMessage;

                // console.log(json);
                // console.log(unique_id_fr);

                tbody.innerHTML = makeTr(newMessage, unique_id_me, unique_id_fr) + tbody.innerHTML;

                messageCloseBtn.click();

                image.value = "";
                message.value = "";
            },
            error: function(err) {
                console.log(err);
            }
        });

    })


    const makeTr = (message, unique_id_me, unique_id_fr) => {
        let tr = `<tr>
							<div class="float-end" style="width: 590px;border: none;">
								<img width="590px" src="../chat_image/${message.image}">
								
								<h5 style="border-radius: 35px" class="response float-end py-2 px-3 bg-success">${message.message}</h5>
								
								<button onclick="unsendMessage(${message.id}, ${unique_id_me}, ${unique_id_fr}, this)"
										class="btn btn-sm btn-dark float-end mb-2" title="Unsend"><i class="fas fa-trash-alt"></i></button>
								
								<button class="btn btn-sm btn-dark float-end"><i class='fas fa-eye-slash'></i></button>
							</div>
						</tr>`
        return tr;
    }


    const unsendMessage = (id_lll, unique_id_me, unique_id_fr, elm_ppp) => {

        let message = {};

        message.id = id_lll;
        message.unique_id_me = unique_id_me;
        message.unique_id_fr = unique_id_fr;

        axios.post("../api/message/unsend.php",
                message, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {
                // console.log(res.data);

                if (res.data == '1') {
                    toastr.error('Message Deleted For Everyone')
                }
                // console.log(elm_ppp.parentElement);

                elm_ppp.parentElement.remove();

            })
            .catch(err => {
                console.log(err);
            })


    }


    const deleteMessage = (id_lll, unique_id_me, unique_id_fr, elm_ppp) => {

        let message = {};

        message.id = id_lll;
        message.unique_id_me = unique_id_me;
        message.unique_id_fr = unique_id_fr;

        axios.post("../api/message/deleteMsg.php",
                message, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {
                // console.log(res.data);

                if (res.data == '1') {
                    toastr.error('Message Deleted For Me')
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


<button style="position: fixed;right:10px;bottom: 10px" class="btn btn-danger float-end mb-3" data-bs-toggle="modal" data-bs-target="#messageModal">
    <i class="fas fa-plus"></i>
</button>


<?php
include './footer.php'
?>
