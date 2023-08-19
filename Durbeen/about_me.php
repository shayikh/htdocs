<?php
include './header.php';


$SQLabout = "SELECT * FROM `about` WHERE `unique_id`='$unique_id_me'";
$runAbout = mysqli_query($connection,$SQLabout);
$dataAbout = mysqli_fetch_assoc($runAbout);

//alert
if (isset($_GET['register'])){
    echo "<script>toastr.success('Registration Completed')</script>";
}
if (isset($_GET['abupdate'])){
    echo "<script>toastr.success('About Info Updated')</script>";
}
?>


<!-- message notification -->
<?php
$SQLnotify="SELECT * FROM `$unique_id_me notify` WHERE `seen`='0'";
$runnotify=mysqli_query($con_notification,$SQLnotify);

$number = mysqli_num_rows($runnotify);

if ($number > 0){
    ?>
<a style="position: fixed;right:35%;top:26px;z-index:15" href="./all_msg.php?type=all_msg" class="btn btn-sm red">You
    Have
    <?php echo $number ?> New Messages</a>

<?php } ?>




<!-- main page -->
<div class="container" style="margin-top:133px">
    <div class="row">
        
        <div class="col-md-12">
            <img title="Cover Photo Size 1280px * 574px" width="1280px" height="574px" src="./pro_pic/cov_pic/<?php echo $dataAbout['cov_pic'] ?>">
        </div>

        <div class="col-md-12 mt-4">
            <a class="text-decoration-none" href="./pro_pic.php?type=no&unique_id_fr=<?php echo $unique_id_me ?>">
                <img style="border-radius: 50%;border: 3px solid #fff" width="220px" height="220px" src="./pro_pic/<?php echo $dataMe['pro_pic'] ?>">
            </a>
        </div>

        <div id="here"></div>
        
        <div class="col-md-12 text-center" style="margin-top: -134px; margin-left: -135px">
            <p class="text-white" style="font-size: 39px"><?php echo $dataMe['name'] ?></p>
        </div>
        
    </div>


    <div class="row">
        <div class="col-md-12">
            <a href="./about_update.php?type=no" class="btn btn-success float-end">Edit Profile</a>
        </div>
    </div>



    <div class="row" style="margin-bottom: 100px">
        <table class="table table-bordered mt-5 pt-5" style="border-color: #5d5d5d">
            <tr>
                <td>
                    <h5 class="text-red">Email</h5>
                </td>
                <td>
                    <h5><?php echo $dataMe['email'] ?></h5>
                </td>
            </tr>
            <tr>
                <td>
                    <h5 class="text-red">Date of Birth</h5>
                </td>
                <td>
                    <h5><?php echo $dataMe['date_birth'] ?></h5>
                </td>
            </tr>
            <tr>
                <td>
                    <h5 class="text-red">Gender</h5>
                </td>
                <td>
                    <h5><?php echo $dataMe['gender'] ?></h5>
                </td>
            </tr>
            <tr>
                <td>
                    <h5 class="text-red">Phone Numbers</h5>
                </td>
                <td>
                    <h5><?php echo $dataAbout['phone_no'] ?></h5>
                </td>
            </tr>
            <tr>
                <td>
                    <h5 class="text-red">Religion</h5>
                </td>
                <td>
                    <h5><?php echo $dataAbout['religion'] ?></h5>
                </td>
            </tr>
            <tr>
                <td>
                    <h5 class="text-red">Country</h5>
                </td>
                <td>
                    <h5><?php echo $dataAbout['country'] ?></h5>
                </td>
            </tr>
            <tr>
                <td>
                    <h5 class="text-red">City</h5>
                </td>
                <td>
                    <h5><?php echo $dataAbout['city'] ?></h5>
                </td>
            </tr>
            <tr>
                <td style="width: 300px">
                    <h5 class="text-red">Bio</h5>
                </td>
                <td>
                    <h5 style="line-height: 200%"><?php echo $dataAbout['bio'] ?></h5>
                </td>
            </tr>
            <tr>
                <td style="width: 300px">
                    <h5 class="text-red">Durbeen Visited</h5>
                </td>
                <td>
                    <h5><?php echo $dataMe['visit'] ?></h5>
                </td>
            </tr>
            <tr>
                <td style="width: 300px">
                    <h5 class="text-red">Account ID</h5>
                </td>
                <td>
                    <h5><?php echo $dataMe['unique_id'] ?></h5>
                </td>
            </tr>
            <tr>
                <td style="width: 300px">
                    <h5 class="text-red">Account Link</h5>
                </td>
                <td>
                    <h5 class="one d-none">
                        http://durbeen.unaux.com/people_timeline.php?type=no&unique_id_fr=<?php echo $dataMe['unique_id'] ?>
                    </h5>
                    <button id="mybtn" class="btn btn-sm btn-success float-start">Copy Account Link</button>
                </td>
            </tr>
            <tr>
                <td style="width: 300px">
                    <h5 class="text-red">Following List</h5>
                </td>
                <td>
                    <a href="./follow_list.php?type" class="btn btn-success">Following List</a>
                </td>
            </tr>
            <tr>
                <td style="width: 300px">
                    <h5 class="text-red">All Post</h5>
                </td>
                <td>
                    <a href="./all_post.php?type" class="btn btn-success">All Post</a>
                </td>
            </tr>
        </table>


        <script>
            let oneV = document.querySelector(".one").innerText;
            let mybtn = document.querySelector("#mybtn");

            mybtn.addEventListener('click', function () {
                const elem = document.createElement('input');
                elem.setAttribute("value", oneV);
                document.body.appendChild(elem);
                elem.select();
                document.execCommand('copy');
                document.body.removeChild(elem);
                toastr.success("Link Copied to Clipboard");
            })
        </script>



        <div class="col-md-12 mt-5 pt-5">
            <h2 class="red text-white text-center py-5">DANGER ZONE &#8595;</h2>
        </div>
        <div class="col-md-3"></div>

        <div class="col-md-6 mt-4">
            <a href="./del_acco.php?type=no" class="btn btn-dark form-control">&#9762; ACCOUNT DELETION &#9785;</a>
        </div>

        <div class="col-md-3"></div>

    </div>
</div>





<script>
    let oneV = document.querySelector(".one").innerText;
    let mybtn = document.querySelector("#mybtn");

    mybtn.addEventListener('click', function () {
        const elem = document.createElement('input');
        elem.setAttribute("value", oneV);
        document.body.appendChild(elem);
        elem.select();
        document.execCommand('copy');
        document.body.removeChild(elem);
        toastr.success("Link Copied to Clipboard");
    })
</script>




<!-- chatify chat -->
<div class="pubble-app" data-app-id="109565" data-app-identifier="109565"></div>
<script type="text/javascript" src="https://cdn.chatify.com/javascript/loader.js" defer></script>





<?php
    include './footer.php'
?>