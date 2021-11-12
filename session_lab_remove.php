<?php 
session_start();
if(isset($_POST['session_item'])){
    if(!isset($_SESSION['lab_items'])){ $_SESSION['lab_items']=array(); }
    if(!array_key_exists($_POST['post_id'], $_SESSION['lab_items'])){
    	echo "faled";
    }else{
    	unset($_SESSION['lab_items'][$_POST['post_id']]);
    	echo "success";
    }
	
}

?>