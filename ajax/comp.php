<?php
session_start();

require('../core/core.php');
$app = new mckirby();
if(isset($_POST['comp'])){
	// <th>Patient</th>
 //                                <th>Inclusive</th>
 //                                <th>Credit Slip</th>
 //                                              <th>Charge Slip</th>
 //                                              <th>Acknowledgement Slip</th>
 //                                              <th>Date</th>
 //                                <th>Amount</th>
 //                                <th></th>
        //echo $_POST['p'];
        $addCon = " AND ".trim($_POST['p'])." = '".$_POST['comp']."'";

        if($_POST['p']=="md"){ $addCon .= " AND company = '0' "; }
        else{ $addCon .= " AND md = '0' "; } 
        //echo "WHERE trans_date >= '".date("Y-m-d",strtotime($_POST['d1']))."' AND trans_date <= '".date("Y-m-d",strtotime($_POST['d2']))."' AND bill_id = '0' AND payment_id = '0'".$addCon;
        //echo $addCon;
        // $trans = $app->getTransactions("WHERE company = '".$_POST['comp']."' AND trans_date >= '".date("Y-m-d",strtotime($_POST['d1']))."' AND trans_date <= '".date("Y-m-d",strtotime($_POST['d2']))."' AND bill_id = '0' AND payment_id = '0'");
        $trans = $app->getTransactions("WHERE trans_date >= '".date("Y-m-d",strtotime($_POST['d1']))."' AND trans_date <= '".date("Y-m-d",strtotime($_POST['d2']))."' AND bill_id = '0' AND payment_id = '0'".$addCon);
        
        $inc = $app->getEnqTrans(); 
        $labtest = $app->getLabTests();
        $patients = $app->getPatients();
   			foreach($trans as $k=>$v):

          
   				// $ran = $app->RandomString(7);	
          $ran = "billings_".$v['id']."_0";
            echo '<tr id="'.$ran.'" class="incount">
                  <td>';
            if(array_key_exists($v['patient_id'], $patients)){
              echo $patients[$v['patient_id']]['fname']." ".$patients[$v['patient_id']]['lname'];
            }else{
              echo "Unavailable";
            }
                  
            echo '</td>
                  <td>';
            if(array_key_exists($v['trans_date'], $inc)){
              if(array_key_exists($v['queuing_number'], $inc[$v['trans_date']])){
                  $ccc=0;
                  foreach($inc[$v['trans_date']][$v['queuing_number']] as $ki => $vi){ $ccc++; if($ccc>1){ echo "<br>"; }
                    if($vi['trans_type']=="Laboratory"){
                      if(array_key_exists($vi['which'], $labtest)){
                        echo $labtest[$vi['which']]['name'];
                      }else{
                        echo "not available";
                      }
                    }else{
                      echo "Check-up";
                    }
                  }
              }
            }  
            $toa = $v['total_amount'] - $v['disc'];     
            echo '</td>
                  <td>'.$v['credit_slip'].'
                  </td>
                  <td>'.$v['charge_slip'].'</td>
                  <td>'.$v['ackknowledgement'].'</td>
                  <td>'.$v['trans_date'].'</td>
                  <td style="text-align: right;">'.number_format($v['total_amount'],2).'
                      <input type="hidden" name="total_amount[]" value="'.$v['total_amount'].'" >
                      <input type="hidden" name="total_amount_r[]" value="'.$toa.'" class="amounts_cal">
                      <input type="hidden" name="ids[]" value="'.$v['id'].'">
                      <input type="hidden" name="trans_date[]"  value="'.$v['trans_date'].'">
                      <input type="hidden" name="disc[]"  value="'.$v['disc'].'">
                  </td>
                  <td style="text-align: right;">'.number_format($v['disc'],2).'
                  </td>
                  <td style="text-align: right;">'.number_format($toa,2).'
                  </td>
                  <td><label class="btn btn-xs btn-danger" onClick="removeMe(\''.$ran.'\')">x</label></td>
                </tr>';
        endforeach;    
                
           
}

?>