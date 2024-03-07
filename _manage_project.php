<?php

include('./include/db_connect.php');
extract($_POST);
$data = "";
foreach($_POST as $k => $v){
    if(!in_array($k, array('id','user_ids')) && !is_numeric($k)){
        if(empty($data)){
            $data .= " $k='$v' ";
        }else{
            $data .= ", $k='$v' ";
        }
    }
}

if(isset($user_ids)){
    $data .= ", user_ids='".implode(',',$user_ids)."' ";
}
//echo $data;exit;


if(empty($id)){
    $save = $conn->query("INSERT INTO project_list set $data");
}else{
    $save = $conn->query("UPDATE project_list set $data where id = $id");
}
if($save){
    header("location:index.php?page=project_list");
}
else
{
    echo '<script>alert("Failed to save project","Warning")</script>';
}



?>