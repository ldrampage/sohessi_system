
<script>


    function deleteThis(id){
        if (confirm('Are you sure you want to delete this?')) {
            window.location.href = window.location.href + '&del='+id;
        }
    }

</script>



<?php




$response=array('action'=>"", 'message'=>"");
$daction = "";

if(isset($_GET['del'])){

    $data = array('model'=>'category', 'condition'=>" WHERE id = '".$_GET['del']."'");
    $response = $app->delete2($data);
}



$data = array('model'=>'category','order'=>' order by name');
$conditions ="";

if(isset($_GET['search'])){
    if($conditions==""){ $conditions = " WHERE name LIKE '%".$_GET['search']."%' OR template LIKE '%".$_GET['search']."%'"; }
    else{ $conditions = $conditions." AND name LIKE '%".$_GET['search']."%'  OR template LIKE '%".$_GET['search']."%'"; }
}

$data = array('model'=>'category', 'condition'=>$conditions,'order'=>' order by name');

//echo json_encode($data);


//$responsed = $app->getRecord2($data);
//$projects = $responsed['data'];



$data = array('model'=>'category', 'order'=>' order by name', 'condition'=>"",
    'joint'=>"SELECT * FROM tbl_category ".$conditions);
//echo json_encode($data);
$categories = $app->getRecordJoint($data);//$app->getRecord($data);
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
                        <h3 class="box-title" style="font-weight: bold;">Category</h3>
                        <div style="padding:7px; text-align: right;" class="pull-right">
                            <button  class="btn btn-primary btn-sm btn-click-view" onclick="PrintElem('print', 'Tenant Recod')"><i class="icon-print"></i> Print</button>

                            <?php if($_SESSION['usertype']==1): ?>
                            <a href="?page=category-create" type="submit" class="btn btn-success btn-sm">Create</a>
                            <?php endif; ?>

                        </div>
                    </div>
                   



                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Category Name</th>
                                <th style="width: 30%;">Template</th>
                               
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $c=0; foreach ($categories as $key => $value): $c++;
                               
                                ?>
                                <tr>
                                    <td><?php echo $c." ".$value['name']; ?></td>
                                   
                                    <td><?php echo $value['template']; ?></td>
                                  
                                    <td>

                                        <a href="?page=category-view&id=<?php echo $value['id']; ?>">
                                            <button  class="btn btn-info btn-xs"><i class="fa fa-file-text-o"></i> View</button>
                                        </a>
                                        <?php if($_SESSION['usertype']==1): ?>
                                        <a href="?page=category-create&id=<?php echo $value['id']; ?>">
                                            <button  class="btn btn-warning btn-xs"><i class="fa fa-refresh"></i> Update</button>
                                        </a>
                                       <!--  <button class="btn btn-danger btn-xs" id="<?php echo $value['id']; ?>" onclick="deleteThis(this.id)"><i class="fa fa-trash-o"></i> Delete</button>

                                        <?php endif; ?> -->

                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Category Name</th>
                                <th style="width: 30%;">Template</th>
                               
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