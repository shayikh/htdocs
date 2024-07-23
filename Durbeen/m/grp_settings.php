<?php
include './header.php';

$grp_id = $_GET['grp_id'];

$SQL110 = "SELECT * FROM `group $grp_id members` WHERE `memberId`='$unique_id_me'";
$run110 = mysqli_query($connection_message, $SQL110);
$count110 = mysqli_num_rows($run110);

if ($count110 == 0) {
    echo "<script>window.location = 'homepage.php?type'</script>";
}

$SQL111 = "SELECT * FROM `groups` WHERE `id`='$grp_id'";
$run111 = mysqli_query($connection, $SQL111);
$data111 = mysqli_fetch_assoc($run111);



$SQL109 = "SELECT * FROM `group $grp_id members` WHERE `memberId`='$unique_id_me' AND `admin`='1'";
$run109 = mysqli_query($connection_message, $SQL109);
$count109 = mysqli_num_rows($run109);
?>





<!-- main page -->
<a style="position: fixed;left: 5px;top: 62px;z-index:20;font-weight: 600;" style="font-weight: 600;" class="btn btn-sm btn-danger float-end" onclick="leaveGrp(<?php echo $grp_id ?>,<?php echo $unique_id_me ?>)">Leave</a>

<?php if ($count109 > 0) { ?>
<a href="grp_admins.php?type&grp_id=<?php echo $grp_id ?>" style="position: fixed;left: 61px;top: 62px;z-index:20;font-weight: 600;" class="btn btn-sm btn-success">Admin</a>
<?php } ?>



<div class="container" style="margin-top: 112px">
    <h6 class="text-center mt-2"><?php echo $data111['grp_name'] ?></h6>
    <h6 class="text-center">Group Members</h6>
    <table class="table table-bordered mt-2" style="margin-bottom: 150px;border-color: #5d5d5d">
        <tbody id="tbodyID">

            <?php

            $SQL = "SELECT * FROM `group $grp_id members` ORDER BY `id` DESC";
            $run = mysqli_query($connection_message,$SQL);

            while ($data154=mysqli_fetch_assoc($run)){

                $unique_id_fr = $data154['memberId'];

                $SQLF154 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_fr'";
                $runF154 = mysqli_query($connection,$SQLF154);
                $dataF154 = mysqli_fetch_assoc($runF154);

                ?>

                <tr>
                    <td class="text-center">
                        <a href="./people_timeline.php?type&unique_id_fr=<?php echo $unique_id_fr ?>">
                            <img style="margin-top: 2px" width="90px" src="../pro_pic/<?php echo $dataF154['pro_pic'] ?>">
                        </a>
                    </td>
                    <td class="text-center" style="max-width: 129px">
                        <a class="text-decoration-none" href="./people_timeline.php?type&unique_id_fr=<?php echo $unique_id_fr ?>">
                            <p style="font-size: 13px;font-weight: 500"><?php echo $dataF154['name'] ?></p>
                            <p class="text-success" style="font-size: 11px;font-weight: 500">Durbeen Visited : <?php echo $dataF154['visit'] ?></p>
                        </a>
                    </td>
                    <td class="text-center">
                        <h6 style="margin-top: 25px"><?php $data154['admin'] == 1 ? printf("Admin") : printf("") ?></h6>
                    </td>
                </tr>
            <?php } ?>

        </tbody>
    </table>




<script>


    const leaveGrp = (grp_id, unique_id_me) => {
        let confirm = window.confirm("Do You Want to Leave From This Group?");

        if (confirm) {

            let message = {};

            message.grp_id = grp_id;
            message.unique_id_me = unique_id_me;

            axios.post("../api/group/leaveGrp.php",
                    message, {
                        headers: {
                            "Content-Type": "application/json"
                        }
                    })
                .then(res => {
                    // console.log(res.data);

                    if (res.data == '1') {
                        window.location = 'groups.php?type=groups';
                    }

                })
                .catch(err => {
                    console.log(err);
                })
        } else {
            return;
        }
    }


    
</script>


</div>


<?php
include './footer.php'
?>
