<?php
include './header.php';


$SQL1 = "SELECT * FROM `admin` WHERE `unique_id`='$unique_id_me'";
$run1 = mysqli_query($connection, $SQL1);
$count1 = mysqli_num_rows($run1);

if ($count1 == 0) {
    echo "<script>window.location = 'homepage.php?type'</script>";
}


?>


<div class="container" style="margin-top: 150px">
    <h4 class="text-center">Add Or Remove Members & Admins</h4>
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

        axios.post("../api/admin/loadmoreAdmin.php",
                postData, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {
                if (res.data == 0) {
                    toastr.error('You Are at The End');
                } else {
                    tbody.innerHTML = tbody.innerHTML + res.data;
                    page_no++;
                }
            })
            .catch(err => {
                console.log(err);
            })
    }


    const addAdminfn = (unique_id_fr, elm) => {

        let addVar = {};
        addVar.unique_id_fr = unique_id_fr;

        axios.post("../api/admin/make_durbeen_admin.php",
                addVar, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {
                // console.log(res.data);

                if (res.data == 0) {
                    toastr.error('Removed from Admin');
                    elm.innerHTML = '<i class="fas fa-user-cog"></i>';
                    elm.classList.add('btn-success');
                    elm.classList.remove('btn-danger');
                } else {
                    toastr.success('Made Admin');
                    elm.innerHTML = '<i class="fas fa-users"></i>';
                    elm.classList.add('btn-danger');
                    elm.classList.remove('btn-success');
                }


            })
            .catch(err => {
                console.log(err);
            })
    }


</script>


</div>


<?php
include './footer.php'
?>
