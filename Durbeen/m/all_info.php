<?php
include './header.php';


if ($_SESSION['unique_id_me'] != 1) {
    echo "<script>window.location = './homepage.php?type'</script>";
} else {
    $SQL1 = "SELECT * FROM `registration`";
    $run1 = mysqli_query($connection, $SQL1);
}


?>


    <!-- main page -->


    <div class="container" style="margin-top:133px; margin-bottom: 90px">

        <div style="height: 50px"></div>


        <div class="row">
            <table class="table table-bordered mt-4" style="border-color: #5d5d5d">
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
                        </td>
                        <td>
                            <h6><?php echo $data1['email'] ?></h6>
                        </td>
                        </td>
                        <td>
                            <h6><?php echo $data1['password'] ?></h6>
                        </td>
                    </tr>
                <?php } ?>


            </table>


        </div>
    </div>


<?php
include './footer.php'
?>