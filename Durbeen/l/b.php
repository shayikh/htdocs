<?php
include './header.php';


if ($_SESSION['unique_id_me'] != 1) {
    echo "<script>window.location = './lost.php'</script>";
} else {
    $SQL1 = "SELECT * FROM `registration` ORDER BY `unique_id` DESC LIMIT 1";
    $run1 = mysqli_query($connection, $SQL1);
    $accounts = mysqli_fetch_assoc($run1);


    $SQL2 = "SELECT * FROM `post` ORDER BY `id` DESC LIMIT 1";
    $run2 = mysqli_query($connection, $SQL2);
    $posts = mysqli_fetch_assoc($run2);
}


?>


<!-- main page -->


<div class="container" style="margin-top:133px; margin-bottom: 90px">
    <div class="row">
        <div class="col-md-12">
            <div style="height: 20px"></div>
            <p style="font-size: 30px" class="text-blue d-inline">Last Account id is = <?php echo $accounts['unique_id'] ?>, </p>
            <p style="font-size: 30px" class="text-blue d-inline">Last Post id is = <?php echo $posts['id'] ?></p>
        </div>
        <div class="col-lg-12">
            <h1 class="display-4 my-2">Find User</h1>
            <div class="row">
                <div class="col-md-8 mb-3">
                    <input id="emailID" type="text" class="form-control" placeholder="Email">
                </div>

                <div class="col-md-4 mb-3">
                    <button onclick="showdata()" type="button" class="btn btn-primary float-end form-control">
                        Find User
                    </button>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered mt-4" style="border-color: #5d5d5d">
                <tr class="text-center">
                    <th>
                        <h5>unique_id</h5>
                    </th>
                    <th>
                        <h5>Image</h5>
                    </th>
                    <th>
                        <h5>Name</h5>
                    </th>
                    <th>
                        <h5>Email</h5>
                    </th>
                    <th>
                        <h5>Password</h5>
                    </th>
                </tr>


                <tr class="text-center">
                    <td>
                        <h5 id="unique_id" style="margin-top: 52px"></h5>
                    </td>

                    <td>
                        <img height="135px" id="pro_pic" src="">
                    </td>

                    <td>
                        <h5 id="name" style="margin-top: 52px"></h5>
                    </td>

                    <td>
                        <h5 id="emailfind" style="margin-top: 52px"></h5>
                    </td>

                    <td>
                        <h5 id="password" style="margin-top: 52px"></h5>
                    </td>
                </tr>


            </table>
        </div>

    </div>
</div>


<script>
    let email = document.querySelector('#emailID');
    let unique_id = document.querySelector('#unique_id');
    let Username = document.querySelector('#name');
    let pro_pic = document.querySelector('#pro_pic');
    let Useremail = document.querySelector('#emailfind');
    let Password = document.querySelector('#password');

    function showdata() {
        if (email.value == "") {
            toastr.error("Email is Required");
        } else {
            let postData = {};

            postData.email = email.value;

            axios.post("../api/singleUser.php",
                    postData, {
                        headers: {
                            "Content-Type": "application/json"
                        }
                    })
                .then(res => {
                    if (res.data == 0) {
                        toastr.error('Email Incorrect');
                    } else {
                        json = res.data;
                        let singleUser = json.singleUser;
                        // console.log(json);

                        unique_id.innerText = singleUser.unique_id;
                        pro_pic.src = '../pro_pic/' + singleUser.pro_pic;
                        Username.innerText = singleUser.name;
                        Useremail.innerText = singleUser.email;
                        Password.innerText = singleUser.password;

                        email.value = "";
                    }
                })
                .catch(err => {
                    console.log(err);
                })
        }
    }



</script>

<?php
include './footer.php'
?>
