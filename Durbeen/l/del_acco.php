<?php
include './header.php';


?>


<!-- main page -->


<div class="container" style="margin-top: 170px">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-blue text-center">ACCOUNT DELETION</h1>
        </div>
        <div class="col-md-12 mt-3">
            <h4 class="text-capitalize" style="line-height: 1.5;">deleting account once will permanently erase all data
                from database and you will never be able to
                regain those data, even <span style="font-weight: 500;font-family: mahfuj;" class="text-durbeen">দূরবীন</span> will not be able to repair this. be careful
                before you continue.</h4>
            <button onclick="deletefn()" class="btn red mt-5 form-control">&#9762; DELETE ACCOUNT PERMANENTLY &#9785;</button>
        </div>
    </div>
</div>


<?php
include './footer.php'
?>
