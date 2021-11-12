<?php 
session_start();
include 'core/core.php';  
$app = new mckirby();
$current = date("Y-m-d");

$transaction = $app->getTransactions("WHERE id = '".$_GET['id']."'");
$trans = array();
foreach($transaction as $k => $v){ $trans=$v; }
//echo json_encode($transaction);

$condition = " WHERE  date = '".date("Y-m-d",strtotime($trans['realdate']))."' AND queuing_number = '".$trans['queuing_number']."'";
$r = $app->getEnqueued($condition);
//echo json_encode($r);
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
    line-height: 18px;
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
              <td style="width: 170px;">&nbsp;</td>
              <td style="width: 15px;">&nbsp;</td>
              <td style="width: 30px;">&nbsp;</td>
              <td style="width: 20px;">&nbsp;</td>
              <td style="width: 60px;">&nbsp;</td>
              <td style="width: 195px;" colspan="1"></td>
              <td style="width: 80px;"><?php //echo mb_substr(date("F d",strtotime($trans['trans_date'])),0,3)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".date("y",strtotime($trans['trans_date'])); ?></td>
            </tr>  
            <tr>
              <td style="width: 170px;">&nbsp;</td>
              <td style="width: 15px;">&nbsp;</td>
              <td style="width: 30px;">&nbsp;</td>
              <td style="width: 20px;">&nbsp;</td>
              <td style="width: 60px;">&nbsp;</td>
              <td style="width: 195px;" colspan="2"><?php echo $rpatient['prename']." ".$rpatient['fname']." ".$rpatient['mname'][0].". ".$rpatient['lname']; ?></td>
            </tr>  
            <tr>
              <?php //$words = $app->convertNumberToWord(number_format($trans['amount_paid'],2));

              $words = $app->numtowords($trans['amount_paid']);
               ?>
              <td style="width: 170px;">&nbsp;</td>
              <td style="width: 15px;">&nbsp;</td>
              <td style="width: 30px;">&nbsp;</td>
              <td style="width: 20px;">&nbsp;</td>
              <td style="width: 60px;">&nbsp;</td>
              <td style="width: 195px;" colspan="1"><?php echo $words; ?></td>
              <td style="width: 60px;"><?php echo number_format($trans['amount_paid'],2); ?></td>
            </tr>  
            <tr>
              <td style="width: 170px;">&nbsp;</td>
              <td style="width: 15px;">&nbsp;</td>
              <td style="width: 30px;">&nbsp;</td>
              <td style="width: 20px;">&nbsp;</td>
              <td style="width: 60px;">&nbsp;</td>
              <td style="width: 195px;" colspan="1">Medical Services</td>
              <td style="width: 60px;"></td>
            </tr>  
            
          </table>  
          
        <div style="position: fixed; top: 80mm;">
           <table>
            <tr>
              <td style="width: 50px;">&nbsp;</td>
              <td style="width: 390px"><?php //echo date("h:i A"); ?></td>
              <td></td>
            </tr> 
            <tr>
              <td style="width: 50px;">&nbsp;</td>
              <td style="width: 355px">&nbsp;<?php //echo date("F d, Y"); ?></td>
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
