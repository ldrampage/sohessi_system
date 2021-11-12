<?php 
session_start();
include 'core/core.php';  
$app = new mckirby();
$current = date("Y-m-d");
$condition = " WHERE  date = '".$current."' AND queuing_number = '".$_GET['enq']."'"; //status='".ENQ."' AND
$r = $app->getEnqueued($condition);
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
  }
$ladoffered = $app->getLabTests();
$settings = $app->getSettingsByName();
$patients = $app->getPatients("WHERE id = '$patientid'");
$rpatient = array();
foreach($patients as $tk => $tv){ $rpatient=$tv; }
$companies = $app->getCompanies();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SOHESSI | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <style>
  @page { size: portrait;  margin: 2mm; }
  td, th {
    padding: 0;
    line-height: 15px;
}
  </style>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      
    <div class="col-md-6">
        <!-- info row -->
        <div class="row invoice-info">
          <table>
            <tr>
              <td colspan="4" style="height:110px;"></td>
            </tr> 
            <tr>
              <td style="width: 130px;">&nbsp;</td>
              <td style="width: 200px;"><?php echo $rpatient['prename']." ".$rpatient['fname']." ".$rpatient['mname'][0].". ".$rpatient['lname']; ?></td>
              <td style="width: 80px;">&nbsp;</td>
              <td><?php echo $rpatient['address']; ?></td>
            </tr>  
            <tr>
              <td style="width: 130px;">&nbsp;</td>
              <td style="width: 200px;"><?php echo  $dr;  ?></td>
              <td style="width: 80px;">&nbsp;</td>
              <td><?php echo date("F d, Y",strtotime($rpatient['bdate'])); ?></td>
            </tr> 
            <tr>
              <td style="width: 130px;">&nbsp;</td>
              <td style="width: 200px;"><?php if($comp==0){ echo $rpatient['position']; }else{ echo $companies[$comp]['company']; } ?></td>
              <td style="width: 80px;">&nbsp;</td>
              <td></td>
            </tr> 
          </table>  
          <table>
            <tr>
              <td colspan="4" style="height:20px;"></td>
            </tr> 

            <?php $total=0; $c=0; foreach($r as $k => $v): $c++;  

           $company = $v['company'];
            if($company==0){
              $total=$total+$v['price']; 
              $rprice = $v['price'];
            }else{
              $labcomps = $app->getMyLabCompanyByTest("WHERE company_id='".$company."'");
              //echo json_encode($v);
              $total=$total + $labcomps[$v['which']]['price'];
              $rprice = $labcomps[$v['which']]['price'];
            }

           // $total=$total+$v['price']; ?>
          <!--   <tr>
              <td><?php echo $c; ?></td>
              <td><?php echo $ladoffered[$v['which']]['name']; ?></td>
              <td>1</td>
              <td><?php echo number_format($v['price'],2); ?></td>
              <td><?php echo number_format($v['price'],2); ?></td>
            </tr> -->

            <tr>
              <td style="width: 30px;">&nbsp;</td>
              <td style="width: 410px;"><?php echo $ladoffered[$v['which']]['name']; ?></td>
              <td><?php echo number_format($rprice,2); ?></td>
            </tr>  


            <?php endforeach; 

             $wht = $settings['wht']['value'] * $total;
             $vat = $settings['vat']['value'] * $total;
             $net = ($total - $wht) - $vat;

            ?>
            <tr>
              <td style="width: 30px;">&nbsp;</td>
              <td style="width: 410px; text-align: right;  border-top: 1px solid #ddd;">Total Amount: &nbsp;&nbsp;</td>
              <td style="border-top: 1px solid #ddd;"><?php echo number_format($total,2); ?></td>
            </tr> 

            <!-- <tr>
              <td style="width: 30px;">&nbsp;</td>
              <td style="width: 400px;"><?php echo $rpatient['prename']." ".$rpatient['fname']." ".$rpatient['mname'][0].". ".$rpatient['lname']; ?></td>
              <td><?php echo $rpatient['address']; ?></td>
            </tr>  
            <tr>
              <td style="width: 30px;">&nbsp;</td>
              <td style="width: 400px;"><?php echo $rpatient['prename']." ".$rpatient['fname']." ".$rpatient['mname'][0].". ".$rpatient['lname']; ?></td>
              <td><?php echo $rpatient['address']; ?></td>
            </tr>  
            <tr>
              <td style="width: 30px;">&nbsp;</td>
              <td style="width: 400px;"><?php echo $rpatient['prename']." ".$rpatient['fname']." ".$rpatient['mname'][0].". ".$rpatient['lname']; ?></td>
              <td><?php echo $rpatient['address']; ?></td>
            </tr>   -->
          </table>  
        </div>
        <div style="position: fixed; top: 90mm;">
           <table>
            <tr>
              <td style="width: 50px;">&nbsp;</td>
              <td style="width: 390px"><?php echo date("h:i A"); ?></td>
              <td></td>
            </tr> 
            <tr>
              <td style="width: 50px;">&nbsp;</td>
              <td style="width: 390px"><?php echo date("F d, Y"); ?></td>
              <td><?php echo $_SESSION['complete_name']; ?></td>
            </tr>  
         </table>   
        </div>  
        <!-- /.row -->
      </div> 
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
