<?php

include('./include/db_connect.php');

$delete = $conn->query("DELETE FROM serpo_exp where id = ".$_GET['id']);

if($delete) {

    header("location:index.php?page=serpo_detail&pid=".$_GET['pid']);
}
else
{
    echo '<script>alert("Gagal menghapus pengeluaran serpo","Warning")</script>';
    header("location:index.php?page=serpo_detail&pid=".$_GET['pid']);
}


?>

