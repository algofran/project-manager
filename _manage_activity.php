<?php

include('./include/db_connect.php');

extract($_POST);
$data = "";
foreach($_POST as $k => $v){
    if(!in_array($k, array('id')) && !is_numeric($k)){
        if($k == 'description')
            $v = htmlentities(str_replace("'","&#;",$v));
        if(empty($data)){
            $data .= " $k='$v' ";
        }else{
            $data .= ", $k='$v' ";
        }
    }
}

echo $post;
if(empty($id)){
    $save = $conn->query("INSERT INTO user_productivity set $data");
}else{
    $save = $conn->query("UPDATE user_productivity set $data where id = $id");
}
if($save){
    header("location:index.php?page=project_detail&pid=".$_POST['project_id']);
}
else
{
    echo '<script>alert("Failed to save activity","Warning")</script>';
}
?>