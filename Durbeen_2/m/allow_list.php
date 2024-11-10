<?php
include './header.php';

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

        axios.post("../api/facelist/loadmoreAllowList_m.php",
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
                    returned = 1;
                }
            })
            .catch(err => {
                console.log(err);
            })
    }


    const rejectfn = (unique_id_me, unique_id_fr, elm) => {
        let confirm = window.confirm("Do You Want to Reject him from Following You?");

        if (confirm) {

            let rejectVar = {};

            rejectVar.unique_id_me = unique_id_me;
            rejectVar.unique_id_fr = unique_id_fr;

            axios.post("../api/facelist/reject.php",
                    rejectVar, {
                        headers: {
                            "Content-Type": "application/json"
                        }
                    })
                .then(res => {
                    // console.log(res.data);

                    if (res.data == 0) {
                        elm.parentElement.parentElement.remove();
                    }


                })
                .catch(err => {
                    console.log(err);
                })

        } else {
            return;
        }


    }

</script>


<?php
include './footer.php'
?>
