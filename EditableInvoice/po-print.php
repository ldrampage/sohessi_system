<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<?php include '../core/core.php'; $app = new mckirby();  ?>

    <?php


    $response=array('message'=>"",'action'=>'');
    $department = $app->getPo("WHERE id = '".$_GET['id']."'");
$department = $department[$_GET['id']];
$value = $department;
// $data = array("model"=>"laboffered", "condition"=>" WHERE id = '".$_GET['id']."'");
// $projects=$app->getRecord2($data);
// $department = $projects['data'][0];
// $eawards = json_decode($department['employee_id']);
// $emps = $app->getEmployees();
//echo json_encode($projects);
 $suppliers = $app->getSuppliers();
 $emps = $app->getEmployees();
//exit();
?>

<?php
$color = "#000";
// if(strtoupper($clients['status'])=="LAUNCHED"){
//     $color = MYGREEN;
// }
// if(strtoupper($clients['status'])=="FINISHED"){
//     $color = MYBLUE;
// }
// if(strtoupper($clients['status'])=="WAITING"){
//     $color = MYGOLD;
// }
// if(strtoupper($clients['status'])=="FAILED"){
//     $color = MYRED;
// }

                                $dpo = "";
                                $dpoCount = strlen($department['po_number']);
                                while($dpoCount<6){
                                    $dpo .= "0";
                                    $dpoCount++;
                                }
                                $real_po = POPRE."-".$dpo.$department['po_number'];

$poStatus = $app->getPoStatus();
$materials = $app->getMaterials(); 
$mymaterials = $app->getMySupMaterials("WHERE sup_id = '".$_GET['id']."'");
    ?>


	<title>IT-Solves - Printable Purchase Order</title>
	
	<link rel='stylesheet' type='text/css' href='css/style.css' />
	<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
	<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='js/example.js'></script>
    <style>

        #page-wrap {
            width: 1000px;
            margin: 0 auto;
        }
        #header {
            height: 15px;
            width: 100%;
            margin: 20px 0;
            background: #367fa9;
            font: bold 14px Helvetica, Sans-Serif;
        }
        #logo {
            text-align: center;
            float: none;
            margin-top: -10px;
        }

    </style>

</head>

<body onload="window.print();"><!-- onload="window.print();">-->
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> Purchase Order
          <small class="pull-right">Date: <?php if($value['date_forwarded']==="0000-00-00"){echo "N/A";}else{echo date("M d, Y",strtotime($value['date_forwarded']));}   ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong>South Occupational Health an Environmental Safety Services Inc.</strong><br>
          F.Imperial St. Legazpi, Albay 4500<br>
          Phone: (052) 742 4820<br>
          Email: info@sohessi.com
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        To
        <address>
          <strong><?php echo $suppliers[$department['supplier_id']]['business']; ?></strong><br>
          <?php echo $suppliers[$department['supplier_id']]['business_address']; ?><br>
          Phone: <?php echo $suppliers[$department['supplier_id']]['phone']."/".$suppliers[$department['supplier_id']]['mobile']; ?><br><br>
          Email: <?php echo $suppliers[$department['supplier_id']]['email']; ?>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>PO No. <?php echo $real_po; ?></b><br>
        <br>
        <b>Date Order:</b> <?php //echo ">".$value['date_forwarded']."<=====";
        if($value['date_forwarded']==="0000-00-00"){echo "N/A";}else{echo date("M d, Y",strtotime($value['date_forwarded']));}
           ?><br>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <?php $inclusives = json_decode($value['inclusives'], true);  ?>
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Item</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Subtotal</th>
          </tr>
          </thead>
          <tbody>
            <?php 
            $c=0;
            $total = 0;
            foreach($inclusives as $k=>$v): 
              $v['amount'] = (float) str_replace(",","", $v['amount']);
              $c++; $total= $total + $v['amount']; 
            ?>
          <tr>
            <td><?php echo $materials[$v['material_id']]['name']; ?></td>
            <td><?php echo number_format($v['qty'],2); ?></td>
            <td><?php echo number_format($v['price'],2); ?></td>
            <td><?php echo number_format($v['amount'],2); ?></td>
          </tr>
          <?php endforeach; ?>
          
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
       
            <h5>Notes:</h5>
                <textarea style="width: 100%;"><?php if($value['notes']==""){echo "N/A";}else{echo $value['notes'];} ?></textarea>
          <!-- Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr
          jibjab, movity jajah plickers sifteo edmodo ifttt zimbra. -->
       
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
        <!-- <p class="lead">Amount Due 2/22/2014</p> -->

        <div class="table-responsive">
          <table class="table">
            <!-- <tr>
              <th style="width:50%">Subtotal:</th>
              <td>$250.30</td>
            </tr>
            <tr>
              <th>Tax (9.3%)</th>
              <td>$10.34</td>
            </tr>
            <tr>
              <th>Shipping:</th>
              <td>$5.80</td>
            </tr> -->
            <tr>
              <th>Total:</th>
              <td><?php echo number_format($total,2); ?></td>
            </tr>
          </table>



            </div>
        </div>
      </div>
      <div class="col-md-12">
        <br><br>
        <table style="width: 100%;">
                    <tr>
                        <td style="border: none;">Prepared By:
                        <br>
                            <?php echo $emps[$value['prepared_by']]['fname']." ".$emps[$value['prepared_by']]['lname'] ?>
                        </td>
                       
                        <td style="border: none;">Approved By:
                        <br>
                            <?php if($value['approved_by']==0){ echo "NOT APPROVED"; }else{echo $emps[$value['approved_by']]['fname']." ".$emps[$value['approved_by']]['lname']; } ?>
                        </td>
                        <td style="border: none;"></td>
                         <td style="border: none;">Received By:
                        <br>
                            _________________________
                        </td>
                    </tr>
                    <tr>
                        
                    </tr>
                </table>
      </div>  
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>