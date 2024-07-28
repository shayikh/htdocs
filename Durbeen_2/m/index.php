<?php
session_start();

if ($_SESSION['unique_id_me']) {
    header('location:./homepage.php');
}

include '../connection.php';

$msg = "";


if (isset($_GET['message'])) {
    $msg = $_GET['message'];
}

if (isset($_POST['login'])) {
    $EmailMe = trim($_POST['email']);
    $password = trim($_POST['password']);

    $SQL1 = "SELECT * FROM `registration` WHERE `email`='$EmailMe' AND `password`='$password'";
    $run1 = mysqli_query($connection, $SQL1);
    $dataMe = mysqli_fetch_assoc($run1);
    $count = mysqli_num_rows($run1);


    if ($count > 0) {
        $unique_id_me = $dataMe['unique_id'];
        $_SESSION['unique_id_me'] = $unique_id_me;


        $visit = $dataMe['visit'] + 1;
        $SQL3 = "UPDATE `registration` SET `active`='1',`visit`='$visit' WHERE `unique_id`='$unique_id_me'";
        mysqli_query($connection, $SQL3);

        header('location:./homepage.php');
    } else {
        $SQL3 = "SELECT * FROM `registration` WHERE `email`='$EmailMe'";
        $run3 = mysqli_query($connection, $SQL3);
        $count = mysqli_num_rows($run3);
        if ($count > 0) {
            header('location:./index.php?message=Incorrect Password');
        } else {
            header('location:./index.php?message=Incorrect Email');
        }
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
        .pwdbody {
            position: relative;
        }

        .icon {
            position: absolute;
            top: 18px;
            right: 30px;
            cursor: pointer;
        }
        input::placeholder {
            color: black;
            font-size: 15px;
        }
    </style>
</head>

<body>



<?php
if (isset($_GET['mustlog'])) {
    echo "<script>toastr.error('You Must LogIn First')</script>";
}
if (isset($_GET['out'])) {
    echo "<script>toastr.error('You Are Logged Out')</script>";
}
if (isset($_GET['wait'])) {
    echo "<script>toastr.error('Wait until Admin Approval')</script>";
    echo "<script>alert('Wait until Admin Approval')</script>";
}
?>


    <div class="container-fluid" style="margin-top: 10px">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <h1 class="durbeen">দূরবীন</h1>
                <p class="bondhu_text text-dark">বন্ধু আড্ডা এডভেঞ্চার সব এখানেই . . .</p>
            </div>


            <div class="col-md-6 col-sm-12">
                <div class="division">
                    <form class="margin-padding" method="post" action="" id="formID">
                        <div class="form-group margin-padding-1">
                            <input required name="email" id="" type="email" class="form-control form-control-lg" placeholder="Email address">
                        </div>
                        <div class="form-group margin-padding-2 pwdbody">
                            <input required name="password" id="" type="password" class="pwd form-control form-control-lg" placeholder="Password">
                            <i onclick="showPwd()" id="" class="icon far fa-eye"></i>
                        </div>


                        <input name="login" value="Log In" class="form-control button_red" type="submit">

                        <div class="text-center">
                            <b>
                                <p class="text-danger text-center d-inline"><?php echo $msg; ?></p>
                            </b>
                            <p class="forgotten-account-link text-center d-inline"><a href=""><span class="text-white">.</span></a></p>

                        </div>

                        <div class="a mt-3"></div>


                        <div style="margin-top:35px;text-align: center">
                            <a style="width: 200px;height: 48px" class="anchor button_index  form-control" href="./registration.php"><b>Create New Account</b></a>
                            <a href="./forgotPass.php" class="text-decoration-none text-primary">Forgot Password?</a>
                        </div>


                    </form>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div style="margin-top: 100px;text-align: center;">
                    <h6 style="color: black">This Website is Designed and Backend Developed by <a style="color: blue" href="https://www.facebook.com/shayikh.fb" target="_blank">Md Mehrab Alam Shayikh</a> and Design Concept Given by <a style="color: blue" href="https://www.facebook.com/tasan.zaman" target="_blank">Ahsan Zaman</a></h6>
                </div>
            </div>
        </div>
    </div>




<?php
include './footer.php'
?>
