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

        axios.post("../api/cov_pic/loadmoreCovPics.php",
                postData, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {
                if (res.data == 1) {
                    toastr.info('You Are at The End');
                } else {
                    tbody.innerHTML = tbody.innerHTML + res.data;
                    page_no++;
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

                elm.parentElement.parentElement.remove();

                tbody.innerHTML = makeCovPicTr(res.data.newCovPic) + tbody.innerHTML;

                toastr.success('Cover Photo Changed');

            })
            .catch(err => {
                console.log(err);
            })

    }


    const makeCovPicTr = (newCovPic) => {
        let tr = `<tr>
                    <td class="text-center">
                        <img height="500px" style="max-width: 1000px;" src="../pro_pic/cov_pic/${newCovPic.cov_pic}">
                    </td>
                    <td class="text-center">
                        <button onclick="makeCovPic(${newCovPic.id}, <?php echo $unique_id_me ?>, this)" class="btn btn-success" style="margin-top: 50px">Make Cover Photo</button>
                    </td>
                    <td class="text-center">
                        <button onclick="deleteCovPic(${newCovPic.id}, <?php echo $unique_id_me ?>, this)" class="btn btn-primary" style="margin-top: 50px"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>`
        return tr;
    }

</script>


<?php
include './footer.php'
?>
