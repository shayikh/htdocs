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
$pro_pic_me = $dataMe['pro_pic'];



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
    <link rel="stylesheet" href="../css/windows.css">

</head>


<body style="background-color: #18191A;">
    <div class="header-position">
        <div class="bg-durbeen py-2">

            <ul id="menu" style="z-index: 50">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Option
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="./about_me.php?type=about_me">About Me</a></li>
                        <li><a class="dropdown-item" href="./facelist.php?type=facelist">People Facelist</a></li>
                        <li><a class="dropdown-item" href="./notification.php?type=notification">Notifications</a></li>
                        <li><a class="dropdown-item" href="./groups.php?type=groups">My Groups</a></li>
                        <li><a class="dropdown-item" style="cursor: pointer" onclick="logout(<?php echo $unique_id_me ?>)">
                                <h6>Log Out <i class="fas fa-sign-out-alt"></i></h6>
                            </a></li>
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

                                <img class="float-end" style="border-radius: 50%" width="50px" height="50px" src="../pro_pic/<?php echo $pro_pic_me ?>" id="timeline_pro_pic">
                                <h5 class="float-start" style="margin-top: 11px;margin-left: 15px;padding-right: 10px" id="timeline_name">
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
                        <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                                <li class="nav-item">
                                    <a class="btn btn-sm nav <?php $_GET['type'] == 'about_me' ? printf("active_2") : "" ?>" href="./about_me.php?type=about_me" aria-current="page">About Me</a>
                                </li>
                                <li class="nav-item">
                                    <a class="btn btn-sm nav <?php $_GET['type'] == 'facelist' ? printf("active_2") : "" ?>" href="./facelist.php?type=facelist" aria-current="page">People Facelist</a>
                                </li>
                                <li class="nav-item">
                                    <a class="btn btn-sm nav <?php $_GET['type'] == 'notification' ? printf("active_2") : "" ?>" href="./notification.php?type=notification" aria-current="page">Notifications</a>
                                </li>
                                <li class="nav-item">
                                    <a class="btn btn-sm nav <?php $_GET['type'] == 'groups' ? printf("active_2") : "" ?>" href="./groups.php?type=groups" aria-current="page">My Groups</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>


    </div>


    <!-- Chatbar start -->
    <div class="main-menu" style="margin-top:133px;padding-top: 8px;z-index: 25">
        <ul style="list-style-type: none">
            <li style="margin-bottom: 5px">
                <a class="text-decoration-none" href="./my_notes.php?type=my_notes">
                    <div class="hover_chatbar">

                        <img class="float-start me-3" style="border-radius: 50%" width="50px" height="50px" src="../pro_pic/<?php echo $pro_pic_me ?>" id="chatbar_pro_pic">
                        <img src="../img/green_dot.png" style="border: 1px solid black;border-radius: 50%;margin-top: 37px;margin-left: -31px" width="12px">
                        <h5 class="text-" style="margin-top: -38px;margin-left: 68px" id="chatbar_name">
                            <?php echo $dataMe['name'] ?>
                        </h5>

                    </div>
                </a>
            </li>






            <?php
            $SQL12 = "SELECT * FROM `$unique_id_me msg_grp` ORDER BY `id` DESC";
            $run12 = mysqli_query($connection_info, $SQL12);

            while ($data12 = mysqli_fetch_assoc($run12)) {

            $grp_id = $data12['grp_id'];

            $SQL1 = "SELECT * FROM `groups` WHERE `id`='$grp_id'";
            $run1 = mysqli_query($connection,$SQL1);
            $data1 = mysqli_fetch_assoc($run1)

            ?>

            <li style="margin-bottom: 5px">
                <a class="text-decoration-none" href="./group_msg.php?type&grp_id=<?php echo $data1['id'] ?>">
                    <div class="hover_chatbar">

                        <img class="float-start me-3" style="border-radius: 50%" width="50px" height="50px" src="../pro_pic/<?php echo $data1['pro_pic'] ?>">
                        <img src="../img/green_dot.png" style="border: 1px solid black;border-radius: 50%;margin-top: 37px;margin-left: -31px" width="12px">
                        <h5 class="text-" style="margin-top: -38px;margin-left: 68px">
                            <?php echo $data1['grp_name'] ?>
                        </h5>

                    </div>
                </a>
            </li>

            <?php } ?>






            <?php
            $SQL11 = "SELECT * FROM `$unique_id_me chats` ORDER BY `id` DESC";
            $run11 = mysqli_query($connection_info, $SQL11);

            while ($data11 = mysqli_fetch_assoc($run11)) {

            $unique_id_fr_chats = $data11['unique_id_fr'];

            $SQL21 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_fr_chats'";
            $run21 = mysqli_query($connection, $SQL21);
            $data21 = mysqli_fetch_assoc($run21);

            ?>

            <li style="margin-bottom: 5px">
                <a class="text-decoration-none" href="message.php?type&unique_id_fr=<?php echo $data21['unique_id'] ?>">
                    <div class="hover_chatbar">

                        <img class="float-start me-3" style="border-radius: 50%" width="50px" height="50px" src="../pro_pic/<?php echo $data21['pro_pic'] ?>">
                        <img src="../img/<?php $data21['active'] == 1 ? printf("green_dot.png") : printf("red_dot.jpg") ?>" style="border: 1px solid black;border-radius: 50%;margin-top: 37px;margin-left: -31px" width="12px">
                        <h5 class="text-" style="margin-top: -38px;margin-left: 68px">
                            <?php echo $data21['name'] ?>
                        </h5>

                    </div>
                </a>
            </li>

            <?php } ?>

        </ul>
    </div>
    <!-- Chatbar end -->
