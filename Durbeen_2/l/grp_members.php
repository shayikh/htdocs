<?php
include './header.php';

$grp_id = $_GET['grp_id'];

$SQL110 = "SELECT * FROM `group $grp_id members` WHERE `memberId`='$unique_id_me' AND `admin`='1'";
$run110 = mysqli_query($connection_message, $SQL110);
$count110 = mysqli_num_rows($run110);

if ($count110 == 0 && $unique_id_me != 1) {
    echo "<script>window.location = './groups.php?type=groups'</script>";
}

$SQL111 = "SELECT * FROM `groups` WHERE `id`='$grp_id'";
$run111 = mysqli_query($connection, $SQL111);
$data111 = mysqli_fetch_assoc($run111);



?>





<!-- main page -->

<a style="position: fixed;right: 174px;top: 91px;z-index:20;font-weight: 600;" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#searchModal">Find Friend</a>

<div class="container" style="margin-top: 150px">

    <h4 class="text-center">"<?php echo $data111['grp_name'] ?>" Group Members For Admins</h4>
    <table class="table table-bordered mt-4" style="margin-bottom: 150px;border-color: #5d5d5d">
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
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 5) {
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

        axios.post("../api/group/members/loadmoreGrpMembers.php",
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

            axios.post("../api/group/members/searchFriend.php",
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
