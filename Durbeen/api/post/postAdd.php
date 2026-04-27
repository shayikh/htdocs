<?php
include '../../connection.php';



$uploadDir = "../../post_image/";

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$content = $_POST["contentID"] ?? "";
$content = mysqli_real_escape_string($connection, $content);
$unique_id_me = $_POST["unique_id_me"];


date_default_timezone_set("Asia/Dhaka");
$time = date_default_timezone_get().' time: '.date("d-M-Y-D-h:i:s a");




if (isset($_FILES["images"])) {

    $count = count($_FILES["images"]["name"]);

    for ($i = 0; $i < $count; $i++) {

        $tmp  = $_FILES["images"]["tmp_name"][$i];
        $name = $_FILES["images"]["name"][$i];

        $extension = pathinfo($name, PATHINFO_EXTENSION);
        $fileName = uniqid().'_'.date("d_M_Y_D_h_i_s_a").'.'.$extension;

        $path = $uploadDir . $fileName;

        move_uploaded_file($tmp, $path);

        // SAME TEXT, MULTIPLE IMAGE ROWS
        $stmt = $connection->prepare("INSERT INTO post (unique_id, image, time, post) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $unique_id_me, $fileName, $time, $content);
        $stmt->execute();
    }





    $SQL2 = "SELECT * FROM `post` WHERE `unique_id`='$unique_id_me' ORDER BY `id` DESC LIMIT $count";
    $run2 = mysqli_query($connection, $SQL2);

    $posts = [];

    while ($singlePost = mysqli_fetch_assoc($run2)) {
        array_push($posts, $singlePost);
    }
    echo json_encode(["unique_id_me"=>$unique_id_me, "newPost" => $posts]);



}
?>