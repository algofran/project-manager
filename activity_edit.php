<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM user_productivity where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
include 'activity_baru.php';
?>