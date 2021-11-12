<?php
include "core/api.php";
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
if(trim($_POST['etimezone'])==""){
    $timezone = "Asia/Manila";
}else{
    $timezone = $_POST['etimezone'];
}
date_default_timezone_set($timezone);
$ldate = date('Y-m-d', time());
$current_time = date("Y-m-d H:i:s", time());

if(strtoupper($_POST['action_taken'])=="OUT"){
     $queryString = "UPDATE tbl_timesheet SET newtimeout = '" .$current_time. "' WHERE userId = '" .$_POST['userId']. "' AND id = '" .$_POST['timesheetId']. "' ";
}
if(strtoupper($_POST['action_taken'])=="FORCEDOUT"){
     $queryString = "UPDATE tbl_timesheet SET Note = 'Forced time-out Due to no action made within 3 minutes.', newlastmin = '" .$current_time. "', newtimeout = '" .$current_time. "' WHERE userId = '" .$_POST['userId']. "' AND id = '" .$_POST['timesheetId']. "'";
}
if(strtoupper($_POST['action_taken'])=="LATESTTIME"){
    $queryString = "UPDATE tbl_timesheet SET newlastmin = '" .$current_time. "' WHERE userId = '" .$_POST['userId']. "' AND id = '" .$_POST['timesheetId']. "'";
}
if(strtoupper($_POST['action_taken'])=="UPDATEBREAK"){
   $queryString = "UPDATE tbl_breaks SET newTimeEnd = '" .$current_time. "' WHERE userId = '" .$_POST['userId']. "' AND newTimeEnd='0000-00-00 00:00:00' " ; 
}
if(strtoupper($_POST['action_taken'])=="TIME-IN"){
    $queryString= "INSERT INTO tbl_timesheet(id,userId,client,project,newtimein,newtimeout,newlastmin,timeInDate,Note)VALUES('" .$_POST['id']. "','" .$_POST['userId']. "','Authoritative Content LLC', 'Daily Task', '" .$current_time. "','0000-00-00 00:00:00', '" .$current_time. "','" .$ldate. "','')";
}
//echo $queryString."<<<";
$result = mysqli_query($app->connect(),$queryString) or die(mysqli_connect_error());
if(strtoupper($_POST['action_taken'])=="LATESTTIME"){
    $current_date = date('Y-m-d', time());
    $current_date_one = date("Y-m-d H:i:s", strtotime($current_date." 00:00:01"));
    $current_date_two = date("Y-m-d H:i:s", strtotime($current_date." 23:59:59"));
    $queryString = "SELECT * FROM tbl_timesheet WHERE userId = '" .$_POST['userId']. "' AND ( id = '".$_POST['timesheetId']."' OR (newtimein>='".$current_date_one."' AND newtimein<= '".$current_date_two."')) " ; 
    $result = mysqli_query($app->connect(),$queryString) or die(mysqli_connect_error());
    $responseData=array();
    $time1 = "00:00:00";
    while($fetchData = mysqli_fetch_assoc($result)){
        //$interval = $app->getTimeDiff(trim($fetchData['timeIn']), trim($fetchData['lastMinIn'])); //$a->diff($b);
        if($fetchData['newtimeout']=="0000-00-00 00:00:00"){
                $timein = date('Y-m-d H:i:s', strtotime($fetchData['newtimein']));
                $lastin = date('Y-m-d H:i:s', strtotime($fetchData['newlastmin']));
                $start_date = new DateTime($timein);
                $since_start = $start_date->diff(new DateTime($lastin));
        }else{
                $timein = date('Y-m-d H:i:s', strtotime($fetchData['newtimein']));
                $lastin = date('Y-m-d H:i:s', strtotime($fetchData['newtimeout']));
                $start_date = new DateTime($timein);
                $since_start = $start_date->diff(new DateTime($lastin));
            }
            
            $time2 = $since_start->h.":".$since_start->i.":".$since_start->s;
            //$time2 = date('H:i:s', $diff);
            $time1 = timeComputer($time1,$time2);
    }
    echo $time1;
}else{
    echo json_encode($result);
}



      
?>