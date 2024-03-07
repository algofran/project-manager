<?php

include('./include/db_connect.php');

$delete = $conn->query("DELETE FROM tbl_serpo where id = ".$_GET['id']);

if($delete) {

    header("location:index.php?page=serpo");
}
else
{
    echo '<script>alert("Gagal menghapus data tagihan Serpo","Warning")</script>';
    header("location:index.php?page=serpo");
}


?>

