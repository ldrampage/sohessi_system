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
        // echo $_POST['p'];
        // $inc = $app->getEnqTrans(); 
        // $labtest = $app->getLabTests();
        // $patients = $app->getPatients();
        $comps = $app->getCompanies();
        $doctors = $app->getDoctors();
        if(trim($_POST['p'])=="bill-company-payment"){
          //echo "WHERE company_id = '".$_POST['comp']."' AND payment_id = '0' ORDER BY date_due ASC";
              $trans = $app->getTransactions("WHERE company = '".$_POST['comp']."' AND payment_id = '0'");
              $billings = $app->getBillings("WHERE md_id = '0' AND company_id = '".$_POST['comp']."' AND payment_id = '0' ORDER BY date_due ASC");
              //echo json_encode($trans)."<===";
              foreach ($billings as $key => $value) {
                $inclusives = json_decode($value['inclusives'], true);
                $total_amount_due = 0;
                foreach($inclusives as $k=>$v){
                    $total_amount_due = $total_amount_due + ($trans[$v]['total_amount'] - $trans[$v]['disc']);
                }
                $ran = $value['bill_id']; 
                echo '<tr>
                  <td>'.$value['bill_id'].'
                  </td>
                  <td>'.$comps[$value['company_id']]['company'].'</td>
                  <td>'.$value['date_bill'].'</td>
                  <td>'.$value['date_due'].'</td>
                  <td style="text-align: right;">'.number_format($total_amount_due,2).'</td>
                  <td><label class="btn btn-xs btn-danger" onClick="Addmew(\''.$value['id'].'\', \''.$value['bill_id'].'\', \''.$comps[$value['company_id']]['company'].'\', \''.$value['date_bill'].'\', \''.$value['date_due'].'\', \''.$total_amount_due.'\', \''.$ran.'\')">+</label></td>
                </tr>';
              }
        }
        if(trim($_POST['p'])=="bill-md-payment"){
              //$trans = $app->getBillings("WHERE md_id = '".$_POST['comp']."' AND payment_id = '0'  ORDER BY date_due ASC");

              $trans = $app->getTransactions("WHERE md = '".$_POST['comp']."' AND payment_id = '0'");
              $billings = $app->getBillings("WHERE company_id = '0' AND md_id = '".$_POST['comp']."' AND payment_id = '0' ORDER BY date_due ASC");
              //echo json_encode($trans)."<===";
              foreach ($billings as $key => $value) {
                $inclusives = json_decode($value['inclusives'], true);
                $total_amount_due = 0;
                foreach($inclusives as $k=>$v){
                    $total_amount_due = $total_amount_due + ($trans[$v]['total_amount'] - $trans[$v]['disc']);
                }
                $ran = $value['bill_id']; 
                echo '<tr>
                  <td>'.$value['bill_id'].'
                  </td>
                  <td>'.$doctors[$value['md_id']]['prename']." ".$doctors[$value['md_id']]['fname']." ".$doctors[$value['md_id']]['lname'].'</td>
                  <td>'.$value['date_bill'].'</td>
                  <td>'.$value['date_due'].'</td>
                  <td style="text-align: right;">'.number_format($total_amount_due,2).'</td>
                  <td><label class="btn btn-xs btn-danger" onClick="Addmew(\''.$value['id'].'\', \''.$value['bill_id'].'\', \''.$doctors[$value['md_id']]['prename']." ".$doctors[$value['md_id']]['fname']." ".$doctors[$value['md_id']]['lname'].'\', \''.$value['date_bill'].'\', \''.$value['date_due'].'\', \''.$total_amount_due.'\', \''.$ran.'\')">+</label></td>
                </tr>';
              }
        }
        if(trim($_POST['p'])=="po-payment"){
              //$trans = $app->getTransactions("WHERE md = '".$_POST['comp']."' AND payment_id = '0'");
              $po = $app->getPo("WHERE supplier_id = '".$_POST['comp']."' AND payment_id = '0' ORDER BY date_forwarded ASC");
              //echo json_encode($trans)."<===";
              $suppliers = $app->getSuppliers();
              foreach ($po as $key => $value) {
                $inclusives = json_decode($value['inclusives'], true);
                $total_amount_due = 0;
                foreach($inclusives as $k=>$v){
                    //echo json_encode($v);
                  $amountis = (float) str_replace(",","",$v['amount']);
                    $total_amount_due = $total_amount_due + $amountis ;
                }

                $ran = $value['po_number']; 
                while(strlen($ran)<6){ $ran = "0".$ran; }
                $ran = "PON-".$ran;
                echo '<tr>
                  <td>'.$ran.'
                  </td>
                  <td>'.$suppliers[$value['supplier_id']]['business'].'</td>
                  <td>'.$value['date_forwarded'].'</td>
                  <td>'.$value['date_received'].'</td>
                  <td style="text-align: right;">'.number_format($total_amount_due,2).'</td>
                  <td><label class="btn btn-xs btn-danger" onClick="Addmew(\''.$value['id'].'\', \''.$value['po_number'].'\', \''.$suppliers[$value['supplier_id']]['business'].'\', \''.$value['date_forwarded'].'\', \''.$value['date_received'].'\', \''.$total_amount_due.'\', \''.$ran.'\')">+</label></td>
                  <!--<td><label class="btn btn-xs btn-danger" onClick="removeMe(\''.$ran.'\')">x</label></td>-->
                </tr>';
              }
        }

      
        
   			  
                
           
}

?>