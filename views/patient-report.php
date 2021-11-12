
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

if($aup!="all"){
    if($conditions==""){
    $conditions = " WHERE auto_payslip = '$aup'";
    }else{
        $conditions = $conditions. " AND auto_payslip = '$aup'";
    }

}
if($en!="all"){
    if($conditions==""){
    $conditions = " WHERE email_notify = '$en'";
    }else{
        $conditions = $conditions. " AND email_notify = '$en'";
    }

}
if($acp!="all"){
    if($conditions==""){
        $conditions = " WHERE active_pay = '$acp'";
    }else{
        $conditions = $conditions. " AND active_pay = '$acp'";
    }

}
//echo $conditions;
$data = array('model'=>'patient', 'condition'=>'','order'=>' order by lname');

//echo json_encode($data);


$patient = $app->getRecord2($data);
$patient = $patient['data'];
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
                                    <div class="col-sm-4">
                                    <label for="inputSkills" class="col-sm-<?php if($t==1){echo "1";}else{echo "6"; } ?> control-label"><h3 class="box-title" style="font-weight: bold;     line-height: 1.5;"><?php echo ucwords($t)." Report"; ?></h3></label>
                                    </div>
                                    <?php if($_GET['t']=="employee"): ?>    
                                    <div class="col-sm-3" >
                                      <select class="form-control input-sm" name="status" id="estatus" style="margin-left: -200px;">
                                        <option value="0" <?php if($estatus==0){ echo "selected"; } ?>>Inactive</status>
                                        <option value="1" <?php if($estatus==1){ echo "selected"; } ?>>Active</status>
                                     </select> 
                                    </div>
                                    <?php endif; ?>
                                  </div>
                       
                            
                    </div>
                   


    
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                             
                                <th style="width:auto;"></th>
                                <th >ID</th>
                                <th >Name</th>
                                <th >Gender</th>
                                <th >Address</th>
                                <th >Contac No.</th>
                                <th >B-Date</th>
                                <th >Blood Typpe</th>
                                <th >Citizenship</th>
                               
                                
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
                                    <td ><?php echo $value['gender']; ?></td>
                                    <td ><?php echo $value['address']; ?></td>
                                    <td ><?php echo $value['phone']; ?></td>
                                    <td ><?php echo $value['bdate']; ?></td>
                                    <td ><?php echo $value['bloodtype']; ?></td>
                                    <td ><?php echo $value['citizenship']; ?></td>
                                  
                                </tr>
                            <?php   endforeach;  ?>

                            </tbody>
                            <tfoot>
                            <tr>

                                <th style="width:auto;"></th>
                                <th >ID</th>
                                <th >Name</th>
                                <th >Gender</th>
                                <th >Address</th>
                                <th >Contac No.</th>
                                <th >B-Date</th>
                                <th >Blood Typpe</th>
                                <th >Citizenship</th>
                               
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
    
       // $(document).ready(function() {
            
       //      $('#example1').DataTable( {
       //          "language": {
       //              "lengthMenu": 100,
                 
       //          }
       //      } );
       //  } );
       //  $.fn.dataTable.ext.errMode = 'none';

    
       //  $("#estatus").on("change", function(e){
       //      var es = $(this).val();
       //      location.href = 'index.php?page=reports&t=<?php echo $_GET['t']; ?>&status='+es;
       //  });
        
       
        
         
        

    </script>