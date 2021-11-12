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
date_default_timezone_set('Asia/Manila');
$current = date("Y-m-d");
$sql = "SELECT * FROM tbl_queuing WHERE status='1' AND date = '".$current."' AND trans_type='Laboratory' AND labcategory = '".$_SESSION['labcategory']."' GROUP BY queuing_number  ORDER BY dtime ASC";
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
  $updata = array("model"=>"queuing", "values"=>"status='5'", 
                "condition"=>" WHERE queuing_number = '".$_GET['done']."' AND trans_type = 'Check-up' AND dr_id = '".$_SESSION['login_id']."'");
  $r=$app->update2($updata);
}


?>


    <section class="content">
      

      
      
      <div class="row">
        
        <div class="col-md-8">
              <!-- USERS LIST -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Patients</h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger"><?php echo sizeOf($trans); ?> Patient(s)</span>
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
                  // echo json_encode($_SESSION);
                  $today = $app->getQueuing(" WHERE date = '".$today."' AND labcategory='".$_SESSION['labcategory']."' AND status>'1'");
                  //echo json_encode($today);
                  ?>

                </div>   


                <div class="box-body no-padding">
                    <div class="box-body table-responsive">
                        
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th style="width:8px;"></th>
                                <th >Patient ID</th>
                                <th >Name</th>
                                <th >Queuing #</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="queuing_body">
                            

                            </tbody>
                            <tfoot>
                            <tr>
                                 <th style="width:8px;"></th>
                                <th >Patient ID</th>
                                <th >Name</th>
                                <th >Queuing #</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                  
                </div>
               
              </div>
              <!--/.box -->
        </div>
        <div class="col-md-4">
          <div class="row"> 
            <div class="col-md-6 col-sm-6 col-xs-6">
              <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="fa fa-credit-card"></i></span>

                <div class="info-box-content">
                  <a href="index.php?page=tickets&status=0"><span class="info-box-text">Today's<br>Patient(s)</span></a>
                  <span class="info-box-number"  id="done_count"><?php echo sizeOf($today); ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                  <a href="index.php?page=tickets&status=0"><span class="info-box-text">Next<br>Patient(s)</span></a>
                  <span class="info-box-number" id="enq_count">0</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">On-process</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                      <tr>
                        <th>Patient ID</th>
                        <th>Name</th>
                        <th>Q#</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody id="onprocess">
                      
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
               <!--  <div class="box-footer clearfix">
                  <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                  <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                </div> -->
                <!-- /.box-footer -->
              </div>
            </div>  
          </div>
        </div> 


      </div>      
      
      
    </section>
    
  <script>




 function chechEnqued(){
   $.ajax({
        url: "checkEnqueued.php",
        type: "post",
        data: { en: 7, lbc: <?php echo $_SESSION['labcategory']; ?> },
        success: function (response) {
          var data = JSON.parse(response);
          var stringHTML = "";
          var counter = 0;
          //alert($("#enq_count").text());

          for (val in data) { counter++;
              stringHTML += "<tr>";
              stringHTML += "<td>"+counter+"</td>";
              stringHTML += "<td>"+data[val]['patient_number']+"</td>";
              stringHTML += "<td>"+data[val]['name']+"</td>";
              stringHTML += "<td>"+data[val]['queuing_number']+"</td>";


              stringHTML += "<td><a href='?page=process-test&id="+data[val]['patient_id']+"&qn="+data[val]['queuing_number']+"&dq="+data[val]['id']+"' class='btn btn-xs btn-success'>Proceed</a></td>";
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


   $.ajax({
        url: "checkEnqueued.php",
        type: "post",
        data: { en: 8, lbc: <?php echo $_SESSION['labcategory']; ?> },
        success: function (response) {
          var data = JSON.parse(response);
          var stringHTML = "";
          var counter = 0;
          //alert($("#enq_count").text());
          for (val in data) { counter++;
              stringHTML += "<tr>";
              stringHTML += "<td>"+data[val]['patient_number']+"</td>";
              stringHTML += "<td>"+data[val]['name']+"</td>";
              stringHTML += "<td>"+data[val]['queuing_number']+"</td>";
              stringHTML += "<td><a href='?page=process-test&id="+data[val]['patient_id']+"&qn="+data[val]['queuing_number']+"&dq="+data[val]['id']+"' class='btn btn-xs btn-success'>Proceed</a></td>";
              stringHTML += "</tr>";
          }

          $("#onprocess").empty();
          $("#onprocess").html(stringHTML);

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

 function cancelPro(){
    $("#proceed").empty();
 }

</script>  

