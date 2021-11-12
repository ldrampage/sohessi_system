
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
    
    $fagdel=$app->faqsdelete($_GET['del']);        
    
}





$ds = array(
        'model'=>'faqs',
        'condition'=>$conditions
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
                        <h3 class="box-title" style="font-weight: bold;">FAQs</h3>
                        <div style="padding:7px; text-align: right;" class="pull-right">
                          


                        </div>
                    </div>
                   


                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                
                                <th >Parent Question</th>
                                <th style="width: 30%;">Question</th>
                                <th style="width: 30%;">Answer</th>
                                <!--<th style="">From Parent</th>-->
                                <th style="width:20%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                              //$dtmodel = array('model'=>'faqs');
                                    
                             $rec = $app->faqsviewall();
                             //echo json_encode($rec);
                             foreach ($rec as $key => $value):;
                               
                                ?>
                                <tr>
                              
                                    <td><?php if($value['parent']==0){echo "Parent";}else{$parentfind= $app->faqsview($value['parent']);
                                    foreach($parentfind as $xy => $xx){
                                    }echo $xx['question'];} ?></td>
                                   
                                    <td ><?php echo $value['question']; ?></td>
                                     <td><?php echo $value['answer']; ?></td>
                                   
                                    <td>

                                        <a href="?page=faqs-view&id=<?php echo $value['id']; ?>">
                                            <button  class="btn btn-info btn-xs"><i class="fa fa-file-text-o"></i> View</button>
                                        </a>
                                       
                                        <a href="?page=faqs-create&id=<?php echo $value['id']; ?>">
                                            <button  class="btn btn-warning btn-xs"><i class="fa fa-refresh"></i> Update</button>
                                        </a>
                                         <button class="btn btn-danger btn-xs" id="<?php echo $value['id']; ?>" onclick="deleteThis(this.id)"><i class="fa fa-trash-o"></i> Delete</button>
                             

                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <!--<tfoot>-->
                            <!--<tr>-->
                            <!--    <th></th>-->
                            <!--    <th>Title</th>-->
                            <!--    <th style="width: 30%;">Domain</th>-->
                            <!--    <th style="width: 30%;">Category</th>-->
                            <!--    <th>Action</th>-->
                            <!--</tr>-->
                            <!--</tfoot>-->
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>