
<script>


    function deleteThis(id,name){
        if (confirm('Are you sure you want to delete '+name+'?')) {
            window.location.href = window.location.href + '&del='+id;
        }
    }

</script>



<?php
if(isset($_GET['lp'])){ $lp=$_GET['lp']; }else{ $lp=0; }
$module = explode("-",$page);
$title = ucfirst($module[0]);
$response['action']="none";
error_reporting(E_ALL); ini_set('display_errors', 1); 


$response=array('action'=>"", 'message'=>"");
$daction = "";

if(isset($_GET['del'])){

    $data = array('model'=>'laboffered', 'condition'=>" WHERE id = '".$_GET['del']."'");
    $response = $app->delete2($data);
}



$data = array('model'=>'laboffered','order'=>' order by name');
$conditions ="";
if($lp!=0){ $conditions = " WHERE category = '".$lp."'"; }


$data = array('model'=>'laboffered', 'condition'=>$conditions,'order'=>' order by name');

//echo json_encode($data);


$materials = $app->getRecord2($data);
$materials = $materials['data'];
$categories = $app->getCategoryNames();




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
                                      <select class="form-control input-sm" name="lc" id="lc">
                                        <option value="0">All</option>
                                        <?php 
                                        foreach($categories as $k =>$v){ $sel="";
                                            if(isset($_GET['lp']) && $_GET['lp']==$k){ $sel = "selected"; }
                                            echo "<option value=\"".$k."\" ".$sel.">".$v."</option>";
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
                                <th style="width: 25%;">Name</th>
                                <th style="width: 60%;">Description</th>
                                <th style="width: 20%;">Category</th>
                                <th style="width: 20%;">Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $c=0; foreach ($materials as $key => $value): $c++;
                               
                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo $value['name']; ?></td>
                                   
                                    <td><?php echo $value['description']; ?></td>
                                    <td><?php echo $categories[$value['category']]; ?></td>
                                     <td><?php echo number_format($value['price'],2); ?></td>
                                     
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th style="width: 5%;"></th>
                                <th style="width: 25%;">Name</th>
                                <th style="width: 60%;">Description</th>
                                <th style="width: 20%;">Category</th>
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
        $("#lc").change(function(){
            location.href="?page=<?php echo $_GET['page']; ?>&t=<?php echo $_GET['t']; ?>&lp="+$(this).val();
        });
    </script>    