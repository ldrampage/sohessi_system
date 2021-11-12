
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
                   



                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th style="width: 5%;"></th>
                                <th style="width: 25%;">Company</th>
                                <th style="width: 30%;">Lab Test</th>
                                <th style="width: 20%;">Type</th>
                                <th style="width: 20%;">Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $c=0; foreach ($mylabcomp as $key => $value): $c++;
                               
                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo $companies[$value['company_id']]['company']; ?></td>
                                   
                                    <td><?php echo $Labs[$value['lab_id']]['name']; ?></td>
                                    <td><?php if($value['ctype']==0){ echo "Pre-employment"; }else{ echo "Annual"; } ?></td>
                                     <td><?php echo number_format($value['price'],2); ?></td>
                                     
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th style="width: 5%;"></th>
                                <th style="width: 25%;">Company</th>
                                <th style="width: 30%;">Lab Test</th>
                                <th style="width: 20%;">Type</th>
                                <th style="width: 20%;">Price</th>
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
        $("#c").change(function(){
            location.href="?page=<?php echo $_GET['page']; ?>&t=<?php echo $_GET['t']; ?>&c="+$(this).val();
        });
    </script>    