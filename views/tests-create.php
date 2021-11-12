<!-- Main content -->
<?php

$response=array('action'=>"", 'message'=>"");
if(isset($_POST['btn_save'])){

    $data = array('model'=>"laboffered",'keys'=>"name, description, price, patient_queing, category");

    if(isset($_POST['id'])){
        $data['values']="name = '".str_replace("'","\'",$_POST['name'])."', 
                         description = '".str_replace("'","\'",$_POST['description'])."',
                         price = '".str_replace(",","",$_POST['price'])."',
                         patient_queing = '".str_replace(",","",$_POST['patient_queing'])."',
                         category = '".str_replace("'","\'",$_POST['category'])."'";
        $data['condition'] = " WHERE id = '".$_POST['id']."'";
        $response = $app->update2($data);
        echo "<script>location.href='?page=tests-view&id=".$_POST['id']."';</script>";
    }else{
        $date = date("Y")."-".date("m")."-".date("d");

        $data2 = array(
            'model'=>'laboffered',
            'keys'=>'name, description, price, patient_queing, category',
            'values'=>"'".str_replace("'","\'",$_POST['name'])."', 
                       '".str_replace(",","",$_POST['description'])."',
                       '".str_replace(",","",$_POST['price'])."' ,
                       '".str_replace(",","",$_POST['patient_queing'])."',
                       '".str_replace("'","\'",$_POST['category'])."'"
        );
        $response = $app->create2($data2);
        $response['message'] = "Successful";
        echo "<script>location.href='?page=tests-view&id=".$response['id']."';</script>";
    }

}
//$rvalue =array();
if(isset($_GET['id'])){
    $action = "Update";
    $rqdata = array("model"=>"laboffered", "condition"=>" WHERE id = '".$_GET['id']."'");
    $department = $app->getRecord2($rqdata);
    $rvalue = $department['data'][0];
    //echo json_encode($rvalue);

}else{ $action = "Create"; }


$module = explode("-",$page);

?>
<section class="content" >


    <div class="row">
        <div class="col-xs-12">

            <?php

            if($response['message']=="Successful"){

                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                Record Saved Successfully!
              </div>';
            }


            ?>
        </div>
        <div class="col-xs-12">
            <form name="user" method="post" >
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                        <h4 class="modal-title" id="myModalLabel"><?php echo $action." ".ucfirst($module[0]); ?> </h4>
                        <div class="pull-right" style="margin-top: -25px;">
                            <a href="?page=tests"><label class="btn btn-xs btn-info">Lab Test List</label></a> 
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <div class="form-group" style="margin-bottom: 0px; ">

                                    <?php if(isset($_GET['id'])): ?>
                                        <input type="hidden" class="form-control" name="id" value="<?php echo $_GET['id']; ?>" required />
                                    <?php endif; ?>
                                </div>
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Name</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="name" name="name" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['name']."'"; } ?> required />
                                </div>
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Description</label>
                                    <textarea class="form-control" placeholder="description" name="description" required><?php if(isset($_GET['id'])){ echo $rvalue['description']; } ?></textarea>
                                </div>
                                <div class="form-group">
                                   <?php $tcat = $app->getTestCategory(); ?>
                                    <label>Category</label>
                                    <select class="form-control select2 select2-hidden-accessible" id="category" name="category" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                      <?php 
                                      echo '<option value="">SELECT</option>';
                                      foreach($tcat as $k=> $v){
                                        $ac=""; if(isset($_GET['id']) && $rvalue['category']==$k){ $ac="selected"; }
                                        echo '<option value="'.$k.'" '.$ac.'>'.$v['name'].'</option>';
                                      } ?>
                                     
                                    </select>
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Price</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Price" name="price" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['price']."'"; } ?> required />
                                </div>


                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>With Test Samples</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <select name="patient_queing" class="form-control">
                                        <option value="0" <?php if(isset($_GET['id']) && $rvalue['patient_queing']==0){ echo "selected"; } ?>>No</option>
                                        <option value="1" <?php if(isset($_GET['id']) && $rvalue['patient_queing']==1){ echo "selected"; } ?>>Yes</option>
                                    </select>    
                                </div>

                                

                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="btn_save" class="btn btn-success fa fa-plus-square btn-sm" value="<?php echo $action; ?>">
                    </div>
                </div>
            </form>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->


