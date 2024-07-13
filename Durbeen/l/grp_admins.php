<?php
include './header.php';

$grp_id = $_GET['grp_id'];

$SQL110 = "SELECT * FROM `group $grp_id members` WHERE `memberId`='$unique_id_me' AND `admin`='1'";
$run110 = mysqli_query($connection_message, $SQL110);
$count110 = mysqli_num_rows($run110);

if ($count110 == 0) {
    echo "<script>window.location = 'homepage.php?type'</script>";
}

$SQL111 = "SELECT * FROM `groups` WHERE `id`='$grp_id'";
$run111 = mysqli_query($connection, $SQL111);
$data111 = mysqli_fetch_assoc($run111);




if (isset($_POST['delete_grp'])) {

    $SQL9 = "SELECT * FROM `group $grp_id`";
    $run9 = mysqli_query($connection_message, $SQL9);

    while ($data9 = mysqli_fetch_assoc($run9)) {
        $imgNameinDB = $data9['image'];
        if ($imgNameinDB != '') {
            unlink('../chat_image/'.$imgNameinDB);
        }
    }

    $SQL10 = "DROP TABLE IF EXISTS `group $grp_id`";
    mysqli_query($connection_message, $SQL10);




    $SQL11 = "SELECT * FROM `group $grp_id members`";
    $run11 = mysqli_query($connection_message, $SQL11);

    while ($data11 = mysqli_fetch_assoc($run11)) {
        $memberId = $data11['memberId'];
        $SQL8 = "DELETE FROM `$memberId msg_grp` WHERE `grp_id`='$grp_id'";
        $run8 = mysqli_query($durbeen_chats, $SQL8);
    }

    $SQL12 = "DROP TABLE IF EXISTS `group $grp_id members`";
    mysqli_query($connection_message, $SQL12);




    $SQL6 = "SELECT * FROM `groups` WHERE `id`='$grp_id'";
    $run6 = mysqli_query($connection, $SQL6);
    $data6 = mysqli_fetch_assoc($run6);
    $pro_pic = $data6['pro_pic'];
    unlink('../pro_pic/'.$pro_pic);

    $SQL7 = "DELETE FROM `groups` WHERE `id`='$grp_id'";
    $run7 = mysqli_query($connection, $SQL7);


    echo "<script>window.location = 'groups.php?type=groups'</script>";
}


?>





<!-- main page -->
<a style="position: fixed;right: 217px;top: 91px;z-index:20;font-weight: 600;" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#groupModal">Group Info</a>


<form method="post" action="grp_admins.php?type&grp_id=<?php echo $grp_id ?>">
    <button style="position: fixed;right: 174px;top: 91px;z-index:20;font-weight: 600;" onclick="return confirm('Do You Want to Delete This Group Permanently?')" name="delete_grp" class="btn btn-success" type="submit"><i class="fas fa-trash-alt"></i></button>
</form>






<div class="container" style="margin-top: 150px">
    <h4 class="text-center">Add Or Remove Members & Admins</h4>
    <table class="table table-bordered mt-4" style="margin-bottom: 150px;border-color: #5d5d5d">
        <tbody id="tbodyID">

            <?php

            $SQL = "SELECT * FROM `registration` WHERE `unique_id`!='$unique_id_me' ORDER BY `unique_id` DESC";
            $run = mysqli_query($connection,$SQL);

            while ($data154=mysqli_fetch_assoc($run)){

                $unique_id_fr = $data154['unique_id'];

                $SQLF154 = "SELECT * FROM `group $grp_id members` WHERE `memberId`='$unique_id_fr'";
                $runF154 = mysqli_query($connection_message,$SQLF154);
                $countF154 = mysqli_num_rows($runF154);

                $SQLF155 = "SELECT * FROM `group $grp_id members` WHERE `memberId`='$unique_id_fr' AND `admin`='1'";
                $runF155 = mysqli_query($connection_message,$SQLF155);
                $countF155 = mysqli_num_rows($runF155);

                ?>

                <tr>
                    <td class="text-center">
                        <a target="_blank" href="./people_timeline.php?type&unique_id_fr=<?php echo $unique_id_fr ?>">
                            <img height="135px" src="../pro_pic/<?php echo $data154['pro_pic'] ?>" alt="">
                        </a>
                    </td>
                    <td class="text-center">
                        <a target="_blank" class="text-decoration-none" href="./people_timeline.php?type&unique_id_fr=<?php echo $unique_id_fr ?>">
                            <h3 style="margin-top: 35px"><?php echo $data154['name'] ?></h3>
                            <h6 class="text-success">Durbeen Visited : <?php echo $data154['visit'] ?></h6>
                        </a>
                    </td>
                    <td class="text-center">
                        <button onclick="addfn(<?php echo $unique_id_me ?>, <?php echo $unique_id_fr ?>, <?php echo $grp_id ?>, this)" class="btn <?php $countF154 == 0 ? printf("btn-success") : printf("btn-danger") ?>" style="margin-top: 50px">
                            <?php $countF154 == 0 ? printf("Add") : printf("Remove") ?>
                        </button>
                    </td>
                    <td class="text-center">
                        <button onclick="adminfn(<?php echo $unique_id_me ?>, <?php echo $unique_id_fr ?>, <?php echo $grp_id ?>, this)" class="btn <?php $countF155 == 0 ? printf("btn-success") : printf("btn-danger") ?>" style="margin-top: 50px">
                            <?php $countF155 == 0 ? printf("Make Admin") : printf("Remove Admin") ?>
                        </button>
                    </td>
                </tr>
            <?php } ?>

        </tbody>
    </table>



    
    <!-- Update Group Info Modal -->
    <div class="modal fade" id="groupModal" tabindex="-1" aria-labelledby="groupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-dark" class="modal-title" id="groupModalLabel">Update Group Info</h5>
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
                                    <label class="form-label text-dark">Group Image (A*A size)</label>
                                    <input style="background-color: #F3F3F3;" name="image_khan_bahadur" class="form-control" id="imageID" type="file" accept="image/png, image/bmp, image/gif, image/jpg, image/avif, image/jpeg, image/jfif, image/pjpeg, image/pjp, image/apng, image/svg, image/webp">
                                </div>
                            </div>
                        </div>

                        <input name="saveBtn" id="buttonID" value="UPDATE" class="mt-2 float-end btn btn-sm red" type="submit" aria-label="Close">
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


    const adminfn = (unique_id_me, unique_id_fr, grp_id, elm) => {

        let addVar = {};

        addVar.unique_id_me = unique_id_me;
        addVar.unique_id_fr = unique_id_fr;
        addVar.grp_id = grp_id;

        axios.post("../api/group/make_admin.php",
                addVar, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {
                // console.log(res.data);

                if (res.data == 0) {
                    toastr.error('Removed from Admin');
                    elm.innerText = "Make Admin";
                    elm.classList.add('btn-success');
                    elm.classList.remove('btn-danger');
                } else {
                    toastr.success('Made Admin');
                    elm.innerText = "Remove Admin";
                    elm.classList.add('btn-danger');
                    elm.classList.remove('btn-success');
                }


            })
            .catch(err => {
                console.log(err);
            })
    }

    
    const addfn = (unique_id_me, unique_id_fr, grp_id, elm) => {

        let addVar = {};

        addVar.unique_id_me = unique_id_me;
        addVar.unique_id_fr = unique_id_fr;
        addVar.grp_id = grp_id;

        axios.post("../api/group/add.php",
                addVar, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {
                // console.log(res.data);

                if (res.data == 0) {
                    toastr.error('Removed');
                    elm.innerText = "Add";
                    elm.classList.add('btn-success');
                    elm.classList.remove('btn-danger');
                } else {
                    toastr.success('Added');
                    elm.innerText = "Remove";
                    elm.classList.add('btn-danger');
                    elm.classList.remove('btn-success');
                }


            })
            .catch(err => {
                console.log(err);
            })
    }


    
</script>


</div>


<?php
include './footer.php'
?>
