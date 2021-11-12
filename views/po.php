
<script>


    function deleteThis(id,name){
        if (confirm('Are you sure you want to delete '+name+'?')) {
            window.location.href = window.location.href + '&del='+id;
        }
    }

</script>



<?php

$module = explode("-",$page);
$title = ucfirst($module[0]);
$response['action']="none";
error_reporting(E_ALL); ini_set('display_errors', 1); 


$response=array('action'=>"", 'message'=>"");
$daction = "";

if(isset($_GET['del'])){

    $data = array('model'=>'po', 'condition'=>" WHERE id = '".$_GET['del']."'");
    $response = $app->delete2($data);
}



$data = array('model'=>'po','order'=>'');
$conditions ="";

if(isset($_GET['search'])){
    if($conditions==""){ $conditions = " WHERE name LIKE '%".$_GET['search']."%' OR description LIKE '%".$_GET['search']."%'"; }
    else{ $conditions = $conditions." AND name LIKE '%".$_GET['search']."%'  OR description LIKE '%".$_GET['search']."%'"; }
}

$data = array('model'=>'po', 'condition'=>$conditions,'order'=>'');




$department = $app->getRecord2($data);
// echo json_encode($department);
$department = $department['data'];

$emps = $app->getEmployees();

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
                        <h3 class="box-title" style="font-weight: bold;">Purchase Orders</h3>
                        <div style="padding:7px; text-align: right;" class="pull-right">
                            

                            <?php if($_SESSION['acl']['po-create']==1): ?>
                            <a href="?page=po-create" type="submit" class="btn btn-success btn-sm">Create</a>
                            <?php endif; ?>

                        </div>
                    </div>
                   



                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th></th>
                                <th style="width: 20%;">PO No.</th>
                                <th style="width: 20%;">Date Created</th>
                                <th style="width: 20%;">Date Forwarded</th>
                                <th style="width: 20%;">Date Approved</th>
                                <th style="width: 60%;">Date Received</th>
                                <th style="width: 60%;">Prepared By</th>
                                <th style="width: 60%;">Approved By</th>
                                <th style="width: 60%;">Status</th>
                                <th style="width: 10%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $c=0; foreach ($department as $key => $value): $c++;
                                
                                $dpo = "";
                                $dpoCount = strlen($value['po_number']);
                                while($dpoCount<6){
                                    $dpo .= "0";
                                    $dpoCount++;
                                }
                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo POPRE."-".$dpo.$value['po_number']; ?></td>
                                   
                                    <td><?php echo date("M d, Y",strtotime($value['date_created'])); ?></td>
                                     <td><?php 
                                     if(trim($value['date_forwarded'])=="0000-00-00"){
                                        echo "N/A";
                                     }else{
                                        echo date("M d, Y",strtotime($value['date_forwarded'])); 
                                     }
                                     ?></td>
                                     <td><?php 
                                     if(trim($value['date_approved'])=="0000-00-00"){
                                        echo "N/A";
                                     }else{
                                        echo date("M d, Y",strtotime($value['date_approved'])); 
                                     }
                                     ?></td>
                                      <td><?php 
                                       if(trim($value['date_received'])=="0000-00-00"){
                                        echo "N/A";
                                     }else{
                                        echo date("M d, Y",strtotime($value['date_received'])); 
                                     }
                                     ?></td>
                                    <td><?php 

                                    if(array_key_exists($value['prepared_by'], $emps)){
                                        echo  $emps[$value['prepared_by']]['fname']." ".$emps[$value['prepared_by']]['lname']; 
                                    }else{
                                        echo "Not Available";
                                    }
                                    ?></td>
                                    <td><?php 

                                    if(array_key_exists($value['approved_by'], $emps)){
                                        echo  $emps[$value['approved_by']]['fname']." ".$emps[$value['approved_by']]['lname']; 
                                    }else{
                                        echo "N/A";
                                    }
                                    ?></td>
                                    <td><?php echo $value['status']; ?></td>
                                    <td>
                                        <?php if($_SESSION['acl']['po-view']==1): ?>    
                                        <a href="?page=po-view&id=<?php echo $value['id']; ?>">
                                            <button  class="btn btn-info btn-xs"><i class="fa fa-file-text-o"></i> View</button>
                                        </a>
                                    <?php endif; ?>
                                        <?php if($_SESSION['acl']['po-update']==100): ?>
                                        <a href="?page=po-create&id=<?php echo $value['id']; ?>">
                                            <button  class="btn btn-warning btn-xs"><i class="fa fa-refresh"></i> Update</button>
                                        </a>
                                       <!--  <button class="btn btn-danger btn-xs" id="<?php echo $value['id']; ?>" onclick="deleteThis(this.id)"><i class="fa fa-trash-o"></i> Delete</button>
                                        -->
                                        <?php endif; ?>

                                         <?php if($_SESSION['acl']['po-delete']==1): ?>
                                        
                                           <button  class="btn btn-danger btn-xs" onClick="deleteThis('<?php echo $value['id']; ?>','<?php echo POPRE."-".$dpo.$value['po_number']; ?>')"><i class="fa fa-refresh"></i> Delete</button>
                                        
                                       <!--  <button class="btn btn-danger btn-xs" id="<?php echo $value['id']; ?>" onclick="deleteThis(this.id)"><i class="fa fa-trash-o"></i> Delete</button>
                                        -->
                                        <?php endif; ?>

                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th style="width: 20%;">PO No.</th>
                                <th style="width: 20%;">Date Created</th>
                                <th style="width: 20%;">Date Forwarded</th>
                                <th style="width: 20%;">Date Approved</th>
                                <th style="width: 60%;">Date Received</th>
                                <th style="width: 60%;">Prepared By</th>
                                <th style="width: 60%;">Approved By</th>
                                <th style="width: 60%;">Status</th>
                                <th style="width: 10%;">Action</th>
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