<?php

include('./include/db_connect.php');

$delete = $conn->query("DELETE FROM users where id = ".$_GET['id']);

if($delete) {

    header("location:index.php?page=users_list");
}
else
{
    echo '<script>alert("Gagal menghapus User","Warning")</script>';
}


?>

