<?php

include('./include/db_connect.php');

$delete = $conn->query("DELETE FROM user_productivity where id = ".$_GET['id']);

if($delete) {

    header("location:index.php?page=project_detail&pid=".$_GET['pid']);
}
else
{
    echo '<script>alert("Gagal menghapus activity","Warning")</script>';
    header("location:index.php?page=project_detail&pid=".$_GET['pid']);
}


?>

