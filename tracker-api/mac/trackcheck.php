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
if(isset($_POST['action_taken'])){
if(trim($_POST['etimezone'])==""){
    $timezone = "Asia/Manila";
}else{
    $timezone = $_POST['etimezone'];
}}else{
    $timezone = "Asia/Manila";
}
date_default_timezone_set($timezone);
$ldate = date('Y-m-d', time());
$current_time = date("Y-m-d H:i:s", time());
if(isset($_POST['action_taken'])){
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
        $queryString = "SELECT shift_start, shift_end FROM tbl_employee WHERE id = '" .$_POST['userId']. "'" ; 
        $resulte = mysqli_query($app->connect(),$queryString) or die(mysqli_connect_error());
        $theEmp = array();
       while($edata = mysqli_fetch_assoc($resulte)){
            $theEmp[] =$edata;
        }
        //echo json_encode($theEmp);
        $current_date = date('Y-m-d', time());
        $current_time = date('H:i:s', time());
        $current_time = date("H:i:s", strtotime($current_time));
        
        $sstime = date("H:i:s", strtotime("24:00:00"));
        
        if($current_time<=$sstime){
            $current_date = date('Y-m-d', time());
            $shift_start = date("Y-m-d H:i:s", strtotime($current_date." ".$theEmp[0]['shift_start']." - 1 hour"));
            $shift_end = date("Y-m-d H:i:s", strtotime($current_date." ".$theEmp[0]['shift_start']." + 14 hour"));
        }else{
            $current_date = date('Y-m-d', strtotime($current_date." - 1 day"));
            $shift_start = date("Y-m-d H:i:s", strtotime($current_date." ".$theEmp[0]['shift_start']." - 1 hour"));
            $shift_end = date("Y-m-d H:i:s", strtotime($current_date." ".$theEmp[0]['shift_start']." + 14 hour")); 
        }
        
       
        $current_date_one = date("Y-m-d H:i:s", strtotime($current_date." 00:00:01"));
        $current_date_two = date("Y-m-d H:i:s", strtotime($current_date." 23:59:59"));
        $queryString = "SELECT * FROM tbl_timesheet WHERE userId = '" .$_POST['userId']. "' AND ( id = '".$_POST['timesheetId']."' OR (newtimein>='".$shift_start."' AND newtimein<= '".$shift_end."')) " ; 
        $result = mysqli_query($app->connect(),$queryString) or die(mysqli_connect_error());
        $responseData=array();
        $time1 = "00:00:00";
        while($fetchData = mysqli_fetch_assoc($result)){
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
                $time1 = timeComputer($time1,$time2);
        }
        echo $time1;
    }else{
        echo json_encode($result);
    }
}else{
    if(isset($_GET['userId'])){
        $queryString = "SELECT shift_start, shift_end FROM tbl_employee WHERE id = '" .$_GET['userId']. "'" ; 
        $resulte = mysqli_query($app->connect(),$queryString) or die(mysqli_connect_error());
        $theEmp = array();
        while($edata = mysqli_fetch_assoc($resulte)){
            $theEmp[] =$edata;
        }
        $current_date = date('Y-m-d', time());
        $current_time = date('H:i:s', time());
        $current_time = date("H:i:s", strtotime($current_time));
        
     
        $current_date = date('Y-m-d', strtotime($current_date." - 12 hour"));
        $shift_start = date('Y-m-d', strtotime($current_date." 00:00:00"));
        
        $shift_start_real = $theEmp[0]['shift_start'];
        $queryString = "SELECT * FROM tbl_timesheet WHERE userId = '" .$_GET['userId']. "' AND newtimein>='".$shift_start."'" ; 
       // echo $queryString;
        $result = mysqli_query($app->connect(),$queryString) or die(mysqli_connect_error());
        $tsheet = array();
        $timesheets = array();
        while($fetchData = mysqli_fetch_assoc($result)){$tsheet[]=$fetchData; }
        // echo json_encode($tsheet);
         $c=0; foreach ($tsheet as $key => $value): $c++; $ff=0;
                                $timestart = date("H:i:s", strtotime($shift_start_real));
                                $dti = date('Y-m-d', strtotime($value['timeInDate']));
                                $datestart = date("Y-m-d H:i:s", strtotime($dti." ".$timestart." - 1 hour"));
                                $dateend = date("Y-m-d H:i:s", strtotime($dti." ".$timestart." + 11 hour"));
                                $index = $datestart." to ".$dateend;
                                if(!array_key_exists($index,$timesheets)){
                                     $timesheets[$index]=array("estimated"=>"00:00:00","included"=>array());
                                }
                                if($value['newtimein']!="0000-00-00 00:00:00"){
                                    if($value['newtimeout']=="0000-00-00 00:00:00"){
                                            $timein = date('Y-m-d H:i:s', strtotime($value['newtimein']));
                                            $lastin = date('Y-m-d H:i:s', strtotime($value['newlastmin']));
                                            $start_date = new DateTime($timein);
                                            $since_start = $start_date->diff(new DateTime($lastin));
                                    }else{
                                            $timein = date('Y-m-d H:i:s', strtotime($value['newtimein']));
                                            $lastin = date('Y-m-d H:i:s', strtotime($value['newtimeout']));
                                            $start_date = new DateTime($timein);
                                            $since_start = $start_date->diff(new DateTime($lastin));
                                    }
                                }else{
                                    if($value['timeOut']=="00:00:00"){
                                            
                                            $timein = date('Y-m-d H:i:s', strtotime($value['timeIn']));
                                            $lastin = date('Y-m-d H:i:s', strtotime($value['lastMinIn']));
                                            if($timein>$lastin){
                                                $ff=1;
                                                $t1 = date('H:i:s', strtotime($timein));
                                                $t2 = date('H:i:s', strtotime("24:00:00"));
                                                $t3 = date('H:i:s', strtotime($lastin));
                                           	$new =  getTimeDiff($t1,$t2);
                                           	$newTime = timeComputer($new,$t3);
                                            }else{
                                            	$start_date = new DateTime($timein);
                                            	$since_start = $start_date->diff(new DateTime($lastin));
                                            }
                                    }else{
                                            $timein = date('Y-m-d H:i:s', strtotime($value['timeIn']));
                                            $lastin = date('Y-m-d H:i:s', strtotime($value['timeOut']));
                                            if($timein>$lastin){
                                                $ff=1;
                                                $t1 = date('H:i:s', strtotime($timein));
                                                $t2 = date('H:i:s', strtotime("24:00:00"));
                                                $t3 = date('H:i:s', strtotime($lastin));
                                           	$new =  getTimeDiff($t1,$t2);
                                           	$newTime = timeComputer($new,$t3);
                                            }else{
	                                        $start_date = new DateTime($timein);
	                                        $since_start = $start_date->diff(new DateTime($lastin));
                                            }
                                    }
                                }
                                if($ff==1){$time2=$newTime; }else{ $time2 = $since_start->h.":".$since_start->i.":".$since_start->s; }   
                                $time1 = $timesheets[$index]['estimated'];
                                $time1 = timeComputer($time1,$time2);
                                $timesheets[$index]['estimated'] =$time1;
                                $timesheets[$index]['included'][] = $value;
                                endforeach;
                                $old = "2010-01-01 00:00:00";
                                $actualDate =  "2010-01-01 00:00:00";
                                $actualTime = '00:00:00';
                                foreach($timesheets as $k => $v){
                                    $old_date = date("Y-m-d H:i:s", strtotime($old));
                                    $tmp = explode("to",$k);
                                    $tmpDate = date("Y-m-d H:i:s", strtotime(trim($tmp[0])));
                                    $new = date("Y-m-d H:i:s", strtotime($old));
                                    if($tmpDate>$old_date){
                                        $actualDate = $tmpDate;
                                        $old = $new;
                                        $actualTime = $v['estimated'];
                                    }
                                    
                                }
                                echo $actualTime;
    }
}



      
?>