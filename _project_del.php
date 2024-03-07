<?php

include('./include/db_connect.php');

if (isset($_GET["status"])) {
   $status=$_GET["status"];
}
else
{
    $status="1";
}
$delete = $conn->query("DELETE FROM project_list where id = '".$_GET["id"]."'");
$delete = $conn->query("DELETE FROM task_list where project_id = '".$_GET["id"]."'");
$delete = $conn->query("DELETE FROM user_productivity where project_id = '".$_GET["id"]."'");
if($delete){

    //header("location:index.php?page=project_list&status=".$status);
    header("location:index.php?page=project_active");
}
else
{
    echo '<script>alert("Gagal menghapus project","Warning")</script>';
}


?>