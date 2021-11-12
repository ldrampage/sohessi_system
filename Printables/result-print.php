<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>IT-Solves - Printable Result</title>
	
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
            /*margin-top: -10px;*/
        }
        @page {
          size: landscape;
          /*margin: 5;*/
        }
        @media print {
          html, body {
            width: 340mm;
            height: 297mm;
          }
          .col-sm-6 {
            width: 50%;
            margin: 0px;
            padding: 0px;
        }
  /* ... the rest of the rules ... */
}
  .col-sm-6 {
            width: 50%;
            margin: 0px;
            padding: 1px;
        }
.col-xs-6 {
  width: 50%;
            margin: 0px;
            padding: 1px;
        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 3px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
}

.page-header {
    margin: 10px 0 20px 0;
    font-size: 14px;
}
body {
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 12px;
    line-height: 1.42857143;
    color: #333;
    background-color: #fff;
}
.row {
    margin-right: 0px;
    margin-left: 0px;
}
table td, table th {
    border: 0px solid black;
    padding: 1px;
}
    </style>

</head>

<body  onload="window.print();"><!-- onload="window.print();">-->
  <center>
<div class="wrapper">

  <!-- Main content -->
  <section class="invoice" style="width: 340mm;">
    <?php
session_start();

require('../core/core.php');
$app = new mckirby();
if(isset($_GET['rid'])){
  $cat = $app->getCategoryNames();
  $labr = $app->getPatientResults("WHERE id = '".$_GET['rid']."' ORDER BY date DESC");
  $labr = $labr[$_GET['rid']];
  //echo json_encode($labr);
    $Labs = $app->getLabTests();
    $patient = $app->getPatients();
    $tmprd = $app->getResultData("WHERE labtest_id = '".$labr['test_id']."'");
    // $tmprd
    foreach($tmprd as $k =>$v){ $rd = $v; }
    // $rd = $rd[$labr['test_id']];
    // echo json_encode($rd);
   //echo $patient[$labr['patient_id']]['bdate'];

   $date = new DateTime($patient[$labr['patient_id']]['bdate']);
   $now = new DateTime();
   $age = $now->diff($date);
   //return $interval->y;
   $image = array();
   ?>

   <table>

    <tr>
    <td style="width: 140mm;">
   <?php

    echo '

      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
          <table class="table">
            <tr>
              <td style="border: none!important;">
                <!--<i class="fa fa-globe"></i>-->
                <img src="../logo.png" style="width: 50px;"> 
                <!--<small class="pull-right">Date: '.date("F d, Y", strtotime($labr['date'])).'</small>-->
              
            </td>  
            <td style="text-align: center;border: none!important;">
              South Occupational Health And Environmental Safety Services, Inc.
              <br>
              <label style="font-size: 12px;">2nd Floor, Tower Mall Bldg. 4, Landco Business Park, Legazpi City</label>
            </td>
            </tr>
          </table> 
          </h2> 
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
          Patient Details:
          <address>
            <strong>'.ucfirst($patient[$labr['patient_id']]['fname'])." ".ucfirst($patient[$labr['patient_id']]['lname']).'</strong><br>
            Age: '.$age->y.'<br>
            Gender: '.$patient[$labr['patient_id']]['gender'].'<br>
            Address: '.$patient[$labr['patient_id']]['address'].'<br>
           <!-- Email: john.doe@example.com-->
          </address>
        </div>
        <div class="col-sm-6 invoice-col">
          Test Procedure Details:
          <address>
            <strong>'.$Labs[$labr['test_id']]['name'].'</strong><br>
            Category/Department: <b>'.$cat[$Labs[$labr['test_id']]['category']].'</b><br>
            Date: '.date("F d, Y", strtotime($labr['date'])).'<br>
          </address>
        </div>
        <!-- 
        
        <div class="col-sm-4 invoice-col">
          <b>Invoice #007612</b><br>
          <br>
          <b>Order ID:</b> 4F3S8J<br>
          <b>Payment Due:</b> 2/22/2014<br>
          <b>Account:</b> 968-34567
        </div>
         -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">';

 // $lr = $app->getLabResults("WHERE id='".$labr['result_id']."'");
              $data_title = json_decode($labr['titles'],true);
            
            //$data_title = json_decode($rd['data_title'],true);
            $normal = json_decode($labr['normal_range'],true);
            $result = json_decode($labr['resultdata'],true);



                   $counts = sizeOf($data_title);
                   $div = $counts/2;
                   $batch1 = $div;
                   $batch2 = $div;
                   if(($counts%2)!=0){
                      $batch1 = $div + 1;
                      $batch2 = $div;
                   }

                 

            $c=0;
            $notImgcheck = array();
            foreach($data_title as $k => $v){
                if (strpos(strtolower(trim($result[$k])), '.jpg') !== false || 
                  strpos(strtolower(trim($result[$k])), '.gif') !== false ||
                  strpos(strtolower(trim($result[$k])), '.png') !== false ||
                  strpos(strtolower(trim($result[$k])), '.jpeg') !== false) {
                  
                }else{
                  $notImgcheck[] = $v;
                }
            }
        if(sizeOf($notImgcheck)>0):    
        echo '<div class="col-xs-6 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Legend</th>
              <th>Normal</th>
              <th>Result</th>
            </tr>
            </thead>
            <tbody>';
            
             
            foreach($data_title as $k => $v){ $c++;
              if($c<=$batch1):

                
                if (strpos(strtolower(trim($result[$k])), '.jpg') !== false || 
                  strpos(strtolower(trim($result[$k])), '.gif') !== false ||
                  strpos(strtolower(trim($result[$k])), '.png') !== false ||
                  strpos(strtolower(trim($result[$k])), '.jpeg') !== false) {
                  $image[] = array("title"=>$data_title[$k], "result"=>"../".trim($result[$k]), "normal"=>$normal[$k]);
                  //echo '<td colspan="2"><img  src="" style="max-width: 250px;"></td>';
              }else{ 

            echo '<tr>
              <td>'.$data_title[$k].'</td>';
             
              echo '<td>'.$normal[$k].'</td>
              <td>';
                  echo $result[$k];
                  echo '</td>';
              echo '
            </tr>';
          }
          endif;
          }
            echo '
            </tbody>
          </table>
        </div>';


         echo '<div class="col-xs-6 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Legend</th>
              <th>Normal</th>
              <th>Result</th>
            </tr>
            </thead>
            <tbody>';
            
             $c = 0;
            foreach($data_title as $k => $v){ $c++;
              if($c>$batch1):

                
                if (strpos(strtolower(trim($result[$k])), '.jpg') !== false || 
                  strpos(strtolower(trim($result[$k])), '.gif') !== false ||
                  strpos(strtolower(trim($result[$k])), '.png') !== false ||
                  strpos(strtolower(trim($result[$k])), '.jpeg') !== false) {
                  $image[] = array("title"=>$data_title[$k], "result"=>"../".trim($result[$k]), "normal"=>$normal[$k]);
                  //echo '<td colspan="2"><img  src="" style="max-width: 250px;"></td>';
              }else{ 

            echo '<tr>
              <td>'.$data_title[$k].'</td>';
             
              echo '<td>'.$normal[$k].'</td>
              <td>';
                  echo $result[$k];
                  echo '</td>';
              echo '
            </tr>';
          }
          endif;
          }
            echo '
            </tbody>
          </table>
        </div>';

      endif;
        
       echo ' 
        <!-- /.col -->
      </div>
      <!-- /.row -->


    '; 


    if(sizeOf($image)>0):
        echo '<div><table><tr>';

        foreach($image as $ik => $iv){
          echo "<td>".$iv['title']."<br><img src='".trim($iv['result'])."'/></td>";
        }

        echo '</tr></table></div>';
        endif;




    ?>


    <!-- /.row -->
    </td>


    <!-- SECOND PAGE -->



     <td style="width: 140mm;">
   <?php

    echo '

      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
          
            <table class="" style="margin-top: -5px;
    margin-bottom: 30px;">
            <tr>
              <td style="border: none!important;">
                <!--<i class="fa fa-globe"></i>-->
                <img src="../logo.png" style="width: 50px;"> 
                <!--<small class="pull-right">Date: '.date("F d, Y", strtotime($labr['date'])).'</small>-->
              
            </td>  
            <td style="border: none!important;text-align: center;">
              South Occupational Health And Environmental Safety Services, Inc.
              <br>
              <label style="font-size: 12px;">2nd Floor, Tower Mall Bldg. 4, Landco Business Park, Legazpi City</label>
            </td>
            </tr>
          </table> 
          </h2> 
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
          Patient Details:
          <address>
            <strong>'.ucfirst($patient[$labr['patient_id']]['fname'])." ".ucfirst($patient[$labr['patient_id']]['lname']).'</strong><br>
            Age: '.$age->y.'<br>
            Gender: '.$patient[$labr['patient_id']]['gender'].'<br>
            Address: '.$patient[$labr['patient_id']]['address'].'<br>
           <!-- Email: john.doe@example.com-->
          </address>
        </div>
        <div class="col-sm-6 invoice-col">
          Test Procedure Details:
          <address>
            <strong>'.$Labs[$labr['test_id']]['name'].'</strong><br>
            Category/Department: <b>'.$cat[$Labs[$labr['test_id']]['category']].'</b><br>
            Date: '.date("F d, Y", strtotime($labr['date'])).'<br>
          </address>
        </div>
        <!-- 
        
        <div class="col-sm-4 invoice-col">
          <b>Invoice #007612</b><br>
          <br>
          <b>Order ID:</b> 4F3S8J<br>
          <b>Payment Due:</b> 2/22/2014<br>
          <b>Account:</b> 968-34567
        </div>
         -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">';

 // $lr = $app->getLabResults("WHERE id='".$labr['result_id']."'");
              $data_title = json_decode($labr['titles'],true);
            
            //$data_title = json_decode($rd['data_title'],true);
            $normal = json_decode($labr['normal_range'],true);
            $result = json_decode($labr['resultdata'],true);



                   $counts = sizeOf($data_title);
                   $div = $counts/2;
                   $batch1 = $div;
                   $batch2 = $div;
                   if(($counts%2)!=0){
                      $batch1 = $div + 1;
                      $batch2 = $div;
                   }

                 $image = array();

            $c=0;



         $c=0;
            $notImgcheck = array();
            foreach($data_title as $k => $v){
                if (strpos(strtolower(trim($result[$k])), '.jpg') !== false || 
                  strpos(strtolower(trim($result[$k])), '.gif') !== false ||
                  strpos(strtolower(trim($result[$k])), '.png') !== false ||
                  strpos(strtolower(trim($result[$k])), '.jpeg') !== false) {
                  
                }else{
                  $notImgcheck[] = $v;
                }
            }
        if(sizeOf($notImgcheck)>0):       
        echo '<div class="col-xs-6 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Legend</th>
              <th>Normal</th>
              <th>Result</th>
            </tr>
            </thead>
            <tbody>';
            
             
            foreach($data_title as $k => $v){ $c++;
              if($c<=$batch1):

                
                if (strpos(strtolower(trim($result[$k])), '.jpg') !== false || 
                  strpos(strtolower(trim($result[$k])), '.gif') !== false ||
                  strpos(strtolower(trim($result[$k])), '.png') !== false ||
                  strpos(strtolower(trim($result[$k])), '.jpeg') !== false) {
                  $image[] = array("title"=>$data_title[$k], "result"=>"../".trim($result[$k]), "normal"=>$normal[$k]);
                  //echo '<td colspan="2"><img  src="" style="max-width: 250px;"></td>';
              }else{ 

            echo '<tr>
              <td>'.$data_title[$k].'</td>';
             
              echo '<td>'.$normal[$k].'</td>
              <td>';
                  echo $result[$k];
                  echo '</td>';
              echo '
            </tr>';
          }
          endif;
          }
            echo '
            </tbody>
          </table>
        </div>';


         echo '<div class="col-xs-6 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Legend</th>
              <th>Normal</th>
              <th>Result</th>
            </tr>
            </thead>
            <tbody>';
            
             $c = 0;
           foreach($data_title as $k => $v){ $c++;
              if($c>$batch1):

                
                if (strpos(strtolower(trim($result[$k])), '.jpg') !== false || 
                  strpos(strtolower(trim($result[$k])), '.gif') !== false ||
                  strpos(strtolower(trim($result[$k])), '.png') !== false ||
                  strpos(strtolower(trim($result[$k])), '.jpeg') !== false) {
                  $image[] = array("title"=>$data_title[$k], "result"=>"../".trim($result[$k]), "normal"=>$normal[$k]);
                  //echo '<td colspan="2"><img  src="" style="max-width: 250px;"></td>';
              }else{ 

            echo '<tr>
              <td>'.$data_title[$k].'</td>';
             
              echo '<td>'.$normal[$k].'</td>
              <td>';
                  echo $result[$k];
                  echo '</td>';
              echo '
            </tr>';
          }
          endif;
          }
            echo '
            </tbody>
          </table>
        </div>';

      endif;
         


       echo ' 
        <!-- /.col -->
      </div>
      <!-- /.row -->


    '; 

    if(sizeOf($image)>0):
        echo '<div><table><tr>';

        foreach($image as $ik => $iv){
          echo "<td>".$iv['title']."<br><img src='".trim($iv['result'])."'/></td>";
        }

        echo '</tr></table></div>';
        endif;


    ?>


    <!-- /.row -->
    </td>
  </tr>



<?php

}

?>


  </table>
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</center>
</body>
</html>