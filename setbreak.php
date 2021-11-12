<?php
include "core/core.php";
$app = new mckirby();
if(trim($_POST['etimezone'])==""){
    $timezone = "Asia/Manila";
}else{
    $timezone = $_POST['etimezone'];
}
date_default_timezone_set($timezone);
$ldate = date('Y-m-d', time());
$current_time = date("Y-m-d H:i:s", time());

if(strtoupper($_POST['action_taken'])=="break"){
     $queryString = "INSERT INTO tbl_breaks(id,userId,client,project,newTimeStart,newTimeEnd,breakDate,breakType)VALUES('" .$_POST['breakid']. "','" .$_POST['userId']. "','Authoritative Content LLC','Daily Tasks','" .$current_time. "','0000-00-00 00:00:00', '".$ldate."', '" .$_POST['breaktype']. "')";
}

echo json_encode($result);


      
?>