<style>
    .content-wrapper {
        background:linear-gradient(rgba(255, 255, 255, 0.4), rgba(255, 255, 255, 0.4)),url('../../hr.jpeg') no-repeat center center fixed;
         -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    
    .skin-blue .content-header {
        padding: 15px 15px 15px 15px;
        background:white;
    }
   
  .info-box-icon {
    /*padding-top: 10%;*/
}
  .box-tools{
    top: 15px;
  }
  .info-box-number{
    font-size: 30px;
    font-weight: bold;
  }
table { 
    /*border-spacing: 10px;
    border-collapse: separate;*/
}
table.protable > th{
  
}
td { 
    padding: 5px;
}
th{
   padding: 5px;
   /*background-color: #dd4b39;*/
}
</style>

<?php
$materials = $app->getMaterials();
$laboffered = $app->getLabTests();
if(isset($_GET['dt'])){
  $data = array('model'=>'queuing', 'condition'=>" WHERE id = '".trim($_GET['dt'])."'");
    $response = $app->delete2($data);
    $response['message'] = "Deleted";
    echo '<script>window.location.href = "?page='.$_GET['page'].'";</script>';
}
if(isset($_POST['btn_prc'])){
  $condition = " WHERE id='".$_POST['id']."'";
  $r = $app->getEnqueued($condition);
  //echo json_encode($r)."<br>----------------<br>";
  $labid = $r[$_POST['id']]['which'];
  

  $data = array("model"=>"queuing",
                "values"=>"status='".ONPROCESS."', notes='".str_replace("'","\'",trim($_POST['notes']))."'",
                "condition"=>"WHERE id = '".$_POST['id']."'");

  $resp = $app->update2($data );
  if($resp['message']=="Successful"){
    $labmat = $app->getLabMaterials("WHERE test_id = '".$labid."'");
    foreach($labmat as $k=>$v){
      //echo json_encode($v)."<br>===<br>";
      $cur_qty = $materials[$v['material_id']]['qty'];
      $sub_qty = $v['qty'];
      $new_qty = $cur_qty - $sub_qty;
      $data = array("model"=>"materials",
                "values"=>"qty='".$new_qty."'",
                "condition"=>"WHERE id = '".$v['material_id']."'");
      $respq = $app->update2($data );
    }
    echo "<script>location.href='?page=process-test';</script>";

    //echo json_encode($materials);
  }
  

}


date_default_timezone_set('Asia/Manila');
$current = date("Y-m-d");
$sql = "SELECT * FROM tbl_queuing WHERE status='".PAID."' AND date = '".$current."' AND (trans_type='Check-up' OR trans_type = 'Laboratory') GROUP BY queuing_number  ORDER BY dtime ASC";
//echo $sql;
$result = mysqli_query($app->connect(),$sql) or die(mysqli_connect_error());
$trans  = array();
while($fetchData = mysqli_fetch_assoc($result)){
    $trans[$fetchData['id']] = $fetchData;
}
//echo json_encode($trans);
$patients = $app->getPatients();

$settings = $app->getSettingsByName();
//echo json_encode($settings);

if(isset($_GET['done'])){
  $updata = array("model"=>"queuing", "values"=>"status='3'", 
                "condition"=>" WHERE queuing_number = '".$_GET['done']."' AND trans_type = 'Laboratory' AND id = '".$_GET['id']."'");
  $r=$app->update2($updata);
}


?>


    <section class="content">
      

      
      
      <div class="row">
        
        <div class="col-md-6">
              <!-- USERS LIST -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Enqueued Patient(s)</h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger"></span>
                    <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>-->
                    <!--</button>-->
                    <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>-->
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body no-padding" id="proceed">
                  <?php
                  $today = date("Y-m-d");
                  $nowTime = date("H:i:s");

                  $secmessage = "";
                   
                   
                  if(isset($_POST['btn_submit'])){
                    ///echo json_encode($_POST)."<br>";
                    
                    ///echo $settings['orprefix']['value'];

                   
                    $orNumberCon = " WHERE orprefix='".$settings['orprefix']['value']."'";
                    $orExists = $app->getTransactions($orNumberCon);
                    $numberExist = sizeOf($orExists);
                    $startNumber = (int) $settings['or_start']['value'];

                    $newOrNumber = $startNumber + $numberExist;
                    if(strlen($newOrNumber)==1){ $newOrNumber = "000".$newOrNumber; }
                    if(strlen($newOrNumber)==2){ $newOrNumber = "00".$newOrNumber; }
                    if(strlen($newOrNumber)==3){ $newOrNumber = "0".$newOrNumber; }
                    //echo $newOrNumber;
                    
                    $inData = array('model'=>"transaction", 
                                    "keys"=>"patient_id, trans_date, trans_time, total_amount, or_number, amount_paid, net, queuing_number, realdate, vat, wht, orprefix",
                                    "values"=>"'".$_POST['patient_id']."', 
                                               '".$today."',
                                               '".$nowTime."',
                                               '".$_POST['total_amount']."',
                                               '".$newOrNumber."',
                                               '".$_POST['amount_paid']."',
                                               '".$_POST['net']."',
                                               '".$_POST['qn']."',
                                               '".date("Y-m-d H:i:s")."',
                                               '".$_POST['vat']."',
                                               '".$_POST['wht']."',
                                               '".$settings['orprefix']['value']."'");  
                   // patient_id
                    $changeIs = $_POST['amount_paid'] -  $_POST['total_amount'];
                    $r = $app->create2($inData);
                    if($r['id']!=0){
                      $con = " WHERE date = '".$today."' AND queuing_number='".$_POST['qn']."' AND or_number=''";
                       $data = array("model"=>"queuing");
                       $data['values']="or_number = '".$newOrNumber."', status = '1'";
                       $data['condition'] = $con;
                       $response = $app->update2($data);

                        if($response['message']=="Successful"){

                            echo '<div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            <h4><i class="icon fa fa-check"></i></h4>
                            O.R. #: <strong>'.$newOrNumber.'</strong><br>
                            Total Amount: <strong>'.number_format($_POST['total_amount'],2).'</strong><br>
                            Amount Paid: <strong>'.number_format($_POST['amount_paid'],2).'</strong><br>
                            Change: <strong>'.number_format($changeIs,2).'</strong><br>
                          </div>';
                        }
                    }
                    
                  }
                  $today = $app->getQueuing(" WHERE date = '".$today."' AND dr_id='".$_SESSION['login_id']."' AND status>'1'");
                  //echo json_encode($today);
                  ?>

                </div>   


                <div class="box-body no-padding">
                    <div class="box-body table-responsive">
                        <?php if(isset($_GET['proceed'])){ ?>
                          <div class="box-body">
                            <form method="POST">  
                            <div class="form-group row">
                              <label for="inputSkills" class="col-sm-3 control-label">Note(s)</label>
                              <input type="hidden" value="<?php echo $_GET['proceed']; ?>" name="id">
                              <div class="col-sm-9">
                                <textarea class="form-control" id="inputSkills" placeholder="Notes" name="notes"  value="" required></textarea> 
                              </div>
                            </div>

                            
                            <input type="submit" name="btn_prc" class="btn btn-sm btn-success pull-right " style="margin-left: 5px;" value="Yes">
                            <a href="?page=process-test" class="btn btn-sm btn-warning pull-right"  style="margin-left: 5px;" value="">No</a>
                           <span class="pull-right" style="margin-top: 5px; font-weight: bold;">Proceed?</span>
                           </form>
              
                          </div>
                          <!-- /.box-body -->
                        <?php } ?>

                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th style="width:3px;"></th>
                                <th >ID/Name</th>
                                <th >Queuing #</th>
                                <th >Test Procedure</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="queuing_body">
                            

                            </tbody>
                            <tfoot>
                            <tr>
                                <th style="width:3px;"></th>
                                <th >ID/Name</th>
                                <th >Queuing #</th>
                                <th >Test Procedure</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                  
                </div>
               
              </div>
              <!--/.box -->
        </div>

        <div class="col-md-6">
              <!-- USERS LIST -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">On-Process Procedure(s)</h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger"></span>
                    <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>-->
                    <!--</button>-->
                    <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>-->
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body no-padding" id="proceed2">
                  <?php
                  $today = date("Y-m-d");
                  $nowTime = date("H:i:s");
                  
                  ?>

                </div>   


                <div class="box-body no-padding">
               
                    <div class="box-body table-responsive">
                   
                        <table id="example2" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th style="width:3px;"></th>
                                <th >ID/Name</th>
                                <th >Queuing #</th>
                                <th >Test Procedure</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="queuing_body2">
                            <?php 
                            $condition = " WHERE status='".ONPROCESS."' AND trans_type='Laboratory'";
                            $r = $app->getEnqueuedByCat($condition); $c=0;
                            //echo json_encode($r);
                            foreach($r as $k=>$v){ $c++;
                              echo "<tr>";
                                echo  "<td>".$c."</td>";
                                echo  "<td>".$v['patient_number']."/<hr style='margin-top: 5px; margin-bottom: 5px;'>".$v['name']."</td>";
                                echo  "<td>".$v['queuing_number']."</td>";
                                echo  "<td>".$v['item_name']."</td>";
                                echo  "<td><a href='?page=saveresult&id=".$v['patient_id']."&qn=".$v['queuing_number']."&qid=".$v['id']."' class='btn btn-xs btn-success'>Add Result</a></td>";
                              echo "</tr>";
                            }
                            ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th style="width:3px;"></th>
                                <th >ID/Name</th>
                                <th >Queuing #</th>
                                <th >Test Procedure</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                  
                </div>
               
              </div>
              <!--/.box -->
        </div>



      </div>      
      
      
    </section>
    
  <script>




 function chechEnqued(){
   $.ajax({
        url: "checkEnqueued.php",
        type: "post",
        data: { en: 7, did: <?php echo $_SESSION['login_id']; ?> },
        success: function (response) {
          var data = JSON.parse(response);
          var stringHTML = "";
          var counter = 0;
          //alert($("#enq_count").text());
          for (val in data) { counter++;
              stringHTML += "<tr>";
              stringHTML += "<td>"+counter+"</td>";
              stringHTML += "<td>"+data[val]['patient_number']+"/<br>";
              stringHTML += ""+data[val]['name']+"</td>";
              stringHTML += "<td>"+data[val]['queuing_number']+"</td>";
              stringHTML += "<td>"+data[val]['item_name']+"</td>";
              stringHTML += "<td><a href='?page=process-test&proceed="+data[val]['id']+"&qn="+data[val]['queuing_number']+"' class='btn btn-xs btn-success'>Proceed</a>";

              stringHTML += "<label onClick=\"deleteProcess('"+val+"', '"+data[val]['queuing_number']+" "+data[val]['item_name']+"')\"><span class='btn btn-xs btn-danger'  style='margin: 3px;'>Delete</span></label>";

              stringHTML += "</td>";
              stringHTML += "</tr>";
          }
          $("#enq_count").text(counter);
          $("#queuing_body").empty();
          $("#queuing_body").html(stringHTML);

         // alert(stringHTML);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });
}



 chechEnqued();  
    setInterval(function(){ 
        chechEnqued();  
    }, 10000);


  function proceedPayment(qnum){
    $("#proceed").empty();


    $.ajax({
        url: "checkEnqueued.php",
        type: "post",
        data: { en: 6, qn:  qnum},
        success: function (response) {
          var data = JSON.parse(response);
          var stringHTML = "";
          var counter = 0;
           stringHTML += "<div class='row' style='padding: 5px;'>";
            stringHTML += "<div class='col-md-12'>";
            stringHTML += "<label class='pull-right btn btn-xs btn-warning' style='margin-bottom: 5px; margin-right:5px;' onClick='cancelPro();'>Cancel</label>";
            stringHTML += "<div style='height: auto; width: 100%;'>";
           
            stringHTML += "<form method='post'><table border='1' class='protable' cellpadding='8' style='background-color: #; border: 1px solid #1e1e1e; padding: 5px; width: 100%;'><tr><th style='text-align: center;background-color: #8fc2fc; '>No.</th><th style='text-align: center;background-color: #8fc2fc; '>Item</th><th style='text-align: center;background-color: #8fc2fc; '>Qty</th><th style='text-align: center;background-color: #8fc2fc; '>Price</th><th style='text-align: center;background-color: #8fc2fc; width: 140px;'>Amount</th></tr>";
            var totalAmount = 0;
            var the_qn ='';
            var patient_id = '';
            
          for (val in data) { counter++;
              var amount = parseFloat(data[val]['price']);
              patient_id = data[val]['patient_id'];
              the_qn = data[val]['queuing_number'].trim();
              totalAmount = totalAmount +  amount;
              stringHTML += "<tr>";
              stringHTML += "<td>"+counter+"</td>";
              stringHTML += "<td>"+data[val]['item_name']+"</td>";
              stringHTML += "<td style='text-align: center;'>1</td>";
              stringHTML += "<td  style='text-align: right;'>"+Number(data[val]['price']).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+"</td>";
              stringHTML += "<td  style='text-align: right;'>"+Number(data[val]['price']).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+"</td>";
              stringHTML += "</tr>";

          }
          var wht = parseFloat(<?php echo $settings['wht']['value']; ?>) * totalAmount;
          var vat = parseFloat(<?php echo $settings['vat']['value']; ?>) * totalAmount;
          var net = (totalAmount - wht) - vat;
          stringHTML+="<tr><th colspan='4' style='text-align: right;'>Gross:</th><td  style='text-align: right;'>"+Number(totalAmount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+"<input type='hidden' value='"+the_qn+"' name='qn'><input type='hidden' value='"+vat+"' name='vat'><input type='hidden' value='"+wht+"' name='wht'></td></tr>";
          stringHTML+="<tr><th colspan='4' style='text-align: right;'>WHT:</th><td  style='text-align: right;'>"+Number(wht).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+"</td></tr>";
          stringHTML+="<tr><th colspan='4' style='text-align: right;'>VAT:</th><td  style='text-align: right;'>"+Number(vat).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+"</td></tr>";
          stringHTML+="<tr><th colspan='4' style='text-align: right;'>NET:</th><td  style='text-align: right;'>"+Number(net).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+"</td></tr>";
          stringHTML+="<tr><th colspan='4' style='text-align: right;'>Amount Paid:</th><td  style='text-align: right;'><input type='hidden' value='"+patient_id+"' name='patient_id'><input type='hidden' value='"+net+"' name='net'><input type='hidden' value='"+totalAmount+"' name='total_amount'><input type='text' onkeypress='return isNumber(event);' name='amount_paid' class='form-control' style='width: 140px; text-align: right;' required></td></tr>";
           stringHTML+="<tr><th colspan='4' style='text-align: right;'></th><td  style='text-align: right;'><input type='submit' name='btn_submit' class='btn btn-success btn-sm' style='width: 140px;'></td></tr>";
          stringHTML+="</table></form></div>";
          stringHTML += "</div>";
          stringHTML += "</div>";

          $("#proceed").empty();
          $("#proceed").html(stringHTML);

         // alert(stringHTML);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });




    
    // alert(qnum);
 }

 function isNumber(evt) {
    //alert(1);
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 46 || charCode > 57)) {
        return false;
    }
    return true;
}
 function deleteProcess(dt, qn){
    //alert(dt+qn);
    if (confirm('Are you sure you want to delete this '+qn+'?')) {
            window.location.href = "?page=<?php echo $_GET['page']; ?>&dt="+dt;
        }
  }
 function cancelPro(){
    $("#proceed").empty();
 }

</script>  

