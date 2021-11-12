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

<?php
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
        
        <div class="col-md-8">
              <!-- USERS LIST -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Patients</h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger"><?php echo sizeOf($trans); ?> Patients</span>
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
                    ///echo json_encode($_POST)."<br>";
                    
                    ///echo $settings['orprefix']['value'];

                   
                    $orNumberCon = " WHERE orprefix='".$settings['orprefix']['value']."'";
                    $orExists = $app->getTransactions($orNumberCon);
                    $numberExist = sizeOf($orExists);
                    $startNumber = (int) $settings['or_start']['value'];

                    $newOrNumber = $startNumber + $numberExist;
                    if(strlen($newOrNumber)==1){ $newOrNumber = "000".$newOrNumber; }
                    if(strlen($newOrNumber)==2){ $newOrNumber = "00".$newOrNumber; }
                    if(strlen($newOrNumber)==3){ $newOrNumber = "0".$newOrNumber; }
                    //echo $newOrNumber;
                    
                    $inData = array('model'=>"transaction", 
                                    "keys"=>"patient_id, trans_date, trans_time, total_amount, or_number, amount_paid, net, queuing_number, realdate, vat, wht, orprefix, transtype, md, company",
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
                                               '".$_POST['company']."'");  
                   // patient_id
                    $changeIs = $_POST['amount_paid'] -  $_POST['total_amount'];
                    $ptype=$_POST['payment_type'];
                    $r = $app->create2($inData);
                    if($r['id']!=0){
                      $con = " WHERE date = '".$today."' AND queuing_number='".$_POST['qn']."' AND or_number=''";
                       $data = array("model"=>"queuing");
                       $data['values']="or_number = '".$newOrNumber."', status = '".PAID."'";
                       $data['condition'] = $con;
                       $response = $app->update2($data);

                        if($response['message']=="Successful"){

                            echo '<div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            <h4><i class="icon fa fa-check"></i></h4>
                            O.R. #: <strong>'.$newOrNumber.'</strong><br>
                            Total Amount: <strong>'.number_format($_POST['total_amount'],2).'</strong><br>
                            Amount Paid: <strong>'.number_format($_POST['amount_paid'],2).'</strong><br>
                            Change: <strong>'.number_format($changeIs,2).'</strong><br>
                          </div>';
                           if($ptype==0){
                              echo '<a href="receipt-print.php?id='.$r['id'].'" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print Official Receipt</a><br>';
                           }else{
                              echo '<a href="credit-print.php?id='.$r['id'].'" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print Credit Slip</a><br>';
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
                                <th >ID</th>
                                <th >Name</th>
                                <th >Queuing #</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="queuing_body">
                            

                            </tbody>
                            <tfoot>
                            <tr>
                                 <th style="width:8px;"></th>
                                <th >ID</th>
                                <th >Name</th>
                                <th >Queuing #</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                  
                </div>
               
              </div>
              <!--/.box -->
        </div>

        <div class="col-md-4 col-sm-4 col-xs-4">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-credit-card"></i></span>

            <div class="info-box-content">
              <a href="index.php?page=tickets&status=0"><span class="info-box-text">Today's<br>Transactions</span></a>
              <span class="info-box-number"  id="done_count"><?php echo sizeOf($today); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-4 col-sm-4 col-xs-4">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <a href="index.php?page=tickets&status=0"><span class="info-box-text">Pending<br>Payments</span></a>
              <span class="info-box-number" id="enq_count">0</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>



      </div>      
      
      
    </section>
    
  <script>




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
           
            stringHTML += "<form method='post'><table border='1' class='protable' cellpadding='8' style='background-color: #; border: 1px solid #1e1e1e; padding: 5px; width: 100%;'><tr><th style='text-align: center;background-color: #8fc2fc; '>No.</th><th style='text-align: center;background-color: #8fc2fc; '>Item</th><th style='text-align: center;background-color: #8fc2fc; '>Qty</th><th style='text-align: center;background-color: #8fc2fc; '>Price</th><th style='text-align: center;background-color: #8fc2fc; width: 140px;'>Amount</th></tr>";
            var totalAmount = 0;
            var the_qn ='';
            var patient_id = '';
            
          for (val in data) { counter++;
              var amount = parseFloat(data[val]['price']);
              patient_id = data[val]['patient_id'];
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
          var wht = parseFloat(<?php echo $settings['wht']['value']; ?>) * totalAmount;
          var vat = parseFloat(<?php echo $settings['vat']['value']; ?>) * totalAmount;
          var net = (totalAmount - wht) - vat;
          stringHTML+="<tr><th colspan='4' style='text-align: right;'>Gross:</th><td  style='text-align: right;'>"+Number(totalAmount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+"<input type='hidden' value='"+the_qn+"' name='qn'><input type='hidden' value='"+vat+"' name='vat'><input type='hidden' value='"+wht+"' name='wht'></td></tr>";
          stringHTML+="<tr><th colspan='4' style='text-align: right;'>WHT:</th><td  style='text-align: right;'>"+Number(wht).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+"</td></tr>";
          stringHTML+="<tr><th colspan='4' style='text-align: right;'>VAT:</th><td  style='text-align: right;'>"+Number(vat).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+"</td></tr>";
          stringHTML+="<tr><th colspan='4' style='text-align: right;'>NET:</th><td  style='text-align: right;'>"+Number(net).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+"</td></tr>";
          stringHTML+="<tr><th colspan='4' style='text-align: right;'>Amount Paid:</th><td  style='text-align: right;'><input type='hidden' value='"+patient_id+"' name='patient_id'><input type='hidden' value='"+net+"' name='net'><input type='hidden' value='"+totalAmount+"' name='total_amount'><input type='text' onkeypress='return isNumber(event);' name='amount_paid' class='form-control' style='width: 140px; text-align: right;' required></td></tr>";
          stringHTML+="<tr><th colspan='4' style='text-align: right;'>Payment Type:</th><td  style='text-align: right;'><select name='payment_type' class='form-control' required><option value='0'>Cash</option><option value='1'>Credit</option></select></td></tr>";

          stringHTML+="<tr id='by'><th colspan='4' style='text-align: right;'>Company Referred:</th><td  style='text-align: right;'><select name='company' class='form-control' required><option value=''>Select</option><option value='0'>None</option>";
          <?php foreach($companies as $dk => $dv){ ?>
            stringHTML+="<option value='<?php echo $dv['id']; ?>'><?php echo $dv['company']." (".$dv['address'].")"; ?></option>";
          <?php } ?>
          stringHTML+="</select></td></tr>";

          stringHTML+="<tr id='by'><th colspan='4' style='text-align: right;'>MD Referred:</th><td  style='text-align: right;'><select name='md' class='form-control' required><option value=''>Select</option><option value='0'>None</option>";
          <?php foreach($doctors as $dk => $dv){ ?>
            stringHTML+="<option value='<?php echo $dv['id']; ?>'><?php echo $dv['prename']." ".$dv['fname']." ".$dv['lname']; ?></option>";
          <?php } ?>
          stringHTML+="</select></td></tr>";

           stringHTML+="<tr><th colspan='4' style='text-align: right;'></th><td  style='text-align: right;'><input type='submit' name='btn_submit' class='btn btn-success btn-sm' style='width: 140px;'></td></tr>";
          stringHTML+="</table></form></div>";
          stringHTML += "</div>";
          stringHTML += "</div>";

          $("#proceed").empty();
          $("#proceed").html(stringHTML);

         // alert(stringHTML);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });




    
    // alert(qnum);
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

 function cancelPro(){
    $("#proceed").empty();
 }

</script>  

