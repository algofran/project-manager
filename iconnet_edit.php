<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM tbl_iconnet where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
include 'iconnet_add.php';
?>