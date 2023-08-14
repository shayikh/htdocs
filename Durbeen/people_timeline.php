<?php
include './header.php';

$unique_id_fr = $_GET['unique_id_fr'];

if($unique_id_fr == $unique_id_me){
	echo "<script>window.location = 'timeline.php?type=timeline'</script>";
}





$SQLF = "SELECT * FROM `$unique_id_me follow` WHERE `unique_id_fr`='$unique_id_fr'";
$runF = mysqli_query($durbeen_chats,$SQLF);
$countF = mysqli_num_rows($runF);





$SQL1 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_fr'";
$run1 = mysqli_query($connection,$SQL1);
$data1 = mysqli_fetch_assoc($run1);

$SQLabout = "SELECT * FROM `about` WHERE `unique_id`='$unique_id_fr'";
$runAbout = mysqli_query($connection,$SQLabout);
$dataAbout = mysqli_fetch_assoc($runAbout);

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
            <a class="text-decoration-none" href="./pro_pic.php?type=no&unique_id_fr=<?php echo $data1['unique_id']?>">
                <img style="border-radius: 50%;border: 3px solid #fff" width="220px" height="220px" src="./pro_pic/<?php echo $data1['pro_pic'] ?>">
            </a>
        </div>

        <div id="here"></div>

        <div class="col-md-12 text-center" style="margin-top: -134px">
            <p class="text-white" style="font-size: 39px"><?php echo $data1['name'] ?></p>
        </div>

    </div>

    <?php if($unique_id_fr != $unique_id_me){ ?>
        
    <div class="row">
        <div class="col-md-12">

            <button onclick="followfn(<?php echo $unique_id_me ?>, <?php echo $unique_id_fr ?>, this)"
                class="btn <?php $countF == 0 ? printf("btn-success") : printf("btn-danger") ?> float-end ms-2">
                <?php $countF == 0 ? printf("Follow") : printf("Unfollow") ?>
            </button>

            <a href="./about_people.php?type=no&unique_id_fr=<?php echo $data1['unique_id']?>" class="btn btn-success float-end ms-2">Profile</a>

            <a href="./message.php?type=no&unique_id_fr=<?php echo $data1['unique_id']?>" class="btn btn-success float-end">Chat by Messenger</a>

        </div>
    </div>




    <div class="row">
        <div class="col-md-12">

        </div>
    </div>
    <?php } ?>





    <script>
        
        
        const followfn = (unique_id_me, unique_id_fr, elm) => {

            let followVar = {};

            followVar.unique_id_me = unique_id_me;
            followVar.unique_id_fr = unique_id_fr;

            axios.post("./api/follow.php",
                    followVar, {
                        headers: {
                            "Content-Type": "application/json"
                        }
                    })
                .then(res => {
                    // console.log(res.data);

                    if (res.data == 0) {
                        toastr.error('Unfollowed');
                        elm.innerText = "Follow";
                        elm.classList.add('btn-success');
                        elm.classList.remove('btn-danger');
                    } else {
                        toastr.success('Following');
                        elm.innerText = "Unfollow";
                        elm.classList.add('btn-danger');
                        elm.classList.remove('btn-success');
                    }


                })
                .catch(err => {
                    console.log(err);
                })
        }
    </script>





    <div class="row mb-5">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <!-- Status Bar -->
            <div class="row justify-content-center">
                <?php

				//pagination
				$posts_per_page = 20;

				$sql = "SELECT * FROM `post` WHERE `unique_id`='$unique_id_fr'";

				$result = mysqli_query($connection, $sql);

				$total_posts = mysqli_num_rows($result);

				$total_pages = ceil($total_posts / $posts_per_page);


				if(isset($_GET['page'])){
						$current_page = $_GET['page'];
				}else{
						$current_page = 1;
				}

				$start_limit = ($current_page - 1) * $posts_per_page;

				$selectSQL = "SELECT * FROM `post` WHERE `unique_id`='$unique_id_fr' ORDER BY `id` DESC LIMIT ".$start_limit.",".$posts_per_page;

				$runSelect = mysqli_query($connection, $selectSQL);





				while ($data3=mysqli_fetch_assoc($runSelect)){ ?>
                <div class="statusp">

                    <div class="col-md-12 mt-4 mb-2 "
                        style="background-color: #18191A;padding: 10px;border-radius: 3px">
                        <div class="card" style="width: 100%;border: none;">
                            <p class="text-white p-2" style="background-color: #18191A;border-radius: 3px 3px 0 0;">
                                <img style="border-radius: 50%" width="70px" height="70px"
                                    src="./pro_pic/<?php echo $data1['pro_pic']?>" alt="">
                                <b><?php echo $data1['name']?></b>
                            </p>
                            <img width="100%" src="./post_image/<?php echo $data3['image']?>" alt="">
                            <div class="card-body" style="background-color: #2C2C2C;border-radius: 0 0 3px 3px">
                                <h6 class="card-title text-white"><?php echo $data3['time']?></h6>
                                <p class="card-text text-white"><?php echo $data3['post']?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <?php } ?>


            </div>
        </div>
        <div class="col-md-2"></div>
    </div>

    <section class="pagination" style="background-color: #18191A;">
        <div style="width: 100%; margin: 20px auto" class="text-center">
            <?php 
					if($current_page==1){
							$dddd=$current_page;
					}else if($current_page>1){
							$dddd=$current_page-1;
					}
					
					if($current_page==$total_pages){
							$llll=$current_page;
					}else if($current_page<$total_pages){
							$llll=$current_page+1;
					}
					?>

            <a href='./people_timeline.php?type=no&page=<?php echo $dddd ?>&unique_id_fr=<?php echo $unique_id_fr ?>'
                class="pag-link">&#60;&#60;</a>

            <?php for($i = 1; $i <= $total_pages; $i++){ ?>

            <a href='./people_timeline.php?type=no&page=<?php echo $i ?>&unique_id_fr=<?php echo $unique_id_fr ?>'
                class='pag-link <?php


			if ($_GET['page'] == $i){
					printf("active");
			}else if ($_GET['page'] == "" && $i == 1){
					printf("active");
			}else{
					printf("");
			}

			?>'><?php echo $i ?></a>

            <?php } ?>

            <a href='./people_timeline.php?type=no&page=<?php echo $llll ?>&unique_id_fr=<?php echo $unique_id_fr ?>'
                class="pag-link">&#62;&#62;</a>
        </div>
    </section>



</div>

<style>
    a {
        text-decoration: none;
    }
</style>

<?php
include './footer.php'
?>