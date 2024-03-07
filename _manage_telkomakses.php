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
    $save = $conn->query("INSERT INTO tbl_telkomakses set $data");
}else{
    $save = $conn->query("UPDATE tbl_telkomakses set $data where id = $id");
}
if($save){
    header("location:index.php?page=Telkom Akses");
    //print $data;
}
else
{
    echo '<script>alert("Gagal menyimpan data iconnet","Warning")</script>';
    //header("location:index.php?page=Iconnet");
}
?>