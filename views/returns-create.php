<!-- Main content -->
<?php

$response=array('action'=>"", 'message'=>"");

if(isset($_POST['btn_save'])){
   //echo json_encode($_POST);
    $data = array('model'=>"returns",'keys'=>"model, model_id, inclusives, status, date_created, created_by");
     //$tmd = explode("/",$_POST['expdate']); 
     //$d = $tmd[2]."-".$tmd[0]."-".$tmd[1];
     //$d= date('Y-m-d',strtotime($_POST['expdate']));
     //echo $d;
     $models = $_POST['model'];
        $ids = $_POST['ids'];
        $names = $_POST['name'];
        $prices = $_POST['price'];
        $qtys = $_POST['qty'];
        $amounts = $_POST['amount'];
        $material_ids = $_POST['material_id'];
        $inclusives = array();

        foreach($models as $k => $v){
            $inclusives[] = array("model"=>$v,
                "id"=>$ids[$k],
                "name"=>$names[$k],
                "price"=>$prices[$k],
                "qty"=>$qtys[$k],
                "amount"=>$amounts[$k],
                "material_id"=>$material_ids[$k]);
        }

    if(isset($_POST['id'])){
        $addon1="";
        if(strtoupper(trim($_POST['status']))=="RETURNED"){
            //echo str_replace("'","\'",$_POST['received_by']);
            $addon1=", date_returned = '".date("Y-m-d", strtotime($_POST['date_returned']))."', received_by = '".str_replace("'","\'",$_POST['received_by'])."'";
        }
        $date = date("Y")."-".date("m")."-".date("d");
        $data['values']="note = '".str_replace("'","\'",$_POST['note'])."', inclusives = '".json_encode($inclusives)."', status = '".$_POST['status']."', date_updated = '".$date."', updated_by = '".$_SESSION['login_id']."'".$addon1;
        $data['condition'] = " WHERE id = '".$_POST['id']."'";
        $response = $app->update2($data);
    }else{
        $addon1="";
        $addon2="";
        if(strtoupper(trim($_POST['status']))=="RETURNED"){
            $addon1=", date_returned, returned_by";
            $addon2=", '".date("Y-m-d", strtotime($_POST['date_returned']))."', '".str_replace("'","\'",$_POST['returned_by'])."'";
        }
        $date = date("Y")."-".date("m")."-".date("d");
        $data2 = array(
            'model'=>'returns',
            'keys'=>'inclusives, status, date_created, created_by, note'.$addon1,
            'values'=>"'".json_encode($inclusives)."', '".$_POST['status']."', '".$date."', '".$_SESSION['login_id']."', '".str_replace("'","\'",$_POST['note'])."'".$addon2
        );
        $response = $app->create2($data2);
        $real_id = $response['id'];
        while(strlen($response['id'])<8){
            $response['id'] = "0".$response['id'];
        }
        $data2 = array("model"=>"returns", "values"=>"return_id = 'RID-".$response['id']."'");
        $data2['condition'] = " WHERE id = '".$real_id."'";
        $response = $app->update2($data2);

        $response['message'] = "Successful";
      
    }

}
//$rvalue =array();
$ret_form = "";
if(isset($_GET['id'])){
    $action = "Update";
    $rqdata = array("model"=>"returns", "condition"=>" WHERE id = '".$_GET['id']."'");
    $department = $app->getRecord2($rqdata);
    $rvalue = $department['data'][0];
    $iss= json_decode($rvalue['inclusives'], true);
    //echo json_encode($rvalue);
    foreach($iss as $k => $v){
        $ret_form = $v['model'];
    }



}else{ $action = "Create"; }
$department = $app->getDepartments();
$emps = $app->getEmployees();
$module = explode("-",$page);

?>
<section class="content" >


    <div class="row">
        <div class="col-xs-12">

            <?php

            if($response['message']=="Successful"){

                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                Record Saved Successfully!
              </div>';
            }


            ?>


        </div>
        <div class="col-xs-12">
            <form name="user" method="post" >
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                        <h4 class="modal-title" id="myModalLabel"><?php echo $action." ".ucfirst($module[0]); ?> </h4>
                        <div class="pull-right" style="margin-top: -25px;">
                            <a href="?page=returns"><label class="btn btn-xs btn-info">Returns List</label></a> 
                        </div>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-sm-12">
                            	<div class="row">
                            		<div class="col-sm-4">
		                            	<div class="form-group" style="margin-bottom: 0px; ">

		                                    <?php if(isset($_GET['id'])): ?>
		                                        <input type="hidden" class="form-control" name="id" value="<?php echo $_GET['id']; ?>" required />
                                                
		                                    <?php endif; ?>
		                                </div>

		                                <div class="form-group">
							                <label>Return From</label>
							                <select class="form-control select2" style="width: 100%;" name="model" id="model" required>
							                	<option value="">Select</option>
							                  <option value="expenses" <?php //if($ret_form=="expenses"){ echo "selected"; } ?>>Purchased Expenses</option>
							                  <option value="po" <?php //if($ret_form=="po"){ echo "selected"; } ?>>Purchased Supplies</option>
							                </select>
							             </div>
							        </div>
                                    <div class="col-sm-2">
                                        

                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control select2" style="width: 100%;" name="status" id="status" required>
                                                <option value="">Select</option>
                                              <option value="Pending" <?php //if(isset($_GET['id']) && $rvalue['status']=="Pending"){ echo "selected"; } ?>>Pending</option>
                                              <option value="Returned" <?php //if(isset($_GET['id']) && $rvalue['status']=="Returned"){ echo "selected"; } ?>>Returned</option>
                                              <option value="Refunded" <?php //if(isset($_GET['id']) && $rvalue['status']=="Refunded"){ echo "selected"; } ?>>Refunded</option>
                                              <option value="Items Changed" <?php //if(isset($_GET['id']) && $rvalue['status']=="Items Changed"){ echo "selected"; } ?>>Items Changed</option>
                                            </select>
                                         </div>
                                    </div>
							    </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="box">
						            <div class="box-header">
						              <h3 class="box-title">Return Inclusives</h3>
						            </div>
						            <!-- /.box-header -->
						            <div class="box-body no-padding">
						              <form name="" action="" method="POST">	
						              <table class="table table-striped">
						              	<thead>
						              		<tr>
							                  <!-- <th style="width: 10px">#</th> -->
							                  <th>Name</th>
							                  <th>Price</th>
							                  <th>Quantity</th>
							                  <th>Amount</th>
							                  <th></th>
							                </tr>
						              	</thead>
						                <tbody id="inctbody">

                                            <?php

                                            if(isset($_GET['id'])){
                                                
                                                $total = 0;    
                                                foreach($iss as $k => $v):

                                                // $rid = $app->RandomString2(8);
                                                $rid = $v['model']."_".$v['id']."_".$v['material_id'];
                                                $float_amount = (float) $v['amount'];
                                                $total = $total + $float_amount;
                                                echo '<tr id="'.$rid.'" class="incount '.$rid.'">
                                                    <td>'.$v['name'].'</td>
                                                    <td>5800  <input type="hidden" name="model[]" id="'.$rid.'_model" value="'.$v['model'].'"> 
                                                        <input type="hidden" name="ids[]" id="'.$rid.'_name" value="'.$v['id'].'">   
                                                        <input type="hidden" name="name[]" id="'.$rid.'_name" value="'.$v['name'].'">    
                                                        <input type="hidden" name="price[]" id="'.$rid.'_price" value="'.$v['price'].'">
                                                        <input type="hidden" name="material_id[]" id="'.$rid.'_material_id" value="'.$v['material_id'].'">
                                                    </td>
                                                    <td><input style="width: 50px; text-align: center;" type="text" name="qty[]" id="'.$rid.'_qty" onchange="reCalculate(\''.$rid.'\')" value="'.$v['qty'].'">
                                                    </td>
                                                    <td><input style="width: 80px; text-align: right;" class="a_amount" type="text" name="amount[]" id="'.$rid.'_amount" value="'.$v['amount'].'" readonly="">
                                                    </td>
                                                    <td>
                                                        <label class="badge bg-red" onclick="removeInc(\''.$rid.'\')">x</label>
                                                    </td>
                                                    </tr>';
                                                endforeach;    
                                            }


                                            ?>

						                
						                
						              </tbody>
						              <tfoot id="dtfoot">
                                        <?php 

                                        if(isset($_GET['id'])){
                                            echo '<tr>
                                                <td colspan="3" style="text-align: right;">Total:</td>
                                                <td><input style="width: 80px; text-align: right;" class="a_amount" type="text" name="realTotal" id="realTotal" value="'.$total.'" readonly=""></td>
                                                <td><input type="submit" name="btn_save" value="Update">
                                                </td></tr>';
                                        }

						              	?>
						              </tfoot>
						          	</table>
						          	</form>
						            </div>
						            <!-- /.box-body -->
						          </div>

                            </div>
                            <div class="col-sm-6">
                            	<div  id="selector"></div>
                            	<div  id="selector-two"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <input type="submit" name="btn_save" class="btn btn-success fa fa-plus-square btn-sm" value="<?php echo $action; ?>"> -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" style="text-align: left;">
                                    <label>Notes:</label>
                                    <textarea id="note" name="note" class="form-control"><?php if(isset($_GET['id'])){ echo $rvalue['note']; } ?></textarea>
                                </div>
                                <div  id="additem_re">
                                </div>    
                            </div>
                            <div class="col-md-6">
                                
                            </div>
                        </div>    
                    </div>
                </div>
            </form>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

<script>
 //   <!-- setTimeout(function(){ $("#model").val("po"); }, 3000); -->
<?php if(isset($_GET['id'])){
    
    echo '$("#model").val("'.$ret_form.'"); modelChange(1);';
    echo '$("#status").val("'.$rvalue['status'].'"); setStatusReturnText();';

    //received_by

} ?>

$("#model").change(function(){ modelChange();
	// var model = $("#model").val();
	// $.ajax({
 //        url: "ajax/fetch.php",
 //        type: "post",
 //        data: {mod: model} ,
 //        success: function (response) {
 //        	$("#inctbody").empty();
 //        	$("#selector").empty();
 //        	$("#selector").append(response);
 //        	if(model.trim()=="expenses"){
 //        		$("#example_d").DataTable();
 //        	}else{

 //        	}
        	
 //           // You will get response from your PHP page (what you echo or print)
 //        },
 //        error: function(jqXHR, textStatus, errorThrown) {
 //           console.log(textStatus, errorThrown);
 //        }
 //    });
});

function modelChange(val = 0){
    //alert(val);
    var model = $("#model").val();
    $.ajax({
        url: "ajax/fetch.php",
        type: "post",
        data: {mod: model} ,
        success: function (response) {
            if(val==0){
                $("#inctbody").empty();
                $("#dtfoot").empty();
            }
                $("#selector").empty();
                $("#selector").append(response);
            if(model.trim()=="expenses"){
                $("#example_d").DataTable();
            }else{

            }
            
           // You will get response from your PHP page (what you echo or print)
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
}


function includeThis(model, id, material_id, name, price, ran){
	var trid = makeCodeId();
	var count = $('.incount').length;
	var countIs = $('.'+ran).length;
	var newC = count + 1;
	if(countIs==0){
	var inclusives = '<tr id="'+trid+'" class="incount '+ran+'">';
		inclusives = inclusives + '<td>'+name+'</td>';
		inclusives = inclusives + '<td>'+price+'';
		inclusives = inclusives + '	<input type="hidden" name="model[]" id="'+trid+'_model" value="'+model+'">';
		inclusives = inclusives + '	<input type="hidden" name="ids[]" id="'+trid+'_name" value="'+id+'">';
		inclusives = inclusives + '	<input type="hidden" name="name[]" id="'+trid+'_name" value="'+name+'">';
		inclusives = inclusives + '	<input type="hidden" name="price[]" id="'+trid+'_price" value="'+price+'">';
        inclusives = inclusives + ' <input type="hidden" name="material_id[]" id="'+trid+'_material_id" value="'+material_id+'">';
		inclusives = inclusives + '</td>';
		inclusives = inclusives + '<td><input style="width: 50px; text-align: center;" type="text" name="qty[]" id="'+trid+'_qty" onChange="reCalculate(\''+trid+'\')" value="0"></td>';
		inclusives = inclusives + '<td><input style="width: 80px; text-align: right;" class="a_amount" type="text" name="amount[]" id="'+trid+'_amount" value="0" readonly></td>';
		inclusives = inclusives + '<td><label class="badge bg-red" onClick="removeInc(\''+trid+'\')">x</label></td>';
		inclusives = inclusives + '</tr>';
		$("#inctbody").append(inclusives);
		$("#dtfoot").empty();
		$("#dtfoot").append("<tr><td colspan=\"3\" style=\"text-align: right;\">Total:</td><td><input style=\"width: 80px; text-align: right;\" class=\"a_amount\" type=\"text\" name=\"realTotal\" id=\"realTotal\" value=\"0\" readonly></td><td><input type='submit' name='btn_save' value='<?php echo $action; ?>'/></td></tr>");
	}else{
		alert("Sorry, already exist!");
	}

}

function removeInc(id){
	$("#"+id).remove();
	var realTotal = getvalues();
	$("#dtfoot").empty();
	var count = $('.incount').length;
	if(count>0){
	$("#dtfoot").append("<tr><td colspan=\"3\" style=\"text-align: right;\">Total:</td><td><input style=\"width: 80px; text-align: right;\" class=\"a_amount\" type=\"text\" name=\"realTotal\" id=\"realTotal\" value=\""+realTotal+"\" readonly></td><td><input type='submit' name='btn_save' value='<?php echo $action; ?>'/></td></tr>");
	}
}
function getvalues(){
		var realTotal = 0;
		var inps = document.getElementsByName('amount[]');
		for (var i = 0; i <inps.length; i++) {
			var inp=inps[i];
		    realTotal = realTotal + parseFloat(inp.value);
		}
		return realTotal;
}
function reCalculate(id){
	var price = $('#'+id+'_price').val();
	var qty = $('#'+id+'_qty').val();
	var amount = parseFloat(price) * parseFloat(qty);
	$('#'+id+'_amount').val(amount);
    var realTotal = getvalues();
	$("#dtfoot").empty();
	$("#dtfoot").append("<tr><td colspan=\"3\" style=\"text-align: right;\">Total:</td><td><input style=\"width: 80px; text-align: right;\" class=\"a_amount\" type=\"text\" name=\"realTotal\" id=\"realTotal\" value=\""+realTotal+"\" readonly></td><td><input type='submit' name='btn_save' value='<?php echo $action; ?>'/></td></tr>");
}

$("#status").on("change", function(){
    setStatusReturnText();
});

function setStatusReturnText(){
    var dateSet = "<?php echo date("m/d/Y"); ?>";
    var name = "";
    <?php
    if(isset($_GET['id'])){
        echo "dateSet = '".date("m/d/Y",strtotime($rvalue['date_returned']))."';";
        echo "name = '".$rvalue['received_by']."';";
    }
    ?>
    var ret = $("#status").val();
    if(ret.trim() == "Returned"){
        var html = '<div class="form-group" style="text-align: left;">';
            html = html + '<label>Received By (Name):</label>';
            html = html + '<input type="text" name="received_by" id="received_by" value="'+name+'" class="form-control">';
            html = html + '</div>';
            html = html + '<div class="form-group" style="text-align: left;">';
            html = html + '<label>Date Returned:</label>';
            html = html + '<input type="text" name="date_returned" value="'+dateSet+'" id="date_returned" class="form-control">';
            html = html + '</div>';
        $("#additem_re").append(html);   
        $("#date_returned").datepicker({
              autoclose: true
          }); 
    }else{
        $("#additem_re").empty();   
    }
}
</script>


