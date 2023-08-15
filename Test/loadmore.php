<?php
$page = $_POST['page'];
$limit = 6;
$row = ($page - 1)*$limit;

$connection = mysqli_connect("localhost","root","","durbeen");
$query = "SELECT * FROM `post` limit $row,$limit";
$run = mysqli_query($connection,$query);




while ($sub = mysqli_fetch_assoc($run)){
?>

<div class="card shadow m-3">
    <div class="card-body">
        <h5 class="card-title"><?php echo $sub['id'] ?></h5>
        <h5 class="card-title"><?php echo $sub['image'] ?></h5>
        <p class="card-text"><?php echo $sub['time'] ?></p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>

<?php } ?>


















