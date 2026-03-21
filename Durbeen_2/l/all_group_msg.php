<?php
include './header.php';

if ($_SESSION['unique_id_me'] != 1) {
    echo "<script>window.location = './lost.php'</script>";
} else {

    $grp_id = $_GET['grp_id'];

    $SQLgrp = "SELECT * FROM `groups` WHERE `id`='$grp_id'";
    $rungrp = mysqli_query($connection, $SQLgrp);
    $datagrp = mysqli_fetch_assoc($rungrp);
    $grpName = $datagrp['grp_name'];

}

?>


<!-- main page -->
<a target="_self" style="position: fixed;right:174px;top:91px;z-index:20;font-weight: 600;" href="./all_group_msg.php?type&grp_id=<?php echo $grp_id ?>" class="btn btn-success">Refresh Page</a>

<a style="position: fixed;right:298px;top:91px;z-index:20;font-weight: 600;" href="./grp_settings.php?type&grp_id=<?php echo $grp_id ?>" class="btn btn-success">Settings</a>




<div class="container" style="margin-top: 150px">

    <div class="row mb-4">
        <div class="col-md-2"></div>

        <div class="col-md-8">
            <h4 class="text-center"><?php echo $grpName ?></h4>
        </div>
        <div class="col-md-2"></div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <span id="appendID"></span>
        </div>
    </div>

</div>





<script>
    let appendData = document.querySelector("#appendID");


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

</script>


<div style="height: 20px"></div>




<?php
include './footer.php'
?>
