<?php
include './header.php';


if ($_SESSION['unique_id_me'] != 1) {
    echo "<script>window.location = 'https://profreehost.com/404/index.php'</script>";
} else {
    $SQL1 = "SELECT * FROM `registration`";
    $run1 = mysqli_query($connection, $SQL1);
}


?>


<!-- main page -->


<div class="container" style="margin-top:120px; margin-bottom: 90px">

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered" style="border-color: #5d5d5d">
                <tr>
                    <th>
                        <h6>unique_id</h6>
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


                <?php while ($data1 = mysqli_fetch_assoc($run1)) { ?>
                <tr>
                    <td>
                        <h6><?php echo $data1['unique_id'] ?></h6>
                    </td>
                    <td>
                        <h6><?php echo $data1['name'] ?></h6>
                    </td>
                    <td>
                        <h6><?php echo $data1['email'] ?></h6>
                    </td>
                    <td>
                        <h6><?php echo $data1['password'] ?></h6>
                    </td>
                </tr>
                <?php } ?>


            </table>


        </div>
    </div>
</div>


<?php
include './footer.php'
?>
