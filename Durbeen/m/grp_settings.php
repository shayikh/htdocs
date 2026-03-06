<?php
include './header.php';

$grp_id = $_GET['grp_id'];

$SQL110 = "SELECT * FROM `group $grp_id members` WHERE `memberId`='$unique_id_me'";
$run110 = mysqli_query($connection_message, $SQL110);
$count110 = mysqli_num_rows($run110);

if ($count110 == 0 && $unique_id_me != 1) {
    echo "<script>window.location = './groups.php?type=groups'</script>";
}

$SQL111 = "SELECT * FROM `groups` WHERE `id`='$grp_id'";
$run111 = mysqli_query($connection, $SQL111);
$data111 = mysqli_fetch_assoc($run111);



$SQL109 = "SELECT * FROM `group $grp_id members` WHERE `memberId`='$unique_id_me' AND `admin`='1'";
$run109 = mysqli_query($connection_message, $SQL109);
$count109 = mysqli_num_rows($run109);
?>





<!-- main page -->
<a style="position: fixed;left: 61px;top: 62px;z-index:20;font-weight: 600;" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search"></i></a>

<a style="position: fixed;left: 5px;top: 62px;z-index:20;font-weight: 600;" style="font-weight: 600;" class="btn btn-sm btn-danger" onclick="leaveGrp(<?php echo $grp_id ?>,<?php echo $unique_id_me ?>)">Leave</a>

<?php if ($count109 > 0) { ?>
<a href="grp_admins.php?type&grp_id=<?php echo $grp_id ?>" style="position: fixed;left: 133px;top: 62px;z-index:20;font-weight: 600;" class="btn btn-sm btn-success"><i class="fas fa-user-cog"></i></a>
<?php } ?>
<?php if ($count109 > 0) { ?>
<a href="grp_members.php?type&grp_id=<?php echo $grp_id ?>" style="position: fixed;left: 95px;top: 62px;z-index:20;font-weight: 600;" class="btn btn-sm btn-success"><i class="fas fa-user-friends"></i></a>
<?php } ?>



<div class="container" style="margin-top: 112px">
    <h6 class="text-center mt-2">"<?php echo $data111['grp_name'] ?>" Group Members</h6>
    <table class="table table-bordered mt-2" style="margin-bottom: 150px;border-color: #5d5d5d">
        <tbody id="tbodyID">

        </tbody>
    </table>
</div>


<!-- Search Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="searchModalLabel">Search Friends</h5>
                <button id="searchCloseBtn" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label text-dark">Friend Name</label>
                            <input id="searchID" style="background-color: #F3F3F3;" class="form-control" type="text">
                        </div>
                    </div>
                </div>
                <input onclick="searchfn(<?php echo $unique_id_me ?>)" value="SEARCH" class="mt-2 float-end btn btn-sm red" type="button">
            </div>
        </div>
    </div>
</div>


<script>
    let tbody = document.querySelector("#tbodyID");
    let search = document.querySelector("#searchID");
    let searchCloseBtn = document.querySelector("#searchCloseBtn");


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
        postData.grp_id = <?php echo $grp_id ?>;

        axios.post("../api/group/settings/loadmoreGrpSetting_m.php",
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

        const searchfn = (unique_id_me, elm) => {

        if(search.value == ""){
            toastr.error('Search Field is Empty');
        }else{
            
            let searchVar = {};

            searchVar.unique_id_me = unique_id_me;
            searchVar.search = search.value;
            searchVar.grp_id = <?php echo $grp_id ?>;

            axios.post("../api/group/settings/searchFriend_m.php",
                searchVar, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
                .then(res => {
                    // console.log(res.data);

                    if (res.data == 0) {
                        tbody.innerHTML = "";
                        toastr.error('Friends Not Found');
                    } else {
                        tbody.innerHTML = res.data;
                        searchCloseBtn.click();
                        search.value = "";
                        toastr.success('Friends Found');
                    }
                    ifSearch = 1;

                })
                .catch(err => {
                    console.log(err);
                })
        }
    }

    
</script>


<?php
include './footer.php'
?>
