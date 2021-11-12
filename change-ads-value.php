<?php
//header('Content-Type: application/json');
include 'core/core.php'; 
$app = new mckirby();

$data = $app->updateAdsSettings($_POST);
echo json_encode($data);
?>