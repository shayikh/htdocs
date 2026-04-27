
<script>

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        

        if (image.value == "" && post.value == "") {
            toastr.error('Post and Image Both Fields are Empty');
        } else {
            var formdata = new FormData(form);

            $.ajax({
                url: "../api/post/postAdd.php",
                type: "POST",
                data: formdata,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    button.classList.add("d-none");
                },
                success: function(data) {

                    let json = JSON.parse(data);

                    // console.log(json);


                    let unique_id_me = json.unique_id_me;
                    let newPost = json.newPost;

                    tbody.innerHTML = makeTr(newPost, unique_id_me) + tbody.innerHTML;
                    button.classList.remove("d-none");

                    image.value = "";
                    post.value = "";

                    toastr.success('Post Created');
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }


    })

</script>


