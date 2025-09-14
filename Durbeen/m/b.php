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


<div class="container" style="margin-top: 90px; margin-bottom: 90px">
    <div class="row">
        <div class="col-md-12">
            <div style="height: 20px"></div>
            <p style="font-size: 30px" class="text-blue d-inline">Last Account id is = <?php echo $accounts['unique_id'] ?>, </p>
            <p style="font-size: 30px" class="text-blue d-inline">Last Post id is = <?php echo $posts['id'] ?></p>
        </div>
        <div class="col-lg-12">
            <h1 class="display-4">Find User</h1>
            <div class="row">
                <div class="col-md-8 mb-3">
                    <input id="emailID" name="email" type="text" class="form-control" placeholder="Email">
                </div>

                <div class="col-md-4 mb-3">
                    <button onclick="showinfo()" type="button" class="btn btn-primary float-end form-control">
                        Find User
                    </button>
                </div>
            </div>
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
                        <img height="90px" id="pro_pic" src="">
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

    <!-- main page -->
    <div class="container" style="margin-top: 112px;">
        <h6 class="text-center">My Groups</h6>
        <table class="table table-bordered mt-3" style="margin-bottom: 150px;border-color: #5d5d5d">
            <tbody id="tbodyID">

            </tbody>
        </table>
    </div>



</div>


<script>
    let email = document.querySelector('#emailID');
    let unique_id = document.querySelector('#unique_id');
    let Username = document.querySelector('#name');
    let pro_pic = document.querySelector('#pro_pic');
    let Useremail = document.querySelector('#emailfind');
    let Password = document.querySelector('#password');
    let tbody = document.querySelector("#tbodyID");

    function showinfo() {
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

        axios.post("../api/group/loadmoreAllGroup_m.php",
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
