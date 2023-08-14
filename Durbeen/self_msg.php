<?php
include './header.php';

//create table if not exist
$SQLcreateMe="CREATE TABLE IF NOT EXISTS `$unique_id_me to $unique_id_me` (
  `id` int(255) unsigned NOT NULL auto_increment,
  `message` text,
  `image` varchar(1000),
  `time` varchar(1000),
  PRIMARY KEY  (`id`)
)";
mysqli_query($connection_message, $SQLcreateMe);
//table creation end





if (isset($_POST['send'])) {
	$message = $_POST['message'];
	date_default_timezone_set("Asia/Dhaka");
	$time = date_default_timezone_get().' time: '.date("d-M-Y-D-H:i:s");

	if($_FILES['image_khan_bahadur']['name']){
		$imageOldName = $_FILES['image_khan_bahadur']['name'];
		$imageNewName = uniqid().'_'.date("Y-M-H-i-s").'_'.$imageOldName;
		$image_tmp = $_FILES['image_khan_bahadur']['tmp_name'];
		move_uploaded_file($image_tmp,'./chat_image/'.$imageNewName);
	}else{
		$imageNewName = '';
	}

	$SQL2 = "INSERT INTO `$unique_id_me to $unique_id_me`(`message`, `image`, `time`) VALUES ('$message','$imageNewName','$time')";
	mysqli_query($connection_message, $SQL2);

	// echo "<script>window.location = 'message.php?unique_id_fr='.$unique_id_fr.'&#last'</script>";
}





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
<a target="_self" style="position: fixed;left:13%;top:142px;z-index:20;font-weight: 600;"
	href="self_msg.php?type=self_msg"
	class="btn btn-lg btn-success">Self Message</a>


<div class="container" style="margin-top:270px">

	<div class="row">
		<div class="col-md-12">

			<table class="table table-bordered mt-4">
				<tbody id="tbodyID">
					<tr>
					</tr>
				</tbody>
			</table>


			<?php

				//pagination
				$posts_per_page = 10;

				$sql = "SELECT * FROM `$unique_id_me to $unique_id_me`";

				$result = mysqli_query($connection_message, $sql);

				$total_posts = mysqli_num_rows($result);

				$total_pages = ceil($total_posts / $posts_per_page);


				if(isset($_GET['page'])){
						$current_page = $_GET['page'];
				}else{
						$current_page = 1;
				}

				$start_limit = ($current_page - 1) * $posts_per_page;

				$selectSQL = "SELECT * FROM `$unique_id_me to $unique_id_me` ORDER BY `id` DESC LIMIT ".$start_limit.",".$posts_per_page;

				$runSelect = mysqli_query($connection_message, $selectSQL);



				while ($data3=mysqli_fetch_assoc($runSelect)){ ?>
				<table class="table table-bordered mt-4">
					<tbody>
						<tr>
															
							<div class="float-end" style="width: 590px;border: none;">
								<img title="<?php echo $data3['time'] ?>" width="590px" src="./chat_image/<?php echo $data3['image'] ?>" alt="">
								
								<?php if($data3['message']!=""){ ?>
								<h5 title="<?php echo $data3['time'] ?>" style="border-radius: 35px" class="response float-end py-2 px-3 bg-success"><?php echo $data3['message'] ?></h5>
								<?php } ?>
								
								<button onclick="unsendMessage(<?php echo $data3['id']?>,<?php echo $unique_id_me ?>, this)"
											class="btn btn-sm btn-primary float-end mb-2" title="Delete"><i class="fas fa-trash-alt"></i></button>
							</div>
							
						</tr>
					</tbody>
				</table>
				
			<?php } ?>
		</div>
	</div>





	<div style="position: fixed;bottom: 25px;right: 10%;left: 10%;z-index:10;">
		<form id="formID" method="post" action="" enctype="multipart/form-data">

			<input type="hidden" name="unique_id_me" value="<?php echo $unique_id_me ?>">

			<div class="row">
				<div class="col-lg-2 col-md-2 col-sm-2">
					<input style="background-color: #F3F3F3;" id="imageID" name="image_khan_bahadur" class="form-control" type="file">
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<div class="form-group">
						<input id="messageID" name="message" class="form-control messageClass" type="text">
					</div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2">
					<div class="form-group">
						<input id="buttonID" name="send" value="SEND" class="btn btn-danger form-control" type="submit">
					</div>
				</div>
			</div>
		</form>
	</div>

	<div style="height: 250px"></div>
</div>




<script>
	let tbody = document.querySelector("#tbodyID");

	let form = document.querySelector("#formID");
	let image = document.querySelector("#imageID");
	let message = document.querySelector("#messageID");
	let button = document.querySelector("#buttonID");



	form.addEventListener('submit', (e) => {
    e.preventDefault();


		var formdata = new FormData(form);

		$.ajax({
			url: "./api/self_msg_add.php",
			type: "POST",
			data: formdata,
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function () {
				// alert('ok')
			},
			success: function (data) {

				let json = JSON.parse(data);
				
				let unique_id_me = json.unique_id_me;
				let newMessage = json.newMessage;

		
				tbody.innerHTML = makeTr(newMessage, unique_id_me) + tbody.innerHTML;

				image.value = "";
				message.value = "";
			},
			error: function (err) {
				console.log(err);
			}
		});

	})




const makeTr = (message, unique_id_me) => {
	let tr = `<tr>
							<div class="float-end" style="width: 590px;border: none;">
								<img title="${message.time}" width="590px" src="./chat_image/${message.image}" alt="">
								
								<h5 title="${message.time}" style="border-radius: 35px" class="response float-end py-2 px-3 bg-success">${message.message}</h5>
								
								<button onclick="unsendMessage(${message.id}, ${unique_id_me}, this)"
										class="btn btn-sm btn-primary float-end mb-2" title="Unsend"><i class="fas fa-trash-alt"></i></button>
							</div>
						</tr>`
	return tr;
}



const unsendMessage = (id_lll, unique_id_me, elm_ppp) => {

	let message = {};

	message.id = id_lll;
	message.unique_id_me = unique_id_me;

	axios.post("./api/delete_self_msg.php",
		message,
		{
			headers: {
				"Content-Type": "application/json"
			}
		})
		.then( res => {
			// console.log(res.data);

			if(res.data == '1'){
				toastr.error('Message Deleted')
			}
			// console.log(elm_ppp.parentElement);

			elm_ppp.parentElement.remove();
			
		})
		.catch( err => {
			console.log(err);
		})

}





</script>




<!-- pagination buttons -->
<section class="pagination" style="background-color: #18191A;">
		<div style="width: 350px; margin: 20px auto" class="text-center">
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

			<a href='./message.php?type=no&page=<?php echo $dddd ?>&unique_id_fr=<?php echo $unique_id_fr?>' class="pag-link">&#60;&#60;</a>

			<?php for($i = 1; $i <= $total_pages; $i++){ ?>

			<a href='./message.php?type=no&page=<?php echo $i ?>&unique_id_fr=<?php echo $unique_id_fr?>'class='pag-link <?php


			if ($_GET['page'] == $i){
					printf("active");
			}else if ($_GET['page'] == "" && $i == 1){
					printf("active");
			}else{
					printf("");
			}

			?>'><?php echo $i ?></a>

			<?php } ?>

			<a href='./message.php?type=no&page=<?php echo $llll ?>&unique_id_fr=<?php echo $unique_id_fr?>' class="pag-link">&#62;&#62;</a>
		</div>
	</section>


	<div style="height: 250px"></div>






<?php
include './footer.php'
?>