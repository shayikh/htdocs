<?php
include './header.php';


?>


<!-- main page -->


<div class="container" style="margin-top:180px">
    <table class="table table-bordered mt-4" style="margin-bottom: 150px;border-color: #5d5d5d">
        <tbody id="tbodyID">

        </tbody>
    </table>


</div>


<script>
    let tbody = document.querySelector("#tbodyID");
    let targetTr = null;


    var page_no = 1;
    var returned = 1;

    showdata();

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 5) {
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

        axios.post("../api/cov_pic/loadmoreCovPics.php",
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


    const deleteCovPic = (cov_pic_id, unique_id_me, elm) => {
        let confirm = window.confirm("Are You Sure?");

        if (confirm) {

            let delCovPic = {};

            delCovPic.cov_pic_id = cov_pic_id;
            delCovPic.unique_id_me = unique_id_me;

            axios.post("../api/cov_pic/deleteCovPic.php",
                    delCovPic, {
                        headers: {
                            "Content-Type": "application/json"
                        }
                    })
                .then(res => {
                    // console.log(res.data);

                    elm.parentElement.parentElement.remove();
                    toastr.error('Cover Photo Deleted');

                })
                .catch(err => {
                    console.log(err);
                })

        } else {
            return;
        }

    }


    const makeCovPic = (cov_pic_id, unique_id_me, elm) => {

        let delCovPic = {};

        delCovPic.cov_pic_id = cov_pic_id;
        delCovPic.unique_id_me = unique_id_me;

        axios.post("../api/cov_pic/makeCovPic.php",
                delCovPic, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {
                // console.log(res.data);

                elm.parentElement.previousElementSibling.firstElementChild.src = "../pro_pic/cov_pic/" + res.data.oldCovPic.cov_pic;

                toastr.success('Cover Photo Changed');

            })
            .catch(err => {
                console.log(err);
            })

    }

</script>


<?php
include './footer.php'
?>
