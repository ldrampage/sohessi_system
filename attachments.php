<?php

session_start();

header('Content-Type: text/html; charset=ISO-8859-1');
include 'core/core.php'; 
$app = new mckirby();
if(!isset($_SESSION['login_id'])){
    echo "<script>location.href='index.php?page=login';</script>";
}else{

   echo '<img src="uploads/'.$_GET['attc'].'">';   
  
}

?>