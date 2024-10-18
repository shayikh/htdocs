<?php
session_start();

if ($_SESSION['unique_id_me']) {
    header('location:./homepage.php?type');
    echo "<script>window.location = './homepage.php?type'</script>";
}

include '../connection.php';

$msg = "";

if (isset($_GET['message'])) {
    $msg = $_GET['message'];
}

if (isset($_POST['signup'])) {
    $email = trim($_POST['email']);

    $SQL1 = "SELECT * FROM `registration` WHERE `email`='$email'";
    $run1 = mysqli_query($connection, $SQL1);
    $count = mysqli_num_rows($run1);
    if ($count > 0) {
        header('location:./registration.php?message=Another Person Already Used This Email');
        echo "<script>window.location = './registration.php?message=Another Person Already Used This Email'</script>";
    } else {
        $name = $_POST['name'];
        $password = trim($_POST['password']);
        $date_birth = $_POST['date_birth'];
        $gender = $_POST['gender'];

        date_default_timezone_set("Asia/Dhaka");
        
        if ($_FILES['pro_pic']['name']) {
            $imageOldName = $_FILES['pro_pic']['name'];
            $extension = pathinfo($imageOldName, PATHINFO_EXTENSION);
            $imageNewName = uniqid().'_'.date("d_M_Y_D_h_i_s_a").'.'.$extension;
            $image_tmp = $_FILES['pro_pic']['tmp_name'];
            move_uploaded_file($image_tmp, '../pro_pic/' . $imageNewName);
        } else {
            $imageNewName = "red_comet.png";
        }


        $SQL2 = "INSERT INTO `account`(`name`, `email`, `password`,`date_birth`, `gender`, `pro_pic`) VALUES ('$name','$email','$password','$date_birth','$gender','$imageNewName')";
        mysqli_query($connection, $SQL2);


        header('location:./index.php?wait');
        echo "<script>window.location = './index.php?wait'</script>";
    }

}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>দূরবীন</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="shortcut icon" href="../img/telescope.png" />
    <link href="../css/alertify.min.css" />
    <link href="../css/all.min.css" />
    <link href="../css/fontawesome.min.css" />
    <link rel="stylesheet" href="../css/toastr.min.css">
    <script src="../js/jquery-3.5.1.toastr.min.js"></script>
    <script src="../js/toastr.min.js"></script>
    <script src="../js/axios.min.js"></script>
    <link rel="stylesheet" href="../css/android.css">
    <style>
        input::placeholder {
            border: #ff4b4b;
            color: black;
            font-size: 15px;
        }

        input[type=text] {
            border: 1px solid deepskyblue;
            border-radius: 6px;
            background-color: #fff;
        }

        input[type=date] {
            border: 1px solid deepskyblue;
            border-radius: 6px;
            background-color: #fff;

        }

        input[type=file] {
            border: 1px solid deepskyblue;
            border-radius: 6px;
            background-color: #fff;

        }

        input[type=email] {
            border: 1px solid deepskyblue;
            border-radius: 6px;
            background-color: #fff;

        }

        input[type=password] {
            border: 1px solid deepskyblue;
            border-radius: 6px;
            background-color: #fff;

        }
        .pwdbody {
            position: relative;
        }

        .icon {
            position: absolute;
            top: 13px;
            right: 45px;
            cursor: pointer;
        }
    </style>
</head>

<body class="bg_img">
    <div class="container-fluid" style="margin-top: 45px">
        <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-8 mb-5 pb-5">
                <div class="division_register p_rel">
                    <form class="margin-padding" method="post" action="" enctype="multipart/form-data">
                        <h4 class="text-dark">Sign Up</h4>
                        <p class="text-white">.</p>
                        <p class="pos-absol text-dark">Created Account Before! <b><a class="text-decoration-none" href="./">
                                    <span style="color: #ff4b4b">Log In</span></a></b></p>

                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <input required name=name type="text" class="form-control" placeholder="Full Name">
                            </div>
                            <div class="col-md-12 mt-2">
                                <input required name="email" oninput="uniqueEmail()" id="emailID" type="email" class="form-control" placeholder="Email address">
                            </div>

                            <b>
                                <h6 class="text-danger ml-3 mt-1"><?php echo $msg; ?></h6>
                            </b>

                            <div class="col-md-12 pwdbody">
                                <input required name="password" id="" type="password" class="pwd form-control" placeholder="New password">
                                <i onclick="showPwd()" id="" class="icon far fa-eye"></i>
                            </div>
                            <div class="col-md-6">
                                <label class="mt-1 font-small text-dark">Date of birth</label>
                                <input required name="date_birth" class="form-control" type="date">
                            </div>
                            <div class="col-md-6">
                                <label class="font-small text-dark">Gender</label>
                                <select required name="gender" class="form-control select">
                                    <option value="">Select Gender</option>
                                    <option value="Female">&#9792; Female</option>
                                    <option value="Male">&#9794; Male</option>
                                    <option value="Mixed">&#9892; Mixed</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="mt-1 font-small text-dark">Profile Picture ( A<span style='font-size:18px;'>&#215;</span>A Size ) (Very Light Weight Photo)</label>
                                <input required name="pro_pic" class="form-control" type="file" accept="image/png, image/bmp, image/gif, image/jpg, image/avif, image/jpeg, image/jfif, image/pjpeg, image/pjp, image/apng, image/svg, image/webp">
                            </div>
                            <label class="mt-2 ml-3 ms-2 font-small-2">.</label>
                            <input name="signup" type="submit" class="btn-custom mt-3" value="Sign Up">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



<script>

    let email = document.querySelector("#emailID");
    function uniqueEmail() {
        let product = {};

        product.email = email.value;

        axios.post("../api/reg_uniq_email.php",
                product, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {
                if (res.data == "0") {
                    toastr.error("This email is used by someone. You can not use this email");
                    alert("This email is used by someone. You can not use this email");
                    email.value = "";
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
