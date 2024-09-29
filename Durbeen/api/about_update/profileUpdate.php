<?php
include '../../connection.php';

$unique_id_me = $_POST['unique_id_me'];
$pro_pic = $_POST['pro_pic'];
$cov_pic = $_POST['cov_pic'];

date_default_timezone_set("Asia/Dhaka");

if ($_FILES['image_khan_bahadur']['name']) {
    $imageOldName = $_FILES['image_khan_bahadur']['name'];
    $imageNewName = uniqid() . '_' . date("d_M_Y_D_h_i_s_a") . '_' . $imageOldName;
    $image_tmp = $_FILES['image_khan_bahadur']['tmp_name'];
    move_uploaded_file($image_tmp, '../../pro_pic/' . $imageNewName);

    $SQL1 = "INSERT INTO `$unique_id_me pro_pic`(`pro_pic`) VALUES ('$pro_pic')";
    mysqli_query($connection_info, $SQL1);
} else {
    $imageNewName = $pro_pic;
}


if ($_FILES['image_khan_cover']['name']) {

    $imageOldName = $_FILES['image_khan_cover']['name'];
    $imageNewName_cov = uniqid() . '_' . date("d_M_Y_D_h_i_s_a") . '_' . $imageOldName;
    $image_tmp = $_FILES['image_khan_cover']['tmp_name'];
    move_uploaded_file($image_tmp, '../../pro_pic/cov_pic/' . $imageNewName_cov);

    $SQL1 = "INSERT INTO `$unique_id_me cov_pic`(`cov_pic`) VALUES ('$cov_pic')";
    mysqli_query($connection_info, $SQL1);
    
} else {
    $imageNewName_cov = $cov_pic;
}


$name = trim($_POST['name']);
$name = mysqli_real_escape_string($connection, $name);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$date_birth = $_POST['date_birth'];

$SQL2 = "UPDATE `registration` SET `name`='$name',`email`='$email',`password`='$password',`pro_pic`='$imageNewName',`cov_pic`='$imageNewName_cov' WHERE `unique_id`='$unique_id_me'";
mysqli_query($connection, $SQL2);


$bio = trim($_POST['bio']);
$bio = mysqli_real_escape_string($connection, $bio);

$phone_no = trim($_POST['phone_no']);
$phone_no = mysqli_real_escape_string($connection, $phone_no);

$religion = trim($_POST['religion']);
$religion = mysqli_real_escape_string($connection, $religion);

$country = trim($_POST['country']);
$country = mysqli_real_escape_string($connection, $country);

$city = trim($_POST['city']);
$city = mysqli_real_escape_string($connection, $city);


$question_one = trim($_POST['question_one']);
$question_one = mysqli_real_escape_string($connection, $question_one);

$answer_one = trim($_POST['answer_one']);
$answer_one = mysqli_real_escape_string($connection, $answer_one);

$question_two = trim($_POST['question_two']);
$question_two = mysqli_real_escape_string($connection, $question_two);

$answer_two = trim($_POST['answer_two']);
$answer_two = mysqli_real_escape_string($connection, $answer_two);

$question_three = trim($_POST['question_three']);
$question_three = mysqli_real_escape_string($connection, $question_three);

$answer_three = trim($_POST['answer_three']);
$answer_three = mysqli_real_escape_string($connection, $answer_three);


$SQL3 = "UPDATE `about` SET `bio`='$bio',`date_birth`='$date_birth',`phone_no`='$phone_no',`religion`='$religion',`country`='$country',`city`='$city',`question_one`='$question_one',`answer_one`='$answer_one',`question_two`='$question_two',`answer_two`='$answer_two',`question_three`='$question_three',`answer_three`='$answer_three' WHERE `unique_id`='$unique_id_me'";
mysqli_query($connection, $SQL3);




$SQL4 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_me'";
$run4 = mysqli_query($connection, $SQL4);
$myData = mysqli_fetch_assoc($run4);

$SQL5 = "SELECT * FROM `about` WHERE `unique_id`='$unique_id_me'";
$run5 = mysqli_query($connection, $SQL5);
$about = mysqli_fetch_assoc($run5);

echo json_encode(["about"=>$about, "myData" => $myData]);
