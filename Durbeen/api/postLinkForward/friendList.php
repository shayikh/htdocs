<?php
include '../../connection.php';
header('Content-Type: application/x-www-form-urlencoded');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$unique_id_me = $data['unique_id_me'];
$post_id = $data['post_id'];




$SQLMe = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_me'";
$runMe = mysqli_query($connection, $SQLMe);
$dataMe = mysqli_fetch_assoc($runMe);

$pro_pic_me = $dataMe['pro_pic'];













$SQL11 = "SELECT * FROM `$unique_id_me chats` ORDER BY `id` DESC";
$run11 = mysqli_query($connection_info, $SQL11);

while ($data11 = mysqli_fetch_assoc($run11)) {

$unique_id_fr_chats = $data11['unique_id_fr'];
$chat_type = $data11['chat_type'];
?>






<?php
if($chat_type == 3){

$SQL21 = "SELECT * FROM `registration` WHERE `unique_id`='$unique_id_fr_chats'";
$run21 = mysqli_query($connection, $SQL21);
$data21 = mysqli_fetch_assoc($run21);

?>

<tr>
    <td class="text-center">
        <a href="./people_timeline.php?type&unique_id_fr=<?php echo $unique_id_fr_chats ?>" target="_blank">
            <img class="text-center rounded-circle" width="50px" height="50px" src="../pro_pic/<?php echo $data21['pro_pic'] ?>">
        </a>
    </td>

    <td class="text-center">
        <a style="color: blue" href="./people_timeline.php?type&unique_id_fr=<?php echo $unique_id_fr_chats ?>" target="_blank"><?php echo $data21['name'] ?></a>
    </td>

    <td class="text-center">
        <button class="btn btn-sm btn-primary" onclick="forwardPostLinkToFriendfn(<?php echo $unique_id_fr_chats ?>, <?php echo $post_id ?>, <?php echo $unique_id_me ?>, this)">Forward</button>
    </td>
</tr>

<?php } 

elseif ($chat_type == 1){
?>
<tr>
    <td class="text-center">
        <img class="text-center rounded-circle" width="50px" height="50px" src="../pro_pic/<?php echo $pro_pic_me ?>">
    </td>

    <td class="text-center text-dark">
        My Notes
    </td>

    <td class="text-center text-dark">
        <button class="btn btn-sm btn-primary" onclick="forwardPostLinkToMefn(<?php echo $post_id ?>, <?php echo $unique_id_me ?>, this)">Forward</button>
    </td>
</tr>


<?php } 

elseif ($chat_type == 2){

$grp_id = $unique_id_fr_chats;

$SQL1 = "SELECT * FROM `groups` WHERE `id`='$grp_id'";
$run1 = mysqli_query($connection,$SQL1);
$data1 = mysqli_fetch_assoc($run1)

?>

<tr>
    <td class="text-center">
        <a href="./group_msg.php?type&grp_id=<?php echo $grp_id ?>" target="_blank">
            <img class="text-center rounded-circle" width="50px" height="50px" src="../pro_pic/<?php echo $data1['pro_pic'] ?>">
        </a>
    </td>

    <td class="text-center">
        <a style="color: blue" href="./group_msg.php?type&grp_id=<?php echo $grp_id ?>" target="_blank">
            <?php echo $data1['grp_name'] ?>
        </a>
    </td>

    <td class="text-center">
        <button class="btn btn-sm btn-primary" onclick="forwardPostLinkToGrpfn(<?php echo $grp_id ?>, <?php echo $post_id ?>, <?php echo $unique_id_me ?>, this)">Forward</button>
    </td>
</tr>

<?php 
} 
} ?>



































