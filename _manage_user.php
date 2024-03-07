<?php

include('./include/db_connect.php');


extract($_POST);
$data = "";
foreach($_POST as $k => $v){
    if(!in_array($k, array('id','cpass','password')) && !is_numeric($k)){
        if(empty($data)){
            $data .= " $k='$v' ";
        }else{
            $data .= ", $k='$v' ";
        }
    }

}
if(!empty($data)){
    $data .=",avatar='".$type.".png'";
}


if(!empty($password)){
            $data .= ", password=md5('$password') ";

}
$check = $conn->query("SELECT * FROM users where username ='$username' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
if($check > 0){
    echo '<script>alert("user already exist","Warning")</script>';
    echo '<script>history.back()</script>';
    exit;
}

if(empty($id)){
    $save = $conn->query("INSERT INTO users set $data");
}else{
    $save = $conn->query("UPDATE users set $data where id = $id");
}

if($save){
    header("location:index.php?page=users_list");
}
else
{
    echo '<script>alert("Failed to save user","Warning")</script>';
}
    


