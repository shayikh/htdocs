<?php
include './header.php';


?>


<!-- main page -->


<div class="container" style="margin-top: 120px">
    <table class="table table-bordered mt-4" style="margin-bottom: 150px;border-color: #5d5d5d">
        <tbody id="tbodyID">

        </tbody>
    </table>
</div>


<script>
    let tbody = document.querySelector("#tbodyID");
    let timeline_pro_pic = document.querySelector("#timeline_pro_pic");
    let targetTr = null;


    var page_no = 1;
    var returned = 1;

    showdata();

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 60) {
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

        axios.post("../api/pro_pic/loadmoreProPics_m.php",
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
