<?php
// error_reporting( E_ALL ); echo "<br><br><br><br><br>asdsadsad";
$res = array('message'=>"");
if(isset($_POST['charge'])){
  
  $data = array("model"=>"queuing", "values"=>"charge_slip='".trim($_POST['charge'])."', status='".PROCESSED."'", "condition"=>"WHERE  date = '".trim($_POST['dateq'])."' AND queuing_number = '".$_GET['enq']."' AND patient_id = '".$_POST['patientid']."'");
  $res = $app->update2($data);
}

$current = date("Y-m-d");
// echo "<br><br><br><br><br>asdsadsad";
$condition = " WHERE  date = '".$current."' AND queuing_number = '".$_GET['enq']."'";
$r = $app->getEnqueued($condition);
// echo "<br><br><br><br><br>asdsadsad";
// echo json_encode($r);
$patientid = 0;
$comp = 0;
$dr = "";
$charge_slip = "";
$credit_slip="";
$or_number="";
foreach($r as $tk => $tv){ 
    $patientid=$tv['patient_id']; 
    $comp = $tv['company']; 
    $dr=$tv['dr_name']; 
    $charge_slip=$tv['charge_slip']; 
    $credit_slip=$tv['credit_slip']; 
    $or_number=$tv['or_number']; 
    $dateq=$tv['date']; 
  }
$ladoffered = $app->getLabTests();
$settings = $app->getSettingsByName();
$patients = $app->getPatients("WHERE id = '$patientid'");
$rpatient = array();
foreach($patients as $tk => $tv){ $rpatient=$tv; }
$companies = $app->getCompanies();
?>
    <!-- Main content -->
    <form method="POST" onsubmit="updateSlip()">
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> SOHESSI
            <small class="pull-right">Date: <?php echo date("Y-m-d"); ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <?php if($res['message']=="Successful"): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                Charge Slip Number Applied Successfully!
              </div>
        <?php endif; ?>
        <div class="col-sm-4 invoice-col">
          PATIENT (<?php echo $rpatient['patient_number']; ?>)
          <address>
            <strong><?php 


            echo $rpatient['prename']." ".$rpatient['fname']." ".$rpatient['mname']." ".$rpatient['lname']; ?></strong><br>
            Address: <?php echo $rpatient['address']; ?><br>
            Gender: <?php echo $rpatient['gender']; ?><br>
            Birth Date: <?php echo date("F d, Y",strtotime($rpatient['bdate'])); ?><br>
            Phone: <?php echo $rpatient['phone']; ?><br>
            Email: <?php echo $rpatient['email']; ?><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          COMPANY
          <address>
            <strong><?php if($comp==0){ echo $rpatient['position']; }else{ echo $companies[$comp]['company']; } ?></strong><br>
            <?php if($comp==0){ 
              echo "Position: ".$rpatient['occupation']; 
            }else{ 
              echo "Position: ".$rpatient['occupation']."<br>"; 
              echo "Address: ".$companies[$comp]['address']."<br>";
              echo "Phone: ".$companies[$comp]['phone']."<br>";
              echo "Email: ".$companies[$comp]['email']."<br>";
            } ?>
          </address>
          PHYSICIAN
          <address>
            <strong><?php echo  $dr;  ?></strong><br>
          
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>QUEUING #: <?php echo $_GET['enq']; ?></b><br>
          <br>
          <b>CHARGE SLIP #:</b> <span id="charge_slip_content"><input id="charge" type="text" name="charge" value="<?php  echo $charge_slip;  ?>" style="width: 150px;" required>&nbsp;&nbsp;<button  type="submit" class="btn-primary ">
            Update slip
          </button><br></span>
          
          <b>CREDIT SLIP #:</b> <?php echo $credit_slip; ?><br>
          <b>OR NUMBER:</b> <?php echo $or_number; ?><br>
          <input type="hidden" name="dateq" value="<?php echo $dateq; ?>">
          <input type="hidden" name="patientid" value="<?php echo $patientid; ?>">
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th style="border-bottom: 1px solid red;">Qty</th>
              <th style="border-bottom: 1px solid red;">Product</th>
              <th style="border-bottom: 1px solid red;">Qty</th>
              <th style="border-bottom: 1px solid red;">Price</th>
              <th style="border-bottom: 1px solid red;">Subtotal</th>
            </tr>
            </thead>
            <tbody>
            <?php $total=0; $c=0; foreach($r as $k => $v):
            $c++;  
            $company = $v['company'];
            if($company==0){
              $total=$total+$v['price']; 
              $rprice = $v['price'];
            }else{
              $labcomps = $app->getMyLabCompanyByTest("WHERE company_id='".$company."'");
              //echo json_encode($v);
              if(array_key_exists($v['which'], $labcomps)){
                $total=$total + $labcomps[$v['which']]['price'];
                $rprice = $labcomps[$v['which']]['price'];
              }else{
                $total=$total+$v['price']; 
                $rprice = $v['price'];
              }
              
            }
            ?>
            <tr>
              <td><?php echo $c; ?></td>
              <td><?php echo $ladoffered[$v['which']]['name']; ?></td>
              <td>1</td>
              <td><?php echo number_format($rprice,2); ?></td>
              <td><?php echo number_format($rprice,2); ?></td>
            </tr>
            <?php endforeach; 

             $wht = $settings['wht']['value'] * $total;
             $vat = $settings['vat']['value'] * $total;
             $net = ($total - $wht) - $vat;

            ?>
            <tr>
              <th colspan="4" style="text-align: right; background-color: #e3e3e3; border-top: 1px solid red;">Gross</th>
              <th style="border-top: 1px solid red;"><?php echo number_format($total,2); ?></th>
            </tr>
            <tr>
              <th colspan="4" style="text-align: right;background-color: #e3e3e3;">WHT</th>
              <th><?php echo number_format($wht,2); ?></th>
            </tr>
            <tr>
              <th colspan="4" style="text-align: right;background-color: #e3e3e3;">VAT</th>
              <th><?php echo number_format($vat,2); ?></th>
            </tr>
            <tr>
              <th colspan="4" style="text-align: right;background-color: #e3e3e3;">NET</th>
              <th><?php echo number_format($net,2); ?></th>
            </tr>
            <tr>
              <th colspan="4" style="text-align: right;background-color: #e3e3e3;">Amount Due</th>
              <th><?php echo number_format($total,2); ?></th>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="invoice-print.php?enq=<?php echo $_GET['enq']; ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
         <!--  <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button> -->
        </div>
      </div>
    </section>
  </form>
    <!-- /.content -->
  <div class="clearfix"></div>
  <script>
    function updateSlip(){
      event.preventDefault();
      //console.dir(event.target[2].value);
      if(event.target.charge != null) {
        var chargeSlip = event.target[0].value;
        var dateq = event.target[2].value;
        var patientid = event.target[3].value;
        var PROCESSED = <?php echo PROCESSED; ?>;
        var enq = <?php echo "'" . $_GET['enq'] . "'"; ?>;
        var chargeSlipContent = document.getElementById("charge_slip_content");
        chargeSlipContent.innerHTML = '<span >'+chargeSlip+'&nbsp;&nbsp;<button class="btn-warning ">Edit slip</button><br></span>';

        //submit through ajax

        //$data = array("model"=>"queuing", "values"=>"charge_slip='".trim($_POST['charge'])."', status='".PROCESSED."'", "condition"=>"WHERE  date = '".trim($_POST['dateq'])."' AND queuing_number = '".$_GET['enq']."' AND patient_id = '".$_POST['patientid']."'");
        var charge_slip = "charge_slip='" + chargeSlip + "', status=" + PROCESSED;
        var condition = "WHERE date= '" + dateq + "' AND queuing_number='" + enq + "' AND patient_id=" + patientid;

        const data = {"model":"queuing", "values":charge_slip,"condition":condition};

        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function(){
          if(this.readyState == 4 && this.status == 200) {
                var obj = JSON.parse(this.responseText);
                console.dir(this.responseText);
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
        xmlhttp.send("charge="+JSON.stringify(data));

      } else {
        var chargeSlipContent = document.getElementById("charge_slip_content");
        chargeSlipContent.innerHTML = '<input id="charge" type="text" name="charge" style="width: 150px;" required>&nbsp;&nbsp;<button type="submit" class="btn-primary ">Update slip</button><br></span>';
      }

      

      //<input type="text" name="charge" value="" style="width: 150px;" required>
     
      
    }
  </script>