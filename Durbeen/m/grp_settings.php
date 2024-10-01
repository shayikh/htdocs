<?php
include './header.php';

$grp_id = $_GET['grp_id'];

$SQL110 = "SELECT * FROM `group $grp_id members` WHERE `memberId`='$unique_id_me'";
$run110 = mysqli_query($connection_message, $SQL110);
$count110 = mysqli_num_rows($run110);

if ($count110 == 0) {
    echo "<script>window.location = 'homepage.php?type'</script>";
}

$SQL111 = "SELECT * FROM `groups` WHERE `id`='$grp_id'";
$run111 = mysqli_query($connection, $SQL111);
$data111 = mysqli_fetch_assoc($run111);



$SQL109 = "SELECT * FROM `group $grp_id members` WHERE `memberId`='$unique_id_me' AND `admin`='1'";
$run109 = mysqli_query($connection_message, $SQL109);
$count109 = mysqli_num_rows($run109);
?>





<!-- main page -->
<a style="position: fixed;left: 5px;top: 62px;z-index:20;font-weight: 600;" style="font-weight: 600;" class="btn btn-sm btn-danger" onclick="leaveGrp(<?php echo $grp_id ?>,<?php echo $unique_id_me ?>)">Leave</a>

<?php if ($count109 > 0) { ?>
<a href="grp_admins.php?type&grp_id=<?php echo $grp_id ?>" style="position: fixed;left: 61px;top: 62px;z-index:20;font-weight: 600;" class="btn btn-sm btn-success">Admin</a>
<?php } ?>



<div class="container" style="margin-top: 112px">
    <h6 class="text-center mt-2">"<?php echo $data111['grp_name'] ?>" Group Members</h6>
    <table class="table table-bordered mt-2" style="margin-bottom: 150px;border-color: #5d5d5d">
        <tbody id="tbodyID">

        </tbody>
    </table>
</div>


<script>
    let tbody = document.querySelector("#tbodyID");


    var page_no = 1;

    showdata();

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 5) {
            showdata();
        }
    })


    function showdata() {

        let postData = {};

        postData.page_no = page_no;
        postData.unique_id_me = <?php echo $unique_id_me ?>;
        postData.grp_id = <?php echo $grp_id ?>;

        axios.post("../api/group/loadmoreGrpSetting_m.php",
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
                }
            })
            .catch(err => {
                console.log(err);
            })
    }



    const leaveGrp = (grp_id, unique_id_me) => {
        let confirm = window.confirm("Do You Want to Leave From This Group?");

        if (confirm) {

            let message = {};

            message.grp_id = grp_id;
            message.unique_id_me = unique_id_me;

            axios.post("../api/group/leaveGrp.php",
                    message, {
                        headers: {
                            "Content-Type": "application/json"
                        }
                    })
                .then(res => {
                    // console.log(res.data);

                    if (res.data == '1') {
                        window.location = './groups.php?type';
                    }else if (res.data == '0') {
                        alert('You Are The Only Admin in This Group. If You Leave, The group Will be Adminless. So You Cannot Leave This Group Until You Make One or More Admin');
                        toastr.error('You Are The Only Admin in This Group. If You Leave, The group Will be Adminless. So You Cannot Leave This Group Until You Make One or More Admin');
                    }

                })
                .catch(err => {
                    console.log(err);
                })
        } else {
            return;
        }
    }
    
</script>


<?php
include './footer.php'
?>
