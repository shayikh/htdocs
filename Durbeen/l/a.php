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


<div class="container" style="margin-top:133px; margin-bottom: 90px">

    <div style="height: 50px"></div>


    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered mt-4" style="border-color: #5d5d5d">
                <tr>
                    <th>
                        <h5>unique_id</h5>
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


                <?php while ($data1 = mysqli_fetch_assoc($run1)) { ?>
                <tr>
                    <td>
                        <h5><?php echo $data1['unique_id'] ?></h5>
                    </td>
                    <td>
                        <h5><?php echo $data1['name'] ?></h5>
                    </td>
                    <td>
                        <h5><?php echo $data1['email'] ?></h5>
                    </td>
                    <td>
                        <h5><?php echo $data1['password'] ?></h5>
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
