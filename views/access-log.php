
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
    
    
    

    $data = array('model'=>'award', 'condition'=>" WHERE id = '".$_GET['del']."'");
    //$response = $app->delete2($data);
}




$conditions ="";
$data = array('model'=>'logs','order'=>' order by date DESC');


//echo json_encode($data);

$emps = $app->getEmployees();
$logs = $app->getRecord2($data);
$logs = $logs['data'];



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
                        <h3 class="box-title" style="font-weight: bold;">Access Logs</h3>
                        <div style="padding:7px; text-align: right;" class="pull-right">
                            <button  class="btn btn-primary btn-sm btn-click-view" onclick="PrintElem('print', 'Tenant Recod')"><i class="icon-print"></i> Print</button>
                        </div>
                    </div>
                   



                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th></th>
                                <th style="width: 5%;">Date</th>
                                <th style="width: 5%;">Action</th>
                                <th style="width: 5%;">Model</th>
                                <th style="width: 30%;">Old Value</th>
                                <th style="width: 30%;">New Value</th>
                                <th style="width: 10%;">Employee</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $c=0; foreach ($logs as $key => $value): $c++; 
                                if($value['eid']!=0){ 
                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo date('F d, Y - H:i:s', strtotime($value['date'])); ?></td>
                                    <td><?php echo ucfirst($value['action']); ?></td>
                                    <td><?php echo ucfirst($value['tmodel']); ?></td>
                                    <td><?php echo $value['oldvalue']; ?></td>
                                    <td><?php echo $value['newvalue']; ?></td>
                                    <td><?php echo $emps[$value['eid']]['fname']." ".$emps[$value['eid']]['lname']; ?></td>
                                    
                                  

                                </tr>
                            <?php } endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                               <th></th>
                                <th style="width: 5%;">Date</th>
                                <th style="width: 5%;">Action</th>
                                <th style="width: 5%;">Model</th>
                                <th style="width: 30%;">Old Value</th>
                                <th style="width: 30%;">New Value</th>
                                <th style="width: 10%;">Employee</th>
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