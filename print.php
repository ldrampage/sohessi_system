<!DOCTYPE html>
<html>

 

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Office | Dashboard - MCBusiness Solution</title>
  <?php 

    include 'core/core.php'; 
    include 'core/session.php';
    $app = new mmlapi();
    if(isset($_GET['logout'])){
        session_destroy();
        header("location: index.php?page=login");
    }

    


  ?>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="libs/font-awesome-4.6.3/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="libs/ionicons-2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  




  <!-- <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css"> -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <link rel="stylesheet" href="plugins/colorpicker/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  


  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <style type="text/css">

  .no-side-bar{
    margin-left: 0px;
  }
  .enable{
    
  }

  </style>

  <style>
  .full button span {
    background-color: limegreen;
    border-radius: 32px;
    color: black;
  }
  .partially button span {
    background-color: orange;
    border-radius: 32px;
    color: black;
  }
</style>


  <script src="libs/js/sha256.js"></script>
<!--   <script src="libs/js/angular.min.js"></script> -->
<!-- <script src="libs/js/ui-bootstrap-tpls-2.0.0.min.js"></script> -->
<!-- <script src="libs/js/angular-route.min.js"></script> -->


<!-- 
 <script src="libs/js/ngStorage.js"></script> -->





<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>


<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>

<!-- <script src="controller/mainController.js"></script> -->

<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="plugins/chartjs/Chart.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script> -->

<script src="plugins/select2/select2.full.min.js"></script>
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>  

<!-- <script src="plugins/daterangepicker/daterangepicker.js"></script> -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>


<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
 



</head>
<body class="hold-transition skin-blue sidebar-mini">


<div id="print">
<?php

if(isset($_GET['id'])){
      $data_payment = array('model'=>'payment', 'keys'=>'*', 'conditions'=>array('id'=>$_GET['id']));
      $fetched = $app->getRecord($data_payment);
      $payment = $fetched['data'][0];

      $data2 = array('model'=>'received', 'keys'=>'*', 'conditions'=>array('payment'=>$_GET['id']),'order'=>'received_Date DESC');
      $fetched_r = $app->getRecord($data2);
      $received_r = $fetched_r['data'];


      $data = array('model'=>'supplier', 'keys'=>'*', 'order'=>'supplier_Name', 'conditions'=>array('id'=>$payment['payment_Supplier']));
      $fetched = $app->getRecord($data);
      $suppliers = $fetched['data'][0];
    }


// echo json_encode($payment)."<br><br>";

// echo json_encode($received_r)."<br>";

// echo json_encode($suppliers)."<br>";

// if(isset($_POST['target'])){
// echo json_encode($_POST['target']);
// }






?>

  <div class="row">
    <div class="col-md-12">
      <table border="0" width="80%;">
      <tr>
      <td>
      <h3>Supplier Info:</h3><br> 
      Supplier Code #: <?php echo $suppliers['supplier_Code']; ?><br>
      Supplier Name: <?php echo $suppliers['supplier_Name']; ?><br>
      </td>
      <td>
      <h3>Payment Info: </h3><br>
      Check #: <?php echo $payment['payment_Check']; ?><br>
      Bank: <?php echo $payment['payment_Checkbank']; ?><br>
      Amount Paid: <?php echo number_format($payment['payment_Amount'],2); ?><br>
      </td>
      </tr>
      </table>
    </div>

    <div class="col-md-12">
        <table border = '1' width="80%;">
        <tr>
          <td style='padding:5px;'>OR #</td>
          <td style='padding:5px;'>Date Received</td>
          <td style='padding:5px;'>Memo</td>
          <td style='padding:5px;'>Amount</td>
          <td style='padding:5px;'>Adjustment</td>
          <td style='padding:5px;'>Paid Amount</td>
        </tr>
        <?php

        foreach ($received_r as $key => $value) {
            if ( in_array( $value['id'], $_POST['target'] ) ) {
              echo "<tr>";
                echo "<td style='padding:5px;'>".$value['received_Or']."</td>";
                echo "<td style='padding:5px;'>".$value['received_Date']."</td>";
                echo "<td style='padding:5px;'>".$value['received_Memo']."</td>";
                echo "<td style='padding:5px;'>".number_format($value['received_Amount'],2)."</td>";
                echo "<td style='padding:5px;'>".number_format($value['received_Adjusted'],2)."</td>";
                echo "<td style='padding:5px;'>".number_format($value['received_Amount']+$value['received_Adjusted'],2)."</td>";
              echo "<tr>";
            }
        }


        ?>
        </table>
    </div>
  </div>
</div>

<!-- page script -->
<script>
  
  function PrintElem(elem, title)
    {
      var mywindow = window.open('', 'PRINT', 'height=400,width=600');


        mywindow.document.write('<html><head><title>' + document.title  + '</title>');

        mywindow.document.write('</head><body >');
      mywindow.document.write('<h3>' + title  + '</h3>');
        mywindow.document.write(document.getElementById(elem).innerHTML);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        mywindow.close();

        return true;

        }

$( document ).ready(function() {
    PrintElem('print', 'Paid')
});
  
</script>
<!-- material design js -->






</body>
</html>
