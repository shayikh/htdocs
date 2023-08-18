<?php
include './header.php';

if (isset($_POST['saveBtn'])){
	date_default_timezone_set("Asia/Dhaka");
	$time = "The time in " . date_default_timezone_get() . " is " . date("d-M-Y-D-H:i:s");
	
	$post = $_POST['post'];


	if($_FILES['image_khan_bahadur']['name']){
		$imageOldName = $_FILES['image_khan_bahadur']['name'];
		$imageNewName = uniqid().'_'.date("Y-M-H-i-s").'_'.$imageOldName;
		$image_tmp = $_FILES['image_khan_bahadur']['tmp_name'];
		move_uploaded_file($image_tmp,'./post_image/'.$imageNewName);
	}else{
		$imageNewName = '';
	}

	


	$SQL4 = "INSERT INTO `post`(`unique_id`, `image`, `time`, `post`) VALUES ('$unique_id_me','$imageNewName','$time','$post')";
	mysqli_query($connection,$SQL4);

	$_SESSION['alert']='post';

  // echo "<script>window.location = 'homepage.php?type=homepage'</script>";


}



//alert
if ($_SESSION['alert']=='login'){
	echo "<script>toastr.success('You Are Logged In')</script>";
	$_SESSION['alert']="nothing";
}
if ($_SESSION['alert']=='post'){
	echo "<script>toastr.success('Post Successfullly Uploaded')</script>";
	$_SESSION['alert']="nothing";
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



<!-- NEWS FEED -->

<div class="container" style="margin-top:130px">

	<div class="row mb-5">
		<div class="col-md-2"></div>
		
		<div class="col-md-8">
			<div class="row justify-content-center" id="tbodyID">


			</div>
		</div>
		<div class="col-md-2"></div>
	</div>







		<!-- Post Modal -->
		<div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="text-dark" class="modal-title" id="postModalLabel">Make Post</h5>
						<button id="postCloseBtn" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form action="" method="post" id="formID" enctype="multipart/form-data">
							<input type="hidden" name="unique_id_me" value="<?php echo $unique_id_me ?>">
							
							<textarea style="background-color: #F3F3F3;color: #000" name="post" id="postID" rows="5"
								class="form-control mb-2" type="text"></textarea>

							<input style="background-color: #F3F3F3;" name="image_khan_bahadur" class="form-control" id="imageID" type="file">

							<p style="font-size: 14px" class="float-start mt-3">Youtube Video Embed Code (width="825" height="470")</p>
							<input name="saveBtn" id="buttonID" value="POST" class="mt-2 float-end btn btn-sm red" type="submit" aria-label="Close">
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- Comment Modal -->
		<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" modal-dialog modal-dialog-scrollable>
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel">Comments</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="clearModal()"></button>
					</div>
					<div class="modal-body">
						<table class="table table-striped table-hover table-bordered">
							<thead>
								<tr>
									<th class="text-center text-dark" scope="col">Picture</th>
									<th class="text-center text-dark" scope="col">Name</th>
									<th class="text-center text-dark" scope="col">Time</th>
									<th class="text-center text-dark" scope="col">Comment</th>
									<th class="text-center text-dark" scope="col">Action</th>
								</tr>
							</thead>
							<tbody id="commentTboody">

							</tbody>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearModal()">Close</button>
					</div>
				</div>
			</div>
		</div>








	<script>

	let tbody = document.querySelector("#tbodyID");

	let form = document.querySelector("#formID");
	let image = document.querySelector("#imageID");
	let post = document.querySelector("#postID");
	let button = document.querySelector("#buttonID");
	let postCloseBtn = document.querySelector("#postCloseBtn");

	let commentTboody = document.querySelector("#commentTboody");




	var page_no = 1;
        
	showdata();
	
	$(window).scroll(function() {
		if ($(window).scrollTop() + $(window).height() > $(document).height() - 5) {
			showdata();
		}
	})


	function showdata() {

		let postData = {};

		postData.page_no = page_no;
		postData.unique_id_me = <?php echo $unique_id_me ?>;

		axios.post("./api/loadmoreAllPOst.php",
		postData,
			{
				headers: {
					"Content-Type": "application/json"
				}
			})
			.then( res => {
				// console.log(res.data);
				tbody.innerHTML = tbody.innerHTML + res.data;
				
				page_no++;
				
				
				
			})
			.catch( err => {
				console.log(err);
			})
	}





	const deleteComment = (comment_id, elm) => {

		let delComment = {};

		delComment.comment_id = comment_id;

		axios.post("./api/deleteComment.php",
		delComment,
			{
				headers: {
					"Content-Type": "application/json"
				}
			})
			.then( res => {
				// console.log(res.data);

				if(res.data == 1){
					elm.parentElement.parentElement.remove();
					toastr.info('Comment Deleted');
				}
				
			})
			.catch( err => {
				console.log(err);
			})

	}



	const clearModal = () => {
		commentTboody.innerHTML = "";
	}


	const showCommentfn = (postid) => {

		let showComment = {};

		showComment.postid = postid;

		axios.post("./api/showComments.php",
			showComment,
			{
				headers: {
					"Content-Type": "application/json"
				}
			})
			.then( res => {

				// console.log(res.data);

				let all = res.data;

				all.forEach(comment => {
					commentTboody.innerHTML = commentTboody.innerHTML + makeCommentTr(comment);
				})

				
			})
			.catch( err => {
				console.log(err);
			})

	}


	const makeCommentTr = (comment) => {
		let tr = `<tr>
						<td>
							<img class="text-center rounded-circle" width="70px" src="./pro_pic/${comment.pro_pic_comn}">
						</td>
						<td class="text-center text-dark">${comment.name_comn}</td>
						<td class="text-center text-dark">${comment.time}</td>
						<td class="text-center text-dark">${comment.comment}</td>
						<td class="text-center text-dark">
								<i class="fas fa-trash me-4" onclick="deleteComment(${comment.id}, this)"></i>
						</td>
				</tr>`
		return tr;
	}














	const commentfn = (elm, unique_id_me, postid, post_user_id) => {

		let comment = elm.nextElementSibling.value;

		if(comment == ""){
			toastr.error("Comment is Empty");
		}else{


			let commentp = {};

			commentp.comment = comment;
			commentp.unique_id_me = unique_id_me;
			commentp.postid = postid;
			commentp.post_user_id = post_user_id;

			axios.post("./api/comment.php",
				commentp,
				{
					headers: {
						"Content-Type": "application/json"
					}
				})
				.then( res => {
					// console.log(elm);

					if(res.data == 1){
						elm.nextElementSibling.value = '';
						toastr.success("Comment Done");
					}

					

					
					
				})
				.catch( err => {
					console.log(err);
				})

		}


	}





	form.addEventListener('submit', (e) => {
    e.preventDefault();


		var formdata = new FormData(form);

		$.ajax({
			url: "./api/postAdd.php",
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

				// console.log(json);


				
				let unique_id_me = json.unique_id_me;
				let newPost = json.newPost;
		
				tbody.innerHTML = makeTr(newPost, unique_id_me) + tbody.innerHTML;

				postCloseBtn.click();

				image.value = "";
				post.value = "";

				toastr.success('Post Uploaded');
			},
			error: function (err) {
				console.log(err);
			}
		});

	})






	const makeTr = (post, unique_id_me) => {
		let tr = `<div class="statusp">
								<div class="col-md-12 mt-2 mb-2">
									<div class="card" style="width: 100%;border: none">

										<p class="text-white p-2" style="background-color: #18191A;border-radius: 3px 3px 0 0; ">
											<a href="people_timeline.php?type=no&amp;unique_id_fr=1">
												<img style="border-radius: 50%" width="70px" height="70px" src="./pro_pic/<?php echo $dataMe['pro_pic'] ?>" alt="">
												<b><?php echo $dataMe['name'] ?></b>
											</a>
										</p>
										<img width="100%" src="./post_image/${post.image}" alt="">
										<div class="card-body" style="background-color: #2C2C2C;border-radius: 0 0 3px 3px">
											<h6 class="card-title text-white">${post.time}</h6>
											<p class="card-text text-white">${post.post}</p>
										</div>
										
									</div>

									<p class="float-start mt-2 me-3" style="color: ; font-size: 18px; cursor: pointer" onclick="likefn(${post.id}, ${unique_id_me}, this)">Like</p>
									<p class="float-start mt-2 me-5" style="color: ; font-size: 18px; cursor: pointer" onclick="dislikefn(${post.id}, ${unique_id_me}, this)">Dislike</p>
									<p class="float-start mt-2 me-3" style="font-size: 18px"><i class="fas fa-thumbs-up me-1"></i>0</p>
									<p class="float-start mt-2 me-5" style="font-size: 18px"><i class="fas fa-thumbs-down me-1"></i>0</p>
									<p class="float-start mt-2" style="font-size: 18px">0 Comments</p>
									
									<a class="btn btn-sm btn-light text-secondary float-end mb-3" onclick="sharefn(${post.id}, ${unique_id_me})">
									<i class="fas fa-share"></i>
									</a>
									<button onclick="showCommentfn(${post.id})" class="btn btn-sm btn-success float-end mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fas fa-comments"></i></button>
									<button onclick="commentfn(this, ${unique_id_me}, ${post.id}, ${post.unique_id})" class="btn btn-sm btn-info text-white float-end mb-3"><i class="fas fa-comment"></i></button>
									<input type="text" class="ms-5 mt-2">
								</div>
							</div>`
		return tr;
	}









	const likefn = (post_id, unique_id_me, elm) => {
		let likep = {};

		likep.post_id = post_id;
		likep.unique_id_me = unique_id_me;

		axios.post("./api/like_post.php",
			likep,
			{
				headers: {
					"Content-Type": "application/json"
				}
			})
			.then( res => {
				// console.log(elm);

				if(res.data == 1){
					elm.style.color = '#0D6EFD';
					elm.nextElementSibling.style.color = '#fff';
				}else{
					elm.style.color = '#fff';
				}

				

				
				
			})
			.catch( err => {
				console.log(err);
			})
	}




	const dislikefn = (post_id, unique_id_me, elm) => {
		let dislikep = {};

		dislikep.post_id = post_id;
		dislikep.unique_id_me = unique_id_me;

		axios.post("./api/dislike_post.php",
		dislikep,
			{
				headers: {
					"Content-Type": "application/json"
				}
			})
			.then( res => {
				// console.log(elm);

				if(res.data == 1){
					elm.style.color = '#0D6EFD';
					elm.previousElementSibling.style.color = '#fff';
				}else{
					elm.style.color = '#fff';
				}

				

				
				
			})
			.catch( err => {
				console.log(err);
			})
	}


	const sharefn = (post_id, unique_id_me) => {
		let dislikep = {};

		dislikep.post_id = post_id;
		dislikep.unique_id_me = unique_id_me;

		axios.post("./api/share.php",
		dislikep,
			{
				headers: {
					"Content-Type": "application/json"
				}
			})
			.then( res => {
        
				let json = res.data;
				
				let unique_id_me = json.unique_id_me;
				let newPost = json.newPost;
		
				tbody.innerHTML = makeTr(newPost, unique_id_me) + tbody.innerHTML;

				toastr.success('Post Shared');

				
			})
			.catch( err => {
				console.log(err);
			})
	}
</script>

<button style="position: fixed;right:10px;bottom: 10px" class="btn btn-success float-end mb-3" data-bs-toggle="modal" data-bs-target="#postModal">
	<i class="fas fa-plus"></i>
</button>




</div>



<?php
include './footer.php'
?>