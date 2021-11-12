<?php
//error_reporting(E_ALL); ini_set('display_errors', 1); 
//echo $_SERVER['DOCUMENT_ROOT'];
include $_SERVER['DOCUMENT_ROOT']."/core/api.php";
$app = new mckirby();
//echo json_encode($_POST);
//exit();
$login = $app->login(str_replace("'","",$_POST['un']),str_replace("'","",$_POST['pw']));
$data = $app->getSettings(); 
echo $login.$data; 
?>