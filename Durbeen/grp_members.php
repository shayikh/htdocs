<?php
include './header.php';

$grp_id = $_GET['grp_id'];

$SQL110 = "SELECT * FROM `group $grp_id members` WHERE `memberId`='$unique_id_me' AND `admin`='1'";
$run110 = mysqli_query($connection_message, $SQL110);
$count110 = mysqli_num_rows($run110);

if ($count110 == 0) {
    echo "<script>window.location = 'homepage.php?type'</script>";
}

?>
<!-- main page -->

<div class="container" style="margin-top:180px">
    <table class="table table-bordered mt-4" style="margin-bottom: 150px;border-color: #5d5d5d">
        <tbody id="tbodyID">

            <?php

            $SQL = "SELECT * FROM `registration` WHERE `unique_id`!='$unique_id_me' ORDER BY `unique_id` DESC";
            $run = mysqli_query($connection,$SQL);

            while ($data154=mysqli_fetch_assoc($run)){

                $unique_id_fr = $data154['unique_id'];

                $SQLF154 = "SELECT * FROM `group $grp_id members` WHERE `memberId`='$unique_id_fr'";
                $runF154 = mysqli_query($connection_message,$SQLF154);
                $countF154 = mysqli_num_rows($runF154);

                $SQLF155 = "SELECT * FROM `group $grp_id members` WHERE `memberId`='$unique_id_fr' AND `admin`='1'";
                $runF155 = mysqli_query($connection_message,$SQLF155);
                $countF155 = mysqli_num_rows($runF155);

                ?>

                <tr>
                    <td class="text-center">
                        <a href="./people_timeline.php?type&unique_id_fr=<?php echo $unique_id_fr ?>">
                            <img height="135px" src="./pro_pic/<?php echo $data154['pro_pic'] ?>" alt="">
                        </a>
                    </td>
                    <td class="text-center">
                        <a class="text-decoration-none" href="./people_timeline.php?type&unique_id_fr=<?php echo $unique_id_fr ?>">
                            <h3 style="margin-top: 35px"><?php echo $data154['name'] ?></h3>
                            <h6 class="text-success">Durbeen Visited : <?php echo $data154['visit'] ?></h6>
                        </a>
                    </td>
                    <td class="text-center">
                        <button onclick="addfn(<?php echo $unique_id_me ?>, <?php echo $unique_id_fr ?>, <?php echo $grp_id ?>, this)" class="btn <?php $countF154 == 0 ? printf("btn-success") : printf("btn-danger") ?>" style="margin-top: 50px">
                            <?php $countF154 == 0 ? printf("Add") : printf("Remove") ?>
                        </button>
                    </td>
                    <td class="text-center">
                        <button onclick="adminfn(<?php echo $unique_id_me ?>, <?php echo $unique_id_fr ?>, <?php echo $grp_id ?>, this)" class="btn <?php $countF155 == 0 ? printf("btn-success") : printf("btn-danger") ?>" style="margin-top: 50px">
                            <?php $countF155 == 0 ? printf("Make Admin") : printf("Remove Admin") ?>
                        </button>
                    </td>
                </tr>
            <?php } ?>

        </tbody>
    </table>


<script>

    const adminfn = (unique_id_me, unique_id_fr, grp_id, elm) => {

    let addVar = {};

    addVar.unique_id_me = unique_id_me;
    addVar.unique_id_fr = unique_id_fr;
    addVar.grp_id = grp_id;

    axios.post("./api/group/make_admin.php",
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

    
    const addfn = (unique_id_me, unique_id_fr, grp_id, elm) => {

        let addVar = {};

        addVar.unique_id_me = unique_id_me;
        addVar.unique_id_fr = unique_id_fr;
        addVar.grp_id = grp_id;

        axios.post("./api/group/add.php",
                addVar, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {
                // console.log(res.data);

                if (res.data == 0) {
                    toastr.error('Removed');
                    elm.innerText = "Add";
                    elm.classList.add('btn-success');
                    elm.classList.remove('btn-danger');
                } else {
                    toastr.success('Added');
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
