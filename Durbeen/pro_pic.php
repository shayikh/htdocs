<?php
include './header.php';

//$SQL1 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_me'";
//$run1 = mysqli_query($connection,$SQL1);
//$data1 = mysqli_fetch_assoc($run1);
//
//$SQLabout = "SELECT * FROM `about` WHERE `unique_id`='$unique_id_me'";
//$runAbout = mysqli_query($connection,$SQLabout);
//$dataAbout = mysqli_fetch_assoc($runAbout);







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


</div>


<script>

    let tbody = document.querySelector("#tbodyID");
    let timeline_pro_pic = document.querySelector("#timeline_pro_pic");




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

        axios.post("./api/loadmoreProPics.php",
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


    const deleteProPic = (pro_pic_id, unique_id_me, elm) => {
        let confirm = window.confirm("Are You Sure?");

        if (confirm) {

            let delProPic = {};

            delProPic.pro_pic_id = pro_pic_id;
            delProPic.unique_id_me = unique_id_me;

            axios.post("./api/deleteProPic.php",
                delProPic,
                {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
                .then( res => {
                    // console.log(res.data);

                    elm.parentElement.parentElement.remove();
                    toastr.error('Profile Picture Deleted');

                })
                .catch( err => {
                    console.log(err);
                })

        } else {
            return;
        }

    }


    const makeProPic = (pro_pic_id, unique_id_me, elm) => {

        let delProPic = {};

        delProPic.pro_pic_id = pro_pic_id;
        delProPic.unique_id_me = unique_id_me;

        axios.post("./api/makeProPic.php",
            delProPic,
            {
                headers: {
                    "Content-Type": "application/json"
                }
            })
            .then( res => {
                // console.log(res.data);

                timeline_pro_pic.src = "./pro_pic/"+ res.data.new_pro_pic;

                elm.parentElement.parentElement.remove();

                tbody.innerHTML = makeProPicTr(res.data.newProPic) + tbody.innerHTML;

                toastr.success('Profile Picture Changed');

            })
            .catch( err => {
                console.log(err);
            })

    }


    const makeProPicTr = (newProPic) => {
        let tr = `<tr>
                    <td class="text-center">
                        <img height="500px" src="./pro_pic/${newProPic.pro_pic}" alt="" id="pro_pic_${newProPic.id}">
                    </td>
                    <td class="text-center">
                        <button onclick="makeProPic(${newProPic.id}, <?php echo $unique_id_me ?>, this)" class="btn btn-success" style="margin-top: 50px">Make Profile Picture</button>
                    </td>
                    <td class="text-center">
                        <button onclick="deleteProPic(${newProPic.id}, <?php echo $unique_id_me ?>, this)" class="btn btn-danger" style="margin-top: 50px">Delete</button>
                    </td>
                </tr>`
        return tr;
    }

</script>








<style>
    a{
        text-decoration: none;
    }
</style>



<?php
include './footer.php'
?>