<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM sales where idsales = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
include 'penjualan_baru.php';
?>