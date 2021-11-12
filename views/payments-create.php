<!-- Main content -->
<?php
$settings = $app->getSettingsByName();
//echo json_encode($settings);

$response=array('action'=>"", 'message'=>"");
if(isset($_GET['pref'])){ $pref =$_GET['pref']; }else{ $pref = "po-payment"; }
if(isset($_POST['btn_save'])){
   //echo json_encode($_POST);
    $data = array('model'=>"payments",'keys'=>"company, bill_date, date_due, inclusives, discount, date_created, created_by, note");
    
        $company = $_POST['company'];
        $ids = $_POST['ids'];
        

    if(isset($_POST['id'])){
        
        $date = date("Y")."-".date("m")."-".date("d");
        if(trim($_POST['payment_class'])=="po-payment"){
          $mdl = "po";
          $cashflow = "out";
        }else{
          $mdl = "billings";
          $cashflow = "in";
        }
        $ids = json_encode($_POST['ids']);
        if(isset($_POST['md']) && trim($_POST['md'])!=""){ $mdcomsup = $_POST['md']; }
        if(isset($_POST['company']) && trim($_POST['company'])!=""){ $mdcomsup = $_POST['company']; }
        if(isset($_POST['sup']) && trim($_POST['sup'])!=""){ $mdcomsup = $_POST['sup']; }
        $dpdata = array("model"=>"payments",
                        "values"=>"amount = '".str_replace(",","",$_POST['realTotal'])."',
                                                   payment_type = '".$_POST['payment_type']."',
                                                   model = '".$mdl."',
                                                   model_id = '".$ids."',
                                                   status = 'PAID',
                                                   note = '".str_replace("'","\'",$_POST['note'])."',
                                                   payment_class = '".trim($_POST['payment_class'])."',
                                                   updated_at = '".date("Y-m-d")."', 
                                                   updated_by = '".$_SESSION['login_id']."',
                                                   cashflow = '".$cashflow."',
                                                   receipt_number = '".$_POST['receipt_number']."',
                                                   bank = '".$_POST['bank']."',
                                                   account_number = '".$_POST['account_number']."',
                                                   check_number = '".$_POST['check_number']."',
                                                   check_date = '".date("Y-m-d",strtotime($_POST['check_date']))."',
                                                   mdcomsup = '".$mdcomsup."'",
                        "condition"=>"WHERE id = '".$_POST['id']."'");
        $response = $app->update2($dpdata);
        $cond = " WHERE id='0' ";
        foreach($_POST['ids'] as $kid => $vid){ $cond .= " OR id = '$vid'"; }
        if(trim($_POST['payment_class'])=="po-payment"){
           $data_1 = array("model"=>"po", "values"=>"payment_id = '0'", "condition"=>"WHERE payment_id = '".$_POST['id']."'");
           $data3 = array("model"=>"po", "values"=>"payment_id = '".$_POST['id'] ."'", "condition"=>$cond );
        }else{
          $data_1 = array("model"=>"billings", "values"=>"payment_id = '0'", "condition"=>"WHERE payment_id = '".$_POST['id']."'");
          $data3 = array("model"=>"billings", "values"=>"payment_id = '".$_POST['id'] ."'", "condition"=>$cond );
        }
        $data3['condition'] = $cond;
        $response = $app->update2($data_1);
        $response = $app->update2($data3);

        
    }else{
        $date = date("Y")."-".date("m")."-".date("d");
        
        if(trim($_POST['payment_class'])=="po-payment"){
          $mdl = "po";
          $cashflow = "out";
        }else{
          $mdl = "billings";
          $cashflow = "in";
        }
        // echo json_encode($_POST);
        if(isset($_POST['md']) && trim($_POST['md'])!=""){ $mdcomsup = $_POST['md']; }
        if(isset($_POST['company']) && trim($_POST['company'])!=""){ $mdcomsup = $_POST['company']; }
        if(isset($_POST['sup']) && trim($_POST['sup'])!=""){ $mdcomsup = $_POST['sup']; }
        $ids = json_encode($_POST['ids']);
        $dpdata = array("model"=>"payments",
                                        "keys"=>"amount, payment_type, model, model_id, status, payment_date, note, received_by, date_received, payment_class, created_at, cashflow, receipt_number, bank, account_number, check_number, check_date, mdcomsup",
                                        "values"=>"'".str_replace(",","",$_POST['realTotal'])."',
                                                   '".$_POST['payment_type']."',
                                                   '".$mdl."',
                                                   '".$ids."',
                                                   'PAID',
                                                   '".date("Y-m-d")."',
                                                   '".str_replace("'","\'",$_POST['note'])."',
                                                   '".$_SESSION['login_id']."',
                                                   '".date("Y-m-d")."',
                                                   '".trim($_POST['payment_class'])."',
                                                   '".date("Y-m-d")."', 
                                                   '".$cashflow."',
                                                   '".$_POST['receipt_number']."',
                                                   '".$_POST['bank']."',
                                                   '".$_POST['account_number']."',
                                                   '".$_POST['check_number']."',
                                                   '".date("Y-m-d",strtotime($_POST['check_date']))."',
                                                   '".$mdcomsup."'");
        //echo "1";
        $response = $app->create2($dpdata);echo "2";
        $real_id = $response['id'];
        while(strlen($response['id'])<8){
            $response['id'] = "0".$response['id'];
        }
        $data2 = array("model"=>"payments", "values"=>"payment_number = 'PNO-".$response['id']."'");
        $data2['condition'] = " WHERE id = '".$real_id."'";
        $response = $app->update2($data2);
        //echo "3";

        $cond = " WHERE id='0' ";
        foreach($_POST['ids'] as $kid => $vid){ $cond .= " OR id = '$vid'"; }
        if(trim($_POST['payment_class'])=="po-payment"){
          $data3 = array("model"=>"po", "values"=>"payment_id = '".$real_id ."'");
        }else{
          $data3 = array("model"=>"billings", "values"=>"payment_id = '".$real_id ."'");
        }
        $data3['condition'] = $cond;
        $response = $app->update2($data3);
        //echo "4";

        $response['message'] = "Successful";
      
    }

}


//$rvalue =array();
$ret_form = "";
$d1 = date("m/d/Y");
$d2 = date("m/d/Y");
if(isset($_GET['id'])){
    $action = "Update";
    $rqdata = array("model"=>"payments", "condition"=>" WHERE id = '".$_GET['id']."'");
    $department = $app->getRecord2($rqdata);
    $rvalue = $department['data'][0];
    $pref = $rvalue['payment_class'];
    $mdcomsup = $rvalue['mdcomsup'];


    $iss = array();
    if(is_numeric($rvalue['model_id'])){
      $iss[] = $rvalue['model_id'];
    }else{
      $iss = json_decode($rvalue['model_id'], true);
    }
    $cond = "WHERE id=0 ";
    foreach ($iss as $key => $value) {
      $cond .= " OR id = '".$value."'";
    }

    if($pref=="trans-payment"){
      $mdl = "transaction";
      $recordIs = $app->getTransactions($cond);
    }
    if($pref=="expenses-payment"){
      $mdl = "expenses";
      $recordIs = $app->getExpenses($cond);
    }
    if($pref=="bill-company-payment"){
      $mdl = "billings";
      $recordIs = $app->getBillings($cond);
    }
    if($pref=="po-payment"){
      // echo json_encode($rvalue);
      $mdl = "po";
      $recordIs = $app->getPo($cond);
      // echo json_encode($rvalue);
    }
   
    $cond = " WHERE id='0' ";
    
    // $d1 = date("m/d/Y",strtotime($rvalue['date_due'])); 


}else{ $action = "Create"; }
$department = $app->getDepartments();
$emps = $app->getEmployees();
$module = explode("-",$page);
$comps = $app->getCompanies();
$doctors = $app->getDoctors();
$sups = $app->getSuppliers();
//echo $pref;
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
            <form name="" action="" method="POST" onsubmit="return recheck();">  
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                        <h4 class="modal-title" id="myModalLabel"><?php echo $action." ".ucfirst($module[0]); ?> <select name="payment_class"  id="pref">
                            <option value="po-payment" <?php if($pref=="po-payment"){ echo "selected"; } ?>>PO Payment</option> 
                            <option value="bill-company-payment" <?php if($pref=="bill-company-payment"){ echo "selected"; } ?>>Company Billing Payment</option> 
                            <option value="bill-md-payment" <?php if($pref=="bill-md-payment"){ echo "selected"; } ?>>MD Billing Payment</option> 
                        </select></h4> 
                        
                        <div class="pull-right" style="margin-top: -25px;">
                            <a href="?page=payments"><label class="btn btn-xs btn-info">Payment List</label></a> 
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
                                         $dis = 'none';
                                         if($pref=="bill-company-payment"){ $dis = 'block'; }
                                         ?>
		                                <div class="form-group" id="div_comp" style="display: <?php echo $dis; ?>;">
							                <label id="">Select Company</label>
							                <select class="form-control select2" style="width: 100%;" name="company" id="company" >
							                	<option value="">Select</option>
                                              <?php foreach($comps as $k=>$v): $sel = ""; if(isset($_GET['id']) && $mdcomsup==$v['id']){ $sel="selected"; } ?>  
							                  <option value="<?php echo $v['id']; ?>" <?php echo $sel; ?>><?php echo $v['company']; ?></option> 
                                          <?php endforeach; ?>
							                </select>
							             </div>
                                         <?php 
                                         $dis = 'none';
                                         if($pref=="bill-md-payment"){ $dis = 'block'; }
                                         ?>
                                         <div class="form-group" id="div_md" style="display: <?php echo $dis; ?>;">
                                            <label id="">Select MD</label>
                                            <select class="form-control select2" style="width: 100%;" name="md" id="md" >
                                                <option value="">Select</option>
                                              <?php 
                                              foreach($doctors as $k=>$v): $sel = ""; if(isset($_GET['id']) && $mdcomsup==$v['id']){ $sel="selected"; } ?>  
                                              <option value="<?php echo $v['id']; ?>" <?php echo $sel; ?>><?php echo $v['prename']." ".$v['fname']." ".$v['lname']; ?></option> 
                                          <?php endforeach; ?>
                                            </select>
                                         </div>


                                         <?php 
                                         // echo $mdcomsup;
                                         $dis = 'none';
                                         if($pref=="po-payment"){ $dis = 'block'; }
                                         ?>
                                         <div class="form-group" id="div_sup" style="display: <?php echo $dis; ?>;">
                                            <label id="">Select Supplier</label>
                                            <select class="form-control select2" style="width: 100%;" name="sup" id="sup" >
                                                <option value="">Select</option>
                                              <?php 
                                              foreach($sups as $k=>$v): $sel = ""; if(isset($_GET['id']) && $mdcomsup==$v['id']){ $sel="selected"; } ?>  
                                              <option value="<?php echo $v['id']; ?>" <?php echo $sel; ?>><?php echo $v['business']; ?></option> 
                                          <?php endforeach; ?>
                                            </select>
                                         </div>

							        </div>

                                    <div class="col-sm-2">
                                        

                                        <!-- <div class="form-group">
                                            <label>Date Due</label>
                                            <input type="text" name="date_due" value="<?php echo $d1; ?>" id="datepicker3" class="form-control">
                                         </div> -->
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
                                        

                                        <!-- <div class="form-group">
                                            <label>Date From</label>
                                            <input type="text" name="date1" value="<?php echo $d1; ?>" id="datepicker" class="form-control">
                                         </div> -->
                                    </div>

                                    <div class="col-sm-2">
                                        

                                        <!-- <div class="form-group">
                                            <label>Date To</label>
                                            <input type="text" name="date2" value="<?php echo $d2; ?>" id="datepicker2" class="form-control">
                                         </div> -->
                                    </div>
							    </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="box">
						            <div class="box-header">
						              <h3 class="box-title">Inclusives</h3>
						            </div>
						            <!-- /.box-header -->
						            <div class="box-body no-padding">
						              
						              <table id="example_d" class="table table-striped">
						              	<thead>
						              		<tr>
							                  <!-- <th style="width: 10px">#</th> -->
							                  <th>ID</th>
							                  <th>Legend</th>
							                  <th>Date</th>
                                <th>Due</th>
                                <th>Amount</th>
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
                                                $suppliers = $app->getSuppliers();
                                                $doctors = $app->getDoctors();
                                                $comps = $app->getCompanies();
                                                $trans = $app->getTransactions("WHERE bill_id != '0'");
                                                foreach($recordIs as $k => $v):
                                                  
                                                  
                                                  if($pref=="bill-company-payment" || $pref=="bill-md-payment"){
                                                    $inclus = json_decode($v['inclusives'], true);
                                                    $amount = 0;
                                                    $pon = $v['id'];
                                                    while(strlen($pon)<8){ $pon = "0".$pon; }
                                                    $pon = $v['bill_id'];
                                                    foreach($inclus as $ik => $iv){ 
                                                      //$amount = $amount + $iv['amount']; 
                                                      $ins = $trans[$iv]['total_amount'] - $trans[$iv]['disc'];
                                                      $amount = $amount + $ins;
                                                    }
                                                    if($pref=="bill-company-payment"){$leg=$comps[$v['company_id']]['company'];}
                                                    else{$leg=$doctors[$v['md_id']]['prename']." ".$doctors[$v['md_id']]['fname']." ".$doctors[$v['md_id']]['lname'];}
                                                    echo '<tr id="'.$pon.'" class="incount '.$pon.'"> 
                                                            <td>1</td>
                                                            <td>'.$leg.'
                                                              <input type="hidden" name="bill_id[]" id="'.$pon.'_bid" value="'.$v['id'].'"> 
                                                              <input type="hidden" name="ids[]" id="'.$pon.'_ids" value="'.$v['id'].'"> 
                                                              <input type="hidden" name="legend[]" id="'.$pon.'_legend" value="'.$leg.'"> 
                                                              <input type="hidden" name="date_bill[]" id="'.$pon.'_date_bill" value="'.$v['date_bill'].'"> 
                                                              <input type="hidden" name="date_due[]" id="'.$pon.'_date_due" value="'.$v['date_due'].'">
                                                            </td>
                                                            <td>'.$v['date_bill'].'</td>
                                                            <td>'.$v['date_due'].'</td>
                                                            <td><input style="width: 80px; text-align: right;" class="a_amount" type="text" name="amount[]" id="'.$pon.'_amount" value="'.$amount.'" readonly="">
                                                            </td>
                                                            <td><label class="badge bg-red" onclick="removeInc(\''.$pon.'\')">x</label></td></tr>';    


                                                  }
                                                  if($pref=="po-payment"){
                                                    $inclus = json_decode($v['inclusives'], true);
                                                    $amount = 0;
                                                    $pon = $v['id'];
                                                    while(strlen($pon)<8){ $pon = "0".$pon; }
                                                    $pon = "PON-".$pon;
                                                    foreach($inclus as $ik => $iv){ 
                                                      $amt = (float) str_replace(",","",$iv['amount']);
                                                      $amount = $amount +  $amt;
                                                    }
                                                    $leg=$suppliers[$v['supplier_id']]['business'];
                                                    echo '<tr id="'.$pon.'" class="incount '.$pon.'"> 
                                                            <td>1</td>
                                                            <td>'.$leg.'
                                                              <input type="hidden" name="bill_id[]" id="'.$pon.'_bid" value="'.$v['id'].'"> 
                                                              <input type="hidden" name="ids[]" id="'.$pon.'_ids" value="'.$v['id'].'"> 
                                                              <input type="hidden" name="legend[]" id="'.$pon.'_legend" value="'.$leg.'"> 
                                                              <input type="hidden" name="date_bill[]" id="'.$pon.'_date_bill" value="'.$v['date_forwarded'].'"> 
                                                              <input type="hidden" name="date_due[]" id="'.$pon.'_date_due" value="'.$v['date_received'].'">
                                                            </td>
                                                            <td>'.$v['date_forwarded'].'</td>
                                                            <td>'.$v['date_received'].'</td>
                                                            <td><input style="width: 80px; text-align: right;" class="a_amount" type="text" name="amount[]" id="'.$pon.'_amount" value="'.$amount.'" readonly="">
                                                            </td>
                                                            <td><label class="badge bg-red" onclick="removeInc(\''.$pon.'\')">x</label></td></tr>';  
                                                  }


                                                  
                                                endforeach;    
                                            }


                                            ?>

						                
						                
						              </tbody>
						              <tfoot id="dtfoot">
                                       
						              </tfoot>
						          	</table>
						          	
						            </div>
						            <!-- /.box-body -->
						          </div>

                            </div>
                            <div class="col-sm-6">
                            	<table id="example_ds" class="table table-striped">
                              <thead>
                                <tr>
                                  <!-- <th style="width: 10px">#</th> -->
                                  <th>ID</th>
                                  <th>Legend</th>
                                  <th>Date</th>
                                  <th>Due</th>
                                  <th>Amount</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody id="inctbody_ds">

                              </tbody>
                              </table>  
                            	<div  id="selector-two"></div>
                            </div>
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

$("#company").change(function(){ 
    companyChange();
    appendCalculations();
});

$("#md").change(function(){ 
    companyChange();
    appendCalculations();
});

$("#sup").change(function(){ 
    companyChange();
    appendCalculations();
});

$("#datepicker").change(function(){ 
    companyChange();
});

$("#datepicker2").change(function(){ 
    companyChange();
});

$("#pref").on("change",function(){
   //alert($(this).val());
    if($(this).val()=="bill-md-payment"){
        // $("#seltitle").text("Select MD");
        $("#div_md").attr("style","display: block;");
        $("#div_comp").attr("style","display: none;");
        $("#div_sup").attr("style","display: none;");

        $("#md").attr("required","required");
        $("#company").removeAttr("required");
        $("#sup").removeAttr("required");
    }

    if($(this).val()=="bill-company-payment"){
        // $("#seltitle").text("Select MD");

        $("#div_md").attr("style","display: none;");
        $("#div_comp").attr("style","display: block;");
        $("#div_sup").attr("style","display: none;");

        $("#md").removeAttr("required","required");
        $("#company").attr("required");
        $("#sup").removeAttr("required");
       // alert(1);
    }
    if($(this).val()=="po-payment"){
        $("#div_md").attr("style","display: none;");
        $("#div_comp").attr("style","display: none;");
        $("#div_sup").attr("style","display: block;");

        $("#md").removeAttr("required","required");
        $("#company").removeAttr("required");
        $("#sup").attr("required");
    }
    companyChange();

});

function companyChange(val = 0){
    //alert(val);
    if($("#pref").val()=="bill-md-payment"){
        var company = $("#md").val();
    }
    if($("#pref").val()=="bill-company-payment"){
        var company = $("#company").val();
    }
    if($("#pref").val()=="po-payment"){
        var company = $("#sup").val();
    }
    
    var pref = $("#pref").val();
    $.ajax({
        url: "ajax/pay.php",
        type: "post",
        data: {comp: company, p: pref} ,
        success: function (response) {
            if(val==0){
                $("#inctbody_ds").empty();
                $("#dtfoot").empty();
                $("#inctbody").empty();
            }
               
                $("#inctbody_ds").append(response);
                $("#example_ds").DataTable();
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
    var countIs = $('.incount').length;
    var total = getTotalAmount();
    //alert(total);
    if(countIs>0){
    $("#dtfoot").html("<tr><td colspan=\"4\" style=\"text-align: right;\">Total:</td><td><input style=\"width: 80px; text-align: right;\" class=\"a_amount\" type=\"text\" name=\"realTotal\" id=\"realTotal\" value=\""+total+"\" readonly></td><td></td></tr>");
    var  payment_type = 'check';
    var  bank = '';
    var  acct_no = '';
    var  check_no = '';
    var  check_date = '';
    var  receipt_no = '';
    var  amount_pad = '';
    <?php 
    if(isset($_GET['id'])){
      echo "bank='".$rvalue['bank']."';";
      echo "acct_no='".$rvalue['account_number']."';";
      echo "check_no='".$rvalue['check_number']."';";
      echo "check_date='".date("m/d/Y",strtotime($rvalue['check_date']))."';";
      echo "receipt_no='".$rvalue['receipt_number']."';";
      echo "amount_pad='".$rvalue['amount']."';";
    }
    ?>
    var html = '<div class="table-responsive">';
        html = html + '<input  type="hidden" name="vat" id="vat" value="'+total+'" >';
        html = html + '<input  type="hidden" name="wht" id="wht" value="'+total+'" >';
        html = html + '<table class="table">';
        html = html + '<tbody><tr>';
        html = html + '<th style="width:50%">Payment Type:</th>';
        html = html + '<td><select name="payment_type" required class="form-control">';
        var sel = "";
        if(payment_type=="check"){ sel = "selected"; }
        html = html + '<option value="check" '+sel+'>Check</option>';
        var sel2 = "";
        if(payment_type=="cash"){ sel2 = "selected"; }
        html = html + '<option value="cash" '+sel2+'>Cash</option>';
        html = html + '</select></td>';
        html = html + '</tr>';

        html = html + '<th style="width:50%">Bank:</th>';
        html = html + '<td><input type="text" name="bank" value="'+bank+'" required class="form-control"></td>';
        html = html + '</tr>';


        html = html + '<th style="width:50%">Account No.:</th>';
        html = html + '<td><input type="text" name="account_number" value="'+acct_no+'" required class="form-control"></td>';
        html = html + '</tr>';

        html = html + '<th style="width:50%">Check No.:</th>';
        html = html + '<td><input type="text" name="check_number" value="'+check_no+'" required class="form-control"></td>';
        html = html + '</tr>';

        html = html + '<th style="width:50%">Check Date:</th>';
        html = html + '<td><input type="text" name="check_date" value="'+check_date+'" id="datepickme" required class="form-control"></td>';
        html = html + '</tr>';


        html = html + '<th style="width:50%">Receipt Number:</th>';
        html = html + '<td><input type="text" name="receipt_number" value="'+receipt_no+'" required class="form-control"></td>';
        html = html + '</tr>';


        html = html + '<th style="width:50%">Amount Paid:</th>';
        html = html + '<td><input type="text" name="amount_paid" value="'+amount_pad+'" id="amount_paid" required class="form-control"></td>';
        html = html + '</tr>';

        // html = html + '<tr>';
        // html = html + '<th>Discount</th>';
        // html = html + '<td>'+total.toFixed(2)+'</td>';
        // html = html + '</tr>';
        // html = html + '<tr>';
        // html = html + '<th>Vat</th>';
        // html = html + '<td>'+total.toFixed(2)+'</td>';
        // html = html + '</tr>';
        // html = html + '<tr>';
        // html = html + '<th>WHT</th>';
        // html = html + '<td>'+total.toFixed(2)+'</td>';
        // html = html + '</tr>';
        // html = html + '<tr>';
        // html = html + '<th>Total Amount Due:</th>';
        // html = html + '<td>'+total.toFixed(2)+'</td>';
        // html = html + '</tr>';
        html = html + '</tbody></table><input type=\'submit\' name=\'btn_save\' value=\'<?php echo $action; ?>\'/>';
        html = html + '</div>';
    $("#additem_re").html(html);
    $("#datepickme").datepicker();
  }else{
    $("#dtfoot").empty();
    $("#additem_re").empty();
  }

}




function Addmew(id, bill_id, legend, date_bill, date_due, amount, ran){
  var countIs = $('.'+ran).length;
  var newC = count + 1;
  if(countIs==0){
  var inclusives = '<tr id="'+ran+'" class="incount '+ran+'">';
    inclusives = inclusives + '<td>'+bill_id+'</td>';
    inclusives = inclusives + '<td>'+legend+'';
    inclusives = inclusives + ' <input type="hidden" name="bill_id[]" id="'+ran+'_bid" value="'+bill_id+'">';
    inclusives = inclusives + ' <input type="hidden" name="ids[]" id="'+ran+'_ids" value="'+id+'">';
    inclusives = inclusives + ' <input type="hidden" name="legend[]" id="'+ran+'_legend" value="'+legend+'">';
    inclusives = inclusives + ' <input type="hidden" name="date_bill[]" id="'+ran+'_date_bill" value="'+date_bill+'">';
        inclusives = inclusives + ' <input type="hidden" name="date_due[]" id="'+ran+'_date_due" value="'+date_due+'">';
    inclusives = inclusives + '</td>';
    inclusives = inclusives + '<td>'+date_bill+'</td>';
    inclusives = inclusives + '<td>'+date_due+'</td>';
    inclusives = inclusives + '<td><input style="width: 80px; text-align: right;" class="a_amount" type="text" name="amount[]" id="'+ran+'_amount" value="'+amount+'" readonly></td>';
    inclusives = inclusives + '<td><label class="badge bg-red" onClick="removeInc(\''+ran+'\')">x</label></td>';
    inclusives = inclusives + '</tr>';
    $("#inctbody").append(inclusives);
    appendCalculations()
  }else{
    alert("Sorry, already exist!");
  }
}


function removeInc(id){
  $("#"+id).remove();
  $("#dtfoot").empty();
  var count = $('.incount').length;
  
        appendCalculations();
  
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
        var inps = document.getElementsByName('amount[]');
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
function recheck(){
    var amount_paid = parseFloat($("#amount_paid").val());
    var total_amount = parseFloat($("#realTotal").val());
      // alert(total_amount+" "+amount_paid);
      // if(amount_paid=="NaN"){ alert('HEY'); }
      // return false;
      if(amount_paid<total_amount || isNaN(amount_paid)){  
        
        alert("Payment for cash should be "+total_amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')); 
        $('#amount_paid').focus();
        return false; 
      }
      else{ return true; }
    
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


