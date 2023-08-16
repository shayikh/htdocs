<?php
include './header.php';

$unique_id_fr = $_GET['unique_id_fr'];

$SQLtest = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_fr'";
$runtest = mysqli_query($connection,$SQLtest);
$countTest = mysqli_num_rows($runtest);

if($countTest == 0){
	echo "<script>window.location = 'homepage.php?type=no'</script>";
}else{




	if($unique_id_fr == $unique_id_me){
		echo "<script>window.location = 'self_msg.php?type=self_msg'</script>";
	}
	elseif($unique_id_fr == ""){
		echo "<script>window.location = 'self_msg.php?type=self_msg'</script>";
	}else{
		//seen from notify db
		$SQL99 = "UPDATE `$unique_id_me notify` SET `seen`='1' WHERE `sender_id`='$unique_id_fr'";
		mysqli_query($con_notification,$SQL99);

		//delete from notify db

		$SQL96 = "SELECT * FROM `$unique_id_me notify` WHERE `seen`='1'";
		$run96 = mysqli_query($con_notification,$SQL96);
		$count = mysqli_num_rows($run96);

		if($count>50){
			$delete = $count-50;

			//50 is the minumum number of messages

			$SQL91 = "DELETE FROM `$unique_id_me notify` WHERE `sender_id`='$unique_id_fr' ORDER BY `id` ASC LIMIT $delete";
			mysqli_query($con_notification,$SQL91);
		}







		//create two table if not exist
		$SQLcreateMe="CREATE TABLE IF NOT EXISTS `$unique_id_me to $unique_id_fr` (
			`id` int(255) unsigned NOT NULL auto_increment,
			`sender` varchar(255),
			`message` text,
			`image` varchar(1000),
			`time` varchar(1000),
			`seen` varchar(1000),
			PRIMARY KEY  (`id`)
		)";
		mysqli_query($connection_message, $SQLcreateMe);

		$SQLcreateFr="CREATE TABLE IF NOT EXISTS `$unique_id_fr to $unique_id_me` (
			`id` int(255) unsigned NOT NULL auto_increment,
			`sender` varchar(255),
			`message` text,
			`image` varchar(1000),
			`time` varchar(1000),
			`seen` varchar(1000),
			PRIMARY KEY  (`id`)
		)";
		mysqli_query($connection_message, $SQLcreateFr);
		//table creation end







		//chat friend start
		$SQL15 = "SELECT * FROM `$unique_id_me chats` WHERE `unique_id_fr`='$unique_id_fr'";
		$run15 = mysqli_query($durbeen_chats,$SQL15);
		$count = mysqli_num_rows($run15);

		if($count == 0){
			$SQL16 = "INSERT INTO `$unique_id_me chats`(`unique_id_fr`) VALUES ('$unique_id_fr')";
			mysqli_query($durbeen_chats,$SQL16);
		}



		$SQL15 = "SELECT * FROM `$unique_id_fr chats` WHERE `unique_id_fr`='$unique_id_me'";
		$run15 = mysqli_query($durbeen_chats,$SQL15);
		$count = mysqli_num_rows($run15);

		if($count == 0){
			$SQL16 = "INSERT INTO `$unique_id_fr chats`(`unique_id_fr`) VALUES ('$unique_id_me')";
			mysqli_query($durbeen_chats,$SQL16);
		}









		// seen all message
		$SQL97 = "UPDATE `$unique_id_me to $unique_id_fr` SET `seen`='Seen' WHERE `sender`='fr'";
		mysqli_query($connection_message,$SQL97);
		$SQL98 = "UPDATE `$unique_id_fr to $unique_id_me` SET `seen`='Seen' WHERE `sender`='me'";
		mysqli_query($connection_message,$SQL98);



		$SQL1 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_fr'";
		$run1 = mysqli_query($connection,$SQL1);
		$data1 = mysqli_fetch_assoc($run1);

		$pro_pic_fr = $data1['pro_pic'];
		$friendName = $data1['name'];
		$EmailFriend = $data1['email'];











		if (isset($_POST['delete_con'])){

			$SQL6 = "SELECT * FROM `$unique_id_me to $unique_id_fr`";
			$run = mysqli_query($connection_message, $SQL6);

			// if($run==true){
				while ($data = mysqli_fetch_assoc($run)){ 
					$imgNameinDB = $data['image'];
					if($imgNameinDB!=''){
							unlink('./chat_image/'.$imgNameinDB);
					}
				}
			// }
			
			$SQL6 = "DROP TABLE IF EXISTS `$unique_id_me to $unique_id_fr`";
			mysqli_query($connection_message, $SQL6);



			$SQL6 = "SELECT * FROM `$unique_id_fr to $unique_id_me`";
			$run = mysqli_query($connection_message, $SQL6);

			// if($run==true){
				while ($data = mysqli_fetch_assoc($run)){ 
					$imgNameinDB = $data['image'];
					if($imgNameinDB!=''){
							unlink('./chat_image/'.$imgNameinDB);
					}
				}
			// }
			
			$SQL6 = "DROP TABLE IF EXISTS `$unique_id_fr to $unique_id_me`";
			mysqli_query($connection_message, $SQL6);





			$SQL6 = "DELETE FROM `$unique_id_me chats` WHERE `unique_id_fr`='$unique_id_fr'";
			mysqli_query($durbeen_chats, $SQL6);

			$SQL7 = "DELETE FROM `$unique_id_fr chats` WHERE `unique_id_fr`='$unique_id_me'";
			mysqli_query($durbeen_chats, $SQL7);

			$SQL6 = "DELETE FROM `$unique_id_me notify` WHERE `sender_id`='$unique_id_fr'";
			mysqli_query($con_notification, $SQL6);

			$SQL7 = "DELETE FROM `$unique_id_fr notify` WHERE `sender_id`='$unique_id_me'";
			mysqli_query($con_notification, $SQL7);







			echo "<script>window.location = 'homepage.php?type=no'</script>";
		}
	}
	
	
	
	
	
	
	

	
}







?>



<!-- message notification -->
<?php
$SQLnotify="SELECT * FROM `$unique_id_me notify` WHERE `seen`='0' AND `sender_id`!='$unique_id_fr'";
$runnotify=mysqli_query($con_notification,$SQLnotify);

$number = mysqli_num_rows($runnotify);

if ($number > 0){
    ?>
<a style="position: fixed;right:35%;top:26px;z-index:15" href="./all_msg.php?type=all_msg" class="btn btn-sm red">You
	Have
	<?php echo $number ?> New Messages From Others</a>

<?php } ?>









<!-- main page -->
<a target="_self" style="position: fixed;left:13%;top:142px;z-index:20;font-weight: 600;"
	href="message.php?type=no&unique_id_fr=<?php echo $unique_id_fr?>"
	class="btn btn-lg btn-success"><?php echo $friendName ?></a>
	

<form method="post" action="message.php?type=no&unique_id_fr=<?php echo $unique_id_fr?>" style="position: fixed;right:10%;top:142px;z-index:20;font-weight: 600;">

	<input onclick="return confirm('Do You Really Want to Delete Conversation?')" name="delete_con"class="btn btn-secondary" type="submit" value="Delete Conversation With <?php echo $friendName ?>">

	</form>





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

				$sql = "SELECT * FROM `$unique_id_me to $unique_id_fr`";

				$result = mysqli_query($connection_message, $sql);

				$total_posts = mysqli_num_rows($result);

				$total_pages = ceil($total_posts / $posts_per_page);


				if(isset($_GET['page'])){
						$current_page = $_GET['page'];
				}else{
						$current_page = 1;
				}

				$start_limit = ($current_page - 1) * $posts_per_page;

				$selectSQL = "SELECT * FROM `$unique_id_me to $unique_id_fr` ORDER BY `id` DESC LIMIT ".$start_limit.",".$posts_per_page;

				$runSelect = mysqli_query($connection_message, $selectSQL);



				while ($data3 = mysqli_fetch_assoc($runSelect)){ ?>
				<table class="table table-bordered mt-4">
					<tbody id="tbodyID">
						<tr>
							<?php if($data3['sender'] == 'fr'){ ?>

								<div class="float-start" style="width: 590px;border: none;">
									<img title="<?php echo $data3['time'] ?>" class="float-start" style="border-radius: 50%" width="40px" height="40px" src="./pro_pic/<?php echo $pro_pic_fr ?>" alt="">
									<img title="<?php echo $data3['time'] ?>" width="590px" src="./chat_image/<?php echo $data3['image'] ?>" alt="">
									
									<?php if($data3['message']!=""){ ?>
									<h5 title="<?php echo $data3['time'] ?>" style="border-radius: 35px;background-color: #265d94" class="response float-start py-2 px-3"><?php echo $data3['message'] ?></h5>
									<?php } ?>
									
									<button onclick="deleteMessage(<?php echo $data3['id']?>,<?php echo $unique_id_me ?>,<?php echo $unique_id_fr ?>, this)"
											class="btn btn-sm btn-primary float-end mb-2" title="Delete For Me"><i class="fas fa-trash-alt"></i></button>
								</div>

							<?php }else{ ?>
								
								<div class="float-end" style="width: 590px;border: none;">
									<img title="<?php echo $data3['time'] ?>" width="590px" src="./chat_image/<?php echo $data3['image'] ?>" alt="">
									
									<?php if($data3['message']!=""){ ?>
									<h5 title="<?php echo $data3['time'] ?>" style="border-radius: 35px" class="response float-end py-2 px-3 bg-success"><?php echo $data3['message'] ?></h5>
									<?php } ?>
									
									<button onclick="unsendMessage(<?php echo $data3['id']?>, <?php echo $unique_id_me ?>, <?php echo $unique_id_fr ?>, this)"
											class="btn btn-sm btn-primary float-end mb-2" title="Unsend"><i class="fas fa-undo-alt"></i></button>
									
									<button class="btn btn-sm <?php $data3['seen'] == 'Seen' ? printf("btn-success") : printf("btn-secondary") ?> float-end"><?php $data3['seen'] == 'Seen' ? printf("<i class='fas fa-eye'></i>") : printf("<i class='fas fa-eye-slash'></i>") ?></button>
								</div>

							<?php } ?>

						</tr>
					</tbody>
				</table>
			<?php } ?>
		</div>
	</div>


</div>



<!-- Message Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<button id="messageCloseBtn" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="" method="post" id="formID" enctype="multipart/form-data">

					<input type="hidden" name="unique_id_me" value="<?php echo $unique_id_me ?>">
					<input type="hidden" name="unique_id_fr" value="<?php echo $unique_id_fr ?>">
					<input type="hidden" name="my_name" id="my_name" value="<?php echo $dataMe['name'] ?>">
					
					<textarea style="background-color: #F3F3F3;color: #000" name="message" id="messageID" rows="5"
						class="form-control mb-2" type="text"></textarea>

					<input style="background-color: #F3F3F3;" name="image_khan_bahadur" class="form-control" id="imageID" type="file">

					<input name="send" id="buttonID" value="SEND" class="mt-2 float-end btn btn-sm btn-success" type="submit" aria-label="Close">
				</form>
			</div>
		</div>
	</div>
</div>





<script>
	let tbody = document.querySelector("#tbodyID");

	let form = document.querySelector("#formID");
	let image = document.querySelector("#imageID");
	let message = document.querySelector("#messageID");
	let button = document.querySelector("#buttonID");
	let messageCloseBtn = document.querySelector("#messageCloseBtn");



	form.addEventListener('submit', (e) => {
    e.preventDefault();


		var formdata = new FormData(form);

		$.ajax({
			url: "./api/messageAdd.php",
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
				let unique_id_fr = json.unique_id_fr;
				let newMessage = json.newMessage;

				// console.log(json);
				// console.log(unique_id_fr);
		
				tbody.innerHTML = makeTr(newMessage, unique_id_me, unique_id_fr) + tbody.innerHTML;

				messageCloseBtn.click();

				image.value = "";
				message.value = "";
			},
			error: function (err) {
				console.log(err);
			}
		});

	})




const makeTr = (message, unique_id_me, unique_id_fr) => {
	let tr = `<tr>
							<div class="float-end" style="width: 590px;border: none;">
								<img title="${message.time}" width="590px" src="./chat_image/${message.image}">
								
								<h5 title="${message.time}" style="border-radius: 35px" class="response float-end py-2 px-3 bg-success">${message.message}</h5>
								
								<button onclick="unsendMessage(${message.id}, ${unique_id_me}, ${unique_id_fr}, this)"
										class="btn btn-sm btn-primary float-end mb-2" title="Unsend"><i class="fas fa-undo-alt"></i></button>
								
								<button class="btn btn-sm btn-secondary float-end"><i class='fas fa-eye-slash'></i></button>
							</div>
						</tr>`
	return tr;
}



const unsendMessage = (id_lll, unique_id_me, unique_id_fr, elm_ppp) => {
	
	let message = {};

	message.id = id_lll;
	message.unique_id_me = unique_id_me;
	message.unique_id_fr = unique_id_fr;

	axios.post("./api/unsend.php",
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





const deleteMessage = (id_lll, unique_id_me, unique_id_fr, elm_ppp) => {

	let message = {};

	message.id = id_lll;
	message.unique_id_me = unique_id_me;
	message.unique_id_fr = unique_id_fr;

	axios.post("./api/deleteMsg.php",
		message,
		{
			headers: {
				"Content-Type": "application/json"
			}
		})
		.then( res => {
			// console.log(res.data);

			if(res.data == '1'){
				toastr.error('Message Deleted For Me')
			}
			// console.log(elm_ppp.parentElement);

			elm_ppp.parentElement.remove();
			
		})
		.catch( err => {
			console.log(err);
		})

}


</script>



<div style="height: 250px"></div>


<button style="position: fixed;right:10px;bottom: 10px" class="btn btn-success float-end mb-3" data-bs-toggle="modal" data-bs-target="#messageModal">
	<i class="fas fa-plus"></i>
</button>






<?php
include './footer.php'
?>