<?php
session_start();

require('../core/core.php');
$app = new mckirby();
if(isset($_POST['mod'])){
	if(trim($_POST['mod'])=="expenses"){
		$data = array("model"=>"expenses", "condition"=>" ORDER BY date DESC");
		$list = $app->getRecord2($data);
        $list = $list['data'];
		echo '<div class="box">
            <div class="box-header">
              <h3 class="box-title">Select Purchased via Expenses</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example_d" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Date</th>
                  <th>Receipt</th>
                  <th>Amount</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>';
    
   			foreach($list as $k=>$v):
   				// $ran = $app->RandomString(7);	
          $ran = "expenses_".$v['id']."_0";
            echo '<tr>
                  <td>'.$v['name'].'</td>
                  <td>'.$v['description'].'
                  </td>
                  <td>'.$v['date'].'</td>
                  <td>'.$v['receipt'].'</td>
                  <td>'.number_format($v['amount'],2).'</td>
                  <td><label class="btn btn-xs btn-warning" onClick="includeThis(\'expenses\', \''.$v['id'].'\',\'0\', \''.$v['name'].'\',\''.str_replace(",","",$v['amount']).'\', \''.$ran.'\')">+</label></td>
                </tr>';
            endforeach;    
                
            echo '</tbody>
                <tfoot>
                <tr>
                  <tr>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Date</th>
                  <th>Receipt</th>
                  <th>Amount</th>
                  <th></th>
                </tr>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->';
	}
	if(trim($_POST['mod'])=="po"){
		$data = array("model"=>"po", "condition"=>" WHERE date_received != '0000-00-00' ORDER BY date_received DESC");
		$list = $app->getRecord2($data);
        $list = $list['data'];
        $suppliers = $app->getSuppliers();
        $materials = $app->getMaterials();
        echo '<div class="box">
            <div class="box-header">
              <h3 class="box-title">Select Purchased Order</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example_d" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Supplier</th>
                  <th>Inclusives</th>
                  <th>Notes</th>
                  <th>Receipt</th>
                  <th>Date Received</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>';
    
   			foreach($list as $k=>$v):
           		  
                  $inc = json_decode($v['inclusives'], true);
                  foreach($inc as $inck => $incv){
                  	//$ran = $app->RandomString(7);	
                    $ran = "po_".$v['id']."_".$incv['material_id'];
                  	echo '<tr>
	                  <td>'.$suppliers[$v['supplier_id']]['business'].'</td>
	                  <td>';
                  	echo $incv['qty']." ".$materials[$incv['material_id']]['name']." (".number_format(str_replace(",","",$incv['price']),2)."/each) = ".number_format(str_replace(",","",$incv['amount']),2)."<br>";
                  	echo '</td>
	                  <td>'.$v['notes'].'</td>
	                  <td>'.$v['date_received'].'</td>
	                  <td><label class="btn btn-xs btn-warning" onClick="includeThis(\'po\', \''.$v['id'].'\', \''.$incv['material_id'].'\', \''.$materials[$incv['material_id']]['name'].'('.$incv['qty'].' qty)'.'\',\''.str_replace(",","",$incv['price']).'\', \''.$ran.'\')">+</label></td>
	                </tr>';
                  }
            
            endforeach;    
                
            echo '</tbody>
                <tfoot>
                <tr>
                  <tr>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Date</th>
                  <th>Receipt</th>
                  <th>Amount</th>
                  <th></th>
                </tr>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->';

	}
}

?>