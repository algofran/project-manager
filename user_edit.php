<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM users where id = ".$_GET['uid'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
include 'user_baru.php';
?>