<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM task_list where id = ".$_GET['tid'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
include 'task_baru.php';
?>