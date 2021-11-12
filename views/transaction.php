<style>
    .content-wrapper {
        background:linear-gradient(rgba(255, 255, 255, 0.4), rgba(255, 255, 255, 0.4)),url('../../hr.jpeg') no-repeat center center fixed;
         -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    
    .skin-blue .content-header {
        padding: 15px 15px 15px 15px;
        background:white;
    }
   
  .info-box-icon {
    /*padding-top: 10%;*/
}
  .box-tools{
    top: 15px;
  }
  .info-box-number{
    font-size: 30px;
    font-weight: bold;
  }
table { 
    /*border-spacing: 10px;
    border-collapse: separate;*/
}
table.protable > th{
  
}
td { 
    padding: 5px;
}
th{
   padding: 5px;
   /*background-color: #dd4b39;*/
}
</style>
<script>
    function delTrans(id, trans){
      if (confirm('Are you sure you want to delete this '+trans+'?')) {
            window.location.href = "?page=<?php echo $_GET['page']; ?>&del="+id;
        }
    }
 </script> 
<?php
if(isset($_GET['del'])){

    //$gdata = array('model'=>'queuing', 'condition'=>" WHERE id = '".$_GET['del']."'");

    $trm = $app->getTransactions(" WHERE id = '".$_GET['del']."'");

    $enq = $app->getEnqueuedSimple(" WHERE queuing_number = '".$trm[$_GET['del']]['queuing_number']."' AND date = '".$trm[$_GET['del']]['trans_date']."'");
    //echo json_encode($enq);
    $condi = " WHERE id='0' ";
    foreach($enq as $kk =>$vv){ $condi .= " OR id = '".$vv['id']."'"; }
    $updata = array('model'=>'queuing', 
                    'values'=>"status='1', or_number = '', credit_slip = '' ",
                    'condition'=>$condi);
   // echo $condi;
    $res = $app->update2($updata);
    $data = array('model'=>'transaction', 'condition'=>" WHERE id = '".$_GET['del']."'");
    $response = $app->delete2($data);
    $response['message'] = "Deleted";

    $data = array('model'=>'payments', 'condition'=>" WHERE id = '".$trm[$_GET['del']]['payment_id']."'");
    $response = $app->delete2($data);
    $response['message'] = "Deleted";
    echo '<script>window.location.href = "?page='.$_GET['page'].'";</script>';
}
if(isset($_POST['credit'])){
    $data = array("model"=>"transaction",
                  "values"=>"credit_slip='".trim($_POST['credit'])."'",
                  "condition"=>" WHERE id = '".$_POST['id']."'");
    $res = $app->update2($data);
}

if(isset($_POST['acknowledgement'])){
  $data = array("model"=>"transaction",
                "values"=>"ackknowledgement='".trim($_POST['acknowledgement'])."'",
                "condition"=>" WHERE id = '".$_POST['trans_id']."'");
  $res = $app->update2($data);
}

if(isset($_POST['ftcredit_slip'])){
  $data = array("model"=>"transaction",
                "values"=>"credit_slip='".trim($_POST['ftcredit_slip'])."'",
                "condition"=>" WHERE id = '".$_POST['trans_id']."'");
  $res = $app->update2($data);
}

if(isset($_POST['or'])){
    $data = array("model"=>"transaction",
                  "values"=>"or_number='".trim($_POST['or'])."'",
                  "condition"=>" WHERE id = '".$_POST['id']."'");
    $res = $app->update2($data);

    $data = array("model"=>"queuing",
                  "values"=>"or_number='".trim($_POST['or'])."'",
                  "condition"=>" WHERE queuing_number = '".$_POST['qn']."'");
    $res = $app->update2($data);
}




date_default_timezone_set('Asia/Manila');
$current = date("Y-m-d");
$sql = "SELECT * FROM tbl_queuing WHERE status='".PROCESSED."' AND date = '".$current."' GROUP BY queuing_number  ORDER BY dtime ASC";
//echo $sql;
$result = mysqli_query($app->connect(),$sql) or die(mysqli_connect_error());
$trans  = array();
while($fetchData = mysqli_fetch_assoc($result)){
    $trans[$fetchData['id']] = $fetchData;
}
//echo json_encode($trans);
$patients = $app->getPatients();

$settings = $app->getSettingsByName();
$companies = $app->getCompanies();
$doctors = $app->getDoctors();
//echo json_encode($settings);

?>


    <section class="content">
      

      
      
      <div class="row">
        
        <div class="col-md-5">
              <!-- USERS LIST -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title"></h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger">Enqueued Patients</span>
                    <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>-->
                    <!--</button>-->
                    <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>-->
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body" id="proceed">
                  <?php
                  $today = date("Y-m-d");
                  $nowTime = date("H:i:s");
                   

                  if(isset($_POST['btn_submit'])){
                   // echo json_encode($_POST)."<br>"; exit();
                    
                    ///echo $settings['orprefix']['value'];
                    $_POST['amount_paid'] = (float) str_replace(",","",$_POST['amount_paid']);
                    $_POST['total_amount'] = (float) str_replace(",","",$_POST['total_amount']);

                    if(isset($_POST['credit_slip'])) { $credit_slip = $_POST['credit_slip']; } else  {$credit_slip=""; }
                   
                    $orNumberCon = " WHERE orprefix='".$settings['orprefix']['value']."'";
                    $orExists = $app->getTransactions($orNumberCon);
                    $numberExist = sizeOf($orExists);
                    $startNumber = (int) $settings['or_start']['value'];
                    

                    $newOrNumber = $startNumber + $numberExist;
                    if(strlen($newOrNumber)==1){ $newOrNumber = "000".$newOrNumber; }
                    if(strlen($newOrNumber)==2){ $newOrNumber = "00".$newOrNumber; }
                    if(strlen($newOrNumber)==3){ $newOrNumber = "0".$newOrNumber; }
                    //echo $newOrNumber;
                    

                    if($settings['auto_or']==0){ $newOrNumber=""; $settings['orprefix']['value']=""; }

                    $inData = array('model'=>"transaction", 
                                    "keys"=>"patient_id, trans_date, trans_time, total_amount, or_number, amount_paid, net, queuing_number, realdate, vat, wht, orprefix, transtype, md, company, disc, disc_type, credit_slip",
                                    "values"=>"'".$_POST['patient_id']."', 
                                               '".$today."',
                                               '".$nowTime."',
                                               '".$_POST['total_amount']."',
                                               '".$newOrNumber."',
                                               '".$_POST['amount_paid']."',
                                               '".$_POST['net']."',
                                               '".$_POST['qn']."',
                                               '".date("Y-m-d H:i:s")."',
                                               '".$_POST['vat']."',
                                               '".$_POST['wht']."',
                                               '".$settings['orprefix']['value']."',
                                               '".$_POST['payment_type']."',
                                               '".$_POST['md']."',
                                               '".$_POST['company']."',
                                               '".str_replace(",","",$_POST['amount_disc'])."',
                                               '".$_POST['disc']."',  
                                               '".$credit_slip."'");
                   // patient_id
                    $topay = $_POST['total_amount'] - str_replace(",","",$_POST['amount_disc']);
                    $changeIs = $_POST['amount_paid'] -  $topay;
                    $ptype=$_POST['payment_type'];
                    
                    $r = $app->create2($inData);
                    if($r['id']!=0){
                      $con = " WHERE date = '".$today."' AND queuing_number='".$_POST['qn']."' AND or_number=''";
                       $data = array("model"=>"queuing");
                       $data['values']="or_number = '".$newOrNumber."', status = '".PAID."', credit_slip = '$credit_slip'";
                       $data['condition'] = $con;
                       $response = $app->update2($data);

                       if($_POST['payment_type']==0){
                        $dpdata = array("model"=>"payments",
                                        "keys"=>"amount, payment_type, model, model_id, status, payment_date, note, received_by, date_received, payment_class, created_at, cashflow, receipt_number",
                                        "values"=>"'".str_replace(",","",$_POST['total_amount'])."',
                                                   'cash',
                                                   'transaction',
                                                   '".$r['id']."',
                                                   'PAID',
                                                   '".date("Y-m-d")."',
                                                   'Walk-in Client',
                                                   '".$_SESSION['login_id']."',
                                                   '".date("Y-m-d")."',
                                                   'trans-payment',
                                                   '".date("Y-m-d")."', 
                                                   'in',
                                                   '".$newOrNumber."'");
                        $rpd = $app->create2($dpdata);

                        $upTrans = array('model'=>"transaction",
                                        'values'=>"payment_id = '".$rpd['id']."'",
                                         'condition'=>" WHERE id = '".$r['id']."'");
                        $response = $app->update2($upTrans);
                       }

                        if($response['message']=="Successful"){

                            echo '<div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            <h4><i class="icon fa fa-check"></i></h4>
                            O.R. #: <strong>'.$newOrNumber.'</strong><br>
                            Total Amount: <strong>'.number_format($_POST['total_amount'],2).'</strong><br>
                            Discount ('.strtolower($_POST['disc']).'): <strong>'.number_format($_POST['amount_disc'],2).'</strong><br>
                            Amount Paid: <strong>'.number_format($_POST['amount_paid'],2).'</strong><br>
                            Change: <strong>'.number_format($changeIs,2).'</strong><br>
                          </div>';
                           if($ptype==0){
                              //echo '<a href="receipt-print.php?id='.$r['id'].'" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print Official Receipt</a><br>';
                           }else{
                              //echo '<a href="credit-print.php?id='.$r['id'].'" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print Credit Slip</a><br>';
                           }
                        }
                    }
                    
                  }
                  $today = $app->getTransactions(" WHERE trans_date = '".$today."' AND or_number!=''");
                  ?>

                </div>   


                <div class="box-body no-padding">
                    <div class="box-body table-responsive">
                        
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                 <th style="width:8px;"></th>
                                <th   style="text-align: center; vertical-align: middle;">ID</th>
                                <th   style="text-align: center; vertical-align: middle;">Name</th>
                                <th   style="text-align: center; vertical-align: middle;">Queuing #</th>
                                <th  style="text-align: center; vertical-align: middle;">Action</th>
                            </tr>
                            </thead>
                            <tbody id="queuing_body">
                            

                            </tbody>
                            <tfoot>
                            <tr>
                                 <th style="width:8px;"></th>
                                <th   style="text-align: center; vertical-align: middle;">ID</th>
                                <th   style="text-align: center; vertical-align: middle;">Name</th>
                                <th   style="text-align: center; vertical-align: middle;">Queuing #</th>
                                <th  style="text-align: center; vertical-align: middle;">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                  
                </div>
               
              </div>
              <!--/.box -->
        </div>

        <div class="col-md-7">
              <!-- USERS LIST -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title"></h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger">Finished Tranactions</span>
                    <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>-->
                    <!--</button>-->
                    <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>-->
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" id="proceed">
                  <?php
                  $today = date("Y-m-d");
                  $nowTime = date("H:i:s");
                  $today = $app->getTransactions(" WHERE trans_date = '".$today."'");
                  // echo "<textarea>";
                  // echo json_encode($today);
                  //  echo "</textarea>";
                  ?>
                </div>   


                <div class="box-body no-padding">
                    <div class="box-body table-responsive">
                        
                        <table id="example2" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th style="width:8px;"></th>
                                <th  style="text-align: center; vertical-align: middle;">ID/Name</th>
                                <th  style="text-align: center; vertical-align: middle;" >Queuing #</th>
                                <th  style="text-align: center; vertical-align: middle;" >OR #</th>
                                <th  style="text-align: center; vertical-align: middle;" >Credit #</th>
                                <th  style="text-align: center; vertical-align: middle;" >Acknowledgement #</th>
                                <th  style="text-align: center; vertical-align: middle;" >Amount</th>
                                <th  style="text-align: center; vertical-align: middle;">Action</th>
                            </tr>
                            </thead>
                            <tbody id="">
                            <?php $c=0; foreach($today as $k =>  $v): $c++; ?>
                              <tr>
                                <th><?php echo $c; ?></th>
                                <td><?php echo $patients[$v['patient_id']]['patient_number'] ?>/<hr style="margin-top: 5px;margin-bottom: 5px;"><?php echo $patients[$v['patient_id']]['fname']." ".$patients[$v['patient_id']]['mname']." ".$patients[$v['patient_id']]['lname']; ?></td>
                                <td><?php echo $v['queuing_number']; ?></td>
                                <td><?php if(trim($v['or_number'])!=""){ echo $v['or_number']; }else{
                                  echo '
                                  <form method="POST">
                                  <input type="hidden" name="id" value="'.$v['id'].'"  style="width: 60px;" required>
                                  <input type="hidden" name="qn" value="'.trim($v['queuing_number']).'"  style="width: 60px;" required>
                                  <input type="text" name="or"  style="width: 60px;" required>
                                  <button type="submit" class="btn btn-success btn-xs" style="margin-top: 2px; width: 60px;"><i class="fa fa-plus"></i></button><br>
                                  </form>
                                  ';
                                } ?></td>
                                <td>
                                  <?php 
                                    if($v['transtype']==1){ 
                                      if(trim($v['credit_slip'])!=""){ 
                                        echo '<span onclick="ftCreditSlip(this)"><input type="hidden" value="0"><span style="cursor:pointer; border-bottom: 1px solid;">' . $v['credit_slip'] . '</span><input type="hidden" value="'.$v['id'].'">
                                              </span>'; 
                                      } else{
                                        echo '<span onkeyup="ftCreditSlip(this)"><input type="hidden" value="1"><form method="POST"><input class="form-control input-sm" style="width:80%;" placeholder="Credit Slip" type="text" name="ftcredit_slip"><input type="hidden" name="trans_id" value="'.$v['id'].'">&nbsp;<button type="submit" class="btn btn-xs btn-warning"><i class="fa fa-plus"></i></button></form></span>';
                                      } 
                                    } else { 
                                      echo "N/A"; 
                                    } 
                                  ?>
                                </td>
                                <td>
                                  <?php 
                                    if(trim($v['ackknowledgement'])!=""){ 
                                      //echo $v['ackknowledgement']; 
                                      echo '<span onclick="ftAcknowledgement(this)"><input type="hidden" value="0"><span style="cursor:pointer; border-bottom: 1px solid">'.$v['ackknowledgement'].'</span><input type="hidden" value="'.$v['id'].'"></span>';
                                    } else {
                                      echo '<span onkeyup="ftAcknowledgement(this)"><input type="hidden" value="1"><form method="POST"><input style="width:80%;" type="text"  class="form-control input-sm" placeholder="Acknowledgement No." name="acknowledgement"><input name="trans_id" type="hidden" value="'.$v['id'].'">&nbsp;<button type="submit" class="btn btn-xs btn-warning"><i class="fa fa-plus"></i></button></form></span>';
                                      /*
                                        echo '
                                          <form method="POST">
                                          <input type="hidden" name="id" value="'.$v['id'].'"  style="width: 60px;" required>
                                          <input type="text" name="ack"  style="width: 60px;" required>
                                          <button type="submit" class="btn btn-success btn-xs" style="margin-top: 2px; width: 60px;"><i class="fa fa-plus"></i></button><br>
                                          </form>
                                          ';*/
                                    }
                                  ?>
                                </td>
                                <td><?php echo number_format($v['total_amount'],2); ?></td>
                                <td>
                                  <?php
                                  if(trim($v['or_number'])!=""){
                                  echo '<a href="receipt-print.php?id='.$v['id'].'" target="_blank" class="btn btn-success btn-xs" style="margin: 3px;"><i class="fa fa-print"></i> Print Official Receipt</a><br>';
                                  }
                                  if(trim($v['credit_slip'])!="" && $v['transtype']==1){
                                  echo '<a href="credit-print.php?id='.$v['id'].'" target="_blank" class="btn btn-warning btn-xs" style="margin: 3px;"><i class="fa fa-print"></i> Print Credit Receipt</a><br>';
                                  }
                                  if(trim($v['ackknowledgement'])!=""){
                                  echo '<a href="ack-print.php?id='.$v['id'].'" target="_blank" class="btn btn-info btn-xs" style="margin: 3px;"><i class="fa fa-print"></i> Print Acknowledgement Receipt</a><br>';
                                  }

                                  if($_SESSION['acl']['transactions-delete']==1){
                                  echo '<label  class="btn btn-danger btn-xs"  onClick=\'delTrans("'.$v['id'].'", "'.$v['queuing_number'].'")\' style="margin: 3px;"><i class="fa fa-trash"></i> Cancel</label><br>';
                                  }
                                  

                                  ?>
                                </td>
                              </tr>  
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th style="width:8px;"></th>
                                <th  style="text-align: center; vertical-align: middle;">ID/Name</th>
                                <th  style="text-align: center; vertical-align: middle;" >Queuing #</th>
                                <th  style="text-align: center; vertical-align: middle;" >OR #</th>
                                <th  style="text-align: center; vertical-align: middle;" >Credit #</th>
                                <th  style="text-align: center; vertical-align: middle;" >Acknow-ledgement #</th>
                                <th  style="text-align: center; vertical-align: middle;" >Amount</th>
                                <th  style="text-align: center; vertical-align: middle;">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                  
                </div>
               
              </div>
              <!--/.box -->
        </div>



      </div>   
      
      <div class="example-modal">
        <div class="modal" id="credit_slip_modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Credit Slip</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="credit_slip">Credit Slip No.</label>
                  <input type="text" class="form-control" name="credit_slip" id="credit_slip" value="" placeholder="Credit Slip No.">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" onclick="updateCreditSlip()" class="btn btn-primary">Submit</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>
      <!-- /.example-modal -->
      
      
    </section>
<script>

  function ftAcknowledgement(element) {
    if(element.childNodes[0].value == 0) {
      var acknowledgement = element.childNodes[1].innerHTML;
      var trans_id = element.childNodes[2].value;
      element.parentNode.innerHTML = '<span onkeyup="ftAcknowledgement(this)"><input type="hidden" value="1"><form method="POST"><input type="text" style="width:80%;" class="form-control input-sm" placeholder="Acknowledgement No." name="acknowledgement" value="'+acknowledgement+'"><input name="trans_id" type="hidden" value="'+trans_id+'">&nbsp;<button type="submit" class="btn btn-xs btn-warning"><i class="fa fa-plus"></i></button></form></span>';
      element.childNodes[1].focus();
    } else {
      //console.dir(element.childNodes);
      const acknowledgement = element.childNodes[1][0].value;
      const trans_id = element.childNodes[1][1].value;
      event.target.onkeyup = function(e){
        if(e.keyCode == 13) {
          if(acknowledgement.trim() == ""){
            element.parentNode.innerHTML = '<span onkeyup="ftAcknowledgement(this)"><input type="hidden" value="1"><form method="POST"><input type="text" style="width:80%;" class="form-control input-sm" placeholder="Acknowledgement No." name="acknowledgement" value="'+acknowledgement+'"><input name="trans_id" type="hidden" value="'+trans_id+'">&nbsp;<button type="submit" class="btn btn-xs btn-warning"><i class="fa fa-plus"></i></button></form></span>';
          } else {
            element.parentNode.innerHTML = '<span onclick="ftAcknowledgement(this)"><input type="hidden" value="0"><span style="cursor:pointer; border-bottom: 1px solid">'+acknowledgement+'</span><input type="hidden" value="'+trans_id+'"></span>';
          }
        }
      } 
    }
  }

  function ftCreditSlip(element){
    if(element.childNodes[0].value == 0) {
      var credit_slip = element.childNodes[1].innerHTML;
      var trans_id = element.childNodes[2].value;
      element.parentNode.innerHTML = '<span onkeyup="ftCreditSlip(this)"><input type="hidden" value="1"><form method="POST"><input type="text" style="width:80%;" class="form-control input-sm" placeholder="Credit Slip" name="ftcredit_slip" value="'+credit_slip+'"><input type="hidden" name="trans_id" value="'+trans_id+'">&nbsp;<button type="submit" class="btn btn-xs btn-warning"><i class="fa fa-plus"></i></button></form></span>';
    } else {
      const credit_slip = element.childNodes[1][0].value;
      const trans_id = element.childNodes[1][0].value;
      event.target.onkeyup = function(e){
        if(e.keyCode == 13) {
          if(credit_slip.trim() == "") {
            element.parentNode.innerHTML = '<span onkeyup="ftCreditSlip(this)"><input type="hidden" value="1"><form method="POST"><input type="text" style="width:80%;" class="form-control input-sm" placeholder="Credit Slip" name="ftcredit_slip" value="'+credit_slip+'"><input type="hidden" name="trans_id" value="'+trans_id+'">&nbsp;<button type="submit" class="btn btn-xs btn-warning"><i class="fa fa-plus"></i></button></form></span>';
          } else {
            element.parentNode.innerHTML = '<span onclick="ftCreditSlip(this)"><input type="hidden" value="0"><span style="cursor:pointer; border-bottom: 1px solid;">' + credit_slip + '</span><input type="hidden" value="'+ trans_id +'"></span>';
          }
          /*
          var values = "credit_slip='"+ credit_slip +"'";
          var condition = "WHERE id=" + trans_id;
          const data = {"model":"transaction", "values":values,"condition":condition};
          //console.dir(data);
          const xmlhttp = new XMLHttpRequest();

          xmlhttp.onload = function(){
            if(this.readyState == 4 && this.status == 200) {
                var obj = JSON.parse(this.responseText);
                //console.dir(this.responseText);
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'center',
                    showConfirmButton: false,
                    timer: 3000
                });

                if(obj.status == 200) {
                  Toast.fire({
                    icon: 'success',
                    title: '<h2>Your work has been saved.</h2>'
                  })
                }
            }
          }

          xmlhttp.open("POST","ajax/api.php",true);
          xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xmlhttp.send("credit="+JSON.stringify(data));
          */
        }
      }
    }

  }

/*
function ftCreditSlip(){
  var ftCreditSlipInput = $("#ftCreditSlipInput").val();
  var ftCreditSlipInputTransId = $("#ftCreditSlipInputTransId").val();
  var ftCreditSlipBody = $("#ftCreditSlipBody");
  
  //var transaction_id = ftCreditSlipBody[0].childNodes[2].value;
  
  if(ftCreditSlipInput != null){
    //console.dir(event.target);
    event.target.onkeyup = function(e) {
      if(e.keyCode == 13) {

        var ftCreditSlipInput = $("#ftCreditSlipInput").val();
        if(ftCreditSlipInput != "") {

          ftCreditSlipBody.html('<span style="cursor:pointer; border-bottom: 1px solid;" onclick="ftCreditSlip()">'+ftCreditSlipInput+'</span><input type="hidden" id="ftCreditSlipInputTransId"  value="'+ftCreditSlipInputTransId+'">');
          // update db through ajax here
          var credit_slip = "credit_slip='" + ftCreditSlipInput.trim() + "'";
          var condition = "WHERE id= '" + ftCreditSlipInputTransId.trim() + "'";

          
          const data = {"model":"transaction", "values":credit_slip,"condition":condition};

          const xmlhttp = new XMLHttpRequest();
          xmlhttp.onload = function(){
            if(this.readyState == 4 && this.status == 200) {
                var obj = JSON.parse(this.responseText);
                //console.dir(this.responseText);
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'center',
                    showConfirmButton: false,
                    timer: 3000
                });

                if(obj.status == 200) {
                  Toast.fire({
                    icon: 'success',
                    title: '<h2>Your work has been saved.</h2>'
                  })
                }
            }
          }

        xmlhttp.open("POST","ajax/api.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("credit="+JSON.stringify(data)); 

        }
      }
    }
  } else {
    //console.dir(event.target);
    ftCreditSlipBody.html('<input id="ftCreditSlipInput" onkeyup="ftCreditSlip()" type="text" value="'+event.target.innerHTML+'" required><input type="hidden" id="ftCreditSlipInputTransId" value="'+ftCreditSlipInputTransId+'">');
    var ftCreditSlipInput = $("#ftCreditSlipInput");
    ftCreditSlipInput.focus();
  } 
  
}*/


function updateCreditSlip(){
  var credit_slip = $("#credit_slip").val();
  
  if(credit_slip != "") {
    $("#thpayment_type").html("<span class='pull-left'>Credit slip No.</span><br> <input class='pull-left' type='text' name='credit_slip' value='"+credit_slip+"' readonly><button style='margin-left:5px; margin-top: 1px;' type='button' data-toggle='modal' data-target='#credit_slip_modal' class='btn btn-warning btn-xs pull-left'>Edit</button>Payment type:");
    var Toast = Swal.mixin({
      toast: true,
      position: 'center',
      showConfirmButton: false,
      timer: 3000
    });

    Toast.fire({
      icon: 'success',
      title: '<h2>Your work has been saved.</h2>'
    })
    $("#credit_slip_modal").modal("hide");
  } 
}


 function chechEnqued(){
   $.ajax({
        url: "checkEnqueued.php",
        type: "post",
        data: { en: 3 },
        success: function (response) {
          var data = JSON.parse(response);
          var stringHTML = "";
          var counter = 0;
          //alert($("#enq_count").text());
          for (val in data) { counter++;
              stringHTML += "<tr>";
              stringHTML += "<td>"+counter+"</td>";
              stringHTML += "<td>"+data[val]['patient_number']+"</td>";
              stringHTML += "<td>"+data[val]['name']+"</td>";
              stringHTML += "<td>"+data[val]['queuing_number']+"</td>";
              stringHTML += "<td><label onCLick='proceedPayment(\""+data[val]['queuing_number'].trim()+"\");' class='btn btn-xs btn-success'>Process</label></td>";
              stringHTML += "</tr>";
          }
          $("#enq_count").text(counter);
          $("#queuing_body").empty();
          $("#queuing_body").html(stringHTML);

         // alert(stringHTML);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });
}



 chechEnqued();  
    setInterval(function(){ 
        chechEnqued();  
    }, 10000);


  function proceedPayment(qnum){
    $("#proceed").empty();


    $.ajax({
        url: "checkEnqueued.php",
        type: "post",
        data: { en: 4, qn:  qnum},
        success: function (response) {
          var data = JSON.parse(response);
          var stringHTML = "";
          var counter = 0;
           stringHTML += "<div class='row' style='padding: 5px;'>";
            stringHTML += "<div class='col-md-12'>";
            stringHTML += "<label class='pull-right btn btn-xs btn-warning' style='margin-bottom: 5px; margin-right:5px;' onClick='cancelPro();'>Cancel</label>";
            stringHTML += "<div style='height: auto; width: 100%;'>";
           
            stringHTML += "<form onsubmit='return recheck();' method='post'><table border='1' class='protable' cellpadding='8' style='background-color: #; border: 1px solid #1e1e1e; padding: 5px; width: 100%;'><tr><th style='text-align: center;background-color: #8fc2fc; '>No.</th><th style='text-align: center;background-color: #8fc2fc; '>Item</th><th style='text-align: center;background-color: #8fc2fc; '>Qty</th><th style='text-align: center;background-color: #8fc2fc; '>Price</th><th style='text-align: center;background-color: #8fc2fc; width: 140px;'>Amount</th></tr>";
            var totalAmount = 0;
            var the_qn ='';
            var patient_id = '';
            var company = 0; 
            var dr_id = 0;
          for (val in data) { counter++;
              var amount = parseFloat(data[val]['price']);
              if(data[val]['dr_id']!=0){ dr_id=data[val]['dr_id']; }
              patient_id = data[val]['patient_id'];
              company = data[val]['company'];
              the_qn = data[val]['queuing_number'].trim();
              totalAmount = totalAmount +  amount;
              stringHTML += "<tr>";
              stringHTML += "<td>"+counter+"</td>";
              stringHTML += "<td>"+data[val]['item_name']+"</td>";
              stringHTML += "<td style='text-align: center;'>1</td>";
              stringHTML += "<td  style='text-align: right;'>"+Number(data[val]['price']).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+"</td>";
              stringHTML += "<td  style='text-align: right;'>"+Number(data[val]['price']).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+"</td>";
              stringHTML += "</tr>";

          }
          //alert(company);
          var wht = parseFloat(<?php echo $settings['wht']['value']; ?>) * totalAmount;
          var vat = parseFloat(<?php echo $settings['vat']['value']; ?>) * totalAmount;
          var net = (totalAmount - wht) - vat;
          stringHTML+="<tr><th colspan='4' style='text-align: right;'>Gross:</th><td id='gross'  style='text-align: right;'>"+Number(totalAmount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+"<input type='hidden' value='"+the_qn+"' name='qn'><input type='hidden' value='"+vat+"' id='vat' name='vat'><input type='hidden' value='"+wht+"' name='wht'  id='wht'></td></tr>";
           stringHTML+="<tr><th colspan='4' style='text-align: right;'>Discount: <select name='disc'><option value='NONE'>None</option><option value='PWD'>PWD</option><option value='SENIOR'>Senior</option></select></th><td  style='text-align: right;'><input type='text' onkeypress='return isNumber(event);' onChange='racal()' value='0' name='amount_disc' id='amount_disc'  class='form-control' style='width: 140px; text-align: right;' required></td></tr>"; 
          stringHTML+="<tr><th colspan='4' style='text-align: right;'>WHT:</th><td id='t_wht' style='text-align: right;'>"+Number(wht).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+"</td></tr>";
          stringHTML+="<tr><th colspan='4' style='text-align: right;'>VAT:</th><td id='t_vat' style='text-align: right;'>"+Number(vat).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+"</td></tr>";
          stringHTML+="<tr><th colspan='4' style='text-align: right;'>NET:</th><td id='t_net' style='text-align: right;'>"+Number(net).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+"</td></tr>";
          stringHTML+="<tr><th colspan='4' style='text-align: right;'>Amount Due:</th><td id='t_net' style='text-align: right;'>"+Number(totalAmount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+"</td></tr>";
         
          stringHTML+="<tr><th colspan='4' style='text-align: right;'>Amount Paid:</th><td  style='text-align: right;'><input type='hidden' value='"+patient_id+"' name='patient_id'><input type='hidden' value='"+net+"' name='net' id='net'><input type='hidden' value='"+totalAmount+"' name='total_amount'  id='total_amount'><input type='text' onkeypress='return isNumber(event);' name='amount_paid' id='amount_paid' class='form-control' style='width: 140px; text-align: right;' required></td></tr>";
          stringHTML+="<tr><th colspan='4' style='text-align: right;' id='thpayment_type'>Payment Type:</th><td  style='text-align: right;'><select name='payment_type' id='ipayment_type' onChange='typeChange()' class='form-control' required><option value='0' selected='selected'>Cash</option><option value='1'>Credit</option></select></td></tr>";

          stringHTML+="<tr id='by'><th colspan='4' style='text-align: right;'>Company Referred:</th><td  style='text-align: right;'><select name='company' id='icompany'  onChange='typeChange()' class='form-control' required><option value=''>Select</option><option value='0'>None</option>";
          <?php foreach($companies as $dk => $dv){ ?>
            stringHTML+="<option value='<?php echo $dv['id']; ?>'><?php echo $dv['company']." (".$dv['address'].")"; ?></option>";
          <?php } ?>
          stringHTML+="</select></td></tr>";
          stringHTML+="<tr id='by'><th colspan='4' style='text-align: right;'>MD Referred:</th><td  style='text-align: right;'><select name='md' id='imd' class='form-control'  onChange='typeChange()' required><option value=''>Select</option><option value='0'>None</option>";
          <?php foreach($doctors as $dk => $dv){ ?>
            stringHTML+="<option value='<?php echo $dv['id']; ?>'><?php echo $dv['prename']." ".$dv['fname']." ".$dv['lname']; ?></option>";
          <?php } ?>
          stringHTML+="</select></td></tr>";

           stringHTML+="<tr><th colspan='4' style='text-align: right;'></th><td  style='text-align: right;'><input type='submit' name='btn_submit' onClick='recheck()' class='btn btn-success btn-sm' style='width: 140px;'></td></tr>";
          stringHTML+="</table></form></div>";
          stringHTML += "</div>";
          stringHTML += "</div>";
          $("#proceed").empty();
          $("#proceed").html(stringHTML);
          $("#icompany").val(company);
          $("#imd").val(dr_id);
          //if(company!=0){ $("#ipayment_type").val(1);  } Removed -- This functionality got removed due to change request on Sept. 30, 2021 , Change was about creating a modal when user selects credit.... --> Removed cause during this method is called the default value is CREDIT and no way to trigger the modal to pop up. 
			     racal();
         // alert(stringHTML);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });




    
    // alert(qnum);
 }

 function recheck(){
    var amount_paid = parseFloat($("#amount_paid").val());
    var total_amount = parseFloat($("#total_amount").val());
    var amount_disc = $("#amount_disc").val();
    var topay = total_amount - amount_disc;
    var pt = $("#ipayment_type").val();
    if(pt==0){
      if(amount_paid<topay){  
        alert("Payment for cash should be "+topay.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')); 
        $('#amount_paid').focus();
        return false; 
      }
      else{ return true; }
    }else{
      return true;
    }
 }

 function isNumber(evt) {
    //alert(1);
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 46 || charCode > 57)) {
        return false;
    }
    return true;
}

function typeChange(){
  var compref = $("#icompany").val();
  var mdref = $("#imd").val();

  if($("#ipayment_type").val()==1){

    if(compref==0 && mdref==0){
      $("#ipayment_type").val(0);
      alert("Sorry, only company Referred and MD Referred are allowed for Credit");
      racal();
      
    } else{
      if(event.target.id == "ipayment_type"){
        $("#credit_slip_modal").modal("show");
        $("#credit_slip").val("");
        $("#credit_slip").focus();
      }
      racal();
    }

  } else{
    racal();
  }
  
}

function racal(){
  var total_amount = $("#total_amount").val();
  var amount_disc = $("#amount_disc").val();
  var wht = $("#wht").val();
  var vat = $("#vat").val();
  var wht = parseFloat(<?php echo $settings['wht']['value']; ?>) * total_amount;
  var vat = parseFloat(<?php echo $settings['vat']['value']; ?>) * total_amount;
  var net = (total_amount - wht) - vat;
  net = net - amount_disc;
  $("#net").val(net);
  $("#t_net").text(net.toFixed(2));
  var topay = total_amount - amount_disc;
  $("#amount_paid").val(topay.toFixed(2));
  $("#thpayment_type").html("Payment type:");
  if($("#ipayment_type").val()==1){$('#amount_paid').val('0.00'); $("#thpayment_type").html("<button type='button' data-toggle='modal' data-target='#credit_slip_modal' class='btn btn-warning btn-xs pull-left'>Edit</button>Payment type:") } 

}
 function cancelPro(){
    $("#proceed").empty();
 }

</script>  

