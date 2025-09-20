<?php
include './header.php';


$SQL1 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_me'";
$run1 = mysqli_query($connection,$SQL1);
$data1 = mysqli_fetch_assoc($run1);
$locking = $data1['locking'];

if ($locking == 0) {
    echo "<script>alert('You Can See Your Allow List When You Profile is Locked')</script>";
    echo "<script>window.location = 'about_me.php?type=about_me'</script>";
}

?>


<!-- main page -->
<div class="container" style="margin-top: 112px">

    <h6 class="text-center">Allow List</h6>
    <table class="table table-bordered mt-3" style="margin-bottom: 210px;border-color: #5d5d5d">
        <tbody id="tbodyID">

        </tbody>
    </table>

</div>


<script>
    let tbody = document.querySelector("#tbodyID");


    var page_no = 1;
    var returned = 1;

    showdata();

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
            if(returned == 1){
                returned = 0;
                showdata();
            }
        }
    })


    function showdata() {

        let postData = {};

        postData.page_no = page_no;
        postData.unique_id_me = <?php echo $unique_id_me ?>;

        axios.post("../api/facelist/loadmoreAllowList_m.php",
        postData, {
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(res => {
            if (res.data == 0) {
                toastr.info('You Are at The End');
            } else {
                tbody.innerHTML = tbody.innerHTML + res.data;
                page_no++;
                returned = 1;
            }
        })
        .catch(err => {
            console.log(err);
        })
    }

</script>


<?php
include './footer.php'
?>
