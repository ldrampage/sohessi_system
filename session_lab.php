<?php 
session_start();
if(isset($_POST['session_item'])){
    if(!isset($_SESSION['lab_items'])){ $_SESSION['lab_items']=array(); }
    if(!array_key_exists($_POST['post_id'], $_SESSION['lab_items'])){
    	$_SESSION['lab_items'][$_POST['post_id']] = array("lab_id"=>$_POST['post_id'], "lab_name"=>$_POST['post_name'], "lab_price"=>$_POST['post_price'], "lab_pq"=>$_POST['post_pq'] );
    	echo "success";
    }else{
    	echo "exists";
    }
	
}

?>