<?php
error_reporting(E_ALL); ini_set('display_errors', 1); 
include $_SERVER['DOCUMENT_ROOT']."/core/api.php";
$app = new mckirby();

$app->checkActiveSessions(1);



      
?>