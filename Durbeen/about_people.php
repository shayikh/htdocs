<?php
include './header.php';

$unique_id_fr = $_GET['unique_id_fr'];

if ($unique_id_fr == $unique_id_me) {
    echo "<script>window.location = 'about_me.php?type=about_me'</script>";
}

$SQLabout = "SELECT * FROM `about` WHERE `unique_id`='$unique_id_fr'";
$runAbout = mysqli_query($connection, $SQLabout);
$dataAbout = mysqli_fetch_assoc($runAbout);


$SQL1 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_fr'";
$run1 = mysqli_query($connection, $SQL1);
$data1 = mysqli_fetch_assoc($run1);

?>


<!-- main page -->


<div class="container" style="margin-top:133px;margin-bottom: 100px">
    <div class="row">

        <div class="col-md-12">
            <img title="Cover Photo Size 1280px * 574px" width="1280px" height="574px" src="./pro_pic/cov_pic/<?php echo $data1['cov_pic'] ?>">
        </div>

        <div class="col-md-12 mt-4">
            <a class="text-decoration-none" href="">
                <img style="border-radius: 50%;border: 3px solid #fff" width="220px" height="220px" src="./pro_pic/<?php echo $data1['pro_pic'] ?>">
            </a>
        </div>

        <div class="col-md-12 text-center" style="margin-top: -146px;">
            <p class="text-white" style="font-size: 39px"><?php echo $data1['name'] ?></p>
        </div>

    </div>




    <div class="row">

        <div class="col-md-12">
            <a href="./people_timeline.php?type&unique_id_fr=<?php echo $data1['unique_id'] ?>" class="btn btn-success float-end ms-2">Timeline</a>

            <a href="./message.php?type&unique_id_fr=<?php echo $data1['unique_id'] ?>" class="btn btn-success float-end">Send Message</a>
        </div>

    </div>




    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered mt-4" style="border-color: #5d5d5d">
                <tr>
                    <td>
                        <h5 class="text-red">Email</h5>
                    </td>
                    <td>
                        <h5><?php echo $data1['email'] ?></h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 class="text-red">Date of Birth</h5>
                    </td>
                    <td>
                        <h5><?php echo $dataAbout['date_birth'] ?></h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 class="text-red">Gender</h5>
                    </td>
                    <td>
                        <h5><?php echo $dataAbout['gender'] ?></h5>
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
                        <h5><?php echo $data1['visit'] ?></h5>
                    </td>
                </tr>
                <tr>
                    <td style="width: 300px">
                        <h5 class="text-red">Account Link</h5>
                    </td>
                    <td>
                        <h5 class="one d-none">
                            http://durbeen.unaux.com/people_timeline.php?type&unique_id_fr=<?php echo $data1['unique_id'] ?></h5>
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

</script>

<?php
include './footer.php'
?>
