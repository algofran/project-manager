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
//print $data;
if(empty($id)){
    $save = $conn->query("INSERT INTO iconnet_exp set $data");
}else{
    $save = $conn->query("UPDATE iconnet_exp set $data where id = $id");
}
if($save){
    header("location:index.php?page=Iconnet");
}
else
{
   echo '<script>alert("Gagal menyimpan data pengeluaran Iconnet","Warning")</script>';
    
}
?>