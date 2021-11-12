<?php
session_start();
include "core/core.php";
$app = new mckirby();

$timezone = "Asia/Manila";
date_default_timezone_set($timezone);
$ldate = date('Y-m-d', time());

$data = $app->getEnqueued("WHERE date='".$ldate."' AND status = '0'"); // GROUP BY queuing_number
$current="+-!#";
$ren=array();
foreach($data as $k=>$v){
    if(!array_key_exists($v['queuing_number'],$ren)){ $ren[$v['queuing_number']]=array(); }
    $ren[$v['queuing_number']][]=$v;
    //echo json_encode($v)."<br>";
}    
echo "<tr>";
    echo "<td>Patient #</td>";
	echo "<td>Name</td>";
	echo "<td>Queuing #</td>";
	echo "<td>Doctor</td>";
	echo "<td>Type</td>";
	echo "<td>Inclusions</td>";
	echo "<td>Total</td>";
	if($_SESSION['acl']['process']==1){
	echo "<td>Action</td>";
}
	echo "</tr>";
foreach($ren as $k => $v){
	//echo json_encode($v)."<br>";
	echo "<tr>";
	$trans = "";
	$c=0;
	$curr="";
	$totalCost = 0;
	$items = "";
	foreach($v as $vk => $vv){ $c++; $cont=""; if($c>1){ $cont = ", "; }
		$patient_number = $vv['patient_number'];
		$patient_name = $vv['name'];
		$doctor_name = $vv['dr_name'];
		$qn = $vv['queuing_number'];
		$rdate = $vv['date'];
		$patient_type = $vv['patient_type'];
		
		
		if($curr!=$vv['trans_type']){
			$trans .= $cont.$vv['trans_type'];
		}
		$curr = $vv['trans_type'];
		$company = $vv['company'];
		if($company==0){
			$totalCost = $totalCost + $vv['price'];
			$items .= $cont. $vv['item_name']." (".number_format($vv['price'],2).")";
		}else{
			$labcomps = $app->getMyLabCompanyByTest("WHERE company_id='".$company."'");
			$totalCost = $totalCost + $labcomps[$vv['which']]['price'];
			$items .= $cont. $vv['item_name']." (".number_format($labcomps[$vv['which']]['price'],2).")";
		}
		
		//echo json_encode($vv);

	}
	echo "<td>".$patient_number."</td>";
	echo "<td>".$patient_name."</td>";
	echo "<td>".$qn."</td>";
	echo "<td>".$doctor_name."</td>";
	echo "<td>".$patient_type."</td>";
	echo "<td>".$items."</td>";
	echo "<td>".number_format($totalCost)."</td>";
	if($_SESSION['acl']['process']==1 || $_SESSION['acl']['process-delete']==1){ echo "<td>"; }
	if($_SESSION['acl']['process']==1){
		echo "<a href='?page=process&enq=".$qn."'><span class='btn btn-xs btn-warning'  style='margin: 3px;'>Process</span></a>";
	}
	if($_SESSION['acl']['process-delete']==1){
		echo "<label onClick=\"deleteProcess('".$rdate."', '".$qn."')\"><span class='btn btn-xs btn-danger'  style='margin: 3px;'>Delete</span></label>";
	}
	if($_SESSION['acl']['process']==1 || $_SESSION['acl']['process-delete']==1){ echo "</td>"; }
	
	echo "</tr>";
}

?>