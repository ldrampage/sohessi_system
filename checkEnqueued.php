<?php
session_start();
include "core/core.php";
date_default_timezone_set('Asia/Manila');
$app = new mckirby();
$current = date("Y-m-d");
if(isset($_POST['en'])){

	if($_POST['en']==1){ //cons
		$condition = " WHERE trans_type='Check-up' AND date = '".$current."' AND (status='1' OR status='2')";	
		$r = $app->getEnqueued($condition);
		echo json_encode($r);
	}
	if($_POST['en']==2){ 
		$condition = " WHERE trans_type='Laboratory' AND date = '".$current."' AND (status='1' OR status='2')";	
		$r = $app->getEnqueued($condition);
		echo json_encode($r);
	}
	if($_POST['en']==3){ //From transaction
		$condition = " WHERE status='".PROCESSED."' AND date = '".$current."' GROUP BY queuing_number";
		$r = $app->getEnqueued($condition);
		echo json_encode($r);
	}
	if($_POST['en']==4){  //From transaction
		$condition = " WHERE status='".PROCESSED."' AND date = '".$current."' AND queuing_number = '".$_POST['qn']."'";
		$r = $app->getEnqueued($condition);
		echo json_encode($r);
	}

	if($_POST['en']==5){ //From consultation
		$condition = " WHERE status='".PAID."' AND date = '".$current."' AND dr_id = '".$_POST['did']."' GROUP BY queuing_number";
		$r = $app->getEnqueued($condition);
		echo json_encode($r);
	}
	if($_POST['en']==6){  //From consultation
		$condition = " WHERE status='".ENQ."' AND date = '".$current."' AND queuing_number = '".$_POST['qn']."'";
		$r = $app->getEnqueued($condition);
		echo json_encode($r);
	}
	if($_POST['en']==7){  //From Lab Test
		$condition = " WHERE status='".PAID."' AND date = '".$current."' AND trans_type='Laboratory' ";
		$r = $app->getEnqueuedByCat($condition);
		echo json_encode($r);
	}

	if($_POST['en']==100){ //cons
		$patient = $app->getPatients();
		$condition = " WHERE trans_type='Check-up' AND date = '".$current."' AND (status='1' OR status='0')";	
		$r = $app->getEnqueued($condition);
		// echo json_encode($r);
		$ret = "";
		$included = array();
		$count = 0;
		foreach($r as $k => $v){
			if(!array_key_exists($v['queuing_number'], $enqTrans)){
			    if(!in_array($v['queuing_number'], $included)){
			    	if($count<=5){
			    	$count++;
			    	$color = "rgb(102, 102, 102)";
			    	if($count==1){ $color = "rgb(255,0,0)"; }
			    	$st = "";
			    	if($v['status']==1){ $st = "Payment"; }
			    	 $ret .= "<tr  style='color: $color;'>
	                    <td>".$v['queuing_number']."</td>
	                    <td>".ucfirst($patient[$v['patient_id']]['fname'])."</td>
	                </tr>";
	                $included[] = $v['queuing_number'];
	            	}
			    }
            }   
        }
        echo $ret;
	}
	if($_POST['en']==101){ 
		$patient = $app->getPatients();
		$condition = " WHERE trans_type='Laboratory' AND date = '".$current."' AND (status='2')";	
		$r = $app->getEnqueued($condition);
		//echo json_encode($r)."<br><br>";
		$enqTrans = $app->getTransactionsTodayQN("WHERE trans_date = '".$current."'");
		//echo json_encode($enqTrans);
		$ret = "";
		$included = array();
		$count = 0;

		foreach($r as $k => $v){
			//echo " ==>".$v['queuing_number'];
			if(in_array($v['queuing_number'], $enqTrans)){
				//echo "hey===>";
			    if(!in_array($v['queuing_number'], $included)){
			    	if($count<=5){
			    	$count++;
			    	$color = "rgb(102, 102, 102)";
			    	if($count==1){ $color = "rgb(255,0,0)"; }
			    	$st = "";
			    	if($v['status']==1){ $st = "Payment"; }
			    	 $ret .= "<tr style='color: $color;'>
	                    <td>".$v['queuing_number']."</td>
	                    <td>".ucfirst($patient[$v['patient_id']]['fname'])."</td>
	                </tr>";
	                $included[] = $v['queuing_number'];
	            	}
			    }
			}
               
        }
        echo $ret;
	}

	if($_POST['en']==102){ 
		$patient = $app->getPatients();
		$condition = " WHERE date = '".$current."' AND (status='1' OR status='0') ORDER BY dtime ASC";	
		$r = $app->getEnqueued($condition);

		$enqTrans = $app->getTransactionsToday();
		// echo json_encode($r);
		$ret = "";
		$included = array();
		$count = 0;
		foreach($r as $k => $v){
			if(!array_key_exists($v['queuing_number'], $enqTrans)){
			    if(!in_array($v['queuing_number'], $included)){
			    	if($count<=5){
			    	$count++;
			    	$color = "rgb(102, 102, 102)";
			    	if($count==1){ $color = "rgb(255,0,0)"; }
			    	$st = "";
			    	if($v['status']==1){ $st = "Payment"; }
			    	 $ret .= "<tr  style='color: $color;'>
	                    <td>".$v['queuing_number']."</td>
	                    <td>".ucfirst($patient[$v['patient_id']]['fname'])."</td>
	                </tr>";
	                $included[] = $v['queuing_number'];
	            	}
			    }
			}
               
        }
        echo $ret;
	}


}
      
?>