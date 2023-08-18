<?php
include './header.php';



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



<div class="container" style="margin-top:180px">
	<table class="table table-bordered mt-4" style="margin-bottom: 150px;border-color: #5d5d5d">
		<tbody>
			<?php

				//pagination
				$posts_per_page = 20;

				$sql = "SELECT * FROM `registration` WHERE `unique_id`!='$unique_id_me'";

				$result = mysqli_query($connection, $sql);

				$total_posts = mysqli_num_rows($result);

				$total_pages = ceil($total_posts / $posts_per_page);


				if(isset($_GET['page'])){
					$current_page = $_GET['page'];
				}else{
					$current_page = 1;
				}

				$start_limit = ($current_page - 1) * $posts_per_page;

				$selectSQL = "SELECT * FROM `registration` WHERE `unique_id`!='$unique_id_me' ORDER BY `unique_id` DESC LIMIT ".$start_limit.",".$posts_per_page;

				$runSelect = mysqli_query($connection, $selectSQL);

        while ($data1=mysqli_fetch_assoc($runSelect)){

				$unique_id_fr = $data1['unique_id'];


				$SQLF = "SELECT * FROM `$unique_id_me follow` WHERE `unique_id_fr`='$unique_id_fr'";
				$runF = mysqli_query($durbeen_chats,$SQLF);
				$countF = mysqli_num_rows($runF);

        ?>

			<tr>
				<td class="text-center">
					<a href="./people_timeline.php?type=no&unique_id_fr=<?php echo $unique_id_fr ?>">
						<img height="130px" src="./pro_pic/<?php echo $data1['pro_pic'] ?>" alt="">
					</a>
				</td>
				<td class="text-center">
					<a class="text-decoration-none" href="./people_timeline.php?type=no&unique_id_fr=<?php echo $unique_id_fr ?>">
						<h3 class="mt-4"><?php echo $data1['name'] ?></h3>
						<h6 class="text-success">Durbeen Visited : <?php echo $data1['visit'] ?></h6>
					</a>
				</td>
				<td class="text-center">
					<button onclick="followfn(<?php echo $unique_id_me ?>, <?php echo $unique_id_fr ?>, this)"
						class="btn <?php $countF == 0 ? printf("btn-success") : printf("btn-danger") ?> mt-5" id="followBtn">
						<?php $countF == 0 ? printf("Follow") : printf("Unfollow") ?>
					</button>
				</td>
				<td class="text-center">
					<a href="message.php?type=no&unique_id_fr=<?php echo $unique_id_fr?>">
						<img width="70px" src="./css/892177.svg" alt="" class="mt-4">
					</a>
				</td>
			</tr>

			<?php } ?>

		</tbody>
	</table>





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

			<a href='./facelist.php?type&page=<?php echo $dddd ?>' class="pag-link">&#60;&#60;</a>

			<?php for($i = 1; $i <= $total_pages; $i++){ ?>

			<a href='./facelist.php?type&page=<?php echo $i ?>' class='pag-link <?php


			if ($_GET['page'] == $i){
				printf("active");
			}else if ($_GET['page'] == "" && $i == 1){
				printf("active");
			}else{
				printf("");
			}

			?>'><?php echo $i ?></a>

			<?php } ?>

			<a href='./facelist.php?type&page=<?php echo $llll ?>' class="pag-link">&#62;&#62;</a>
		</div>
	</section>



</div>





<?php
include './footer.php'
?>