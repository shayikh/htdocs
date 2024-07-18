<?php
include './header.php';




$SQL1 = "SELECT * FROM `admin` WHERE `unique_id`='$unique_id_me'";
$run1 = mysqli_query($connection, $SQL1);
$count1 = mysqli_num_rows($run1);

?>


<!-- main page -->

<?php if ($count1 > 0) { ?>
<a style="position: fixed;left: 6px;top: 62px;z-index:20;font-weight: 600;" href="admin.php?type" class="btn btn-sm btn-success">Durbeen Admin</a>
<?php } ?>


<div class="container" style="margin-top: 120px">
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-blue text-center">ACCOUNT DELETION</h4>
        </div>
        <div class="col-md-12 mt-2">
            <h6 class="text-capitalize" style="line-height: 1.5;">deleting account once will permanently erase all data
                from database and you will never be able to
                regain those data, even <span style="font-weight: 500;font-family: mahfuj;" class="text-durbeen">দূরবীন</span> will not be able to repair this. be careful
                before you continue.</h6>
            <button onclick="deletefn()" class="btn btn-sm red mt-5 form-control">&#9762; DELETE ACCOUNT PERMANENTLY &#9785;</button>
        </div>
    </div>





</div>

<script>
    function deletefn() {
        let data = confirm('Are You Sure You Want to Delete Your Account?');
        if(data == true) {
            alert("We are sorry, There is no way to delete your account");
            toastr.info("We are sorry, There is no way to delete your account");
        }
    }
    
</script>

<?php
include './footer.php'
?>
