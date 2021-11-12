<?php
$path    = 'softwares';
$files = scandir($path);
$files = array_diff(scandir($path), array('.', '..'));
if(isset($_POST['version'])){
    $p = $_POST['version'];
    foreach($files as $file){
        $latest = $file;
    }
    $latest = str_replace(".zip","",$latest);
    if($latest!=$p){
        echo "http://hr.backoffice-services.net/softwares/$latest.zip";
    }else{
        echo "updated";
    }
}



?>