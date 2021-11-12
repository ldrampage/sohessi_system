<!-- Main content -->
<?php
$settings = $app->getSettingsByName();
//echo json_encode($settings);

$response=array('action'=>"", 'message'=>"");
if(isset($_GET['pref'])){ $pref =$_GET['pref']; }else{ $pref = "company"; }
if(isset($_POST['btn_save'])){
   //echo json_encode($_POST);
    $data = array('model'=>"billings",'keys'=>"company, bill_date, date_due, inclusives, discount, date_created, created_by, note");
     //$tmd = explode("/",$_POST['expdate']); 
     //$d = $tmd[2]."-".$tmd[0]."-".$tmd[1];
     //$d= date('Y-m-d',strtotime($_POST['expdate']));
     //echo $d;
        $company = $_POST['company'];
        $ids = $_POST['ids'];
        // foreach($models as $k => $v){
        //     $inclusives[] = array("model"=>$v,
        //         "id"=>$ids[$k],
        //         "name"=>$names[$k],
        //         "price"=>$prices[$k],
        //         "qty"=>$qtys[$k],
        //         "amount"=>$amounts[$k],
        //         "material_id"=>$material_ids[$k]);
        // }

    if(isset($_POST['id'])){
        
        $date = date("Y")."-".date("m")."-".date("d");

        if(isset($_POST['company'])){
            $k1 = "md_id = '0', company_id = '".$_POST['company']."', pref= 'company', ";
        }else{
            $k1 = "company_id = '0', md_id = '".$_POST['md']."', pref= 'md', ";
        }

        $data['values']= $k1 ."note = '".str_replace("'","\'",$_POST['note'])."', inclusives = '".json_encode($ids)."', date_due = '".date("Y-m-d",strtotime($_POST['date_due']))."', date_updated = '".$date."', updated_by = '".$_SESSION['login_id']."'";
        $data['condition'] = " WHERE id = '".$_POST['id']."'";
        $response = $app->update2($data);

        $data3 = array("model"=>"transaction", "values"=>"bill_id = '0'");
        $data3['condition'] = " WHERE bill_id = '".$_POST['id']."'";
        $response = $app->update2($data3);

        $cond = " WHERE id='0' ";
        foreach($ids as $kid => $vid){ $cond .= " OR id = '$vid'"; }
        $data3 = array("model"=>"transaction", "values"=>"bill_id = '".$_POST['id']."'");
        $data3['condition'] = $cond;
        $response = $app->update2($data3);
    }else{
        $date = date("Y")."-".date("m")."-".date("d");
        if(isset($_POST['company'])){
            $k1 = "company_id, pref, ";
            $v1 = "'".$_POST['company']."', 'company', ";
        }else{
            $k1 = "md_id, pref, ";
            $v1 = "'".$_POST['md']."', 'md', ";
        }
        
        $data2 = array(
            'model'=>'billings',
            'keys'=> $k1 .'date_bill, date_due, inclusives, date_created, created_by, note',
            'values'=> $v1 ."'".$date."', '".date("Y-m-d",strtotime($_POST['date_due']))."', '".json_encode($ids)."', '".$date."', '".$_SESSION['login_id']."', '".str_replace("'","\'",$_POST['note'])."'"
        );
        $response = $app->create2($data2);
        $real_id = $response['id'];
        while(strlen($response['id'])<8){
            $response['id'] = "0".$response['id'];
        }
        $data2 = array("model"=>"billings", "values"=>"bill_id = 'BID-".$response['id']."'");
        $data2['condition'] = " WHERE id = '".$real_id."'";
        $response = $app->update2($data2);

        $cond = " WHERE id='0' ";
        foreach($ids as $kid => $vid){ $cond .= " OR id = '$vid'"; }
        $data3 = array("model"=>"transaction", "values"=>"bill_id = '".$real_id ."'");
        $data3['condition'] = $cond;
        $response = $app->update2($data3);

        $response['message'] = "Successful";
      
    }

}
//$rvalue =array();
$ret_form = "";
$d1 = date("m/d/Y");
$d2 = date("m/d/Y");
if(isset($_GET['id'])){
    $action = "Update";
    $rqdata = array("model"=>"billings", "condition"=>" WHERE id = '".$_GET['id']."'");
    $department = $app->getRecord2($rqdata);
    $rvalue = $department['data'][0];
    $pref = $rvalue['pref'];
    $iss= json_decode($rvalue['inclusives'], true);
    $cond = " WHERE id='0' ";
    $trans = $app->getTransactions("WHERE bill_id = '".$_GET['id']."'");
    $d1 = date("m/d/Y",strtotime($rvalue['date_due'])); 


}else{ $action = "Create"; }
$department = $app->getDepartments();
$emps = $app->getEmployees();
$module = explode("-",$page);
$comps = $app->getCompanies();
$doctors = $app->getDoctors();
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
                        <h4 class="modal-title" id="myModalLabel"><?php echo $action." ".ucfirst($module[0]); ?> <select name="pref"  id="pref">
                            <option value="md" <?php if($pref=="md"){ echo "selected"; } ?>>MD Referred</option> 
                            <option value="company" <?php if($pref=="company"){ echo "selected"; } ?>>Company Referred</option> 
                        </select></h4> 
                        
                        <div class="pull-right" style="margin-top: -25px;">
                            <a href="?page=billings"><label class="btn btn-xs btn-info">Billing List</label></a> 
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
                                        <?php 
                                         $dis = 'block';
                                         if(isset($_GET['id']) && $rvalue['md_id']!=0){ $dis = 'none'; }
                                         ?>
		                                <div class="form-group" id="div_comp" style="display: <?php echo $dis; ?>;">
							                <label id="">Select Company</label>
							                <select class="form-control select2" style="width: 100%;" name="company" id="company" required>
							                	<option value="">Select</option>
                                              <?php foreach($comps as $k=>$v): $sel = ""; if(isset($_GET['id']) && $rvalue['company_id']==$v['id']){ $sel="selected"; } ?>  
							                  <option value="<?php echo $v['id']; ?>" <?php echo $sel; ?>><?php echo $v['company']; ?></option> 
                                          <?php endforeach; ?>
							                </select>
							             </div>
                                         <?php 
                                         $dis = 'none';
                                         if(isset($_GET['id']) && $rvalue['md_id']!=0){ $dis = 'block'; }
                                         ?>
                                         <div class="form-group" id="div_md" style="display: <?php echo $dis; ?>;">
                                            <label id="">Select MD</label>
                                            <select class="form-control select2" style="width: 100%;" name="md" id="md" >
                                                <option value="">Select</option>
                                              <?php 
                                              foreach($doctors as $k=>$v): $sel = ""; if(isset($_GET['id']) && $rvalue['md_id']==$v['id']){ $sel="selected"; } ?>  
                                              <option value="<?php echo $v['id']; ?>" <?php echo $sel; ?>><?php echo $v['prename']." ".$v['fname']." ".$v['lname']; ?></option> 
                                          <?php endforeach; ?>
                                            </select>
                                         </div>
							        </div>

                                    <div class="col-sm-2">
                                        

                                        <div class="form-group">
                                            <label>Date Due</label>
                                            <input type="text" name="date_due" value="<?php echo $d1; ?>" id="datepicker3" class="form-control">
                                         </div>
                                    </div>

                                    <div class="col-sm-2">
                                        

                                        <div class="form-group">
                                            <!-- <label>Filter:</label> -->
                                            <!-- <select class="form-control select2" style="width: 100%;" name="status" id="status" required>
                                                <option value="">Select</option>
                                              <option value="Pending" <?php //if(isset($_GET['id']) && $rvalue['status']=="Pending"){ echo "selected"; } ?>>Pending</option>
                                              <option value="Billed" <?php //if(isset($_GET['id']) && $rvalue['status']=="Returned"){ echo "selected"; } ?>>Billed</option>
                                              
                                            </select> -->
                                         </div>
                                    </div>
                                    <div class="col-sm-2">
                                        

                                        <div class="form-group">
                                            <label>Date From</label>
                                            <input type="text" name="date1" value="<?php echo $d1; ?>" id="datepicker" class="form-control">
                                         </div>
                                    </div>

                                    <div class="col-sm-2">
                                        

                                        <div class="form-group">
                                            <label>Date To</label>
                                            <input type="text" name="date2" value="<?php echo $d2; ?>" id="datepicker2" class="form-control">
                                         </div>
                                    </div>
							    </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="box">
						            <div class="box-header">
						              <h3 class="box-title">Inclusives</h3>
						            </div>
						            <!-- /.box-header -->
						            <div class="box-body no-padding">
						              <form name="" action="" method="POST">	
						              <table id="example_d" class="table table-striped">
						              	<thead>
						              		<tr>
							                  <!-- <th style="width: 10px">#</th> -->
							                  <th>Patient</th>
							                  <th>Inclusive</th>
							                  <th>Credit Slip</th>
                                              <th>Charge Slip</th>
                                              <th>Acknowledgement Slip</th>
                                              <th>Date</th>
                                              <th>Amount</th>
                                              <th>Discount</th>
							                  <th>Total Amount</th>
							                  <th></th>
							                </tr>
						              	</thead>
						                <tbody id="inctbody">

                                            <?php

                                            if(isset($_GET['id'])){
                                                
                                                $total = 0;   
                                                $inc = $app->getEnqTrans(); 
                                                $labtest = $app->getLabTests();
                                                $patients = $app->getPatients(); 
                                                foreach($trans as $k => $v):

                                                // $ran = $app->RandomString(7);    
                                                  $ran = "billings_".$v['id']."_0";
                                                    echo '<tr id="'.$ran.'" class="incount">
                                                          <td>';
                                                    if(array_key_exists($v['patient_id'], $patients)){
                                                      echo $patients[$v['patient_id']]['fname']." ".$patients[$v['patient_id']]['lname'];
                                                    }else{
                                                      echo "Unavailable";
                                                    }
                                                          
                                                    echo '</td>
                                                          <td>';
                                                    if(array_key_exists($v['trans_date'], $inc)){
                                                      if(array_key_exists($v['queuing_number'], $inc[$v['trans_date']])){
                                                          foreach($inc[$v['trans_date']][$v['queuing_number']] as $ki => $vi){
                                                            if($vi['trans_type']=="Laboratory"){
                                                              if(array_key_exists($vi['which'], $labtest)){
                                                                echo $labtest[$vi['which']]['name'];
                                                              }else{
                                                                echo "not available";
                                                              }
                                                            }else{
                                                              echo "Check-up";
                                                            }
                                                          }
                                                      }
                                                    }  
                                                    $toa = $v['total_amount'] - $v['disc'];     
                                                    echo '</td>
                                                          <td>'.$v['credit_slip'].'
                                                          </td>
                                                          <td>'.$v['charge_slip'].'</td>
                                                          <td>'.$v['ackknowledgement'].'</td>
                                                          <td>'.$v['trans_date'].'</td>
                                                          <td style="text-align: right;">'.number_format($v['total_amount'],2).'
                                                              <input type="hidden" name="total_amount[]" value="'.$v['total_amount'].'" >
                                                              <input type="hidden" name="total_amount_r[]" value="'.$toa.'" class="amounts_cal">
                                                              <input type="hidden" name="ids[]" value="'.$v['id'].'">
                                                              <input type="hidden" name="trans_date[]"  value="'.$v['trans_date'].'">
                                                              <input type="hidden" name="disc[]"  value="'.$v['disc'].'">
                                                          </td>
                                                          <td style="text-align: right;">'.number_format($v['disc'],2).'
                                                          </td>
                                                          <td style="text-align: right;">'.number_format($toa,2).'
                                                          </td>
                                                          <td><label class="btn btn-xs btn-danger" onClick="removeMe(\''.$ran.'\')">x</label></td>
                                                        </tr>';
                                                endforeach;    
                                            }


                                            ?>

						                
						                
						              </tbody>
						              <tfoot id="dtfoot">
                                       
						              </tfoot>
						          	</table>
						          	</form>
						            </div>
						            <!-- /.box-body -->
						          </div>

                            </div>
                            <!-- <div class="col-sm-6">
                            	<div  id="selector"></div>
                            	<div  id="selector-two"></div>
                            </div> -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <input type="submit" name="btn_save" class="btn btn-success fa fa-plus-square btn-sm" value="<?php echo $action; ?>"> -->
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group" style="text-align: left;">
                                    <label>Notes:</label>
                                    <textarea id="note" name="note" class="form-control"><?php if(isset($_GET['id'])){ echo $rvalue['note']; } ?></textarea>
                                </div>
                                 
                            </div>
                            <div class="col-md-4">
                                <div  id="additem_re">
                                </div>   
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
<?php if(isset($_GET['id'])){ echo "appendCalculations();"; }  ?>
$("#md").change(function(){ 
    companyChange();
});
$("#company").change(function(){ 
    companyChange();
});

$("#datepicker").change(function(){ 
    companyChange();
});

$("#datepicker2").change(function(){ 
    companyChange();
});

$("#pref").on("change",function(){
    //alert($(this).val());
    if($(this).val()=="md"){
        // $("#seltitle").text("Select MD");
        $("#div_md").attr("style","display: block;");
        $("#div_comp").attr("style","display: none;");
        $("#md").attr("required","required");
        $("#company").removeAttr("required");
    }else{
        $("#div_md").attr("style","display: none;");
        $("#div_comp").attr("style","display: block;");
        $("#company").attr("required","required");
        $("#md").removeAttr("required");
    }
    companyChange();
});

function companyChange(val = 0){
    //alert(val);
    if($("#pref").val()=="md"){
       var company = $("#md").val();
    }else{
       var company = $("#company").val();
    }
    
    var pref = $("#pref").val();
    var date1 = $("#datepicker").val();
    var date2 = $("#datepicker2").val();
    $.ajax({
        url: "ajax/comp.php",
        type: "post",
        data: {comp: company, d1: date1, d2: date2, p: pref} ,
        success: function (response) {
            if(val==0){
                $("#inctbody").empty();
                $("#dtfoot").empty();
            }
               
                $("#inctbody").append(response);
                $("#example_d").DataTable();
                // var realTotal = getvalues();
                // var totalGross = getTotalAmount();
                // var totalDisc = getDiscount();

                // $("#dtfoot").append("<tr><td colspan=\"6\" style=\"text-align: right;\">Total:</td><td><input style=\"width: 80px; text-align: right;\" class=\"a_amount\" type=\"text\" name=\"realTotal\" id=\"realTotal\" value=\""+realTotal+"\" readonly></td><td><input type='submit' name='btn_save' value='<?php echo $action; ?>'/></td></tr>");
                appendCalculations();
                 
    
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
}



function appendCalculations(){
    var realTotal = getvalues();
    var totalGross = getTotalAmount();
    var totalDisc = getDiscount();
    var vat_rate = <?php echo $settings['vat']['value']; ?>;
    var wht_rate = <?php echo $settings['wht']['value']; ?>;
    var total_vat = totalGross * vat_rate;
    var total_wht = totalGross * wht_rate;

    $("#dtfoot").append("<tr><td colspan=\"6\" style=\"text-align: right;\">Total:</td><td><input style=\"width: 80px; text-align: right;\" class=\"a_amount_gross\" type=\"text\" name=\"amount_gross\" id=\"amount_gross\" value=\""+totalGross+"\" readonly></td><td><input style=\"width: 80px; text-align: right;\" class=\"a_amount_disc\" type=\"text\" name=\"amount_discount\" id=\"amount_discount\" value=\""+totalDisc+"\" readonly></td><td><input style=\"width: 80px; text-align: right;\" class=\"a_amount\" type=\"text\" name=\"realTotal\" id=\"realTotal\" value=\""+realTotal+"\" readonly></td><td><input type='submit' name='btn_save' value='<?php echo $action; ?>'/></td></tr>");


    var html = '<div class="table-responsive">';
        html = html + '<input  type="hidden" name="vat" id="vat" value="'+total_vat+'" >';
        html = html + '<input  type="hidden" name="wht" id="wht" value="'+total_wht+'" >';
        html = html + '<table class="table">';
        html = html + '<tbody><tr>';
        html = html + '<th style="width:50%">Amount:</th>';
        html = html + '<td>'+totalGross.toFixed(2)+'</td>';
        html = html + '</tr>';
         html = html + '<tr>';
        html = html + '<th>Discount</th>';
        html = html + '<td>'+totalDisc.toFixed(2)+'</td>';
        html = html + '</tr>';
        html = html + '<tr>';
        html = html + '<th>Vat</th>';
        html = html + '<td>'+total_vat.toFixed(2)+'</td>';
        html = html + '</tr>';
        html = html + '<tr>';
        html = html + '<th>WHT</th>';
        html = html + '<td>'+total_wht.toFixed(2)+'</td>';
        html = html + '</tr>';
        html = html + '<tr>';
        html = html + '<th>Total Amount Due:</th>';
        html = html + '<td>'+totalGross.toFixed(2)+'</td>';
        html = html + '</tr>';
        html = html + '</tbody></table>';
        html = html + '</div>';
    $("#additem_re").html(html);

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

function removeMe(id){
	$("#"+id).remove();
	// var realTotal = getvalues();
 //    var totalGross = getTotalAmount();
 //    var totalDisc = getDiscount();
	$("#dtfoot").empty();
	var count = $('.incount').length;
	if(count>0){
        appendCalculations();
	   // var realTotal = getvalues();
    //             $("#dtfoot").append("<tr><td colspan=\"6\" style=\"text-align: right;\">Total:</td><td><input style=\"width: 80px; text-align: right;\" class=\"a_amount_gross\" type=\"text\" name=\"amount_gross\" id=\"amount_gross\" value=\""+totalGross+"\" readonly></td><td><input style=\"width: 80px; text-align: right;\" class=\"a_amount_disc\" type=\"text\" name=\"amount_discount\" id=\"amount_discount\" value=\""+totalDisc+"\" readonly></td><td><input style=\"width: 80px; text-align: right;\" class=\"a_amount\" type=\"text\" name=\"realTotal\" id=\"realTotal\" value=\""+realTotal+"\" readonly></td><td><input type='submit' name='btn_save' value='<?php echo $action; ?>'/></td></tr>");
	}
}
function getvalues(){
		var realTotal = 0;
		var inps = document.getElementsByName('total_amount_r[]');
		for (var i = 0; i <inps.length; i++) {
			var inp=inps[i];
		    realTotal = realTotal + parseFloat(inp.value);
		}
		return realTotal;
}
function getTotalAmount(){
        var realTotal = 0;
        var inps = document.getElementsByName('total_amount[]');
        for (var i = 0; i <inps.length; i++) {
            var inp=inps[i];
            realTotal = realTotal + parseFloat(inp.value);
        }
        return realTotal;
}
function getDiscount(){
        var realTotal = 0;
        var inps = document.getElementsByName('disc[]');
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



// function setStatusReturnText(){
//     var dateSet = "<?php echo date("m/d/Y"); ?>";
//     var name = "";
//     <?php
//     if(isset($_GET['id'])){
//         echo "dateSet = '".date("m/d/Y",strtotime($rvalue['date_returned']))."';";
//         echo "name = '".$rvalue['received_by']."';";
//     }
//     ?>
//     var ret = $("#status").val();
//     if(ret.trim() == "Returned"){
//         var html = '<div class="form-group" style="text-align: left;">';
//             html = html + '<label>Received By (Name):</label>';
//             html = html + '<input type="text" name="received_by" id="received_by" value="'+name+'" class="form-control">';
//             html = html + '</div>';
//             html = html + '<div class="form-group" style="text-align: left;">';
//             html = html + '<label>Date Returned:</label>';
//             html = html + '<input type="text" name="date_returned" value="'+dateSet+'" id="date_returned" class="form-control">';
//             html = html + '</div>';
//         $("#additem_re").append(html);   
//         $("#date_returned").datepicker({
//               autoclose: true
//           }); 
//     }else{
//         $("#additem_re").empty();   
//     }
// }
</script>


