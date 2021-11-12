<?php
include 'core/core.php';

$app = new mckirby();
// $file = "chem.txt";
// $file = "hep.txt";
// $file = "specdrug.txt";
// $file = "ultra.txt";
$file = "digi.txt";

$contents = file_get_contents($file);
//echo $contents;
$lines = explode(";;",$contents);

foreach($lines as $k=>$v){
	$d = explode(",", $v);
	//echo json_encode($d)."<br>";
	if(isset($d[1])){
		$data = array("model"=>"laboffered",
	        "keys"=>"name, price, category",
	        "values"=>"'".trim($d[0])."', '".trim($d[1])."', '18'");
		echo json_encode($data)."<br>";
		// $app->create2($data);
	}
	
}
?>