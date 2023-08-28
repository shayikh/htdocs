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
            <img title="Cover Photo Size 1280px * 574px" width="1280px" height="574px" src="./pro_pic/cov_pic/<?php echo $dataAbout['cov_pic']?>">
        </div>

        <div class="col-md-12 mt-4">
            <a class="text-decoration-none" href="./pro_pic.php?type=no&unique_id_fr=<?php echo $data1['unique_id']?>">
                <img style="border-radius: 50%;border: 3px solid #fff" width="220px" height="220px" src="./pro_pic/<?php echo $data1['pro_pic'] ?>">
            </a>
        </div>

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

    <?php } ?>











	<div class="row mb-5">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="row justify-content-center" id="tbodyID">
						

			</div>
		</div>
		<div class="col-md-2"></div>
	</div>




</div>

<style>
    a {
        text-decoration: none;
    }
</style>

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
        postData.unique_id_fr = <?php echo $unique_id_fr ?>;

        axios.post("./api/post/loadmorePeopleTimeline.php",
        postData,
            {
                headers: {
                    "Content-Type": "application/json"
                }
            })
            .then( res => {
                // console.log(res.data);
                if(res.data == 0){
                    toastr.error('You are at the End');
                }else{
                    tbody.innerHTML = tbody.innerHTML + res.data;
                    page_no++;
                }
                
                
            })
            .catch( err => {
                console.log(err);
            })
    }
        
    const followfn = (unique_id_me, unique_id_fr, elm) => {

        let followVar = {};

        followVar.unique_id_me = unique_id_me;
        followVar.unique_id_fr = unique_id_fr;

        axios.post("./api/facelist/follow.php",
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



    
	const deleteComment = (comment_id, unique_id_me, elm) => {

    let delComment = {};

    delComment.comment_id = comment_id;
    delComment.unique_id_me = unique_id_me;

    axios.post("./api/comment/deleteComment.php",
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
            }else{
                toastr.warning('This is not Your Comment');
            }
            
        })
        .catch( err => {
            console.log(err);
        })

    }



    const clearModal = () => {
        commentTboody.innerHTML = "";
    }


    const showCommentfn = (post_id) => {

        let showComment = {};

        showComment.post_id = post_id;

        axios.post("./api/comment/showComments.php",
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
							<a href="./people_timeline.php?type=no&unique_id_fr=${comment.comn_giver_id}" target="_blank">
								<img class="text-center rounded-circle" width="70px" src="./pro_pic/${comment.pro_pic}">
							</a>
						</td>

						<td class="text-center text-dark">
							<a style="color: blue" href="./people_timeline.php?type=no&unique_id_fr=${comment.comn_giver_id}" target="_blank">${comment.name}</a>
						</td>

						<td class="text-center text-dark">${comment.time}</td>
						<td class="text-center text-dark">${comment.comment}</td>
						<td class="text-center text-dark">
							<i class="fas fa-trash me-4" onclick="deleteComment(${comment.id}, <?php echo $unique_id_me ?>, this)"></i>
						</td>
				</tr>`
        return tr;
    }








    const commentfn = (elm, post_id, post_giver_id, comn_giver_id) => {

        let comment = elm.nextElementSibling.value;

        if(comment == ""){
            toastr.error("Comment is Empty");
        }else{


            let commentp = {};

            commentp.comment = comment;
            commentp.post_id = post_id;
            commentp.post_giver_id = post_giver_id;
            commentp.comn_giver_id = comn_giver_id;


            axios.post("./api/comment/comment.php",
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











    const likefn = (post_id, unique_id_me, elm) => {
		let likep = {};

		likep.post_id = post_id;
		likep.unique_id_me = unique_id_me;

		axios.post("./api/post/like_post.php",
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

		axios.post("./api/post/dislike_post.php",
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
		let sharep = {};

        sharep.post_id = post_id;
        sharep.unique_id_me = unique_id_me;

		axios.post("./api/post/share.php",
            sharep,
			{
				headers: {
					"Content-Type": "application/json"
				}
			})
			.then( res => {

				toastr.success('Post Shared to Your Timeline');

			})
			.catch( err => {
				console.log(err);
			})
	}
</script>






<?php
include './footer.php'
?>