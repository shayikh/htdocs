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
		<tbody id="tbodyID">

		</tbody>
	</table>




	<script>


        let tbody = document.querySelector("#tbodyID");




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

            axios.post("./api/loadmoreFollowList.php",
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


		const unfollowfn = (unique_id_me, unique_id_fr, elm) => {

			let unfollowVar = {};

			unfollowVar.unique_id_me = unique_id_me;
			unfollowVar.unique_id_fr = unique_id_fr;

			axios.post("./api/unfollow.php",
				unfollowVar,
				{
					headers: {
						"Content-Type": "application/json"
					}
				})
				.then( res => {
					// console.log(res.data);

					if(res.data == 0){
						elm.parentElement.parentElement.remove();
					}

					

					
					
				})
				.catch( err => {
					console.log(err);
				})
		}
	</script>





</div>


<style>
a{
	text-decoration: none;
}
</style>



<?php
include './footer.php'
?>