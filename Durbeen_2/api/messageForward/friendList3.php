<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$unique_id_me = $data['unique_id_me'];
$message_id = $data['message_id'];
$from_unique_id_fr = $data['from_unique_id_fr'];



$SQLMe = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_me'";
$runMe = mysqli_query($connection, $SQLMe);
$dataMe = mysqli_fetch_assoc($runMe);

$pro_pic_me = $dataMe['pro_pic'];
?>












<tr>
    <td class="text-center">
        <img class="text-center rounded-circle" width="50px" height="50px" src="../pro_pic/<?php echo $pro_pic_me ?>">
    </td>

    <td class="text-center text-dark">
        <?php echo $dataMe['name'] ?>
    </td>

    <td class="text-center text-dark">
        <button class="btn btn-sm btn-primary" onclick="forwardMessagefn(31, <?php echo $from_unique_id_fr ?>, <?php echo $unique_id_me ?>, <?php echo $message_id ?>, <?php echo $unique_id_me ?>, this)">Forward</button>
    </td>
</tr>









<?php
$SQL12 = "SELECT * FROM `$unique_id_me msg_grp` ORDER BY `id` DESC";
$run12 = mysqli_query($connection_info, $SQL12);

while ($data12 = mysqli_fetch_assoc($run12)){

    $grp_id = $data12['grp_id'];

    $SQL1 = "SELECT * FROM `groups` WHERE `id`='$grp_id'";
    $run1 = mysqli_query($connection,$SQL1);
    $data1 = mysqli_fetch_assoc($run1)

    ?>

    <tr>
        <td class="text-center">
            <img class="text-center rounded-circle" width="50px" height="50px" src="../pro_pic/<?php echo $data1['pro_pic'] ?>">
        </td>

        <td class="text-center text-dark">
            <?php echo $data1['grp_name'] ?>
        </td>

        <td class="text-center text-dark">
            <button class="btn btn-sm btn-primary" onclick="forwardMessagefn(32, <?php echo $from_unique_id_fr ?>, <?php echo $grp_id ?>, <?php echo $message_id ?>, <?php echo $unique_id_me ?>, this)">Forward</button>
        </td>
    </tr>



<?php } ?>









<?php
$SQL = "SELECT * FROM `$unique_id_me chats` WHERE `unique_id_fr`!=$unique_id_me ORDER BY `id` DESC";
$run = mysqli_query($connection_info,$SQL);

while ($data1=mysqli_fetch_assoc($run)){

    $to_unique_id_fr = $data1['unique_id_fr'];

    
    $SQLF = "SELECT * FROM `registration` WHERE `unique_id`='$to_unique_id_fr'";
    $runF = mysqli_query($connection, $SQLF);
    $data2 = mysqli_fetch_assoc($runF);

    ?>

    <tr>
        <td class="text-center">
            <a href="./people_timeline.php?type&unique_id_fr=<?php echo $to_unique_id_fr ?>" target="_blank">
                <img class="text-center rounded-circle" width="50px" height="50px" src="../pro_pic/<?php echo $data2['pro_pic'] ?>">
            </a>
        </td>

        <td class="text-center text-dark">
            <a style="color: blue" href="./people_timeline.php?type&unique_id_fr=<?php echo $to_unique_id_fr ?>" target="_blank"><?php echo $data2['name'] ?></a>
        </td>

        <td class="text-center text-dark">
            <button class="btn btn-sm btn-primary" onclick="forwardMessagefn(33, <?php echo $from_unique_id_fr ?>, <?php echo $to_unique_id_fr ?>, <?php echo $message_id ?>, <?php echo $unique_id_me ?>, this)">Forward</button>
        </td>
    </tr>



<?php } ?>