<?php
session_start();

if ($_SESSION['unique_id_me']) {
    header('location:./homepage.php?type');
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>দূরবীন</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="shortcut icon" href="../img/telescope_2.png" />
    <link href="../css/alertify.min.css" />
    <link href="../css/all.min.css" />
    <link href="../css/fontawesome.min.css" />
    <link rel="stylesheet" href="../css/toastr.min.css">
    <script src="../js/jquery-3.5.1.toastr.min.js"></script>
    <script src="../js/toastr.min.js"></script>
    <script src="../js/axios.min.js"></script>
    <link rel="stylesheet" href="../css/custom.css" />

</head>

<body>

    <div style="height: 100px"></div>

    <img width="120px" height="120px" id="pro_pic" src="" style="display: block;margin-left: auto;margin-right: auto; border-radius: 50%" alt="">

    <div class="container">
        <div class="row">
            <form action="" method="post" id="formone">
                <div class="col-lg-12">
                    <h5>Enter Your Email</h5>
                </div>
                <div class="col-lg-12">
                    <input name="email" class="form-control" type="email" id="email">
                </div>
                <div class="col-lg-12 mt-4">
                    <input name="send" class="btn btn-success form-control" type="submit">
                </div>
            </form>
        </div>


        <div class="row mt-5 mb-5 pb-5" id="question">
            <form action="" method="post" id="formtwo">
                <div class="col-lg-12">
                    <h5>Question 1:</h5>
                    <h5 id="question_one"></h5>
                </div>
                <input name="unique_id" id="hidden" type="hidden" value="">
                <div class="col-lg-12">
                    <input name="answer_one" id="answer_one" class="form-control" type="text" value="">
                </div>
                <div class="col-lg-12">
                    <h5>Question 2:</h5>
                    <h5 id="question_two"></h5>
                </div>
                <div class="col-lg-12">
                    <input name="answer_two" id="answer_two" class="form-control" type="text" value="">
                </div>
                <div class="col-lg-12">
                    <h5>Question 3:</h5>
                    <h5 id="question_three"></h5>
                </div>
                <div class="col-lg-12">
                    <input name="answer_three" id="answer_three" class="form-control" type="text" value="">
                </div>

                <input type="submit" class="btn btn-success form-control mt-4" value="SUBMIT">
            </form>

        </div>


        <div class="row mt-5 mb-5 pb-5" id="passdiv">
            <h2>Password:</h2>
            <h2 id="passw"></h2>
        </div>
    </div>


    <script>
        $("#question").hide();
        $("#pro_pic").hide();
        $("#passdiv ").hide();

        let formone = document.querySelector('#formone');
        let email = document.querySelector('#email');
        let hidden = document.querySelector('#hidden');


        formone.addEventListener('submit', (e) => {
            e.preventDefault();


            if (email.value == "") {
                toastr.error('Email Field is Required');
            }

            var formdataone = new FormData(formone);

            $.ajax({
                url: "../api/forgot_pass/forgotPass.php",
                type: "POST",
                data: formdataone,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    // alert('ok')
                },
                success: function(data) {


                    let json = JSON.parse(data);

                    let questions = json.questions;
                    // console.log(questions)

                    if (questions == "Account Not Found") {
                        toastr.error('Account Not Found');
                        $("#pro_pic ").hide();
                        $("#question").hide();
                        $("#passdiv ").hide();
                    } else {
                        pro_pic.src = '../pro_pic/' + json.pro_pic;
                        $("#pro_pic ").show();

                        if (questions.answer_one == "") {
                            toastr.error('No Saved Answer');
                            $("#question").hide();
                            $("#passdiv ").hide();
                        } else if (questions.answer_two == "") {
                            toastr.error('No Saved Answer');
                            $("#question").hide();
                            $("#passdiv ").hide();
                        } else if (questions.answer_three == "") {
                            toastr.error('No Saved Answer');
                            $("#question").hide();
                            $("#passdiv ").hide();
                        } else {
                            $("#question").show();
                            question_one.innerText = questions.question_one;
                            question_two.innerText = questions.question_two;
                            question_three.innerText = questions.question_three;
                            hidden.value = questions.unique_id;
                        }
                    }


                },
                error: function(err) {
                    console.log(err);
                }
            });
        })

        let formtwo = document.querySelector('#formtwo');
        let answer_one = document.querySelector('#answer_one');
        let answer_two = document.querySelector('#answer_two');
        let answer_three = document.querySelector('#answer_three');
        let passw = document.querySelector('#passw');
        let passdiv = document.querySelector('#passdiv');


        formtwo.addEventListener('submit', (e) => {
            e.preventDefault();

            if (answer_one.value == "") {
                toastr.error('All Fields are Required');
            } else if (answer_two.value == "") {
                toastr.error('All Fields are Required');
            } else if (answer_three.value == "") {
                toastr.error('All Fields are Required');
            } else {

                var formdatatwo = new FormData(formtwo);

                $.ajax({
                    url: "../api/forgot_pass/findPass.php",
                    type: "POST",
                    data: formdatatwo,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        // alert('ok')
                    },
                    success: function(data) {


                        let json = JSON.parse(data);

                        let password = json.password;

                        if (password == "Wrong Answer") {
                            toastr.error('Wrong Answer');
                        } else {
                            $("#question").hide();
                            $("#passdiv ").show();
                            passw.innerText = password;

                            toastr.success("Success, Password Found")

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
