<?php

include('./include/db_connect.php');

$delete = $conn->query("DELETE FROM tbl_telkomakses where id = ".$_GET['id']);

if($delete) {

    header("location:index.php?page=telkomakses");
}
else
{
    echo '<script>alert("Gagal menghapus data telkomakses","Warning")</script>';
    header("location:index.php?page=telkomakses");
}


?>

