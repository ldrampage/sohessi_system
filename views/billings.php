
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

    $rqdata = array("model"=>"billings", "condition"=>" WHERE id = '".$_GET['del']."'");
    $department = $app->getRecord2($rqdata);
    $rvalue = $department['data'][0];
    $iss= json_decode($rvalue['inclusives'], true);
   // echo json_encode($iss);

    $data = array('model'=>'billings', 'condition'=>" WHERE id = '".$_GET['del']."'");
    $response = $app->delete2($data);


        $cond = " WHERE id='0' ";
        foreach($iss as $kid => $vid){ $cond .= " OR id = '$vid'"; }
        $data3 = array("model"=>"transaction", "values"=>"bill_id = '0'");
        $data3['condition'] = $cond;
        $response = $app->update2($data3);



}


$conditions ="";
$data = array('model'=>'billings', 'condition'=>$conditions,'order'=>' order by date_created DESC');

//echo json_encode($data);

$department = $app->getDepartments();
$billings = $app->getRecord2($data);
$billings = $billings['data'];
$trans = $app->getTransactions("WHERE bill_id != '0'");
$inc = $app->getEnqTrans(); 
$labtest = $app->getLabTests();
$patients = $app->getPatients();
$comps = $app->getCompanies();
$doctors = $app->getDoctors();


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

                            <?php if($_SESSION['acl']['billings-create']==1): ?>
                            <a href="?page=billings-create" type="submit" class="btn btn-success btn-sm">Create</a>
                            <?php endif; ?>

                        </div>
                    </div>
                   



                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th></th>
                                <th style="width: 20%;">Bill No.</th>
                                <th style="width: 20%;">Company/MD</th>
                                <th style="width: 20%;">Date Billed</th>
                                <th style="width: 20%;">Date Due</th>
                                <th style="width: 20%;">Amount Due</th>
                                <th style="width: 10%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                             $today = date("Y-m-d");
                             $fiveDay = date("Y-m-d", strtotime($today." -5 day"));
                             $c=0; foreach ($billings as $key => $value): $c++;

                                    $inclusives = json_decode($value['inclusives'], true);
                                    $total_amount_due = 0;
                                    foreach($inclusives as $k=>$v){
                                        $total_amount_due = $total_amount_due + ($trans[$v]['total_amount'] - $trans[$v]['disc']);
                                    }
                                    //echo $fiveDay." ".$today;
                                    $dueIs = date("Y-m-d", strtotime($value['date_due']));
                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo $value['bill_id']; ?></td>
                                    <td><?php  
                                    if($value['pref']=="company"){
                                        if(array_key_exists($value['company_id'], $comps)){
                                            echo $comps[$value['company_id']]['company']; 
                                        }else{
                                            echo "Data Unavailable"; 
                                        }
                                        
                                    }else{
                                        if(array_key_exists($value['md_id'], $doctors)){
                                            echo $doctors[$value['md_id']]['prename']." ".$doctors[$value['md_id']]['fname']." ".$doctors[$value['md_id']]['lname']; 
                                        }else{
                                            echo "Data Unavailable"; 
                                        }
                                    }
                                    

                                    ?></td>
                                    <td><?php echo $value['date_bill']; ?></td>
                                    <td><?php echo $value['date_due']; ?></td>
                                    <td><?php echo number_format($total_amount_due,2); ?></td>
                                    <td>
                                        <?php if($_SESSION['acl']['billings-view']==100): ?>    
                                        <a href="?page=billings-view&id=<?php echo $value['id']; ?>">
                                            <button  class="btn btn-info btn-xs"><i class="fa fa-file-text-o"></i> View</button>
                                        </a>
                                    <?php endif; ?>
                                        <?php if($_SESSION['acl']['billings-update']==1): ?>
                                        <a href="?page=billings-create&id=<?php echo $value['id']; ?>">
                                            <button  class="btn btn-warning btn-xs"><i class="fa fa-refresh"></i> Review/Update</button>
                                        </a>
                                       <!--  <button class="btn btn-danger btn-xs" id="<?php echo $value['id']; ?>" onclick="deleteThis(this.id)"><i class="fa fa-trash-o"></i> Delete</button>
                                        -->
                                        <?php endif; ?>
                                        
                                         <?php if($_SESSION['acl']['billings-delete']==1): ?>
                                        
                                           <button  class="btn btn-danger btn-xs" onClick="deleteThis('<?php echo $value['id']; ?>','<?php echo $value['bill_id']; ?>')"><i class="fa fa-refresh"></i> Delete</button>
                                        
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
                                <th style="width: 20%;">Bill No.</th>
                                <th style="width: 20%;">Company/MD</th>
                                <th style="width: 20%;">Date Billed</th>
                                <th style="width: 20%;">Date Due</th>
                                <th style="width: 20%;">Amount Due</th>
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