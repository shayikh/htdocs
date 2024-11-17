<?php
include './header.php';

?>


<a style="position: fixed;right: 174px;top: 91px;z-index:20;font-weight: 600;" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#searchModal">Find Friend</a>


<!-- main page -->
<div class="container" style="margin-top: 150px">

    <h4 class="text-center" id="headerID">People Facelist</h4>
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
                            <input id="searchID" style="background-color: #F3F3F3;" class="form-control" type="text">
                        </div>
                    </div>
                </div>
                <input onclick="searchfn(<?php echo $unique_id_me ?>)" value="SEARCH" class="mt-2 float-end btn btn-sm red" type="button" aria-label="Close">
            </div>
        </div>
    </div>
</div>


<script>
    let search = document.querySelector("#searchID");
    let searchCloseBtn = document.querySelector("#searchCloseBtn");
    let tbody = document.querySelector("#tbodyID");
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

        axios.post("../api/facelist/loadmoreFacelist.php",
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

            axios.post("../api/facelist/searchFriend.php",
                searchVar, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
                .then(res => {
                    headerText.innerText = "Search Results";
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

    

    const followfn = (unique_id_me, unique_id_fr, elm) => {

        let followVar = {};

        followVar.unique_id_me = unique_id_me;
        followVar.unique_id_fr = unique_id_fr;

        axios.post("../api/facelist/follow.php",
            followVar, {
                headers: {
                    "Content-Type": "application/json"
                }
            })
            .then(res => {
                // console.log(res.data);

                if (res.data == 0) {
                    toastr.error('Unfollowed');
                    elm.innerHTML = '<i class="fas fa-user-plus"></i>';
                    elm.classList.add('btn-success');
                    elm.classList.remove('btn-danger');
                } else {
                    toastr.success('Following');
                    elm.innerHTML = '<i class="fas fa-user-slash"></i>';
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
