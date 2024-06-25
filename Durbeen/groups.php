<?php
include './header.php';


?>


<!-- main page -->
<div class="container" style="margin-top:133px;margin-bottom: 100px">

    <div class="row">

        <div class="col-md-12 mt-2">
            <a class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#groupModal">Create Messenger Group</a>
        </div>

    </div>
    <table class="table table-bordered mt-2" style="margin-bottom: 150px;border-color: #5d5d5d">
        <tbody id="tbodyID">

        </tbody>
    </table>




    <!-- Create Group Modal -->
    <div class="modal fade" id="groupModal" tabindex="-1" aria-labelledby="groupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-dark" class="modal-title" id="groupModalLabel">Create New Messenger Group</h5>
                    <button id="postCloseBtn" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="formID" enctype="multipart/form-data">
                        <input type="hidden" name="unique_id_me" value="<?php echo $unique_id_me ?>">


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label text-dark">Group Name</label>
                                    <input style="background-color: #F3F3F3;" name="grp_name" class="form-control" id="grp_nameID" type="text" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label text-dark">Group Image (A*A size)</label>
                                    <input style="background-color: #F3F3F3;" name="image_khan_bahadur" class="form-control" id="imageID" type="file" accept="image/png, image/bmp, image/gif, image/jpg, image/avif, image/jpeg, image/jfif, image/pjpeg, image/pjp, image/apng, image/svg, image/webp" required>
                                </div>
                            </div>
                        </div>

                        <input name="saveBtn" id="buttonID" value="CREATE" class="mt-2 float-end btn btn-sm red" type="submit" aria-label="Close">
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

            axios.post("./api/group/loadmoreGroup.php",
                    postData, {
                        headers: {
                            "Content-Type": "application/json"
                        }
                    })
                .then(res => {
                    if (res.data == 0) {
                        toastr.error('You Are at The End');
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


            var formdata = new FormData(form);

            $.ajax({
                url: "./api/group/grpAdd.php",
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

                    // console.log(json);


                    let unique_id_me = json.unique_id_me;
                    let newGroup = json.newGroup;

                    tbody.innerHTML = makeTr(newGroup, unique_id_me) + tbody.innerHTML;

                    postCloseBtn.click();

                    image.value = "";
                    grp_name.value = "";

                    toastr.success('Group Created');
                },
                error: function(err) {
                    console.log(err);
                }
            });

        })


        const makeTr = (newGroup, unique_id_me) => {
            let tr = `    <tr>
                            <td class="text-center">
                                <a href="./group_msg.php?type&grp_id=${newGroup.grp_id}">
                                    <img height="135px" src="./pro_pic/${newGroup.pro_pic}" alt="">
                                </a>
                            </td>
                            <td class="text-center">
                                <a class="text-decoration-none" href="./group_msg.php?type&grp_id=${newGroup.grp_id}">
                                    <h3 style="margin-top: 35px">${newGroup.grp_name}</h3>
                                </a>
                            </td>
                        </tr>`
            return tr;
        }
    </script>

</div>



<?php
include './footer.php'
?>
