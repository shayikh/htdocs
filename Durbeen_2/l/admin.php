<?php
include './header.php';


$SQL1 = "SELECT * FROM `admin` WHERE `unique_id`='$unique_id_me'";
$run1 = mysqli_query($connection, $SQL1);
$count1 = mysqli_num_rows($run1);

if ($count1 == 0) {
    echo "<script>window.location = 'homepage.php?type'</script>";
}


?>



<a style="position: fixed;right:174px;top:91px;z-index:20;font-weight: 600;" href="register_confirm.php?type" class="btn btn-success">Account Request</a>


<div class="container" style="margin-top: 150px">
    <h4 class="text-center">Add Or Remove Members & Admins</h4>
    <table class="table table-bordered mt-4" style="margin-bottom: 150px;border-color: #5d5d5d">
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
                            <img height="135px" src="../pro_pic/<?php echo $data['pro_pic'] ?>" alt="">
                        </a>
                    </td>
                    <td class="text-center">
                        <a class="text-decoration-none" href="./people_timeline.php?type&unique_id_fr=<?php echo $unique_id_fr ?>">
                            <h3 style="margin-top: 35px"><?php echo $data['name'] ?></h3>
                            <h6 class="text-success">Durbeen Visited : <?php echo $data['visit'] ?></h6>
                        </a>
                    </td>
                    <td class="text-center">
                        <button onclick="addAdminfn(<?php echo $unique_id_fr ?>, this)" class="btn <?php $count2 == 0 ? printf("btn-success") : printf("btn-danger") ?>" style="margin-top: 50px">
                            <?php $count2 == 0 ? printf("Make Admin") : printf("Remove Admin") ?>
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

        axios.post("../api/admin/make_durbeen.admin.php",
                addVar, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {
                // console.log(res.data);

                if (res.data == 0) {
                    toastr.error('Removed from Admin');
                    elm.innerText = "Make Admin";
                    elm.classList.add('btn-success');
                    elm.classList.remove('btn-danger');
                } else {
                    toastr.success('Made Admin');
                    elm.innerText = "Remove Admin";
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
