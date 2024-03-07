<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM tbl_telkomakses where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
include 'telkomakses_add.php';
?>