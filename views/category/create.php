<!-- Main content -->
<?php

$response=array('action'=>"", 'message'=>"");
if(isset($_POST['btn_save'])){

    $data = array('model'=>"category",'
    keys'=>"name, template");

    if(isset($_POST['id'])){
        $data['values']="name = '".$_POST['name']."', template = '".$_POST['template']."'";
        $data['condition'] = " WHERE id = '".$_POST['id']."'";
        $response = $app->update2($data);
    }else{
        $date = date("Y")."-".date("m")."-".date("d");

        $data2 = array(
            'model'=>'category',
            'keys'=>'name, template',
            'values'=>"'".$_POST['name']."', '".$_POST['template']."'"
        );
        $response = $app->create2($data2);
        $response['message'] = "Successful";
      
    }

}

if(isset($_GET['id'])){
    $action = "Update";
}else{ $action = "Create"; }



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
                        <h4 class="modal-title" id="myModalLabel"><?php echo $action; ?> Client</h4>
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
                                    <label>Template</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="template" name="template" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['template']."'"; } ?> required />
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


