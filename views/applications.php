
<script>


    function deleteThis(id){
        if (confirm('Are you sure you want to delete this?')) {
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

    $data = array('model'=>'application', 'condition'=>" WHERE id = '".$_GET['del']."'");
    $response = $app->delete2($data);
}



$data = array('model'=>'application','order'=>' order by title');
$conditions ="";

if(isset($_GET['search'])){
    if($conditions==""){ $conditions = " WHERE fname LIKE '%".$_GET['search']."%' OR lname LIKE '%".$_GET['search']."%'"; }
    else{ $conditions = $conditions." AND fname LIKE '%".$_GET['search']."%'  OR lname LIKE '%".$_GET['search']."%'"; }
}

$data = array('model'=>'application', 'condition'=>$conditions,'order'=>' order by fname');

//echo json_encode($data);

$department = $app->getDepartments();
$application = $app->getRecord2($data);
$application = $application['data'];

$vacancy = $app->getVacancy();

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

                            

                        </div>
                    </div>
                   



                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th></th>
                                <th style="width: 20%;">Name</th>
                                <th style="width: 60%;">Email</th>
                                <th style="width: 60%;">Vacancy</th>
                                <th style="width: 60%;">Department</th>
                                <th style="width: 10%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $c=0; foreach ($application as $key => $value): $c++;
                               
                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo $value['fname']." ".$value['lname']; ?></td>
                                    <td><?php echo $value['email']; ?></td>
                                    <td>
                                    <?php 
                                     echo "<a target='_BLANK' href='?page=vacancy-view&id=".$value['vacancy_id']."'>".$vacancy[$value['vacancy_id']]['title']."</a><br>"; 
                                    
                                   

                                    ?>
                                        
                                    </td>
                                
                                    <td>
                                    <?php 
                                     echo "<a target='_BLANK' href='?page=department-view&id=".$value['department_id']."'>".$department[$value['department_id']]['name']."</a><br>"; 
                                    
                                   

                                    ?>
                                        
                                    </td>
                                    <td>
                                        <?php if($_SESSION['acl']['award-view']==1): ?>    
                                        <a href="?page=applications-view&id=<?php echo $value['id']; ?>">
                                            <button  class="btn btn-info btn-xs"><i class="fa fa-file-text-o"></i> View</button>
                                        </a>
                                    <?php endif; ?>
                                      

                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th style="width: 20%;">Name</th>
                                <th style="width: 60%;">Email</th>
                                <th style="width: 60%;">Vacancy</th>
                                <th style="width: 60%;">Department</th>
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