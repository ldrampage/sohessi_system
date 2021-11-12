
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

    $data = array('model'=>'patient', 'condition'=>" WHERE id = '".$_GET['del']."'");
    $response = $app->delete2($data);
}



$data = array('model'=>'patient','order'=>' order by lname');
$conditions ="";

if(isset($_GET['search'])){
    if($conditions==""){ $conditions = " WHERE fname LIKE '%".$_GET['search']."%' OR mname LIKE '%".$_GET['search']."%' OR lname LIKE '%".$_GET['search']."%'"; }
    else{ $conditions = $conditions." AND fname LIKE '%".$_GET['search']."%'  OR mname LIKE '%".$_GET['search']."%'  OR lname LIKE '%".$_GET['search']."%'"; }
}







//echo $conditions;
$data = array('model'=>'patient', 'condition'=>$conditions,'order'=>' order by lname');

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
                        
                        <div style="padding:7px; text-align: right; margin-top: -15px;" class="pull-right">
                           

                            <?php if($_SESSION['acl']['employee-create']==1): ?>
                            <a href="?page=patients-create" type="submit" class="btn btn-success btn-sm">Create</a>
                            <?php endif; ?>
                            
                          
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
                                <th >Age</th>
                                <th >Gender</th>
                                <th >Company</th>
                                <th >Occupation</th>
                                <th >Address</th>
                                <th >Number</th>
                                <th >Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $n=0;
                            foreach($employee as $ke => $value): $n++;
                            ?>
                                <tr>
                                    <td >
                                        <?php echo $n; ?></td>
                                    <td ><?php echo $value['patient_number']; ?></td>
                                    <td ><img src="<?php echo $value['image']; ?>" style="width: 35px; height: 35px;" class="user-image" alt="User Image">
                                    <?php echo $value['lname'].", ".$value['fname']." ".$value['mname']; ?></td>
                                    <td ><?php
                                    $date = date('Y-m-d', time());
                                    $datehired = new DateTime($value['bdate']);
                                    $dateNow = new DateTime($date);
                                    $since = $app->diffInMonths($value['bdate'],$date);
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
                                     <td ><?php echo $value['gender']; ?></td>
                                     <td ><?php echo $value['position']; ?></td>
                                    <td ><?php echo $value['occupation']; ?></td>
                                    <td ><?php echo $value['address']; ?></td>
                                    <td ><?php echo $value['phone']; ?></td>
                                    <td ><?php echo $value['email']; ?></td>
                                    <td>

                                         <?php if($_SESSION['acl']['patients-view']==1): ?>    
                                        <a href="?page=patients-view&id=<?php echo $value['id']; ?>">
                                            <label  class="btn btn-info btn-xs"><i class="fa fa-file-text-o"></i> View</label>
                                        </a>
                                    <?php endif; ?>
                                        <?php if($_SESSION['acl']['patients-update']==1): ?>
                                        <a href="?page=patients-create&id=<?php echo $value['id']; ?>">
                                            <label  class="btn btn-warning btn-xs"><i class="fa fa-refresh"></i> Update</label>
                                        </a>
                                       <!--  <button class="btn btn-danger btn-xs" id="<?php echo $value['id']; ?>" onclick="deleteThis(this.id)"><i class="fa fa-trash-o"></i> Delete</button>
                                        -->
                                        <?php endif; ?>
                                        
                                         <?php  if($_SESSION['acl']['patients-delete']==1): ?> 
                                        
                                           <label  class="btn btn-danger btn-xs" onClick="deleteThis('<?php echo $value['id']; ?>','<?php echo $value['lname'].", ".$value['fname']." ".$value['mname']; ?>')"><i class="fa fa-minus"></i> Delete</label>
                                        
                                       <!--  <button class="btn btn-danger btn-xs" id="<?php echo $value['id']; ?>" onclick="deleteThis(this.id)"><i class="fa fa-trash-o"></i> Delete</button>
                                        -->
                                        <?php endif; ?>

                                    </td>
                                </tr>
                            <?php  endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                 <th style="width:8px;"></th>
                                <th >ID</th>
                                <th >Name</th>
                                <th >Age</th>
                                <th >Gender</th>
                                <th >Company</th>
                                <th >Occupation</th>
                                <th >Address</th>
                                <th >Number</th>
                                <th >Email</th>
                                <th>Action</th>
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
            location.href = 'index.php?page=employee'+es+ut+dept;
        });
        
        $("#dept").on("change", function(e){
            var es = "&estatus="+$("#estatus").val();
            var ut = "&ut="+$("#ut").val();
            var dept = "&dept="+$("#dept").val();
            location.href = 'index.php?page=employee'+es+ut+dept;
        });

        $("#ut").on("change", function(e){
            var es = "&estatus="+$("#estatus").val();
            var ut = "&ut="+$("#ut").val();
            var dept = "&dept="+$("#dept").val();
            location.href = 'index.php?page=employee'+es+ut+dept;
        });
        
        

    </script>