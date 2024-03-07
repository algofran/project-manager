<?php
include 'db_connect.php';
$data="test ";
$qry = $conn->query("SELECT * FROM telkomakses_exp where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	
	$$k = $v;
}
include 'telkomakses_pengeluaran.php';

?>