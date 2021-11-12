
<script>


    function deleteThis(id, name){
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

    $data = array('model'=>'returns', 'condition'=>" WHERE id = '".$_GET['del']."'");
    $response = $app->delete2($data);
}


$conditions ="";
$data = array('model'=>'returns', 'condition'=>$conditions,'order'=>' order by date_created DESC');

//echo json_encode($data);

$department = $app->getDepartments();
$expenses = $app->getRecord2($data);
$expenses = $expenses['data'];
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
                        <h3 class="box-title" style="font-weight: bold;"><?php echo $title; ?></h3>
                        <div style="padding:7px; text-align: right;" class="pull-right">
                            <button  class="btn btn-primary btn-sm btn-click-view" onclick="PrintElem('print', 'Tenant Recod')"><i class="icon-print"></i> Print</button>

                            <?php if($_SESSION['acl']['returns-create']==1): ?>
                            <a href="?page=returns-create" type="submit" class="btn btn-success btn-sm">Create</a>
                            <?php endif; ?>

                        </div>
                    </div>
                   



                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th></th>
                                <th style="width: 10%;">Return No.</th>
                                <th style="width: 60%;">Inclusions</th>
                                <th style="width: 10%;">Created</th>
                                <th style="width: 10%;">Updated</th>
                                <th style="width: 10%;">Returned</th>
                                <th style="width: 10%;">Status</th>
                                <th style="width: 10%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $c=0; foreach ($expenses as $key => $value){ $c++;
                               
                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo $value['return_id']; ?></td>
                                    <td><?php 
                                    $r = json_decode($value['inclusives'], true);
                                    $cc=0;
                                    foreach($r as $rk => $rv){ $cc++; if($cc>1){ echo "<br>"; }
                                        $name = explode("(",$rv['name']); $name = $name[0];
                                        echo $rv['qty']." ".$name." for ".number_format($rv['amount'],2);
                                    }
                                     ?></td>
                                    <td><?php echo $value['date_created']." by ".$emps[$value['created_by']]['fname']; ?></td>
                                    <td><?php if($value['updated_by']!=0){ echo $value['date_updated']." by ".$emps[$value['updated_by']]['fname']; } ?></td>
                                    
                                    <td><?php 
                                    if($value['status']=="Returned"){
                                        echo $value['date_returned']." received by ".$value['received_by']; 
                                    }
                                    

                                    ?></td>
                                    <td><?php echo $value['status']; ?></td>
                                    <td>
                                        <?php if($_SESSION['acl']['returns-view']==100): ?>    
                                        <a href="?page=returns-view&id=<?php echo $value['id']; ?>">
                                            <button  class="btn btn-info btn-xs"><i class="fa fa-file-text-o"></i> View</button>
                                        </a>
                                    <?php endif; ?>
                                        <?php if($_SESSION['acl']['returns-update']==1): ?>
                                        <a href="?page=returns-create&id=<?php echo $value['id']; ?>">
                                            <button  class="btn btn-warning btn-xs"><i class="fa fa-refresh"></i> Update</button>
                                        </a>
                                       <!--  <button class="btn btn-danger btn-xs" id="<?php echo $value['id']; ?>" onclick="deleteThis(this.id)"><i class="fa fa-trash-o"></i> Delete</button>
                                        -->
                                        <?php endif; ?>
                                        
                                         <?php if($_SESSION['acl']['returns-delete']==1): ?>
                                        
                                           <button  class="btn btn-danger btn-xs" onClick="deleteThis('<?php echo $value['id']; ?>','<?php echo $value['return_id']; ?>')"><i class="fa fa-refresh"></i> Delete</button>
                                        
                                       <!--  <button class="btn btn-danger btn-xs" id="<?php echo $value['id']; ?>" onclick="deleteThis(this.id)"><i class="fa fa-trash-o"></i> Delete</button>
                                        -->
                                        <?php endif; ?>

                                    </td>
                                </tr>
                            <?php } ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th style="width: 20%;">Name</th>
                                <th style="width: 60%;">Description</th>
                                <th style="width: 60%;">Date</th>
                                <th style="width: 60%;">Amount</th>
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