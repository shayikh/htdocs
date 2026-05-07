<?php
include './header.php';


$SQL1 = "SELECT * FROM `admin` WHERE `unique_id`='$unique_id_me'";
$run1 = mysqli_query($connection, $SQL1);
$count1 = mysqli_num_rows($run1);

if ($count1 == 0) {
    echo "<script>window.location = 'homepage.php?type'</script>";
}


?>


<a style="position: fixed;right: 174px;top: 91px;z-index:20;font-weight: 600;" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#searchModal">Find Friend</a>



<div class="container" style="margin-top: 150px">
    <h4 class="text-center">Add Or Remove Durbeen Admins</h4>
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
                <h5 class="text-dark" class="modal-title" id="searchModalLabel">Search Friends</h5>
                <button id="searchCloseBtn" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label text-dark">Friend Name</label>
                            <input id="searchID" style="background-color: #F3F3F3;" class="form-control" type="text" required>
                        </div>
                    </div>
                </div>
                <input onclick="searchfn(<?php echo $unique_id_me ?>)" value="SEARCH" class="mt-2 float-end btn btn-sm red" type="button" aria-label="Close">
            </div>
        </div>
    </div>
</div>


<script>
    let tbody = document.querySelector("#tbodyID");
    let search = document.querySelector("#searchID");
    let searchCloseBtn = document.querySelector("#searchCloseBtn");
    let headerText = document.querySelector("#headerID");


    var page_no = 1;
    var ifSearch = 0;
    var returned = 1;

    showdata();

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 5) {
            if(ifSearch == 0 && returned == 1){
                returned = 0;
                showdata();
            }
        }
    })


    function showdata() {

        let postData = {};

        postData.page_no = page_no;
        postData.unique_id_me = <?php echo $unique_id_me ?>;

        axios.post("../api/admin/loadmoreAdmin.php",
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


    const searchfn = (unique_id_me) => {

        if(search.value == ""){
            toastr.error('Search Field is Empty');
        }else{
            let searchVar = {};

            searchVar.unique_id_me = unique_id_me;
            searchVar.search = search.value;

            axios.post("../api/admin/searchFriend.php",
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


    const addAdminfn = (unique_id_fr, elm) => {

        let addVar = {};
        addVar.unique_id_fr = unique_id_fr;

        axios.post("../api/admin/make_durbeen_admin.php",
                addVar, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {
                // console.log(res.data);

                if (res.data == 0) {
                    toastr.error('Removed from Admin');
                    elm.innerHTML = '<i class="fas fa-user-cog"></i>';
                    elm.classList.add('btn-success');
                    elm.classList.remove('btn-danger');
                } else {
                    toastr.success('Made Admin');
                    elm.innerHTML = '<i class="fas fa-users"></i>';
                    elm.classList.add('btn-danger');
                    elm.classList.remove('btn-success');
                }


            })
            .catch(err => {
                console.log(err);
            })
    }


</script>





<?php
include './footer.php'
?>
