<?php

if(isset($_GET['t'])){ $t=$_GET['t']; }else{ $t = "employee"; }
require_once("report-".trim($t).".php");
?>