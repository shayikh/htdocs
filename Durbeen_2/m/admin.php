<?php
include './header.php';


$SQL1 = "SELECT * FROM `admin` WHERE `unique_id`='$unique_id_me'";
$run1 = mysqli_query($connection, $SQL1);
$count1 = mysqli_num_rows($run1);

if ($count1 == 0) {
    echo "<script>window.location = 'homepage.php?type'</script>";
}


?>


<?php if ($count1 > 0) { ?>
<a style="position: fixed;left: 6px;top: 62px;z-index:20;font-weight: 600;" href="register_confirm.php?type" class="btn btn-sm btn-success">Account Requests</a>
<?php } ?>


<div class="container" style="margin-top: 112px">
    <h6 class="text-center">Add Or Remove Members & Admins</h6>
    <table class="table table-bordered mt-3" style="margin-bottom: 150px;border-color: #5d5d5d">
        <tbody id="tbodyID">

            <?php

            $SQL = "SELECT * FROM `registration` WHERE `unique_id`!='$unique_id_me' ORDER BY `unique_id` DESC";
            $run = mysqli_query($connection,$SQL);

            while ($data = mysqli_fetch_assoc($run)){

                $unique_id_fr = $data['unique_id'];

                $SQL2 = "SELECT * FROM `admin` WHERE `unique_id`='$unique_id_fr'";
                $run2 = mysqli_query($connection,$SQL2);
                $count2 = mysqli_num_rows($run2);

                ?>

                <tr>
                    <td class="text-center">
                        <a href="./people_timeline.php?type&unique_id_fr=<?php echo $unique_id_fr ?>">
                            <img style="margin-top: 2px" width="90px" src="../pro_pic/<?php echo $data['pro_pic'] ?>">
                        </a>
                    </td>
                    <td class="text-center" style="max-width: 129px">
                        <a class="text-decoration-none" href="./people_timeline.php?type&unique_id_fr=<?php echo $unique_id_fr ?>">
                            <p style="font-weight: 500"><?php echo $data['name'] ?></p>
                            <p class="text-success" style="font-size: 11px;font-weight: 500">Durbeen Visited : <?php echo $data['visit'] ?></p>
                        </a>
                    </td>
                    <td class="text-center">
                        <button onclick="addAdminfn(<?php echo $unique_id_fr ?>, this)" class="btn btn-sm <?php $count2 == 0 ? printf("btn-success") : printf("btn-danger") ?>" style="margin-top: 5px">
                            <?php $count2 == 0 ? printf("Admin") : printf("Remove") ?>
                        </button>
                    </td>
                </tr>
            <?php } ?>

        </tbody>
    </table>




<script>
    const addAdminfn = (unique_id_fr, elm) => {

        let addVar = {};
        addVar.unique_id_fr = unique_id_fr;

        axios.post("../api/make_durbeen.admin.php",
                addVar, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {
                // console.log(res.data);

                if (res.data == 0) {
                    toastr.error('Removed from Admin');
                    elm.innerText = "Admin";
                    elm.classList.add('btn-success');
                    elm.classList.remove('btn-danger');
                } else {
                    toastr.success('Made Admin');
                    elm.innerText = "Remove";
                    elm.classList.add('btn-danger');
                    elm.classList.remove('btn-success');
                }


            })
            .catch(err => {
                console.log(err);
            })
    }


</script>


</div>


<?php
include './footer.php'
?>
