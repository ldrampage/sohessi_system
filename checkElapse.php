<?php
        //include_once('../webapp/lib/functions.php');
       // error_reporting(E_ALL); ini_set('display_errors', TRUE); ini_set('display_startup_errors', TRUE);
        include "core/core.php";
        $app = new mckirby();
        date_default_timezone_set('America/New_York');
        $date = date('Y-m-d h:i:s', time());
        $sql = "SELECT * FROM tbl_employee";
        $result = mysqli_query($app->connect(),$sql) or die(mysqli_connect_error());
        $records=array();
        while($fetchData = mysqli_fetch_assoc($result)){
            $records[]=$fetchData;
        }
        //echo json_encode($records);
        $new = array();
        
       // echo json_encode($session);
        foreach($records as $k => $v){
            $session = $app->getLastSession($v['id']); 
            if($session=="[]"){  }
           // echo json_encode($session)." ?= ".$v['last_session']." ==> ".$v['fname']."<br>================<br>";
           // $v['elapse'] = $app->time_elapsed_string($v['user_Lastsession
           $et = trim($v['etimezone']);
           if(trim($v['etimezone'])==""){
               $et="Asia/Manila";
           }
             $new[] = array("form"=>"time-".$v['id'], "elapse"=> $app->time_elapsed_string($session,false,$et), "date"=>$session);
           //$new[] = array("form"=>"time-".$v['id'], "elapse"=> $app->time_elapsed_string($v['last_session']), "date"=>$v['last_session']);
            //echo time_elapsed_string($v['last_session'])."<br>";
        }
       echo json_encode($new);
?>