<?php
include './header.php';

$cov_pic = $dataMe['cov_pic'];

$SQLabout = "SELECT * FROM `about` WHERE `unique_id`='$unique_id_me'";
$runAbout = mysqli_query($connection, $SQLabout);
$dataAbout = mysqli_fetch_assoc($runAbout);


?>


<a style="position: fixed;right:174px;top: 91px;z-index:20;font-weight: 600;" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#updateModal">Edit Profile</a>


<!-- main page -->
<div class="container" style="margin-top: 133px">
    <div class="row">

        <div class="col-md-12">
            <img width="1294px" src="../pro_pic/cov_pic/<?php echo $cov_pic ?>" id="cov_pic">
        </div>

        <div class="col-md-12 mt-4">
			<img style="border-radius: 50%;border: 3px solid #fff" width="220px" height="220px" src="../pro_pic/<?php echo $pro_pic_me ?>" id="pro_pic">
        </div>

        <div class="col-md-12 text-center" style="margin-top: -146px;">
            <p class="text-white" style="font-size: 39px" id="name"><?php echo $dataMe['name'] ?></p>
        </div>

    </div>



    



    <div class="row" style="margin-bottom: 100px">
        <div class="col-md-12">
            <table class="table table-bordered mt-5 pt-5" style="border-color: #5d5d5d">
                <tr>
                    <td>
                        <h5 class="text-blue">Email</h5>
                    </td>
                    <td>
                        <h5 id="emailID"><?php echo $dataMe['email'] ?></h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 class="text-blue">Date of Birth</h5>
                    </td>
                    <td>
                        <h5 id="birth_date"><?php echo $dataAbout['date_birth'] ?></h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 class="text-blue">Gender</h5>
                    </td>
                    <td>
                        <h5><?php echo $dataAbout['gender'] ?></h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 class="text-blue">Phone Numbers</h5>
                    </td>
                    <td>
                        <h5 id="phone"><?php echo $dataAbout['phone_no'] ?></h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 class="text-blue">Religion</h5>
                    </td>
                    <td>
                        <h5 id="religion"><?php echo $dataAbout['religion'] ?></h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 class="text-blue">Country</h5>
                    </td>
                    <td>
                        <h5 id="country"><?php echo $dataAbout['country'] ?></h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 class="text-blue">City</h5>
                    </td>
                    <td>
                        <h5 id="city"><?php echo $dataAbout['city'] ?></h5>
                    </td>
                </tr>
                <tr>
                    <td style="width: 300px">
                        <h5 class="text-blue">Bio</h5>
                    </td>
                    <td>
                        <h5 id="bio" style="line-height: 200%"><?php echo $dataAbout['bio'] ?></h5>
                    </td>
                </tr>
                <tr>
                    <td style="width: 300px">
                        <h5 class="text-blue">Durbeen Visited</h5>
                    </td>
                    <td>
                        <h5><?php echo $dataMe['visit'] ?></h5>
                    </td>
                </tr>
                <tr>
                    <td style="width: 300px">
                        <h5 class="text-blue">Account ID</h5>
                    </td>
                    <td>
                        <h5 id="unique_id_me"><?php echo $dataMe['unique_id'] ?></h5>
                    </td>
                </tr>
                <tr>
                    <td style="width: 300px">
                        <h5 class="text-blue">Account Link</h5>
                    </td>
                    <td>
                        <h5 class="one d-none">
                            http://durbeen.unaux.com/l/people_timeline.php?type&unique_id_fr=<?php echo $dataMe['unique_id'] ?></h5>
                        <button id="mybtn" class="btn btn-success float-start">Copy Account Link</button>
                    </td>
                </tr>
                <tr>
                    <td style="width: 300px">
                        <h5 class="text-blue">Follow List</h5>
                    </td>
                    <td>
                        <a href="./follow_list.php?type" class="btn btn-success">Follow List</a>
                    </td>
                </tr>
                <tr>
                    <td style="width: 300px">
                        <h5 class="text-blue">Allow List</h5>
                    </td>
                    <td>
                        <a href="./allow_list.php?type" class="btn btn-success">Allow List</a>
                    </td>
                </tr>
                <tr>
                    <td style="width: 300px">
                        <h5 class="text-blue">Old Profile Pictures</h5>
                    </td>
                    <td>
                        <a href="./pro_pic.php?type" class="btn btn-success">Old Profile Pictures</a>
                    </td>
                </tr>
                <tr>
                    <td style="width: 300px">
                        <h5 class="text-blue">Old Cover Photos</h5>
                    </td>
                    <td>
                        <a href="./cov_pic.php?type" class="btn btn-success">Old Cover Photos</a>
                    </td>
                </tr>
                <tr>
                    <td style="width: 300px">
                        <h5 class="text-blue">My All Comments</h5>
                    </td>
                    <td>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myCommentModal" onclick="showMyComment()">My Comments</button>
                    </td>
                </tr>
                <tr>
                    <td style="width: 300px">
                        <h5 class="text-blue">Other's Comments</h5>
                    </td>
                    <td>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#otherCommentModal" onclick="showOtherComment();">Other's Comments</button>
                    </td>
                </tr>
                <tr>
                    <td style="width: 300px">
                        <h5 class="text-blue">Liked Posts</h5>
                    </td>
                    <td>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#likedPostsModal" onclick="showLikedPosts();">Liked Posts</button>
                    </td>
                </tr>
                <tr>
                    <td style="width: 300px">
                        <h5 class="text-blue">Disliked Posts</h5>
                    </td>
                    <td>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#disLikedPostsModal" onclick="showDisLikedPosts();">Disliked Posts</button>
                    </td>
                </tr>
                <tr>
                    <td style="width: 300px">
                        <h5 class="text-blue">Lock/Unlock Profile</h5>
                    </td>
                    <td>
                        <button class="btn 
                        <?php if($dataMe['locking'] == 0){
                            echo 'btn-danger';
                        }else{
                            echo 'btn-success';
                        } ?>" onclick="lockingfn(<?php echo $unique_id_me ?>, this)">
                            <?php if($dataMe['locking'] == 0){
                                echo 'Lock Profile';
                            }else{
                                echo 'Unlock Profile';
                            } ?>
                        </button>
                    </td>
                </tr>
            </table>
        </div>


        <div class="col-md-12 mt-5 pt-5">
            <h2 class="red text-white text-center py-5">DANGER ZONE &#8595;</h2>
        </div>
        <div class="col-md-3"></div>

        <div class="col-md-6 mt-4">
            <a href="./del_acco.php?type" class="btn btn-dark form-control">&#9762; ACCOUNT DELETION &#9785;</a>
        </div>

        <div class="col-md-3"></div>

    </div>
</div>





<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="postModalLabel">Update Profile</h5>
                <button id="updateCloseBtn" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="updateFormID" enctype="multipart/form-data">
                    <input type="hidden" name="unique_id_me" value="<?php echo $unique_id_me ?>">
                    <input type="hidden" id="hidden_pro_pic" name="pro_pic" value="<?php echo $pro_pic_me ?>">
                    <input type="hidden" id="hidden_cov_pic" name="cov_pic" value="<?php echo $cov_pic ?>">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="mt-2 text-dark">Full Name</label>
                                <input name="name" id="nameModal" value="<?php echo $dataMe['name'] ?>" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="mt-2 text-dark">Profile Picture</label>
                                <input name="image_khan_bahadur" id="pro_img_id" class="form-control" type="file" accept="image/png, image/bmp, image/gif, image/jpg, image/avif, image/jpeg, image/jfif, image/pjpeg, image/pjp, image/apng, image/svg, image/webp">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="mt-2 text-dark">Cover Photo</label>
                                <input name="image_khan_cover" id="cov_img_id" class="form-control" type="file" accept="image/png, image/bmp, image/gif, image/jpg, image/avif, image/jpeg, image/jfif, image/pjpeg, image/pjp, image/apng, image/svg, image/webp">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="mt-2 text-dark">Email</label>
                                <input name="email" oninput="uniqueEmailProfile()" id="emailModal" value="<?php echo $dataMe['email'] ?>" class="form-control" type="email">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group pwdbody">
                                <label class="mt-2 text-dark">Password</label>
                                <input name="password" id="passwordModal" value="<?php echo $dataMe['password'] ?>" class="pwd form-control" type="password">
                                <i onclick="showPwd()" class="icon far fa-eye" style="cursor: pointer"></i>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="mt-2 text-dark">Religion</label>
                                <input name="religion" id="religionModal" value="<?php echo $dataAbout['religion'] ?>" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="mt-2 text-dark">Country</label>
                                <input name="country" id="countryModal" value="<?php echo $dataAbout['country'] ?>" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="mt-2 text-dark">City</label>
                                <input name="city" id="cityModal" value="<?php echo $dataAbout['city'] ?>" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="mt-2 text-dark">Date of Birth</label>
                                <input name="date_birth" id="date_birthModal" value="<?php echo $dataAbout['date_birth'] ?>" class="form-control" type="date">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="mt-2 text-dark">Phone No</label>
                                <input name="phone_no" id="phoneModal" value="<?php echo $dataAbout['phone_no'] ?>" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="mt-2 text-dark">Bio</label><br>
                                <textarea name="bio" id="bioModal" rows="3" class="form-control"><?php echo $dataAbout['bio'] ?></textarea>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="mt-2 text-dark">Question One</label><br>
                                <input name="question_one" class="form-control" type="text" value="<?php echo $dataAbout['question_one'] ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="mt-2 text-dark">Answer One</label><br>
                                <input name="answer_one" class="form-control" type="text" value="<?php echo $dataAbout['answer_one'] ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="mt-2 text-dark">Question Two</label><br>
                                <input name="question_two" class="form-control" type="text" value="<?php echo $dataAbout['question_two'] ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="mt-2 text-dark">Answer Two</label><br>
                                <input name="answer_two" class="form-control" type="text" value="<?php echo $dataAbout['answer_two'] ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="mt-2 text-dark">Question Three</label><br>
                                <input name="question_three" class="form-control" type="text" value="<?php echo $dataAbout['question_three'] ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="mt-2 text-dark">Answer Three</label><br>
                                <input name="answer_three" class="form-control" type="text" value="<?php echo $dataAbout['answer_three'] ?>">
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group mt-2">
                                <input name="updateBtn" value="UPDATE" class="btn btn-success float-end" type="submit">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- My Comment Modal -->
<div class="modal fade" id="myCommentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true" modal-dialog modal-dialog-scrollable>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="staticBackdropLabel1">My Comments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center text-dark" scope="col" style="min-width: 150px">Time</th>
                            <th class="text-center text-dark" scope="col">Comment</th>
                            <th class="text-center text-dark" scope="col">Post</th>
                            <th class="text-center text-dark" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="myCommentTbody">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onmouseover="showMyComment()" onclick="showMyComment()">
                    More Comments
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>


<!-- Other Comment Modal -->
<div class="modal fade" id="otherCommentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true" modal-dialog modal-dialog-scrollable>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="staticBackdropLabel2">Others Comments in My Posts</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center text-dark" scope="col">Picture</th>
                            <th class="text-center text-dark" scope="col">Name</th>
                            <th class="text-center text-dark" scope="col">Time</th>
                            <th class="text-center text-dark" scope="col">Comment</th>
                            <th class="text-center text-dark" scope="col">Post</th>
                        </tr>
                    </thead>
                    <tbody id="otherCommentTbody">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onmouseover="showOtherComment()" onclick="showOtherComment()">
                    More Comments
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>



<!-- Liked Posts Modal -->
<div class="modal fade" id="likedPostsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel3" aria-hidden="true" modal-dialog modal-dialog-scrollable>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="staticBackdropLabel3">Liked Posts</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center text-dark" scope="col">Image</th>
                            <th class="text-center text-dark" scope="col">Post</th>
                            <th class="text-center text-dark" scope="col">Show</th>
                            <th class="text-center text-dark" scope="col">Remove Like</th>
                        </tr>
                    </thead>
                    <tbody id="likedPostsTbody">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onmouseover="showLikedPosts()" onclick="showLikedPosts()">
                    More Posts
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>


<!-- Disliked Posts Modal -->
<div class="modal fade" id="disLikedPostsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel4" aria-hidden="true" modal-dialog modal-dialog-scrollable>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="staticBackdropLabel4">Disliked Posts</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center text-dark" scope="col">Image</th>
                            <th class="text-center text-dark" scope="col">Post</th>
                            <th class="text-center text-dark" scope="col">Show</th>
                            <th class="text-center text-dark" scope="col">Remove Dislike</th>
                        </tr>
                    </thead>
                    <tbody id="disLikedPostsTbody">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onmouseover="showDisLikedPosts()" onclick="showDisLikedPosts()">
                    More Posts
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>






<script>
    let oneV = document.querySelector(".one").innerText;
    let mybtn = document.querySelector("#mybtn");

    let updateForm = document.querySelector("#updateFormID");
    let updateCloseBtn = document.querySelector("#updateCloseBtn");
    let unique_id_me = document.querySelector('#unique_id_me');

    let timeline_name = document.querySelector("#timeline_name");
    let chatbar_name = document.querySelector("#chatbar_name");
    let name = document.querySelector("#name");
    let emailID = document.querySelector("#emailID");
    let pro_pic = document.querySelector("#pro_pic");
    let cov_pic = document.querySelector("#cov_pic");
    let birth_date = document.querySelector("#birth_date");
    let phone = document.querySelector("#phone");
    let religion = document.querySelector("#religion");
    let country = document.querySelector("#country");
    let city = document.querySelector("#city");
    let bio = document.querySelector("#bio");

    let hidden_pro_pic = document.querySelector("#hidden_pro_pic");
    let hidden_cov_pic = document.querySelector("#hidden_cov_pic");
    let nameModal = document.querySelector("#nameModal");
    let pro_img_id = document.querySelector("#pro_img_id");
    let cov_img_id = document.querySelector("#cov_img_id");
    let emailModal = document.querySelector("#emailModal");
    let passwordModal = document.querySelector("#passwordModal");
    let religionModal = document.querySelector("#religionModal");
    let countryModal = document.querySelector("#countryModal");
    let cityModal = document.querySelector("#cityModal");
    let date_birthModal = document.querySelector("#date_birthModal");
    let phoneModal = document.querySelector("#phoneModal");
    let bioModal = document.querySelector("#bioModal");
    let timeline_pro_pic = document.querySelector("#timeline_pro_pic");
    let chatbar_pro_pic = document.querySelector("#chatbar_pro_pic");

    let myMail = emailModal.value;


    let myCommentTbody = document.querySelector("#myCommentTbody");
    let otherCommentTbody = document.querySelector("#otherCommentTbody");
    let likedPostsTbody = document.querySelector("#likedPostsTbody");
    let disLikedPostsTbody = document.querySelector("#disLikedPostsTbody");





    updateForm.addEventListener('submit', (e) => {
        e.preventDefault();


        var updateFormData = new FormData(updateForm);

        $.ajax({
            url: "../api/about_update/profileUpdate.php",
            type: "POST",
            data: updateFormData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                // alert('ok')
            },
            success: function(data) {
                let json = JSON.parse(data);
                let profile_picture = json.myData.pro_pic;
                let cover_photo = json.myData.cov_pic;

                pro_pic.src = "../pro_pic/" + profile_picture;
                timeline_pro_pic.src = "../pro_pic/" + profile_picture;
                chatbar_pro_pic.src = "../pro_pic/" + profile_picture;
                cov_pic.src = "../pro_pic/cov_pic/" + cover_photo;
                
                hidden_pro_pic.value = profile_picture;
                hidden_cov_pic.value = cover_photo;
                
                timeline_name.innerText = json.myData.name;
                chatbar_name.innerText = json.myData.name;
                name.innerText = json.myData.name;
                emailID.innerText = json.myData.email;
                birth_date.innerText = json.about.date_birth;
                phone.innerText = json.about.phone_no;
                religion.innerText = json.about.religion;
                country.innerText = json.about.country;
                city.innerText = json.about.city;
                bio.innerText = json.about.bio;
                
                pro_img_id.value = "";
                cov_img_id.value = "";

                toastr.success('Profile Updated');
                updateCloseBtn.click();


                myMail = json.myData.email;
            },
            error: function(err) {
                console.log(err);
            }
        });

    })



    mybtn.addEventListener('click', function() {
        const elem = document.createElement('input');
        elem.setAttribute("value", oneV);
        document.body.appendChild(elem);
        elem.select();
        document.execCommand('copy');
        document.body.removeChild(elem);
        toastr.success("Link Copied to Clipboard");
    })



    var page_no_liked_posts = 1;

    function showLikedPosts() {

        let postData = {};

        postData.page_no = page_no_liked_posts;
        postData.unique_id_me = <?php echo $unique_id_me ?>;

        axios.post("../api/about_update/loadmorelikedPosts.php",
        postData, {
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(res => {
            if (res.data == 0) {
                toastr.info('You Are at The End');
            } else {
                let all = res.data;

                likedPostsTbody.innerHTML = likedPostsTbody.innerHTML + all;
                page_no_liked_posts++;
            }
        })
        .catch(err => {
            console.log(err);
        })
    }


    var page_no_disliked_posts = 1;

    function showDisLikedPosts() {

        let postData = {};

        postData.page_no = page_no_disliked_posts;
        postData.unique_id_me = <?php echo $unique_id_me ?>;

        axios.post("../api/about_update/loadmoreDisLikedPosts.php",
        postData, {
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(res => {
            if (res.data == 0) {
                toastr.info('You Are at The End');
            } else {
                let all = res.data;

                disLikedPostsTbody.innerHTML = disLikedPostsTbody.innerHTML + all;
                page_no_disliked_posts++;
            }
        })
        .catch(err => {
            console.log(err);
        })
    }

    var page_no_my_comment = 1;


    function showMyComment() {

        let postData = {};

        postData.page_no = page_no_my_comment;
        postData.unique_id_me = <?php echo $unique_id_me ?>;

        axios.post("../api/comment/loadmoreMyComments.php",
        postData, {
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(res => {
            if (res.data == 0) {
                toastr.info('You Are at The End');
            } else {
                let all = res.data;

                all.forEach(comment => {
                    myCommentTbody.innerHTML = myCommentTbody.innerHTML + makeMyCommentTr(comment);
                })
                page_no_my_comment++;
            }
        })
        .catch(err => {
            console.log(err);
        })
    }

    const makeMyCommentTr = (comment) => {
        let tr = `<tr>
                            <td class="text-center text-dark" style="min-width: 180px">${comment.time}</td>
                            <td class="text-center text-dark">${comment.comment}</td>
                            <td class="text-center" style="min-width: 150px">
                                <a href="./singlePost.php?type&amp;post_id=${comment.post_id}" class="btn btn-success" target="_blank">Show Post</a>
                            </td>
                            <td class="text-center text-dark">
                                <i class="fas fa-trash ms-4 mt-2 me-4" style="cursor: pointer" onclick="deleteComment(${comment.id}, ${comment.comn_giver_id}, this)"></i>
                            </td>
                        </tr>`
        return tr;
    }




    var page_no_other_comment = 1;


    function showOtherComment() {

        let postData = {};

        postData.page_no = page_no_other_comment;
        postData.unique_id_me = <?php echo $unique_id_me ?>;

        axios.post("../api/comment/loadmoreOtherComments.php",
        postData, {
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(res => {
            if (res.data == 0) {
                toastr.info('You Are at The End');
            } else {

                otherCommentTbody.innerHTML = otherCommentTbody.innerHTML + res.data;

                page_no_other_comment++;
            }
        })
        .catch(err => {
            console.log(err);
        })
    }


</script>



<style>
    .pwdbody {
        position: relative;
    }

    .icon {
        position: absolute;
        top: 45px;
        right: 30px;
    }

</style>

<?php
include './footer.php'
?>
