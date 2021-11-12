<?php
session_start();

require('../core/core.php');
$app = new mckirby();
if(isset($_POST['rid'])){
  $cat = $app->getCategoryNames();
	$labr = $app->getPatientResults("WHERE id = '".$_POST['rid']."' ORDER BY date DESC");
	$labr = $labr[$_POST['rid']];
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

   

    echo '

    	<section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
          <div class="row">
            <div class="col-md-2" style="text-align: right;">
              
                <!--<i class="fa fa-globe"></i>-->
                <img src="logo.png" style="width: 50px;"> 
                <!--<small class="pull-right">Date: '.date("F d, Y", strtotime($labr['date'])).'</small>-->
              
            </div>  
            <div class="col-md-10" style="text-align: center;">
              South Occupational Health And Environmental Safety Services, Inc.
              <br>
              <label style="font-size: 12px;">2nd Floor, Tower Mall Bldg. 4, Landco Business Park, Legazpi City</label>
            </div>
          </div> 
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
            echo '<tr>
              <td>'.$data_title[$k].'</td>';
            if (strpos(strtolower(trim($result[$k])), '.jpg') !== false || 
                  strpos(strtolower(trim($result[$k])), '.gif') !== false ||
                  strpos(strtolower(trim($result[$k])), '.png') !== false ||
                  strpos(strtolower(trim($result[$k])), '.jpeg') !== false) {
                  echo '<td colspan="2"><img  src="'.trim($result[$k]).'" style="max-width: 350px;"></td>';
              }else{  
              echo '<td>'.$normal[$k].'</td>
              <td>';
                  echo $result[$k];
                  echo '</td>';
              }
              echo '
            </tr>';
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
            echo '<tr>
              <td>'.$data_title[$k].'</td>';
            if (strpos(strtolower(trim($result[$k])), '.jpg') !== false || 
                  strpos(strtolower(trim($result[$k])), '.gif') !== false ||
                  strpos(strtolower(trim($result[$k])), '.png') !== false ||
                  strpos(strtolower(trim($result[$k])), '.jpeg') !== false) {
                  echo '<td colspan="2"><img  src="'.trim($result[$k]).'" style="max-width: 350px;"></td>';
              }else{  
              echo '<td>'.$normal[$k].'</td>
              <td>';
                  echo $result[$k];
                  echo '</td>';
              }
              echo '
            </tr>';
          endif;
          }
            echo '
            </tbody>
          </table>
        </div>';


       echo ' 
        <!-- /.col -->
      </div>
      <!-- /.row -->


     
    </section>

    ';

}


if(isset($_POST['charge'])){
  $res = $app->update2(json_decode($_POST['charge'], true));
  echo json_encode($res);
}

if(isset($_POST['credit'])){
  $res = $app->update2(json_decode($_POST['credit'], true));
  echo json_encode($res);
}

if(isset($_POST['acknowledgement'])){
  $res = $app->update2(json_decode($_POST['acknowledgement'], true));
  echo json_encode($res);
}

?>