<?php
include './header.php';


if ($_SESSION['unique_id_me'] != 1) {
    echo "<script>window.location = './homepage.php?type'</script>";
}


?>


<!-- main page -->


<div class="container" style="margin-top: 120px; margin-bottom: 90px">
    <div class="row">
        <div class="col-lg-12">

            <h1 class="display-4">Find User</h1>
            <form id="form" action="" method="post" enctype="multipart/form-data">
                <div class="row">

                    <div class="col-md-8 mb-3">
                        <input id="email" name="email" type="text" class="form-control" placeholder="Email">
                    </div>

                    <div class="col-md-4 mb-3">
                        <button id="button" type="submit" class="btn btn-secondary float-end form-control">Find
                            User
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered" style="border-color: #5d5d5d">
                <tr class="text-center">
                    <th>
                        <h6>unique_id</h6>
                    </th>
                    <th>
                        <h6>Image</h6>
                    </th>
                    <th>
                        <h6>Name</h6>
                    </th>
                    <th>
                        <h6>Email</h6>
                    </th>
                    <th>
                        <h6>Password</h6>
                    </th>
                </tr>


                <tr class="text-center">
                    <td>
                        <h6 id="unique_id" style="margin-top: 40px"></h6>
                    </td>

                    <td>
                        <img height="90px" id="pro_pic" src="" alt="">
                    </td>

                    <td>
                        <h6 id="name" style="margin-top: 10px"></h6>
                    </td>

                    <td>
                        <h6 id="emailfind" style="margin-top: 40px"></h6>
                    </td>

                    <td>
                        <h6 id="password" style="margin-top: 40px"></h6>
                    </td>
                </tr>


            </table>
        </div>

    </div>
</div>


<script>
    let form = document.querySelector('#form');
    let button = document.querySelector('#button');
    let unique_id = document.querySelector('#unique_id');
    let Username = document.querySelector('#name');
    let pro_pic = document.querySelector('#pro_pic');
    let Useremail = document.querySelector('#emailfind');
    let Password = document.querySelector('#password');

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        if (email.value == "") {
            toastr.error("Email is Required");
        } else {

            var formdata = new FormData(form);

            $.ajax({
                url: "../api/singleUser.php",
                type: "POST",
                data: formdata,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    // alert('ok')
                },
                success: function(data) {

                    let json = JSON.parse(data);
                    
                    if (json == 0) {
                        
                        toastr.error("Email Incorrect");
                        
                    } else {
                        
                        let singleUser = json.singleUser;
                        //console.log(json);

                        unique_id.innerText = singleUser.unique_id;
                        pro_pic.src = './pro_pic/' + singleUser.pro_pic;
                        Username.innerText = singleUser.name;
                        Useremail.innerText = singleUser.email;
                        Password.innerText = singleUser.password;

                        $("#form")[0].reset();
                    }

                },
                error: function(err) {
                    console.log(err);
                }
            });


        }


    })

</script>

<?php
include './footer.php'
?>
