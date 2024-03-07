<?php

include('./include/db_connect.php');

extract($_POST);
$data = "";
foreach($_POST as $k => $v){
    if(!in_array($k, array('id')) && !is_numeric($k)){
        
        if(empty($data)){
            $data .= " $k='$v' ";
        }else{
            $data .= ", $k='$v' ";
        }
    }
}

if(empty($id)){
    $save = $conn->query("INSERT INTO tbl_serpo set $data");
}else{
    $save = $conn->query("UPDATE tbl_serpo set $data where id = $id");
}
if($save){
    header("location:index.php?page=serpo");
    //print $data;
}
else
{
    echo '<script>alert("Gagal menyimpan data tagihan Serpo","Warning")</script>';
    header("location:index.php?page=serpo_add");
}
?>