<?php
include './header.php';

?>


<!-- main page -->


<div class="container" style="margin-top: 120px">
    <table class="table table-bordered mt-4" style="margin-bottom: 150px;border-color: #5d5d5d">
        <tbody id="tbodyID">

        </tbody>
    </table>


    <script>
        let tbody = document.querySelector("#tbodyID");


        var page_no = 1;

        showdata();

        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() > $(document).height() - 60) {
                showdata();
            }
        })


        function showdata() {

            let postData = {};

            postData.page_no = page_no;
            postData.unique_id_me = <?php echo $unique_id_me ?>;

            axios.post("../api/mobile/loadmoreFacelist.php",
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

        const followfn = (unique_id_me, unique_id_fr, elm) => {

            let followVar = {};

            followVar.unique_id_me = unique_id_me;
            followVar.unique_id_fr = unique_id_fr;

            axios.post("../api/facelist/follow.php",
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

    </script>


</div>


<?php
include './footer.php'
?>
