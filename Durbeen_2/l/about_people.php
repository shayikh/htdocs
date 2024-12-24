<?php
include './header.php';

$unique_id_fr = $_GET['unique_id_fr'];

if ($unique_id_fr == $unique_id_me) {
    echo "<script>window.location = 'about_me.php?type=about_me'</script>";
}


$SQLF = "SELECT * FROM `$unique_id_me follow` WHERE `unique_id_fr`='$unique_id_fr'";
$runF = mysqli_query($connection_info, $SQLF);
$countF = mysqli_num_rows($runF);

if ($countF == 0) {
    echo "<script>window.location = 'facelist.php?type=facelist&nofollow'</script>";
}


$SQL1 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_fr'";
$run1 = mysqli_query($connection, $SQL1);
$data1 = mysqli_fetch_assoc($run1);

$SQLabout = "SELECT * FROM `about` WHERE `unique_id`='$unique_id_fr'";
$runAbout = mysqli_query($connection, $SQLabout);
$dataAbout = mysqli_fetch_assoc($runAbout);

$SQL2 = "SELECT * FROM `$unique_id_me allow` WHERE `unique_id_fr`='$unique_id_fr'";
$run2 = mysqli_query($connection_info,$SQL2);
$count2 = mysqli_num_rows($run2);

?>


<!-- main page -->
<div class="container" style="margin-top:133px; margin-bottom: 100px">

    <div class="row">

        <div class="col-md-12">
            <img width="1294px" src="../pro_pic/cov_pic/<?php echo $data1['cov_pic'] ?>">
        </div>

        <div class="col-md-12 mt-4">
            <img style="border-radius: 50%;border: 3px solid #fff" width="220px" height="220px" src="../pro_pic/<?php echo $data1['pro_pic'] ?>">
        </div>

        <div class="col-md-12 text-center" style="margin-top: -146px;">
            <p class="text-white" style="font-size: 39px"><?php echo $data1['name'] ?></p>
        </div>

    </div>



    <div class="row">
        <div class="col-md-12">          
            <a href="./people_timeline.php?type&unique_id_fr=<?php echo $data1['unique_id'] ?>" class="btn btn-success float-end ms-1">Timeline</a>

            <a href="./message.php?type&unique_id_fr=<?php echo $data1['unique_id'] ?>" class="btn btn-success float-end ms-1">Send Message</a>

            <button onclick="allowfn(<?php echo $unique_id_me ?>, <?php echo $unique_id_fr ?>, this)" class="btn <?php $count2 == 0 ? printf("btn-success") : printf("btn-danger") ?> float-end ms-1">
                <?php $count2 == 0 ? printf('<i class="fas fa-user-check"></i>') : printf('<i class="fas fa-user-times"></i>') ?>
            </button>

            <button onclick="unfollowfn(<?php echo $unique_id_me ?>, <?php echo $unique_id_fr ?>)" class="btn btn-danger float-end">
                <i class="fas fa-user-slash"></i>
            </button>
        </div>

    </div>




    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered mt-4" style="border-color: #5d5d5d">
                <tr>
                    <td>
                        <h5 class="text-blue">Email</h5>
                    </td>
                    <td>
                        <h5><?php echo $data1['email'] ?></h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 class="text-blue">Date of Birth</h5>
                    </td>
                    <td>
                        <h5><?php echo $dataAbout['date_birth'] ?></h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 class="text-blue">Gender</h5>
                    </td>
                    <td>
                        <h5><?php echo $dataAbout['gender'] ?></h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 class="text-blue">Phone Numbers</h5>
                    </td>
                    <td>
                        <h5><?php echo $dataAbout['phone_no'] ?></h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 class="text-blue">Religion</h5>
                    </td>
                    <td>
                        <h5><?php echo $dataAbout['religion'] ?></h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 class="text-blue">Country</h5>
                    </td>
                    <td>
                        <h5><?php echo $dataAbout['country'] ?></h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 class="text-blue">City</h5>
                    </td>
                    <td>
                        <h5><?php echo $dataAbout['city'] ?></h5>
                    </td>
                </tr>
                <tr>
                    <td style="width: 300px">
                        <h5 class="text-blue">Bio</h5>
                    </td>
                    <td>
                        <h5 style="line-height: 200%"><?php echo $dataAbout['bio'] ?></h5>
                    </td>
                </tr>

                <tr>
                    <td style="width: 300px">
                        <h5 class="text-blue">Durbeen Visited</h5>
                    </td>
                    <td>
                        <h5><?php echo $data1['visit'] ?></h5>
                    </td>
                </tr>
                <tr>
                    <td style="width: 300px">
                        <h5 class="text-blue">Account Link</h5>
                    </td>
                    <td>
                        <h5 class="one d-none">
                            http://durbeen2.unaux.com/l/people_timeline.php?type&unique_id_fr=<?php echo $data1['unique_id'] ?></h5>
                        <button id="mybtn" class="btn btn-success float-start">Copy Account Link</button>
                    </td>
                </tr>
            </table>
        </div>

    </div>
</div>


<script>
    let oneV = document.querySelector(".one").innerText;
    let mybtn = document.querySelector("#mybtn");

    mybtn.addEventListener('click', function() {
        const elem = document.createElement('input');
        elem.setAttribute("value", oneV);
        document.body.appendChild(elem);
        elem.select();
        document.execCommand('copy');
        document.body.removeChild(elem);
        toastr.success("Link Copied to Clipboard");
    })


    const unfollowfn = (unique_id_me, unique_id_fr) => {

        let unfollowVar = {};

        unfollowVar.unique_id_me = unique_id_me;
        unfollowVar.unique_id_fr = unique_id_fr;

        axios.post("../api/facelist/unfollow.php",
                unfollowVar, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {
                // console.log(res.data);

                if (res.data == 0) {
                    window.location = 'facelist.php?type=facelist';
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
