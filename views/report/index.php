
<script>


    function deleteThis(id){
        if (confirm('Are you sure you want to delete this?')) {
            window.location.href = window.location.href + '&del='+id;
        }
    }

</script>



<?php

// error_reporting(E_ALL); ini_set('display_errors', 1);


$response=array('action'=>"", 'message'=>"");
$daction = "";
$st = $app->getStatus();



$condition="";


//$_SESSION['role']="user";
if(strtoupper($_SESSION['role'])!="ADMIN"){
    if($condition!=""){
        $condition = $condition." AND uid = '". $_SESSION['user_id']."'";
    }else{
        $condition = " WHERE uid = '". $_SESSION['user_id']."'";
    }
    $duser=getMyUsers($_SESSION['user_id']);
    $duser=$duser[0];
    //echo json_encode($duser)."<<<<<";
    $tckt = $duser["name"];
}else{
    $tckt = "All ";
}


$ds = array(
        'model'=>'reports',
        'condition'=>$condition
    );
    $cur = $app->getRecord2($ds);
    $tickets=$cur['data'];

  
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
                <div">

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
                        <h3 class="box-title" style="font-weight: bold;"><?php echo $tckt; ?>Reports</h3>
                        <div style="padding:7px; text-align: right;" class="pull-right">
                            <button  class="btn btn-primary btn-sm btn-click-view" onclick="PrintElem('print', 'Tenant Recod')"><i class="icon-print"></i> Print</button>

                            <?php if($_SESSION['acl']['new-ticket']==1): ?>
                            <a href="?page=ticket-create" type="submit" class="btn btn-success btn-sm">Create</a>
                            <?php endif; ?>

                        </div>
                    </div>
                   



                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th></th>
                                <th style="width: 60%;">Report</th>
                                <th>User</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            
                            
                            $c=0; foreach ($tickets as $key => $value): $c++;
                               $muser=getMyUsers($value['uid']);  $muser=$muser[0];
                                ?>
                                <tr>
                                <td><?php echo $c; ?></td>
                                     <td><textarea class="form-control" style ="width:100%; background:white;" readonly><?php echo $value['content']; ?></textarea></div></td>
                                    <td><?php echo $muser['name']; ?></td>
                                    
                                    <td>

                                        <a href="?page=report-view&id=<?php echo $value['id']; ?>">
                                            <button  class="btn btn-info btn-xs"><i class="fa fa-file-text-o"></i> View</button>
                                        </a>
                                        <?php if($_SESSION['acl']['update-report']==1 && $value['uid']==$_SESSION['user_id']): ?>
                                        <a href="?page=report-create&id=<?php echo $value['id']; ?>">
                                            <button  class="btn btn-warning btn-xs"><i class="fa fa-refresh"></i> Update</button>
                                        </a>
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
                                <th style="width: 60%;">Report</th>
                                <th>User</th>
                                <th>Action</th>
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