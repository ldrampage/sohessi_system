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
  }
$ladoffered = $app->getLabTests();
$settings = $app->getSettingsByName();
$patients = $app->getPatients("WHERE id = '$patientid'");
$rpatient = array();
foreach($patients as $tk => $tv){ $rpatient=$tv; }
$companies = $app->getCompanies();
$doctors = $app->getDoctors();
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
              <td colspan="4" style="height:150px;"></td>
            </tr> 
            <?php
            $d1 = new DateTime(date("Y-m-d"));
            $d2 = new DateTime(date("Y-m-d",strtotime($rpatient['bdate'])));

            $diff = $d2->diff($d1);
            ?>
            <tr>
              <td style="width: 105px;">&nbsp;</td>
              <td style="width: 180px;"><?php echo $rpatient['prename']." ".$rpatient['fname']." ".$rpatient['mname'][0].". ".$rpatient['lname']; ?></td>
              <td style="width: 40px;">&nbsp;</td>
              <td><?php echo "&nbsp;&nbsp;&nbsp;".date("m-d-Y",strtotime($rpatient['bdate'])); ?></td>
            </tr>  
            <tr>
              <td style="width: 105px;">&nbsp;</td>
              <td style="width: 180px;"><?php echo $rpatient['address']; ?></td>
              <td style="width: 40px;">&nbsp;</td>
              <td><?php echo $diff->y; ?></td>
            </tr> 
            <tr>
              <td style="width: 105px;">&nbsp;</td>
              <td style="width: 180px;"><?php 
              if($trans['md']!=0){
                echo $doctors[$trans['md']]['prename']." ".$doctors[$trans['md']]['fname']." ".$doctors[$trans['md']]['lname']; 
              }
              ?></td>
              <td style="width: 40px;">&nbsp;</td>
              <td><?php echo $rpatient['gender']; ?></td>
            </tr> 
            <tr>
               <td style="width: 105px;">&nbsp;</td>
              <td style="width: 180px;"><?php if($comp==0){ echo $rpatient['position']; }else{ echo $companies[$comp]['company']; } ?></td>
              <td style="width: 40px;">&nbsp;</td>
              <td></td>

            </tr> 
          </table>  
          <table>
            <tr>
              <td colspan="4" style="height:15px;"></td>
            </tr> 

            <?php $total=0; $c=0; foreach($r as $k => $v): $c++;  $total=$total+$v['price']; ?>
          <!--   <tr>
              <td><?php echo $c; ?></td>
              <td><?php echo $ladoffered[$v['which']]['name']; ?></td>
              <td>1</td>
              <td><?php echo number_format($v['price'],2); ?></td>
              <td><?php echo number_format($v['price'],2); ?></td>
            </tr> -->

            <tr>
              <td style="width: 50px;">&nbsp;</td>
              <td style="width: 260px;"><?php echo $ladoffered[$v['which']]['name']; ?></td>
              <td style="text-align:right;"><?php echo number_format($v['price'],2); ?></td>
            </tr>  


            <?php endforeach; 

             $wht = $settings['wht']['value'] * $total;
             $vat = $settings['vat']['value'] * $total;
             $net = ($total - $wht) - $vat;

            ?>
            

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
        <div style="position: fixed; top: 140mm;">
          <table>
            <tr>
              <td style="width: 50px;">&nbsp;</td>
              <td style="width: 260px; text-align: right;  border-top: 1px solid #ddd;">&nbsp;</td>
              <td style="border-top: 1px solid #ddd; text-align: right;"><?php echo number_format($total,2); ?></td>
            </tr> 
          </table>  

           <table>

            <tr>
              <td style="width: 50px;">&nbsp;</td>
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
