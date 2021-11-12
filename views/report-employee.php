
<script>


    function deleteThis(id, name){
        if (confirm('Are you sure you want to delete '+name+'?')) {
            window.location.href = window.location.href + '&del='+id;
        }
    }

</script>



<?php

//$app->autoGenerateIds();
if(isset($_GET['estatus'])){ $estatus=$_GET['estatus']; }else{ $estatus=1; }
if(isset($_GET['ut'])){ $ut=$_GET['ut']; }else{ $ut=0; }
if(isset($_GET['dept'])){ $dept=$_GET['dept']; }else{ $dept=0; }

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
//echo $conditions;
if($ut!=0){
    $conditions = $conditions. " AND  usertype = '".$ut."'";
}

if($dept!=0){
    $conditions = $conditions. " AND  department_id  = '".$dept."'";
}



//echo $conditions;
$data = array('model'=>'employee', 'condition'=>$conditions,'order'=>' order by lname');

//echo json_encode($data);


$employee = $app->getRecord2($data);
$employee = $employee['data'];
//echo json_encode(sizeOf($department));


//$data = array('model'=>'employee', 'order'=>' order by lname', 'condition'=>"",
  //  'joint'=>"SELECT * FROM tbl_category ".$conditions);
//echo json_encode($data);
//$categories = $app->getRecordJoint($data);//$app->getRecord($data);
//echo json_encode($projects);
//$projects = $projects['data'];


//echo json_encode($clients);
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
                <form name="" method="POST" action="index.php?page=acl-settings">
                <div class="box">
                    <div class="box-header">
                        
                        
                        <div class="form-group">
                                    <label for="inputSkills" class="col-sm-9 control-label"><h3 class="box-title" style="font-weight: bold;     line-height: 1.5;">Employee <?php echo $title; ?></h3></label>
                                    <div class="col-sm-3">
                                      <select class="form-control input-sm" name="status" id="estatus">
                                        <option value="0" <?php if($estatus==0){ echo "selected"; } ?>>Inactive</status>
                                        <option value="1" <?php if($estatus==1){ echo "selected"; } ?>>Active</status>
                                     </select> 
                                    </div>
                                  </div>
                        
                        <div style="padding:7px; text-align: right; margin-top: -15px;" class="pull-right">
                           

                            <?php /*if($_SESSION['acl']['employee-create']==1): ?>
                            <a href="?page=employee-create&b=employee" type="submit" class="btn btn-success btn-sm">Create</a>
                            <?php endif; */ ?>
                            
                          
                        </div>
                        
                        
                        
                        <br>
                        <div class="row" style="margin-top: 5px;">
                            <div class="col-md-12" >
                                <div class="box box-primary">
                                    <div class="row"  style="margin-top: 5px;">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="inputSkills" class="control-label"><h3 class="box-title" style="font-weight: bold;line-height: 2; font-size: 14px;">Department</h3></label>
                                            
                                              <select class="form-control input-sm filterme" name="dept" id="dept">
                                                <?php 
                                                echo "<option value='0'>All</option>";
                                                $department = $app->getDepartments();
                                                foreach($department as $k=>$v){
                                                    $sl=""; if($k==$dept){ $sl="selected"; }
                                                    echo "<option value='$k' $sl>".$v['name']."</option>";
                                                }

                                                ?>
                                             </select> 
                                            
                                        </div>
                                    </div>
                                    
                                   
                                    
                                    <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputSkills" class="control-label"><h3 class="box-title" style="font-weight: bold;line-height: 2; font-size: 14px;">Employee Type</h3></label>
                                        <?php $types = $app->getUserTypes(); ?>
                                          <select class="form-control input-sm filterme" name="ut" id="ut">
                                          
                                            <?php 
                                            echo "<option value='0'>All</option>";
                                            foreach($types as $k=>$v){
                                                if($k>0){
                                                $sl=""; if($k==$ut){ $sl="selected"; }
                                                echo "<option value='$k' $sl>$v</option>";
                                            }
                                            }

                                            ?>

                                         </select> 
                                        
                                    </div>
                                    </div>
                                    <div class="col-md-3">
                                    <div class="form-group">
                                       
                                         </select> 
                                        
                                    </div>
                                    </div>
                                    </div>
                               
                                </div>
                            </div>
                           
                        </div>    
                    </div>
                   



                    <!-- /.box-header -->
                    
                    <div class="box-body table-responsive">
                        
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th style="width:8px;"></th>
                                <th >ID</th>
                                <th >Name</th>
                                <th >Position</th>
                                <th >Since</th>
                                <th >Number</th>
                                <th >Email</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            <?php $n=0;
                            foreach($employee as $ke => $value): if($value['usertype']>0): $n++;
                            ?>
                                <tr>
                                    <td >
                                        <?php echo $n; ?></td>
                                    <td ><?php echo $value['employee_number']; ?></td>
                                    <td ><img src="<?php echo $value['image']; ?>" style="width: 35px; height: 35px;" class="user-image" alt="User Image">
                                    <?php echo $value['lname'].", ".$value['fname']." ".$value['mname']; ?></td>
                                    <td ><?php echo $value['position']; ?></td>
                                    <td ><?php
                                    $date = date('Y-m-d', time());
                                    $datehired = new DateTime($value['date_hired']);
                                    $dateNow = new DateTime($date);
                                    $since = $app->diffInMonths($value['date_hired'],$date);
                                    //echo $since. " Month(s)"; 
                                    
                                    $interval = $datehired->diff($dateNow);
                                    $years = $interval->format('%y');
                                    $months = $interval->format('%m');
                                    $days = $interval->format('%d');
                                    if($years!=0){
                                        echo " $years Year(s)";
                                    }
                                    if($months!=0){
                                        if($years!=0){
                                            echo ", $months Month(s)";
                                        }else{
                                            echo " $months Month(s)";
                                        }
                                    }
                                    if($days!=0){
                                        if($years!=0 || $months!=0 ){
                                            echo ", $days Day(s)";
                                        }else{
                                            echo " $days Day(s)";
                                        }
                                    }
                                    //echo $interval->format('%y years %m months and %d days');
                                    ?></td>
                                    <td ><?php echo $value['mobilenumber']; ?></td>
                                    <td ><?php echo $value['email']; ?></td>
                                   
                                </tr>
                            <?php endif; endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th style="width:8px;"></th>
                                <th >ID</th>
                                <th >Name</th>
                                <th >Position</th>
                                <th >Since</th>
                                <th >Number</th>
                                <th >Email</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                </form>
            </div>
        </div>
    </div>
    </div> 
    </div>
    <script>
    
      
    
        $("#estatus").on("change", function(e){
            var es = "&estatus="+$("#estatus").val();
            var ut = "&status="+$("#ut").val();
            var dept = "&dept="+$("#dept").val();
            location.href = 'index.php?page=reports&t=employee'+es+ut+dept;
        });
        
        $("#dept").on("change", function(e){
            var es = "&estatus="+$("#estatus").val();
            var ut = "&ut="+$("#ut").val();
            var dept = "&dept="+$("#dept").val();
            location.href = 'index.php?page=reports&t=employee'+es+ut+dept;
        });

        $("#ut").on("change", function(e){
            var es = "&estatus="+$("#estatus").val();
            var ut = "&ut="+$("#ut").val();
            var dept = "&dept="+$("#dept").val();
            location.href = 'index.php?page=reports&t=employee'+es+ut+dept;
        });
        
        

    </script>