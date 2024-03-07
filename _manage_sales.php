<?php

include('./include/db_connect.php');

extract($_POST);
$data = "";
foreach($_POST as $k => $v){
    if(!in_array($k, array('idsales')) && !is_numeric($k)){
        if($k == 'keterangan')
            $v = htmlentities(str_replace("'","&#;",$v));
        if(empty($data)){
            $data .= " $k='$v' ";
        }else{
            $data .= ", $k='$v' ";
        }
    }
}


if(empty($idsales)){
    $save = $conn->query("INSERT INTO sales set $data");
}else{
    $save = $conn->query("UPDATE sales set $data where idsales = $idsales");
}
if($save){
    header("location:index.php?page=penjualan");
}
else
{
    echo '<script>alert("Failed to save sales","Warning")</script>';
}
?>