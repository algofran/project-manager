<?php

include('./include/db_connect.php');

$delete = $conn->query("DELETE FROM iconnet_exp where id = ".$_GET['id']);

if($delete) {

    header("location:index.php?page=iconnet_detail&pid=".$_GET['pid']);
}
else
{
    echo '<script>alert("Gagal menghapus pengeluaran Iconnet","Warning")</script>';
    header("location:index.php?page=iconnet_detail&pid=".$_GET['pid']);
}


?>

