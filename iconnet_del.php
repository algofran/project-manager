<?php

include('./include/db_connect.php');

$delete = $conn->query("DELETE FROM tbl_iconnet where id = ".$_GET['id']);

if($delete) {

    header("location:index.php?page=Iconnet");
}
else
{
    echo '<script>alert("Gagal menghapus data iconnet","Warning")</script>';
    header("location:index.php?page=Iconnet");
}


?>

