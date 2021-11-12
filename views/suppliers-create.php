<!-- Main content -->
<?php

$response=array('action'=>"", 'message'=>"");
if(isset($_POST['btn_save'])){

    $data = array('model'=>"suppliers",'keys'=>"business_name, business_address, fname, lname, phone, mobile, email");

    if(isset($_POST['id'])){
        $data['values']="business = '".str_replace("'","\'",$_POST['business'])."', 
                         business_address = '".str_replace("'","\'",$_POST['business_address'])."',
                         fname = '".str_replace("'","\'",$_POST['fname'])."',
                         lname = '".str_replace("'","\'",$_POST['lname'])."',
                         phone = '".str_replace("'","\'",$_POST['phone'])."',
                         mobile = '".str_replace("'","\'",$_POST['mobile'])."',
                         email = '".str_replace("'","\'",$_POST['email'])."'";
        $data['condition'] = " WHERE id = '".$_POST['id']."'";
        $response = $app->update2($data);
    }else{
        $date = date("Y")."-".date("m")."-".date("d");

        $data2 = array(
            'model'=>'suppliers',
            'keys'=>'business, business_address, fname, lname, phone, mobile, email',
            'values'=>"'".str_replace("'","\'",$_POST['business'])."', 
                       '".str_replace(",","",$_POST['business_address'])."',
                       '".str_replace(",","",$_POST['fname'])."' ,
                       '".str_replace(",","",$_POST['lname'])."' ,
                       '".str_replace(",","",$_POST['phone'])."' ,
                       '".str_replace(",","",$_POST['mobile'])."' ,
                       '".str_replace(",","",$_POST['email'])."' "
        );
        $response = $app->create2($data2);
        $response['message'] = "Successful";
      
    }

}
//$rvalue =array();
if(isset($_GET['id'])){
    $action = "Update";
    $rqdata = array("model"=>"suppliers", "condition"=>" WHERE id = '".$_GET['id']."'");
    $department = $app->getRecord2($rqdata);
    $rvalue = $department['data'][0];
    //echo json_encode($rvalue);

}else{ $action = "Create"; }

$suppliers = $app->getSuppliers();

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
                            <a href="?page=suppliers"><label class="btn btn-xs btn-info">Supplier List</label></a> 
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
                                    <label>Business Name</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Business Name" name="business" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['business']."'"; } ?> required />
                                </div>


                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Address</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Business Address" name="business_address" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['business_address']."'"; } ?> required />
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>First Name</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="First Name" name="fname" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['fname']."'"; } ?> required />
                                </div>


                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Last Name</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Last Name" name="lname" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['lname']."'"; } ?> required />
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Phone</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Phone" name="phone" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['phone']."'"; } ?>  />
                                </div>


                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Mobile</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Mobile" name="mobile" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['mobile']."'"; } ?>  />
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Email</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="email" class="form-control" placeholder="Email" name="email" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['email']."'"; } ?>  />
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


