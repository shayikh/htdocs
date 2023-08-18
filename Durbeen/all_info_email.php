<?php
include './header.php';




if ($_SESSION['unique_id_me'] != 1){
  echo "<script>window.location = './homepage.php?type=no'</script>";
}





?>




<!-- main page -->



<div class="container" style="margin-top:133px; margin-bottom: 90px">
  <div class="row">
    <div class="col-lg-12">

      <div style="height: 30px"></div>
      <h1 class="display-4 my-4">Find User</h1>
      <form id="form" action="" method="post" enctype="multipart/form-data">
        <div class="row">

          <div class="col-md-8 mb-3">
            <input id="email" name="email" type="text" class="form-control" placeholder="Email">
          </div>

          <div class="col-md-4 mb-3">
            <button id="button" type="submit" class="btn btn-secondary float-end form-control">Find User</button>
          </div>

        </div>
      </form>
      
    </div>
  </div>





  <div class="row">
    <div class="col-lg-12">
      <table class="table table-bordered mt-4" style="border-color: #5d5d5d">
        <tr>
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



        <tr>
          <td>
            <h5 id="unique_id"></h5>
          </td>
          <td>
            <img width="120px" id="pro_pic" src="" alt="">
          </td>
          <td>
            <h5 id="name"></h5>
          </td>
          </td>
          <td>
            <h5 id="emailfind"></h5>
          </td>
          </td>
          <td>
            <h5 id="password"></h5>
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

    if(email.value == ""){
      toastr.error("Email is Required");
    }else{

      var formdata = new FormData(form);

      $.ajax({
          url: "./api/getSingle.php",
          type: "POST",
          data: formdata,
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function () {
              // alert('ok')
          },
          success: function (data) {

            let json = JSON.parse(data);
            
            let singleUser = json.singleUser;
            // console.log(singleUser);

            unique_id.innerText = singleUser.unique_id;
            pro_pic.src = './pro_pic/' + singleUser.pro_pic;
            Username.innerText = singleUser.name;
            Useremail.innerText = singleUser.email;
            Password.innerText = singleUser.password;
            

            $("#form")[0].reset();
          },
          error: function (err) {
            console.log(err);
          }
      });


    }





  })
</script>

<?php
include './footer.php'
?>