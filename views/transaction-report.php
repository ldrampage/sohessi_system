
<script>


    function deleteThis(id, name){
        if (confirm('Are you sure you want to delete '+name+'?')) {
            window.location.href = window.location.href + '&del='+id;
        }
    }

</script>



<?php

//$app->autoGenerateIds();
if(isset($_GET['status'])){ $estatus=$_GET['status']; }else{ $estatus=1; }
if(isset($_GET['aup'])){ $aup=$_GET['aup']; }else{ $aup="all"; }
if(isset($_GET['en'])){ $en=$_GET['en']; }else{ $en="all"; }
if(isset($_GET['acp'])){ $acp=$_GET['acp']; }else{ $acp="all"; }

$module = explode("-",$page);
$title = ucfirst($module[0]);
$response['action']="none";
error_reporting(E_ALL); ini_set('display_errors', 1); 


$response=array('action'=>"", 'message'=>"");
$daction = "";

if(isset($_GET['del'])){

    $data = array('model'=>'employee', 'condition'=>" WHERE id = '".$_GET['del']."'");
    $response = $app->delete2($data);
}



$data = array('model'=>'employee','order'=>' order by lname');
$conditions ="";

if(isset($_GET['search'])){
    if($conditions==""){ $conditions = " WHERE fname LIKE '%".$_GET['search']."%' OR mname LIKE '%".$_GET['search']."%' OR lname LIKE '%".$_GET['search']."%'"; }
    else{ $conditions = $conditions." AND fname LIKE '%".$_GET['search']."%'  OR mname LIKE '%".$_GET['search']."%'  OR lname LIKE '%".$_GET['search']."%'"; }
}

if($conditions==""){
    $conditions = " WHERE status = '".$estatus."'";
}else{
    $conditions = $conditions. " AND status = '".$estatus."'";
}
$where ="";
if(isset($_GET['searchd'])){
    $xp = explode('=>',$_GET['searchd']);
    $where=' WHERE t.trans_date BETWEEN "'.date('Y-m-d', strtotime($xp[0])).'" AND "'.date('Y-m-d', strtotime($xp[1])).'"';
    $dfrom = date('m/d/Y', strtotime($xp[0]));
    $dto = date('m/d/Y', strtotime($xp[1]));
}else{
    $where=' WHERE t.trans_date BETWEEN "'.date('Y-m-d').'" AND "'.date('Y-m-d').'"';
    $dfrom = date('m/d/Y');
    $dto = date('m/d/Y');
}

//echo $conditions;
$data['joint'] = "SELECT p.id as pid, p.fname, p.mname, p.lname,p.patient_number,p.image,
                         t.patient_id, t.trans_date, t.trans_time,t.total_amount, t.amount_paid, t.or_number   
FROM tbl_transaction t
INNER JOIN tbl_patient p ON t.patient_id = p.id ".$where;

// echo json_encode($data);


$patient = $app->getRecordJoint($data);
// $patient = $patient['data'];
// echo json_encode($patient);


//echo json_encode($clients);

if(isset($_GET['t'])){ $t=$_GET['t'];}else{ $t=1; }
// $addtitle = array(1=>"", 2=>" (Probationary Employees)", 3=>" (Newly Regular Employees)", 4=>" (Upcoming Payroll Summary)");
$addtitle = array(1=>"", 2=>" (Probationary Employees)", 3=>" (Newly Regular Employees)", 4=>" (Upcoming Payroll Summary)");


?>

<div class="message-box">
    <?php

    if($response['action']=="delete"){ $daction = "deleted"; }
    if( $response['action']=="update"){ $daction = "updated"; }
    if( $response['action']=="create"){ $daction = "created"; }



    ?>

</div>

<section class="content" >


    <div class="row">

        <div class="col-md-12">



            <div class="widget-content ">
                <div>

                <?php if( $response['message']=="Successful"){
                    echo '<br><div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">x</a>
                    <strong>Success!</strong> Record '.$daction.' successfully.
                </div>';
                }
                ?>



            </div>
            <div id="print" class="myDivToPrint">
                <div class="box">
                    <div class="box-header">
                        
                        
                        <div class="form-group">
                                    <div class="col-sm-8">
                                    <label for="inputSkills" class="col-sm-<?php if($t==1){echo "1";}else{echo "6"; } ?> control-label"><h3 class="box-title" style="font-weight: bold;     line-height: 1.5;">Transaction Report</h3></label>
                                    </div>
                                   
                                  </div>
                       
                            
                    </div>
                   <form method="post" enctype="">
                   <div class='row' style="margin-left: 10px;">
                        <div class="col-sm-2">
                            <label>Date From</label>
                            <input type="text" id="datefrom" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask=""  value="<?php echo $dfrom; ?>">
                        </div>
                        <div class="col-sm-2">
                            <label>Date To</label>
                            <input type="text" id="dateto" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" value="<?php echo $dto; ?>">
                        </div>
                        <div class="col-sm-2" >
                            <button type="button" class="btn btn-success" onclick="javascript:search();" style="margin-top:23px;">search</button>
                        </div>    
                   </div>
               </form>
    
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                             
                                <th style="width:auto;"></th>
                                <th >ID</th>
                                <th >Name</th>
                                <th >DateTime</th>
                                <th >Total Amount</th>
                                <th >Amount Paid</th>
                                <th >OR Number</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $n=0;
                            
                
                            foreach($patient as $ke => $value): $n++;

                            ?>
                                <tr>
                                    <td ><?php echo $n; ?></td>
                                    <td ><?php echo $value['patient_number']; ?></td>
                                    <td ><img src="<?php echo $value['image']; ?>" style="width: 35px; height: 35px;" class="user-image" alt="User Image">
                                    <?php echo $value['lname'].", ".$value['fname']." ".$value['mname']; ?></td>
                                    <td ><?php echo $value['trans_date']." ".$value['trans_time']; ?></td>
                                    <td ><?php echo $value['total_amount']; ?></td>
                                    <td ><?php echo $value['amount_paid']; ?></td>
                                    <td ><?php echo $value['or_number']; ?></td>

                                </tr>
                            <?php   endforeach;  ?>

                            </tbody>
                            <tfoot>
                            <tr>

                                <th style="width:auto;"></th>
                                <th >ID</th>
                                <th >Name</th>
                                <th >DateTime</th>
                                <th >Total Amount</th>
                                <th >Amount Paid</th>
                                <th >OR Number</th>
                               
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
    </div> 
    </div>
    <script>
    
      function search(){
        var x = $('#datefrom').val();
        var y = $('#dateto').val();
        if(x!=='' && y !=='')
        window.location.href = '?page=transaction-report&t=transactions&searchd='+x+'=>'+y;
      }

    </script>