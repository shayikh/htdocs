<?php
include './header.php';

?>


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

            $(window).scroll(function () {
                if ($(window).scrollTop() + $(window).height() > $(document).height() - 5) {
                    showdata();
                }
            })


            function showdata() {

                let postData = {};

                postData.page_no = page_no;
                postData.unique_id_me = <?php echo $unique_id_me ?>;

                axios.post("./api/facelist/loadmoreMyComments.php",
                    postData,
                    {
                        headers: {
                            "Content-Type": "application/json"
                        }
                    })
                    .then(res => {
                        // console.log(res.data);
                        if (res.data == 0) {
                            toastr.error('You are at the End');
                        } else {
                            let all = res.data;

                            all.forEach(comment => {
                                tbody.innerHTML = tbody.innerHTML + makeCommentTr(comment);
                            })
                            page_no++;
                        }


                    })
                    .catch(err => {
                        console.log(err);
                    })
            }



            const makeCommentTr = (comment) => {
                let tr = `<tr>
                            <td class="text-center bg-secondary" style="min-width: 150px">${comment.time}</td>
                            <td class="text-center bg-success">${comment.comment}</td>
                            <td class="text-center" style="min-width: 150px">
                                <a href="./singlePost.php?type&amp;post_id=${comment.post_id}" class="btn btn-success" target="_blank">Show Post</a>
                            </td>
                            <td class="text-center">
                                <i class="fas fa-trash ms-4 mt-3 me-4" style="cursor: pointer" onclick="deleteComment(${comment.id}, <?php echo $unique_id_me ?>, this)"></i>
                            </td>
                        </tr>`
                return tr;
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
                    .then(res => {
                        // console.log(res.data);

                        if (res.data == 1) {
                            elm.parentElement.parentElement.remove();
                            toastr.info('Comment Deleted');
                        } else {
                            toastr.warning('This is not Your Comment');
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