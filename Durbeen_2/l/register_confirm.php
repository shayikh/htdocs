<?php
include './header.php';


$SQL1 = "SELECT * FROM `account` ORDER BY `id` DESC";
$run1 = mysqli_query($connection, $SQL1);




?>


<!-- main page -->
<div class="container" style="margin-top: 150px">

    <h4 class="text-center">People Facelist</h4>
    <table class="table table-bordered mt-4" style="margin-bottom: 150px;border-color: #5d5d5d">
        <tr>
            <th>
                <h5>Picture</h5>
            </th>
            <th>
                <h5>Name</h5>
            </th>
            <th>
                <h5>Email</h5>
            </th>
            <th>
                <h5>Birth Date</h5>
            </th>
            <th>
                <h5>Gender</h5>
            </th>
        </tr>


        <?php while ($data1 = mysqli_fetch_assoc($run1)) { ?>
        <tr>
            <td>
                <img height="135px" src="../pro_pic/<?php echo $data1['pro_pic'] ?>" alt="">
            </td>
            <td>
                <h5><?php echo $data1['name'] ?></h5>
            </td>
            <td>
                <h5><?php echo $data1['email'] ?></h5>
            </td>
            <td>
                <h5><?php echo $data1['date_birth'] ?></h5>
            </td>
            <td>
                <h5><?php echo $data1['gender'] ?></h5>
            </td>
        </tr>
        <?php } ?>
    </table>




</div>


<?php
include './footer.php'
?>
