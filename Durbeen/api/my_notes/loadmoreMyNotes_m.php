<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);


$page_no = $data['page_no'];
$unique_id_me = $data['unique_id_me'];



$limit = 20;
$row = ($page_no - 1) * $limit;

$SQL = "SELECT * FROM `$unique_id_me to $unique_id_me` ORDER BY `id` DESC LIMIT $row,$limit";
$run = mysqli_query($connection_message, $SQL);


while ($data3 = mysqli_fetch_assoc($run)) { ?>
    <table class="table mt-4">
        <tbody>
            <tr>

                <div class="float-end" style="border: none;">
                    <?php if ($data3['image'] != "") { ?>
                        <img class="float-end" title="<?php echo $data3['time'] ?>" width="300px" src="../note_image/<?php echo $data3['image'] ?>">
                    <?php } ?>
                    
                    <?php if ($data3['message'] != "") { ?>
                        <h6 title="<?php echo $data3['time'] ?>" style="border-radius: 35px" class="response float-end py-2 px-3 bg-success"><?php echo $data3['message'] ?></h6>
                    <?php } ?>
                    <br>
                    <button onclick="deleteMyNotes(<?php echo $data3['id'] ?>,<?php echo $unique_id_me ?>, this)" class="btn btn-sm btn-dark float-end mb-2"><i class="fas fa-trash-alt"></i></button>
                </div>

            </tr>
        </tbody>
    </table>

<?php } ?>



