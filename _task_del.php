<?php

include('./include/db_connect.php');

$delete = $conn->query("DELETE FROM task_list where id = ".$_GET['id']);

if($delete) {

    header("location:index.php?page=project_detail&pid=".$_GET['pid']);
}
else
{
    echo '<script>alert("Gagal menghapus task","Warning")</script>';
    header("location:index.php?page=project_detail&pid=".$_GET['pid']);
}


?>

