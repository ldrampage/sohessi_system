<?php

include 'core/core.php';
$app=new mckirby();

if(isset($_POST['sid'])){
	$supmaterials = $app->getSupMaterials("WHERE sup_id = '".$_POST['sid']."'");
	$materials = $app->getMaterials();
	$c = $_POST['c'] + 1;
	echo "
	    <tr id='trmat_".$c."'>
	    <td>
	    <input type='hidden' name='realmaterial_id[]' id='realmat_".$c."'>
		<select class='form-control' onChange='setDetails(\"".$c."\")' id='mat_".$c."' name='material_id[]' required>
		<option value=''>Select Item</option>
		";
		  
		  foreach($supmaterials as $k=>$v){ 
		  	echo "<option value='".$v['id']."'>".$materials[$v['material_id']]['name']."</option>";
		  }

	echo "</select>
		</td>
		<td>
			<input type='text' name='qty[]' value='1' onChange=\"recalculate('".$c."')\" id='qty_".$c."'   class='form-control' required>
		</d>
		<td>
			<input type='text' name='price[]' readonly id='price_".$c."'  class='form-control' required>
		</d>
		<td>
			<input type='text' name='amount[]' readonly id='amount_".$c."'   class='form-control amounts' required>
		</d>
		<td>
			<label class='btn btn-xs btn-danger' onClick='removeItem(\"mat_".$c."\")'>x</label>
		</d>
	    </tr>	
	";
}

if(isset($_POST['gp'])){
	$supmaterials = $app->getSupMaterials("WHERE sup_id = '".$_POST['sidn']."' and id = '".$_POST['gp']."'");
	if(sizeOf($supmaterials)>0){
		echo json_encode($supmaterials[$_POST['gp']]);
	}else{
		echo json_encode($supmaterials);
	}
	
}


?>