<?php
include './header.php';


if (isset($_GET['nofollow'])) {
    echo "<script>toastr.info('He did not Allow to Follow You')</script>";
}
?>

<a style="position: fixed;right: 174px;top: 91px;z-index:20;font-weight: 600;" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#groupModal">Find Friend</a>



<!-- main page -->
<div class="container" style="margin-top: 150px">

    <h4 class="text-center" id="headerID">People Facelist</h4>
    <table class="table table-bordered mt-4" style="margin-bottom: 150px;border-color: #5d5d5d">
        <tbody id="tbodyID">

        </tbody>
    </table>

</div>

<!-- Search Modal -->
<div class="modal fade" id="groupModal" tabindex="-1" aria-labelledby="groupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-dark" class="modal-title" id="groupModalLabel">Search Friends</h5>
                <button id="postCloseBtn" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formID" enctype="multipart/form-data">

                    <input type="hidden" name="unique_id_me" value="<?php echo $unique_id_me ?>">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label text-dark">Friend Name</label>
                                <input style="background-color: #F3F3F3;" name="search" class="form-control" id="searchID" type="text" required>
                            </div>
                        </div>
                    </div>

                    <input name="saveBtn" id="buttonID" value="SEARCH" class="mt-2 float-end btn btn-sm red" type="submit" aria-label="Close">
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    let form = document.querySelector("#formID");
    let search = document.querySelector("#searchID");
    let button = document.querySelector("#buttonID");
    let postCloseBtn = document.querySelector("#postCloseBtn");
    let tbody = document.querySelector("#tbodyID");
    let headerText = document.querySelector("#headerID");


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

        axios.post("../api/facelist/loadmoreFacelist.php",
                postData, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {
                if (res.data == 1) {
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

    
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        headerText.innerText = "Search Results";


        var formdata = new FormData(form);

        $.ajax({
            url: "../api/facelist/searchFriend.php",
            type: "POST",
            data: formdata,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                // alert('ok')
            },
            success: function(data) {
                // console.log(data);
                tbody.innerHTML = data;

                postCloseBtn.click();
                search.value = "";
                toastr.success('Frieds Found');


            },
            error: function(err) {
                console.log(err);
            }
        });

    })

    const follow_req = (unique_id_me, unique_id_fr, elm) => {

        let follow_req = {};

        follow_req.unique_id_me = unique_id_me;
        follow_req.unique_id_fr = unique_id_fr;

        axios.post("../api/facelist/follow_req.php",
                follow_req, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {
                console.log(res.data);

                if (res.data == 1) {
                    toastr.success('Follow Request Sent');
                    elm.remove();
                }else{
                    toastr.error('Unfollowed');
                    elm.innerHTML = '<i class="fas fa-user-plus"></i>';
                    elm.classList.add('btn-success');
                    elm.classList.remove('btn-danger');
                }
            })
            .catch(err => {
                console.log(err);
            })
    }

    const allowfn = (unique_id_me, unique_id_fr, elm) => {

        let allowVar = {};

        allowVar.unique_id_me = unique_id_me;
        allowVar.unique_id_fr = unique_id_fr;

        axios.post("../api/facelist/allow.php",
                allowVar, {
                    headers: {
                        "Content-Type": "application/json"
                        }
                })
            .then(res => {
                // console.log(res.data);

                if (res.data == 0) {
                    toastr.error('Rejected to Follow You');
                    elm.innerHTML = '<i class="fas fa-user-check"></i>';
                    elm.classList.add('btn-success');
                    elm.classList.remove('btn-danger');
                } else {
                    toastr.success('Allowed to Follow You');
                    elm.innerHTML = '<i class="fas fa-user-times"></i>';
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
