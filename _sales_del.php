<?php

include('./include/db_connect.php');

$delete = $conn->query("DELETE FROM sales where idsales = ".$_GET['id']);

if($delete) {

    header("location:index.php?page=penjualan");
}
else
{
    echo '<script>alert("Gagal menghapus sales","Warning")</script>';
    header("location:index.php?page=penjualan");
}


?>

