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
<a style="position: fixed;right: 217px;top: 91px;z-index:20;font-weight: 600;" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#groupModal">Group Info</a>


<a style="position: fixed;right: 174px;top: 91px;z-index:20;font-weight: 600;" class="btn btn-success" onclick="cleanGrp(<?php echo $grp_id ?>)"><i class="fas fa-trash-alt"></i></a>


<a style="position: fixed;right: 325px;top: 91px;z-index:20;font-weight: 600;" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#searchModal">Find Friend</a>





<div class="container" style="margin-top: 150px">
    <h4 class="text-center">Add Or Remove "<?php echo $data111['grp_name'] ?>" Group Members & Admins</h4>
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


<!-- Update Group Info Modal -->
<div class="modal fade" id="groupModal" tabindex="-1" aria-labelledby="groupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="groupModalLabel">Update Group Info</h5>
                <button id="postCloseBtn" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formID" enctype="multipart/form-data">

                    <input type="hidden" name="grp_id" value="<?php echo $grp_id ?>">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label text-dark">Group Name</label>
                                <input style="background-color: #F3F3F3;" value="<?php echo $data111['grp_name'] ?>" name="grp_name" class="form-control" id="grp_nameID" type="text" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label text-dark">Group Image</label>
                                <input style="background-color: #F3F3F3;" name="image_khan_bahadur" class="form-control" id="imageID" type="file" accept="image/png, image/bmp, image/gif, image/jpg, image/avif, image/jpeg, image/jfif, image/pjpeg, image/pjp, image/apng, image/svg, image/webp">
                            </div>
                        </div>
                    </div>

                    <input name="saveBtn" id="buttonID" value="UPDATE" class="mt-2 float-end btn btn-sm red" type="submit">
                </form>
            </div>
        </div>
    </div>
</div>




<script>
    let form = document.querySelector("#formID");
    let image = document.querySelector("#imageID");
    let grp_name = document.querySelector("#grp_nameID");
    let button = document.querySelector("#buttonID");
    let postCloseBtn = document.querySelector("#postCloseBtn");
    let tbody = document.querySelector("#tbodyID");
    let search = document.querySelector("#searchID");
    let searchCloseBtn = document.querySelector("#searchCloseBtn");


    var page_no = 1;
    var ifSearch = 0;
    var returned = 1;

    showdata();

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 5) {
            if(ifSearch == 0 && returned == 1){
                showdata();
                returned = 0;
            }
        }
    })


    function showdata() {

        let postData = {};

        postData.page_no = page_no;
        postData.unique_id_me = <?php echo $unique_id_me ?>;
        postData.grp_id = <?php echo $grp_id ?>;

        axios.post("../api/group/admins/loadmoreGrpAdmin.php",
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

            axios.post("../api/group/admins/searchFriend.php",
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


    form.addEventListener('submit', (e) => {
        e.preventDefault();


        var formdata = new FormData(form);

        $.ajax({
            url: "../api/group/grpUpdate.php",
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
                let newGroup = json.newGroup;



                postCloseBtn.click();
                image.value = "";
                toastr.success('Group Info Updated');
            },
            error: function(err) {
                console.log(err);
            }
        });

    })

    
</script>


<?php
include './footer.php'
?>
