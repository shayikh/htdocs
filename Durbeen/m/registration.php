<?php
session_start();

if ($_SESSION['unique_id_me']) {
    header('location:./homepage.php?type');
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
        echo "<script>window.location = './registration.php?message=Another Person Already Used This Email'</script>";
    } else {
        $name = $_POST['name'];
        $password = trim($_POST['password']);
        $date_birth = $_POST['date_birth'];
        $gender = $_POST['gender'];


        if ($_FILES['pro_pic']['name']) {
            $imageOldName = $_FILES['pro_pic']['name'];
            $imageNewName = uniqid() . '_' . date("Y-M-H-i-s") . '_' . $imageOldName;
            $image_tmp = $_FILES['pro_pic']['tmp_name'];
            move_uploaded_file($image_tmp, '../pro_pic/' . $imageNewName);
        } else {
            $imageNewName = "red_comet.png";
        }


        $SQL2 = "INSERT INTO `registration`(`name`, `email`, `password`, `pro_pic`, `cov_pic`) VALUES ('$name','$email','$password','$imageNewName','cov_pic.jpg')";
        mysqli_query($connection, $SQL2);


        $SQL3 = "SELECT * FROM `registration` WHERE `email`='$email'";
        $run3 = mysqli_query($connection, $SQL3);
        $data3 = mysqli_fetch_assoc($run3);

        $unique_id_me = $data3['unique_id'];

        $_SESSION['unique_id_me'] = $unique_id_me;

        $SQL4 = "INSERT INTO `about`(`unique_id`, `date_birth`, `gender`) VALUES ('$unique_id_me','$date_birth','$gender')";
        mysqli_query($connection, $SQL4);


        //create notification table
        $SQL5 = "CREATE TABLE `$unique_id_me notify` (
			`id` int(255) unsigned NOT NULL auto_increment,
			`sender` varchar(255),
			`sender_id` int(255),
			`seen` int(255),
			PRIMARY KEY  (`id`)
		)";
        mysqli_query($durbeen_chats, $SQL5);


        $SQLcreate = "CREATE TABLE IF NOT EXISTS `$unique_id_me chats` (
			`id` int(255) unsigned NOT NULL auto_increment,
			`unique_id_fr` int(255),
			PRIMARY KEY  (`id`)
		)";
        mysqli_query($durbeen_chats, $SQLcreate);

        $SQLcreate = "CREATE TABLE IF NOT EXISTS `$unique_id_me follow` (
			`id` int(255) unsigned NOT NULL auto_increment,
			`unique_id_fr` int(255),
			PRIMARY KEY  (`id`)
		)";
        mysqli_query($durbeen_chats, $SQLcreate);

        $SQL400 = "INSERT INTO `$unique_id_me follow`(`unique_id_fr`) VALUES ('$unique_id_me')";
        mysqli_query($durbeen_chats, $SQL400);
        $SQL400 = "INSERT INTO `$unique_id_me follow`(`unique_id_fr`) VALUES ('1')";
        mysqli_query($durbeen_chats, $SQL400);


        $SQLcreateMe = "CREATE TABLE IF NOT EXISTS `$unique_id_me to $unique_id_me` (
			`id` int(255) unsigned NOT NULL auto_increment,
			`message` text,
			`image` varchar(1000),
			`time` varchar(1000),
			PRIMARY KEY  (`id`)
		)";
        mysqli_query($connection_message, $SQLcreateMe);


        $SQLcreateMe = "CREATE TABLE IF NOT EXISTS `$unique_id_me pro_pic` (
			`id` int(255) unsigned NOT NULL auto_increment,
			`pro_pic` varchar(1000),
			PRIMARY KEY  (`id`)
		)";
        mysqli_query($durbeen_chats, $SQLcreateMe);
        
        $SQLcreateMe = "CREATE TABLE IF NOT EXISTS `$unique_id_me cov_pic` (
			`id` int(255) unsigned NOT NULL auto_increment,
			`cov_pic` varchar(1000),
			PRIMARY KEY  (`id`)
		)";
        mysqli_query($durbeen_chats, $SQLcreateMe);
        
        $SQLcreateMe = "CREATE TABLE IF NOT EXISTS `$unique_id_me msg_grp` (
			`id` int(255) unsigned NOT NULL auto_increment,
            `grp_id` int(255),
			PRIMARY KEY  (`id`)
		)";
        mysqli_query($durbeen_chats, $SQLcreateMe);


        echo "<script>window.location = './about_me.php?type=about_me&register'</script>";
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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/mobile.css">

</head>

<body>
    <div class="container-fluid" style="margin-top: 45px">
        <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-8 mb-5 pb-5">
                <div class="division_mb_register p_rel">
                    <form class="margin-padding" method="post" action="" enctype="multipart/form-data">
                        <h4 class="text-dark">Sign Up</h4>
                        <p class="text-white">.</p>
                        <p class="pos-absol_mb text-dark">Created Account Before! <b><a class="text-decoration-none" href="./">
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

                            <div class="col-md-12 mt- pwdbody">
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
                                <label class="mt-1 font-small text-dark">Profile Picture ( A<span style='font-size:18px;'>&#215;</span>A Size )</label>
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

    <style>
        .pwdbody {
            position: relative;
        }

        .icon {
            position: absolute;
            top: 13px;
            right: 45px;
        }

        .btn-custom {
            width: 200px;
            height: 45px;
            font-size: 21px;
            font-weight: 500;
            text-align: center;
            margin-left: 60px;
            margin-top: 0px;
            margin-bottom: 10px;
            border: 1px solid #00c44b;
            border-radius: 5px;
            color: white;
            background-color: #00c44b;
            transition: 1s;
        }

        .btn-custom:hover {
            background-color: #00983a;
        }

        .font-small-2 {
            font-size: 12px;
        }

        .font-small {
            font-size: 13px;
        }

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

        .select {
            border: 1px solid deepskyblue;
            border-radius: 6px;
            background-color: #fff;
        }

        * {
            margin: 0;
            padding: 0;
        }

        .logo {
            width: 300px;
            margin-left: 225px;
            margin-top: 175px;
            margin-bottom: 0px;
        }

        .heading {
            margin-left: 255px;
            margin-top: 0px;
            font-size: 28px;
            font-weight: 400;
            line-height: 1.2;
        }

        body {
            background: url(../img/background_mb.jpg);
            background-repeat: no-repeat;
            background-size: 100% 1225px;
            background-position: center;
        }

        .margin-padding {
            padding: 15px;
        }

        .division_mb_register {
            background-color: #f7ffff;
            margin-left: 0px;
            margin-top: 55px;
            border-radius: 8px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

    </style>



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
