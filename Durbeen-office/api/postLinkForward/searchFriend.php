<?php
include '../../connection.php';

$search = $_POST['search'];
$unique_id_me = $_POST['unique_id_me'];
$post_id = $_POST['hidden_post_id'];





$search = strtolower(trim($search));
$search = mysqli_real_escape_string($connection, $search);




$SQL1 = "SELECT * FROM `registration` WHERE `unique_id`!='$unique_id_me' ORDER BY `unique_id` DESC";
$run1 = mysqli_query($connection, $SQL1);




while($data1 = mysqli_fetch_assoc($run1)) {
    $data = strtolower($data1['name']);
    $result = strstr($data, $search);

    if ($result) {
    
        $unique_id_fr = $data1['unique_id'];

        ?>

        <tr>
            <td class="text-center">
                <a href="./people_timeline.php?type&unique_id_fr=<?php echo $unique_id_fr ?>" target="_blank">
                    <img class="text-center rounded-circle" width="50px" height="50px" src="../pro_pic/<?php echo $data1['pro_pic'] ?>">
                </a>
            </td>

            <td class="text-center text-dark">
                <a style="color: blue" href="./people_timeline.php?type&unique_id_fr=<?php echo $unique_id_fr ?>" target="_blank"><?php echo $data1['name'] ?></a>
            </td>

            <td class="text-center text-dark">
                <button class="btn btn-sm btn-primary" onclick="forwardPostLinkToFriendfn(<?php echo $unique_id_fr ?>, <?php echo $post_id ?>, <?php echo $unique_id_me ?>, this)">Forward</button>
            </td>
        </tr>

    <?php 
    }
}









