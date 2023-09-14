<?php
session_start();

if (!$_SESSION['unique_id_me']) {
    header('location:./index.php?mustlog');
}


include '../connection.php';


$unique_id_me = $_SESSION['unique_id_me'];
$SQLMe = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_me'";
$runMe = mysqli_query($connection, $SQLMe);
$dataMe = mysqli_fetch_assoc($runMe);

$EmailMe = $dataMe['email'];
$pro_pic = $dataMe['pro_pic'];



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>দূরবীন</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="shortcut icon" href="../img/telescope.png">
    <link href="../css/alertify.min.css">
    <link href="../css/all.min.css">
    <link href="../css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/toastr.min.css">
    <script src="../js/jquery-3.5.1.toastr.min.js"></script>
    <script src="../js/toastr.min.js"></script>
    <script src="../js/axios.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/mobile.css">

</head>


<body style="background-color: #18191A;">
<div class="header-position">
    <div class="bg-durbeen py-2">

        <ul id="menu" style="z-index: 50">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    Option
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="./about_me.php">About Me</a></li>
                    <li><a class="dropdown-item" href="./facelist.php">People Facelist</a></li>
                    <li><a class="dropdown-item" href="./chat_list.php">Chat List</a></li>
                    <li><a class="dropdown-item" href="./all_msg.php">All Message</a></li>
                    <li><a class="dropdown-item" href="./self_msg.php">Self Message</a></li>
                    <li><a class="dropdown-item" style="cursor: pointer" onclick="logout(<?php echo $unique_id_me ?>)"><h6>Log Out <i class="fas fa-sign-out-alt"></i></h6></a></li>
                </ul>
            </li>
        </ul>


        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <a href="./homepage.php?type">
                        <img title="News Feed" width="90px" height="70px" src="../img/brand_logo.png" alt="Logo">
                    </a>


                    <a class="text-decoration-none float-end mt-2" href="./timeline.php?type=timeline">
                        <div class="t-hover <?php $_GET['type'] == 'timeline' ? printf('t-active') : "" ?>">

                            <img class="float-end" style="border-radius: 50%" width="50px" height="50px"
                                 src="../pro_pic/<?php echo $dataMe['pro_pic'] ?>" alt="" id="timeline_pro_pic">
                            <h5 class="float-start" style="margin-top: 11px;margin-left: 15px;padding-right: 10px">
                                <?php echo $dataMe['name'] ?>
                            </h5>

                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>


    <nav style="z-index: 40" class="navbar navbar-expand-lg navbar-light bg-durbeen-special">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <button class="navbar-toggler" type="button">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>
        </div>
    </nav>


</div>




