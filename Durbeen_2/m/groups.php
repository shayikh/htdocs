<?php
include './header.php';


$SQL1 = "SELECT * FROM `admin` WHERE `unique_id`='$unique_id_me'";
$run1 = mysqli_query($connection, $SQL1);
$count1 = mysqli_num_rows($run1);


?>

<?php if ($count1 > 0) { ?>
<a style="position: fixed;left: 8px;top: 62px;z-index:20;font-weight: 600;" class="btn btn-sm btn-success float-end" data-bs-toggle="modal" data-bs-target="#groupModal">Create Group</a>
<?php } ?>


<!-- main page -->
<div class="container" style="margin-top: 112px;">
    <h6 class="text-center">My Groups</h6>
    <table class="table table-bordered mt-3" style="margin-bottom: 150px;border-color: #5d5d5d">
        <tbody id="tbodyID">

        </tbody>
    </table>




    <!-- Create Group Modal -->
    <div class="modal fade" id="groupModal" tabindex="-1" aria-labelledby="groupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
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
                                    <label class="form-label text-dark">Group Image</label>
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

            axios.post("../api/group/loadmoreGroup_m.php",
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
                url: "../api/group/grpAdd.php",
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

                    let newGroup = json.newGroup;

                    tbody.innerHTML = makeTr(newGroup) + tbody.innerHTML;

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


        const makeTr = (newGroup) => {
            let tr = `    <tr>
                            <td class="text-center">
                                <a href="./group_msg.php?type&grp_id=${newGroup.id}">
                                    <img style="margin-top: 2px"width="90px" src="../pro_pic/${newGroup.pro_pic}" alt="">
                                </a>
                            </td>
                            <td class="text-center">
                                <a class="text-decoration-none" href="./group_msg.php?type&grp_id=${newGroup.id}">
                                    <p style="font-weight: 500">${newGroup.grp_name}</p>
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
