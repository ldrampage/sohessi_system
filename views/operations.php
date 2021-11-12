
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

    $data = array('model'=>'operations', 'condition'=>" WHERE id = '".$_GET['del']."'");
    $response = $app->delete2($data);
}



$data = array('model'=>'operations','order'=>' order by name');
$conditions ="";


$data = array('model'=>'operations', 'condition'=>$conditions,'order'=>' order by name');

//echo json_encode($data);


$materials = $app->getRecord2($data);
$materials = $materials['data'];





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

                            <?php if($_SESSION['acl']['operations-create']==1): ?>
                            <a href="?page=operations-create" type="submit" class="btn btn-success btn-sm">Create</a>
                            <?php endif; ?>

                        </div>
                    </div>
                   



                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th style="width: 2%;"></th>
                                <th style="width: 20%;">Name</th>
                                <th style="width: 20%;">Description</th>
                                <th style="width: 10%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $c=0; foreach ($materials as $key => $value): $c++;
                               
                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo $value['name']; ?></td>
                                   
                                    <td><?php echo $value['description']; ?></td>
                                  
                                    <td>
                                        <?php if($_SESSION['acl']['operations-view']==100): ?>    
                                        <a href="?page=operations-view&id=<?php echo $value['id']; ?>">
                                            <button  class="btn btn-info btn-xs"><i class="fa fa-file-text-o"></i> View</button>
                                        </a>
                                    <?php endif; ?>
                                        <?php if($_SESSION['acl']['operations-update']==1): ?>
                                        <a href="?page=operations-create&id=<?php echo $value['id']; ?>">
                                            <button  class="btn btn-warning btn-xs"><i class="fa fa-refresh"></i> Update</button>
                                        </a>
                                       <!--  <button class="btn btn-danger btn-xs" id="<?php echo $value['id']; ?>" onclick="deleteThis(this.id)"><i class="fa fa-trash-o"></i> Delete</button>
                                        -->
                                        <?php endif; ?>

                                         <?php if($_SESSION['acl']['operations-delete']==1): ?>
                                        
                                           <button  class="btn btn-danger btn-xs" onClick="deleteThis('<?php echo $value['id']; ?>','<?php echo $value['name']; ?>')"><i class="fa fa-refresh"></i> Delete</button>
                                        
                                       <!--  <button class="btn btn-danger btn-xs" id="<?php echo $value['id']; ?>" onclick="deleteThis(this.id)"><i class="fa fa-trash-o"></i> Delete</button>
                                        -->
                                        <?php endif; ?>

                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th style="width: 2%;"></th>
                                <th style="width: 20%;">Name</th>
                                <th style="width: 20%;">Description</th>
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