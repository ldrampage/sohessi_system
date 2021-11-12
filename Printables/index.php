<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<?php include '../core/core.php'; $app = new mckirby();  ?>

    <?php


    $response=array('message'=>"",'action'=>'');
    if(isset($_GET['id'])){
        $data = array('model'=>'client', 'condition'=>"WHERE id = '".$_GET['id']."'",'order'=>' order by business');
        $responsed = $app->getRecord2($data);
        $tenant = $responsed['data'][0];


        $c = "WHERE id = '".$_GET['view-bill']."'";



        $data = array('model'=>'billings', 'condition'=> $c,'order'=>' order by date_due DESC');
        $responsedb = $app->getRecord2($data);
        $bills = $responsedb['data'];
        $bills = $bills[0];
        // echo json_encode($bills);


        $bill_types = $app->getCharges();

    }

   
    $dsunits = $app->getRentalUnits(); 


    ?>


	<title>IT-Solves - Printable Invoice</title>
	
	<link rel='stylesheet' type='text/css' href='css/style.css' />
	<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
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

<body>

	<div id="page-wrap">
        <table>
        <tr>
        <td style="border: none; padding: 0px;">
        <div style="width: 95%;">
            <textarea id="header">BILLING</textarea>

            <div id="identity">




                <div id="logo">

<!--                  <div id="logoctr">-->
<!--                    <a href="javascript:;" id="change-logo" title="Change logo">Change Logo</a>-->
<!--                    <a href="javascript:;" id="save-logo" title="Save changes">Save</a>-->
<!--                    |-->
<!--                    <a href="javascript:;" id="delete-logo" title="Delete logo">Delete Logo</a>-->
<!--                    <a href="javascript:;" id="cancel-logo" title="Cancel changes">Cancel</a>-->
<!--                  </div>-->

                  <div id="logohelp">
                    <input id="imageloc" type="text" size="50" value="" /><br />
                    (max width: 540px, max height: 100px)
                  </div>
                  <img id="image" src="images/logo.png" alt="logo" />
                </div>

            </div>

            <div style="clear:both"></div>

            <div id="customer">
                <table border="0">
                <tr>
                <td style="border: none;vertical-align: top;">
                <?php echo "Trade Name: ".$tenant['business']; ?><br>
                <?php //echo "Owner: ".$tenant['lname'].", ".$tenant['fname']." ".$tenant['mname']; ?>
                <?php //echo "Address: ".$tenant['address_line1'].", ".$tenant['muni_city']." ".$tenant['province']; ?>
                <?php echo "Tel #: ".$tenant['phone']."/ ".$tenant['mobile']; ?><br>
                <?php echo "Unit #: ". $dsunits[$bills['unit_id']]['name']; ?>
                <?php 
                $type1 = array(0=>"Reant", 1=>"Water", 2=>"Electricity");
                if($bills['type']<3){
                    $rtype = $type1[$bills['type']];    
                }else{
                    
                    $rtype = $bill_types[$bills['other']]['name'];   
                }
                echo "Bill Type: ". $rtype; ?>
                </td>
                <td style="border: none; vertical-align: top;">
                <table id="meta">
                    <tr>
                        <td class="meta-head">Bill #</td>
                        <td><?php echo $bills['invoice_number']; ?></td>
                    </tr>
                    <tr>

                        <td class="meta-head">Bill Date</td>
                        <td><?php

                                echo date("M d, Y",strtotime($bills['date_from']))."-".date("M d, Y",strtotime($bills['date_to']));

                                ?></td>
                    </tr>
                    <tr>

                        <td class="meta-head">Date Issued</td>
                        <td><?php

                                echo date("M d, Y",strtotime($bills['date_issued']));


                                ?></td>
                    </tr>
                    <tr>

                        <td class="meta-head">Date Due</td>
                        <td><?php
                                echo date("M d, Y",strtotime($bills['date_due']));
                                 ?></td>
                    </tr>
                    <tr>
                        <td class="meta-head">Amount Due</td>
                        <td><div class="due">PHP <?php echo number_format($bills['amount'],2); ?></div></td>
                    </tr>

                </table>
                </td>
                </tr>
                </table>

            </div>

            <table id="items">

              <tr>
                  <th colspan="5">Bill Details</th>
              </tr>

              <tr class="item-row">
                  <td class="item-name">RATE: </td>
                  <td class="description" colspan="4"><?php 
                  
                                $settings = $app->getSettings();
                                $vat = 0;
                                $wht = 0;
                                $wrate = 0;
                                $erate = 0;
                                $rent_rate = ($tenant['price_per_sqm']*$dsunits[$bills['unit_id']]['sqr']);
                                foreach($settings as $k=> $v){
                                    if(trim($v['name'])=="vat"){ $vat = $v['value']; }
                                    if(trim($v['name'])=="wht"){ $wht = $v['value']; }
                                    if(trim($v['name'])=="water-rate"){ $wrate = $v['value']; }
                                    if(trim($v['name'])=="electric-rate"){ $erate = $v['value']; }
                                }
                    $rrealu = "";
                    
                    $month_number = $app->nb_mois($bills['date_from'], $bills['date_to']);
                    $amt = "";
                     if( $bills['type']==0 ){
                         $amt = ($tenant['price_per_sqm']*$dsunits[$bills['unit_id']]['sqr']);
                         echo $amt."/month";
                         
                         $rrealu = "month";
                         $cons = $month_number;
                     }
                     if( $bills['type']==1 ){
                         $amt = $bills['consumed']*$wrate;
                         echo $wrate."/cubic metre";
                         $rrealu = "cubic metre";
                         $cons = $bills['consumed'];
                     }
                     if( $bills['type']==2 ){
                         $amt = $bills['consumed']*$erate;
                         echo $erate."/cubic metre";
                         $rrealu = "cubic metre";
                         $cons = $bills['consumed'];
                     }
                     if( $bills['type']>2 ){
                        if (strpos(strtoupper($bill_types[$bills['other']]['name']), 'CUSA') !== false) {
                            if($tenant['cusa_rate']!=0){
                                if($bill_types[$bills['other']]['sqmby']=="Fixed"){
                                    echo $tenant['cusa_rate']."/month";
                                    $amt = $tenant['cusa_rate'];
                                    $rrealu = "month";
                                }else{
                                    echo $tenant['cusa_rate']."/sqm";
                                    $amt = $tenant['cusa_rate'];
                                    $rrealu = "sqm";
                                    $cons = $dsunits[$bills['unit_id']]['sqr'];
                                }
                            }else{
                                if($bill_types[$bills['other']]['sqmby']=="Fixed"){
                                    echo $bill_types[$bills['other']]['price']."/month";
                                    $amt = $bill_types[$bills['other']]['price'];
                                    $rrealu = "month";
                                    $cons = $month_number;
                                }else{
                                    echo $bill_types[$bills['other']]['price']."/sqm";
                                    $amt = $bill_types[$bills['other']]['price']*$dsunits[$bills['unit_id']]['sqr'];
                                    $rrealu = "sqm";
                                    $cons = $dsunits[$bills['unit_id']]['sqr'];
                                }
                            }
                        }else{
                            if($bill_types[$bills['other']]['sqmby']=="Fixed"){
                                echo $bill_types[$bills['other']]['price']."/month";
                                $amt = $bill_types[$bills['other']]['price'];
                                $rrealu = "month";
                                $cons = $month_number;
                            }else{
                                echo $bill_types[$bills['other']]['price']."/sqm";
                                $amt = $bill_types[$bills['other']]['price']*$dsunits[$bills['unit_id']]['sqr'];
                                $rrealu = "sqm";
                                $cons = $dsunits[$bills['unit_id']]['sqr'];
                            }
                            
                        }
                         
                     }
                  
                 // echo number_format($bills['amount_per_unit'],2)."/". $bills['billing_unit']; ?></td>
              </tr>

                <?php

                if( $bills['type']==1 || $bills['type']==2 ): ?>
                    <tr class="item-row">
                        <td class="item-name">READING: </td>
                        <td class="description" colspan="4"><?php echo $bills['meter_from']; ?> - <?php echo $bills['meter_to']; ?></td>
                    </tr>

                <?php endif; ?>

              <tr class="item-row">
                  <td class="item-name">Amount: </td>
                  <td class="description" colspan="4"><?php echo number_format($amt,0);  ?></td>
              </tr>

                <tr class="item-row">
                    <td class="item-name"><?php echo $rrealu; ?>: </td>
                    <td class="description" colspan="4"><?php echo $cons; echo " ".$rrealu; if($cons>1){ echo "s"; } ?>  </td>
                </tr>
                <tr class="item-row">
                    <td class="item-name">VAT: </td>
                    <td class="description" colspan="4"><?php  echo number_format($bills['vat'],2); ?>  </td>
                </tr>
                <tr class="item-row">
                    <td class="item-name">WHT: </td>
                    <td class="description" colspan="4"><?php  echo number_format($bills['wht'],2); ?> </td>
                </tr>

                <tr class="item-row">
                    <td class="item-name">Total Amount Due: </td>
                    <td class="description" colspan="4"><?php  echo number_format($bills['amount'],2); ?> </td>
                </tr>



            </table>
            <div id="terms">
                <h5>Notes:</h5>
                <textarea><?php if($bills['notes']==""){echo "N/A";}else{echo $bills['notes'];} ?></textarea>
            </div>
            <div id="terms">


                <table style="width: 100%;">
                    <tr>
                        <td style="border: none;">Prepared By:
                        <br>
                            <textarea class="prepared"></textarea>
                        </td>
                        <td style="border: none;">Received By:
                        <br>
                            <textarea class="received"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td style="border: none;">Approved By:
                        <br>
                            <textarea class="approved"></textarea>
                        </td>
                        <td style="border: none;"></td>
                    </tr>
                </table>

            </div>
        </div>
        </td>
        <td style="border: none; padding: 0px;">
            <div style="width: 95%;">
            <textarea id="header">BILLING</textarea>

            <div id="identity">




                <div id="logo">

<!--                  <div id="logoctr">-->
<!--                    <a href="javascript:;" id="change-logo" title="Change logo">Change Logo</a>-->
<!--                    <a href="javascript:;" id="save-logo" title="Save changes">Save</a>-->
<!--                    |-->
<!--                    <a href="javascript:;" id="delete-logo" title="Delete logo">Delete Logo</a>-->
<!--                    <a href="javascript:;" id="cancel-logo" title="Cancel changes">Cancel</a>-->
<!--                  </div>-->

                  <div id="logohelp">
                    <input id="imageloc" type="text" size="50" value="" /><br />
                    (max width: 540px, max height: 100px)
                  </div>
                  <img id="image" src="images/logo.png" alt="logo" />
                </div>

            </div>

            <div style="clear:both"></div>

            <div id="customer">
                <table border="0">
                <tr>
                <td style="border: none;vertical-align: top;">
                <?php echo "Trade Name: ".$tenant['business']; ?><br>
                <?php //echo "Owner: ".$tenant['lname'].", ".$tenant['fname']." ".$tenant['mname']; ?>
                <?php //echo "Address: ".$tenant['address_line1'].", ".$tenant['muni_city']." ".$tenant['province']; ?>
                <?php echo "Tel #: ".$tenant['phone']."/ ".$tenant['mobile']; ?><br>
                <?php echo "Unit #: ". $dsunits[$bills['unit_id']]['name']; ?>
                <?php 
                $type1 = array(0=>"Reant", 1=>"Water", 2=>"Electricity");
                if($bills['type']<3){
                    $rtype = $type1[$bills['type']];    
                }else{
                    
                    $rtype = $bill_types[$bills['other']]['name'];   
                }
                echo "Bill Type: ". $rtype; ?>
                </td>
                <td style="border: none; vertical-align: top;">
                <table id="meta">
                    <tr>
                        <td class="meta-head">Bill #</td>
                        <td><?php echo $bills['invoice_number']; ?></td>
                    </tr>
                    <tr>

                        <td class="meta-head">Bill Date</td>
                        <td><?php

                                echo date("M d, Y",strtotime($bills['date_from']))."-".date("M d, Y",strtotime($bills['date_to']));

                                ?></td>
                    </tr>
                    <tr>

                        <td class="meta-head">Date Issued</td>
                        <td><?php

                                echo date("M d, Y",strtotime($bills['date_issued']));


                                ?></td>
                    </tr>
                    <tr>

                        <td class="meta-head">Date Due</td>
                        <td><?php
                                echo date("M d, Y",strtotime($bills['date_due']));
                                 ?></td>
                    </tr>
                    <tr>
                        <td class="meta-head">Amount Due</td>
                        <td><div class="due">PHP <?php echo number_format($bills['amount'],2); ?></div></td>
                    </tr>

                </table>
                </td>
                </tr>
                </table>

            </div>

            <table id="items">

              <tr>
                  <th colspan="5">Bill Details</th>
              </tr>

              <tr class="item-row">
                  <td class="item-name">RATE: </td>
                  <td class="description" colspan="4"><?php 
                  
                                $settings = $app->getSettings();
                                $vat = 0;
                                $wht = 0;
                                $wrate = 0;
                                $erate = 0;
                                $rent_rate = ($tenant['price_per_sqm']*$dsunits[$bills['unit_id']]['sqr']);
                                foreach($settings as $k=> $v){
                                    if(trim($v['name'])=="vat"){ $vat = $v['value']; }
                                    if(trim($v['name'])=="wht"){ $wht = $v['value']; }
                                    if(trim($v['name'])=="water-rate"){ $wrate = $v['value']; }
                                    if(trim($v['name'])=="electric-rate"){ $erate = $v['value']; }
                                }
                    $rrealu = "";
                    
                    $month_number = $app->nb_mois($bills['date_from'], $bills['date_to']);
                    $amt = "";
                     if( $bills['type']==0 ){
                         $amt = ($tenant['price_per_sqm']*$dsunits[$bills['unit_id']]['sqr']);
                         echo $amt."/month";
                         
                         $rrealu = "month";
                         $cons = $month_number;
                     }
                     if( $bills['type']==1 ){
                         $amt = $bills['consumed']*$wrate;
                         echo $wrate."/cubic metre";
                         $rrealu = "cubic metre";
                         $cons = $bills['consumed'];
                     }
                     if( $bills['type']==2 ){
                         $amt = $bills['consumed']*$erate;
                         echo $erate."/cubic metre";
                         $rrealu = "cubic metre";
                         $cons = $bills['consumed'];
                     }
                     if( $bills['type']>2 ){
                        if (strpos(strtoupper($bill_types[$bills['other']]['name']), 'CUSA') !== false) {
                            if($tenant['cusa_rate']!=0){
                                if($bill_types[$bills['other']]['sqmby']=="Fixed"){
                                    echo $tenant['cusa_rate']."/month";
                                    $amt = $tenant['cusa_rate'];
                                    $rrealu = "month";
                                }else{
                                    echo $tenant['cusa_rate']."/sqm";
                                    $amt = $tenant['cusa_rate'];
                                    $rrealu = "sqm";
                                    $cons = $dsunits[$bills['unit_id']]['sqr'];
                                }
                            }else{
                                if($bill_types[$bills['other']]['sqmby']=="Fixed"){
                                    echo $bill_types[$bills['other']]['price']."/month";
                                    $amt = $bill_types[$bills['other']]['price'];
                                    $rrealu = "month";
                                    $cons = $month_number;
                                }else{
                                    echo $bill_types[$bills['other']]['price']."/sqm";
                                    $amt = $bill_types[$bills['other']]['price']*$dsunits[$bills['unit_id']]['sqr'];
                                    $rrealu = "sqm";
                                    $cons = $dsunits[$bills['unit_id']]['sqr'];
                                }
                            }
                        }else{
                            if($bill_types[$bills['other']]['sqmby']=="Fixed"){
                                echo $bill_types[$bills['other']]['price']."/month";
                                $amt = $bill_types[$bills['other']]['price'];
                                $rrealu = "month";
                                $cons = $month_number;
                            }else{
                                echo $bill_types[$bills['other']]['price']."/sqm";
                                $amt = $bill_types[$bills['other']]['price']*$dsunits[$bills['unit_id']]['sqr'];
                                $rrealu = "sqm";
                                $cons = $dsunits[$bills['unit_id']]['sqr'];
                            }
                            
                        }
                         
                     }
                  
                 // echo number_format($bills['amount_per_unit'],2)."/". $bills['billing_unit']; ?></td>
              </tr>

                <?php

                if( $bills['type']==1 || $bills['type']==2 ): ?>
                    <tr class="item-row">
                        <td class="item-name">READING: </td>
                        <td class="description" colspan="4"><?php echo $bills['meter_from']; ?> - <?php echo $bills['meter_to']; ?></td>
                    </tr>

                <?php endif; ?>

              <tr class="item-row">
                  <td class="item-name">Amount: </td>
                  <td class="description" colspan="4"><?php echo number_format($amt,0);  ?></td>
              </tr>

                <tr class="item-row">
                    <td class="item-name"><?php echo $rrealu; ?>: </td>
                    <td class="description" colspan="4"><?php echo $cons; echo " ".$rrealu; if($cons>1){ echo "s"; } ?>  </td>
                </tr>
                <tr class="item-row">
                    <td class="item-name">VAT: </td>
                    <td class="description" colspan="4"><?php  echo number_format($bills['vat'],2); ?>  </td>
                </tr>
                <tr class="item-row">
                    <td class="item-name">WHT: </td>
                    <td class="description" colspan="4"><?php  echo number_format($bills['wht'],2); ?> </td>
                </tr>

                <tr class="item-row">
                    <td class="item-name">Total Amount Due: </td>
                    <td class="description" colspan="4"><?php  echo number_format($bills['amount'],2); ?> </td>
                </tr>



            </table>
            <div id="terms">
                <h5>Notes:</h5>
                <textarea><?php if($bills['notes']==""){echo "N/A";}else{echo $bills['notes'];} ?></textarea>
            </div>
            <div id="terms">


                <table style="width: 100%;">
                    <tr>
                        <td style="border: none;">Prepared By:
                        <br>
                            <textarea class="prepared"></textarea>
                        </td>
                        <td style="border: none;">Received By:
                        <br>
                            <textarea class="received"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td style="border: none;">Approved By:
                        <br>
                            <textarea class="approved"></textarea>
                        </td>
                        <td style="border: none;"></td>
                    </tr>
                </table>

            </div>
        </div>
        </td>
        </tr>
        </table>
	</div>
	
</body>

<script>
    window.onload = function() { window.print(); }
    $('.approved').on('input', function() {
        var val = $(this).val();
       //alert(val);
    });



</script>

</html>