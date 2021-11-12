
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
$st = $app->getStatus();





if($_GET['status']=="all"){
    $condition = "";
    $tckt = "All ";
    
}else{
    $condition = " WHERE status = '".$_GET['status']."'";
    $tckt = $st[$_GET['status']]." ";
}

if(strtoupper($_SESSION['role'])!="ADMIN"){
    if($condition!=""){
        $condition = $condition." AND uid = '". $_SESSION['user_id']."'";
    }else{
        $condition = " WHERE uid = '". $_SESSION['user_id']."'";
    }
}


if(isset($_GET['status'])){ $thestatus = $_GET['status']; }else{ $thestatus = 0; }
if(isset($_GET['priority'])){ $thepriority = $_GET['priority']; 
    if($thepriority>0){
        if($condition!=""){
            $condition = $condition." AND priority = '". $_GET['priority']."'";
        }else{
            $condition = " WHERE priority = '". $_GET['priority']."'";
        }
    }
    
}else{ $thepriority = 0; }

$ds = array(
        'model'=>'tickets',
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
                        
                       
                            
                        <div class="row" > 
                            <div class="col-md-3">
                                <h3 class="box-title" style="font-weight: bold;"><?php echo $tckt; ?>Tickets</h3></div>
                            <div class="col-md-9">
                                  <div style="padding:0px; text-align: right; width: 80%;" class="pull-right">
                                <button  class="btn btn-primary btn-sm btn-click-view" onclick="PrintElem('print', 'Tenant Recod')"><i class="icon-print"></i> Print</button>
    
                                <?php if($_SESSION['acl']['new-ticket']==1): ?>
                                <a href="?page=ticket-create" type="submit" class="btn btn-success btn-sm">Create</a>
                                <?php endif; ?>
    
                                </div>
                            </div>
                        </div>        
                        <hr style="margin-top: 5px;">
                        <h3 class="box-title" style="font-weight: bold; margin-top:3px; font-size: 14px;">Priority State:</h3> 
                        <div class="row"> 
                            <div class="col-md-3">
                            <select id="pr" class="form-control">
                                <option value="0" <?php if($thepriority==0){ echo "SELECTED"; } ?>>All</option>
                                <option value="1" <?php if($thepriority==1){ echo "SELECTED"; } ?>>Minor</option>
                                <option value="2" <?php if($thepriority==2){ echo "SELECTED"; } ?>>Moderate</option>
                                <option value="3" <?php if($thepriority==3){ echo "SELECTED"; } ?>>Major</option>
                            </select></div>
                            <div class="col-md-9">
                           
                            </div>
                        </div>    
                    </div>
                   



                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Reference #</th>
                                <th>Subject</th>
                                <th style="width: 30%;">Concern</th>
                                <th style="">Status</th>
                                <th style="">Date Submitted</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            
                            
                            $c=0; foreach ($tickets as $key => $value): $c++;
                               
                                ?>
                                <tr>
                                <td><?php echo $c; ?></td>
                                    <td><?php echo $value['refno']; ?></td>
                                   
                                    <td><?php echo $value['subject']; ?></td>
                                     <td><textarea class="form-control" style ="width:100%; background:white;" readonly><?php echo $value['concern']; ?></textarea></div></td>
                                    <td><?php echo $st[$value['status']]; ?></td>
                                    <td><?php echo $value['date_open']; ?></td>
                                    <td>

                                        <a href="?page=tickets-view&id=<?php echo $value['id']; ?>" target="_BLANK">
                                            <button  class="btn btn-info btn-xs"><i class="fa fa-file-text-o"></i> View</button>
                                        </a>
                                        <?php if($_SESSION['acl']['update-ticket']==1): ?>
                                        <a href="?page=ticket-create&id=<?php echo $value['id']; ?>" target="_BLANK">
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
                                <th>Title</th>
                                <th style="width: 30%;">Domain</th>
                                <th style="width: 30%;">Category</th>
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
    <script>
    
    $('#pr').on('change', function() {
      //alert( this.value );
      location.href = 'http://support.backoffice-services.net/?page=tickets&status=<?php echo $thestatus; ?>&priority='+this.value;
    })
    
    </script>