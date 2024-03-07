<?php

include('./include/db_connect.php');

$delete = $conn->query("DELETE FROM telkomakses_exp where id = ".$_GET['id']);

if($delete) {

    header("location:index.php?page=telkomakses_detail&pid=".$_GET['pid']);
}
else
{
    echo '<script>alert("Gagal menghapus pengeluaran Telkom Akses","Warning")</script>';
    header("location:index.php?page=telkomakses_detail&pid=".$_GET['pid']);
}


?>

