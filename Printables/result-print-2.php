<?php 


if(isset($_GET['rid'])) {
    require_once('pdfgen/printables.php');
    require('../core/core.php');
    $app = new mckirby();
    
    $cat = $app->getCategoryNames();
    $labr = $app->getPatientResults("WHERE id = '".$_GET['rid']."' ORDER BY date DESC");
    $labr = $labr[$_GET['rid']]; 
    $medTech = $app->getEmployees('WHERE id='.$labr['medtech_id']);
    $pathologist = $app->getEmployees('WHERE id='.$labr['pathologist_id']);

    $labs = $app->getLabTests(); 
    $patient = $app->getPatients();
    
    //print_r($labr);
    //echo "<br><br>";
    //print_r($Labs);
    //echo "<br><br>";
    //print_r($labr['resultdata']); 
    //$labTestArray = json_decode($labr['resultdata'],false);
    //print_r($labTestArray);

    print_r($labr);

    $printables = new Printables();

    if($labr['test_id'] == 35) { // routine fecalysis
        $printables->fecalysis($labr,$patient,$labs,$medTech,$pathologist);
    } else if ($labr['test_id'] == 36) { // routine urinalysis
        $printables->urinalysis($labr,$patient,$labs,$medTech,$pathologist);
    } else if ($labr['test_id'] == 37) { // Sperm analysis

    }
}
?>