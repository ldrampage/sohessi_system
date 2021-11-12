
<script>


    function deleteThis(id,name){
        if (confirm('Are you sure you want to delete '+name+'?')) {
            window.location.href = window.location.href + '&del='+id;
        }
    }

</script>



<?php
if(isset($_GET['c'])){ $c=$_GET['c']; }else{ $c=0; }
$module = explode("-",$page);
$title = ucfirst($module[0]);
$response['action']="none";
error_reporting(E_ALL); ini_set('display_errors', 1); 


$response=array('action'=>"", 'message'=>"");
$daction = "";
$condition = "";
if($c!=0){ $condition = "WHERE company_id = '".$c."'"; }
$Labs = $app->getLabTests(); 
$mylabcomp = $app->getMyLabCompany($condition);
$categories = $app->getCategoryNames();
$companies = $app->getCompanies();




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
                        <div class="form-group">
                                    <label for="inputSkills" class="col-sm-1 control-label"><h3 class="box-title" style="font-weight: bold;     line-height: 1.5;"><?php echo $title; ?></h3></label>
                                    <div class="col-sm-3">
                                      <select class="form-control input-sm" name="c" id="c">
                                        <option value="0">All</option>
                                        <?php 
                                        foreach($companies as $k =>$v){ $sel="";
                                            if(isset($_GET['c']) && $_GET['c']==$k){ $sel = "selected"; }
                                            echo "<option value=\"".$k."\" ".$sel.">".$v['company']."</option>";
                                        }
                                        ?>
                                     </select> 
                                    </div>
                                  </div>
                        <div style="padding:7px; text-align: right;" class="pull-right">
                            

                        </div>
                    </div>
                   

                    <?php
                    $labr = $app->getPatientResults("ORDER BY date DESC");
                    $Labs = $app->getLabTests(); 
                    $patients = $app->getPatients();
                    ?>

                    <div class="modal fade" id="checkDetailsmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0" id="body_message"></p>
            </div>
            <div class="modal-footer">
                <label class="btn btn-secondary" data-dismiss="modal">Close</label>
            </div>
        </div>
    </div>
  
</div>     
                <br><br>  

                   

                    <!-- /.box-header -->

                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th style="">Name</th>
                                <th style="">Lab Test</th>
                                <th style="">Date</th>
                                <th style="">Note</th>
                                <th style="">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                           
                            
                            $c=0; foreach ($labr as $key => $value): $c++;
                               
                                ?>
                                <tr>
                                    <td><?php echo ucfirst($patients[$value['patient_id']]['fname'])." ".ucfirst($patients[$value['patient_id']]['lname']); ?></td>
                                    <td><?php echo $Labs[$value['test_id']]['name']; ?></td>
                                    <td><?php echo date("M jS, Y", strtotime($value['date'])); ?></td>
                                    <td><?php echo $value['note']; ?></td>
                                    <td>
                                    <?php if($_SESSION['acl']['result-view']==1): ?>    
                                    <label onClick="retrieveResult('<?php echo $value['id']; ?>')" class="btn btn-warning btn-xs"><i class="fa fa-search"></i> Check Details</label>
                                    <?php endif; ?>
                                    <?php if($_SESSION['acl']['result-print']==1): ?>  
                                    <a href="Printables/result-print-2.php?rid=<?php echo $value['id']; ?>" target="_BLANK" class="btn btn-warning btn-xs"><i class="fa fa-print"></i>Print</a>
                                    <?php endif; ?>
                                    </td>
                         
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th style="">Lab Test</th>
                                <th style="">Date</th>
                                <th style="">Note</th>
                                <th style="">Action</th>
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
       <label id="checkDetails" data-toggle="modal" data-target="#checkDetailsmodal"></label>
    </div>
       <script>
        $("#c").change(function(){
            location.href="?page=<?php echo $_GET['page']; ?>&t=<?php echo $_GET['t']; ?>&c="+$(this).val();
        });

        function retrieveResult(id){
  $("#checkDetails").click();
  $.ajax({
            url: "ajax/api.php",
            type: "post",
            data: {rid: id} ,
            success: function (response) {
                $("#body_message").html(response);
                console.log(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
                }
    });
}
    </script>    

 
