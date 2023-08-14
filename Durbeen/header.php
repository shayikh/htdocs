<?php
session_start();

if (!$_SESSION['unique_id_me']){
  header('location:./index.php?a');
}


include './connection.php';



$unique_id_me = $_SESSION['unique_id_me'];
$SQLMe = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_me'";
$runMe = mysqli_query($connection,$SQLMe);
$dataMe = mysqli_fetch_assoc($runMe);

$EmailMe = $dataMe['email'];



// visiting
if (!$_SESSION['visit']){
  $_SESSION['visit'] = 'visit';

  $visit = $dataMe['visit'] + 1;

  $SQLvisit = "UPDATE `registration` SET `visit`='$visit' WHERE `unique_id`='$unique_id_me'";
  mysqli_query($connection,$SQLvisit);
}






?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>দূরবীন</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="shortcut icon" href="./img/telescope_2.png">
  <link href="./css/alertify.min.css">
  <link href="./css/all.min.css">
  <link href="./css/fontawesome.min.css">
  <link rel="stylesheet" href="css/toastr.min.css">
  <script src="./js/jquery-3.5.1.toastr.min.js"></script>
  <script src="./js/toastr.min.js"></script>
  <script src="./js/axios.min.js"></script>
  <link rel="stylesheet" href="./css/style.css">

</head>


<body style="background-color: #18191A;">
  <div class="header-position">
    <div class="bg-durbeen-1 py-2">

      <ul id="menu" style="z-index: 50">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Option
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="./about_me.php?type=about_me">About Me</a></li>
            <li><a class="dropdown-item" href="./facelist.php?type=facelist">People Facelist</a></li>
            <li><a class="dropdown-item" href="./all_msg.php?type=all_msg">All Message</a></li>
            <li><a class="dropdown-item" href="./self_msg.php?type=self_msg">Self Message</a></li>
            <li><a class="dropdown-item" href="./logout.php"><h6>Log Out <i class="fas fa-sign-out-alt"></i></h6></a></li>
          </ul>
        </li>
      </ul>




      <div class="container">
        <a href="./homepage.php?type=no" aria-current="page">
          <img title="News Feed" style="margin-left:-65px" width="240px" height="70px" src="./img/brand_logo.png"
            alt="Logo">
        </a>


        <a class="text-decoration-none float-end mt-2" href="./timeline.php?type=timeline">
          <div class="t-hover <?php $_GET['type'] == 'timeline' ? printf('t-active') : "" ?>">

            <img class="float-end" style="border-radius: 50%" width="50px" height="50px"
              src="./pro_pic/<?php echo $dataMe['pro_pic'] ?>" alt="">
            <h5 class="float-start" style="margin-top: 11px;margin-left: 15px;padding-right: 10px">
              <?php echo $dataMe['name'] ?>
            </h5>

          </div>
        </a>
      </div>
    </div>


    <nav style="z-index: 40" class="navbar navbar-expand-lg navbar-light bg-durbeen-special">
      <div class="container">
        <a class="navbar-brand bg-white" href="#"></a>
        <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <li class="nav-item">
              <a class="btn btn-sm nav <?php $_GET['type'] == 'about_me' ? printf("active_2") : "" ?>"
                href="./about_me.php?type=about_me" aria-current="page">About Me</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-sm nav <?php $_GET['type'] == 'facelist' ? printf("active_2") : "" ?>"
                href="./facelist.php?type=facelist" aria-current="page">People Facelist</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-sm nav <?php $_GET['type'] == 'all_msg' ? printf("active_2") : "" ?>"
                href="./all_msg.php?type=all_msg" aria-current="page">All Message</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-sm nav <?php $_GET['type'] == 'self_msg' ? printf("active_2") : "" ?>"
                href="./self_msg.php?type=self_msg" aria-current="page">Self Message</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


  </div>





  <!-- Chatbar start -->
  <div class="main-menu" style="margin-top:133px;padding-top: 8px;z-index: 25">
    <ul style="list-style-type: none">
      <?php
      $SQL11="SELECT * FROM `$unique_id_me chats`";
      $run11=mysqli_query($durbeen_chats,$SQL11);

      while ($data11=mysqli_fetch_assoc($run11)){

        $unique_id_fr_chats = $data11['unique_id_fr'];

        $SQL21="SELECT * FROM `registration` WHERE `unique_id`='$unique_id_fr_chats'";
        $run21=mysqli_query($connection,$SQL21);
        $data21=mysqli_fetch_assoc($run21);
        
        
        ?>

      <li style="margin-bottom: 5px">
        <a class="text-decoration-none" href="message.php?type=no&unique_id_fr=<?php echo $data21['unique_id']?>">
          <div class="hover">

            <img class="float-start me-3" style="border-radius: 50%" width="50px" height="50px"
              src="./pro_pic/<?php echo $data21['pro_pic'] ?>" alt="">
            <img src="./img/<?php $data21['active'] == 1 ? printf("green_dot.png") : printf("red_dot.jpg") ?>"
              style="border: 1px solid black;border-radius: 50%;margin-top: 37px;margin-left: -31px" width="12px"
              alt="">
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


