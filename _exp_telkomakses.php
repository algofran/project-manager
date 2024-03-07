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
    $save = $conn->query("INSERT INTO telkomakses_exp set $data");
}else{
    $save = $conn->query("UPDATE telkomakses_exp set $data where id = $id");
}
if($save){
    header("location:index.php?page=Telkom Akses");
}
else
{
   echo '<script>alert("Gagal menyimpan data pengeluaran Telkom Akses","Warning")</script>';
    
}
?>