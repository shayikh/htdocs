<?php
include './header.php';

$SQLabout = "SELECT * FROM `about` WHERE `unique_id`='$unique_id_me'";
$runAbout = mysqli_query($connection,$SQLabout);
$dataAbout = mysqli_fetch_assoc($runAbout);

if (isset($_POST['updateBtn'])){
	if($_FILES['image_khan_bahadur']['name']){
		if ($dataMe['pro_pic'] != "red_comet.png"){
			unlink('./pro_pic/'.$dataMe['pro_pic']);
		}

		$imageOldName = $_FILES['image_khan_bahadur']['name'];
		$imageNewName = uniqid().'_'.date("Y-M-H-i-s").'_'.$imageOldName;
		$image_tmp = $_FILES['image_khan_bahadur']['tmp_name'];
		move_uploaded_file($image_tmp,'./pro_pic/'.$imageNewName);

	}else{
		$imageNewName = $dataMe['pro_pic'];
	}



	if($_FILES['image_khan_cover']['name']){
		if ($dataAbout['cov_pic'] != "cov_pic.jpg"){
			unlink('./pro_pic/cov_pic/'.$dataAbout['cov_pic']);
		}

		$imageOldName = $_FILES['image_khan_cover']['name'];
		$imageNewName_cov = uniqid().'_'.date("Y-M-H-i-s").'_'.$imageOldName;
		$image_tmp = $_FILES['image_khan_cover']['tmp_name'];
		move_uploaded_file($image_tmp,'./pro_pic/cov_pic/'.$imageNewName_cov);

	}else{
		$imageNewName_cov = $dataAbout['cov_pic'];
	}


	$name = trim($_POST['name']);
	$name = mysqli_real_escape_string($connection, $name);
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	$date_birth = $_POST['date_birth'];

	$SQL2 = "UPDATE `registration` SET `name`='$name',`email`='$email',`password`='$password',`date_birth`='$date_birth',`pro_pic`='$imageNewName' WHERE `unique_id`='$unique_id_me'";
	mysqli_query($connection,$SQL2);


	$bio = trim($_POST['bio']);
	$bio = mysqli_real_escape_string($connection, $bio);

	$phone_no = trim($_POST['phone_no']);
	$phone_no = mysqli_real_escape_string($connection, $phone_no);

	$religion = trim($_POST['religion']);
	$religion = mysqli_real_escape_string($connection, $religion);

	$country = trim($_POST['country']);
	$country = mysqli_real_escape_string($connection, $country);

	$city = trim($_POST['city']);
	$city = mysqli_real_escape_string($connection, $city);



	$question_one = trim($_POST['question_one']);
	$question_one = mysqli_real_escape_string($connection, $question_one);

	$answer_one = trim($_POST['answer_one']);
	$answer_one = mysqli_real_escape_string($connection, $answer_one);

	$question_two = trim($_POST['question_two']);
	$question_two = mysqli_real_escape_string($connection, $question_two);

	$answer_two = trim($_POST['answer_two']);
	$answer_two = mysqli_real_escape_string($connection, $answer_two);

	$question_three = trim($_POST['question_three']);
	$question_three = mysqli_real_escape_string($connection, $question_three);

	$answer_three = trim($_POST['answer_three']);
	$answer_three = mysqli_real_escape_string($connection, $answer_three);



	$SQL3 = "UPDATE `about` SET `bio`='$bio',`cov_pic`='$imageNewName_cov',`phone_no`='$phone_no',`religion`='$religion',`country`='$country',`city`='$city',`question_one`='$question_one',`answer_one`='$answer_one',`question_two`='$question_two',`answer_two`='$answer_two',`question_three`='$question_three',`answer_three`='$answer_three' WHERE `unique_id`='$unique_id_me'";
	mysqli_query($connection,$SQL3);

	

	echo "<script>window.location = 'about_me.php?type=about_me'</script>";
}




if (isset($_POST['blackTheme'])){
	$SQL4 = "UPDATE `registration` SET `bgcolor`='#18191A' WHERE `unique_id`='$unique_id_me'";
	mysqli_query($connection,$SQL4);
}

?>




<!-- message notification -->
<?php
$SQLnotify = "SELECT * FROM `$unique_id_me notify` WHERE `seen`='0'";
$runnotify = mysqli_query($con_notification,$SQLnotify);

$number = mysqli_num_rows($runnotify);

if ($number > 0){
    ?>
<a style="position: fixed;right:35%;top:26px;z-index:15" href="./all_msg.php?type=all_msg" class="btn btn-sm red">You
	Have
	<?php echo $number ?> New Messages</a>

<?php } ?>

<!-- main page -->




<div class="container" style="margin-top: 168px">
	<form action="" method="post" enctype="multipart/form-data" style="margin-bottom: 200px">
		<div class="row">
			<div class="col-md-2">
				<h3 class="d-inline">Edit Profile</h3>
			</div>
			<div class="col-md-4">
				<div class="form-group text-center">
					<img width="100%" src="./pro_pic/<?php echo $dataMe['pro_pic']?>" alt="">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group text-center">
					<img width="100%" src="./pro_pic/cov_pic/<?php echo $dataAbout['cov_pic'] ?>" alt="">
				</div>
			</div>
			<div class="col-md-12 mt-5 pt-5">
				<div class="form-group">
					<input name="updateBtn" value="UPDATE" class="btn btn-success float-end" type="submit">
				</div>
			</div>
			
			

			<div class="col-md-4">
				<div class="form-group">
					<label class="mt-4">Full Name</label>
					<input name="name" value="<?php echo $dataMe['name']?>" class="form-control" type="text">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="mt-4">Profile Picture( a<span style='font-size:13px;'>&#10006;</span>a size )</label>
					<input style="background-color: #808080;color: #fff" name="image_khan_bahadur" class="form-control" type="file">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="mt-4">Cover Photo( 1280px <span style='font-size:13px;'>&#10006;</span> 574px )</label>
					<input style="background-color: #808080;color: #fff" name="image_khan_cover" class="form-control" type="file">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="mt-2">Email</label>
					<input style="background-color: #808080;color: #fff" name="email" oninput="uniqueEmail()" id="email" value="<?php echo $dataMe['email']?>" class="form-control" type="email">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group pwdbody">
					<label class="mt-2">Password</label>
					<input name="password" value="<?php echo $dataMe['password']?>" class="pwd form-control" type="password" style="background-color: #808080;color: #fff">
					<i onclick="showPwd()" id="" class="icon far fa-eye"></i>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="mt-2">Religion</label>
					<input name="religion" value="<?php echo $dataAbout['religion']?>" class="form-control" type="text">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="mt-2">Country</label>
					<input name="country" value="<?php echo $dataAbout['country']?>" class="form-control" type="text">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="mt-2">City</label>
					<input name="city" value="<?php echo $dataAbout['city']?>" class="form-control" type="text">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="mt-2">Date of Birth</label>
					<input style="background-color: #808080;color: #fff" name="date_birth" value="<?php echo $dataMe['date_birth']?>" class="form-control" type="date">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="mt-2">Phone No</label>
					<input name="phone_no" value="<?php echo $dataAbout['phone_no']?>" class="form-control" type="text">
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label class="mt-2">Bio</label><br>
					<textarea style="background-color: #808080;color: #fff" name="bio" rows="7" class="form-control"><?php echo $dataAbout['bio']?></textarea>
				</div>
			</div>


			<div class="col-md-12">
				<div class="form-group">
					<label class="mt-2">Question One</label><br>
					<input name="question_one" class="form-control" type="text" value="<?php echo $dataAbout['question_one']?>">
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label class="mt-2">Answer One</label><br>
					<input name="answer_one" class="form-control" type="text" value="<?php echo $dataAbout['answer_one']?>">
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label class="mt-2">Question Two</label><br>
					<input name="question_two" class="form-control" type="text" value="<?php echo $dataAbout['question_two']?>">
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label class="mt-2">Answer Two</label><br>
					<input name="answer_two" class="form-control" type="text" value="<?php echo $dataAbout['answer_two']?>">
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label class="mt-2">Question Three</label><br>
					<input name="question_three" class="form-control" type="text" value="<?php echo $dataAbout['question_three']?>">
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label class="mt-2">Answer Three</label><br>
					<input name="answer_three" class="form-control" type="text" value="<?php echo $dataAbout['answer_three']?>">
				</div>
			</div>





			<div class="col-md-12">
				<div class="form-group mt-2">
					<input name="updateBtn" value="UPDATE" class="btn btn-success float-end" type="submit">
				</div>
			</div>



		</div>
	</form>


</div>



<input type="hidden" id="unique_id_me" value="<?php echo $unique_id_me ?>">


<script>
	let email = document.querySelector('#email');
	let unique_id_me = document.querySelector('#unique_id_me');


	function uniqueEmail(){
		
		let product = {};

    product.email = email.value;
    product.unique_id_me = unique_id_me.value;

		axios.post("./api/unique_email.php",
			product,
			{
				headers: {
					"Content-Type": "application/json"
				}
			})
			.then( res => {
				console.log(res.data);
				if(res.data == "0"){
					toastr.error("This email is used by others. You can not use this email");
					alert("This email is used by others. You can not use this email");
				}
			})
			.catch( err => {
				console.log(err);
			})



	}
</script>







<style>
	.pwdbody {
		position: relative;
	}

	.icon {
		position: absolute;
		top: 45px;
		right: 30px;
	}
	input[type=text]{
    background-color: #808080;
		color: #fff;
	}
</style>

<?php
include './footer.php';
?>