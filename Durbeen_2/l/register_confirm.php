<?php
include './header.php';


$SQL1 = "SELECT * FROM `account` ORDER BY `id` DESC";
$run1 = mysqli_query($connection, $SQL1);


?>


<!-- main page -->
<div class="container" style="margin-top: 150px">

    <h4 class="text-center">Account Requests</h4>
    <table class="table table-bordered mt-4" style="margin-bottom: 150px;border-color: #5d5d5d">
        <tr>
            <th class="text-center">
                <h5>Picture</h5>
            </th>
            <th class="text-center">
                <h5>Name</h5>
            </th>
            <th class="text-center">
                <h5>Email</h5>
            </th>
            <th class="text-center">
                <h5>Birth Date</h5>
            </th>
            <th class="text-center">
                <h5>Gender</h5>
            </th>
            <th colspan="2" class="text-center">
                <h5>Action</h5>
            </th>
        </tr>


        <?php while ($data1 = mysqli_fetch_assoc($run1)) { ?>
        <tr>
            <td class="text-center">
                <img width="550px" src="../pro_pic/<?php echo $data1['pro_pic'] ?>">
            </td>
            <td class="text-center">
                <h5><?php echo $data1['name'] ?></h5>
            </td>
            <td class="text-center">
                <h5><?php echo $data1['email'] ?></h5>
            </td>
            <td class="text-center">
                <h5><?php echo $data1['date_birth'] ?></h5>
            </td>
            <td class="text-center">
                <h5><?php echo $data1['gender'] ?></h5>
            </td>
            <td class="text-center">
                <button onclick="approve(<?php echo $data1['id'] ?>, this)" class="btn btn-success">Approve</button>
            </td>
            <td class="text-center">
                <button onclick="reject(<?php echo $data1['id'] ?>, this)" class="btn btn-danger">Reject</button>
            </td>
        </tr>
        <?php } ?>
    </table>




</div>


<script>
    const approve = (id, elm) => {
        let confirm = window.confirm("Do You Want to Accept This Account");

        if (confirm) {
            let approve = {};

            approve.id = id;

            axios.post("../api/admin/approve.php",
                    approve, {
                        headers: {
                            "Content-Type": "application/json"
                        }
                    })
                .then(res => {
                    if (res.data == 0) {
                        toastr.success('Request Accepted');
                        elm.parentElement.parentElement.remove();
                    } 
                })
                .catch(err => {
                    console.log(err);
                })
        }
    }

    const reject = (id, elm) => {
        let confirm = window.confirm("Do You Want to Reject?");

        if (confirm) {
            let reject = {};

            reject.id = id;

            axios.post("../api/admin/reject.php",
                    reject, {
                        headers: {
                            "Content-Type": "application/json"
                        }
                    })
                .then(res => {
                    if (res.data == 0) {
                        toastr.success('Request Rejected');
                        elm.parentElement.parentElement.remove();
                    } 
                })
                .catch(err => {
                    console.log(err);
                })
        }
    }
</script>

<?php
include './footer.php'
?>
