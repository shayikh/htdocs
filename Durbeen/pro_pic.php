<?php
include './header.php';

$unique_id_fr = $_GET['unique_id_fr'];




$SQL1 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_fr'";
$run1 = mysqli_query($connection,$SQL1);
$data1 = mysqli_fetch_assoc($run1);

$SQLabout = "SELECT * FROM `about` WHERE `unique_id`='$unique_id_fr'";
$runAbout = mysqli_query($connection,$SQLabout);
$dataAbout = mysqli_fetch_assoc($runAbout);





//message notification 

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



<div class="container text-center" style="margin-top:180px; margin-bottom:180px;">

  <img width="800px" src="./pro_pic/<?php echo $data1['pro_pic'] ?>">


  <br>

  <img style="margin-top: 100px" width="1280px" src="./pro_pic/cov_pic/<?php echo $dataAbout['cov_pic'] ?>" alt="">

</div>






<?php
include './footer.php'
?>