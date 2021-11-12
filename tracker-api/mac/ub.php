<?php
error_reporting(E_ALL); ini_set('display_errors', 1); 
include $_SERVER['DOCUMENT_ROOT']."/core/api.php";
$app = new mckirby();
function timeComputer($old,$add){
    $old = explode(":", $old);
    $add = explode(":", $add);
    $newHour = $add[0]+$old[0];
    $newMin = $add[1]+$old[1];
    $newSec = $add[2]+$old[2];
    while($newSec>=60){
        $newMin = $newMin + 1;
        $newSec = $newSec - 60;
    }
    while($newMin>=60){
        $newHour = $newHour + 1;
        $newMin = $newMin - 60;
    }
    if($newMin<10){ $newMin = "0".$newMin; }
    if($newSec<10){ $newSec = "0".$newSec; }
    if($newHour<10){ $newHour = "0".$newHour; }
    return $newHour.":".$newMin.":".$newSec;
}
//echo json_encode($_POST);
if(isset($_POST['action_taken'])){
    //echo json_encode($_POST);
    if(trim($_POST['etimezone'])==""){
        $timezone = "Asia/Manila";
    }else{
        $timezone = $_POST['etimezone'];
    }
    date_default_timezone_set($timezone);
    $ldate = date('Y-m-d', time());
    $current_time = date("Y-m-d H:i:s", time());
    //$queryString = "UPDATE tbl_breaks SET newTimeEnd = '" .$current_time. "' WHERE userId = '" .$_POST['userId']. "' AND id='".$_POST['breakid']."' " ;
    $data = array("userId"=>$_POST['userId'], "newTimeEnd"=>$current_time, "breakid"=>$_POST['breakid']);  
    //echo "<br>===============".json_encode($data);
    $id = $app->updateBreak($data); 
    echo json_encode($id);
}
else{
    $timezone = "Asia/Manila";
}


?>