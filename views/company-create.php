<!-- Main content -->
<?php

$response=array('action'=>"", 'message'=>"");
if(isset($_POST['btn_save'])){

    $data = array('model'=>"company",'keys'=>"company, address, phone, email, company_number, branch");

    if(isset($_POST['id'])){
        $data['values']="company = '".str_replace("'","\'",$_POST['company'])."',
                         address = '".str_replace("'","\'",$_POST['address'])."',
                         phone = '".str_replace("'","\'",$_POST['phone'])."',
                         email = '".str_replace("'","\'",$_POST['email'])."',
                         company_number = '".str_replace("'","\'",$_POST['company_number'])."', 
                         branch = '".str_replace("'","\'",$_POST['branch'])."'";
        $data['condition'] = " WHERE id = '".$_POST['id']."'";
        $response = $app->update2($data);
        // echo "<script>location.href='?page=tests-view&id=".$_POST['id']."';</script>";
    }else{
        $date = date("Y")."-".date("m")."-".date("d");

        $data2 = array(
            'model'=>'company',
            'keys'=>'company, address, phone, email, company_number, branch',
            'values'=>"'".str_replace("'","\'",$_POST['company'])."',
                       '".str_replace("'","\'",$_POST['address'])."', 
                       '".str_replace("'","\'",$_POST['phone'])."', 
                       '".str_replace("'","\'",$_POST['email'])."', 
                       '".str_replace("'","\'",$_POST['company_number'])."', 
                       '".str_replace(",","\'",$_POST['branch'])."' "
        );
        $response = $app->create2($data2);
        $response['message'] = "Successful";
        // echo "<script>location.href='?page=tests-view&id=".$response['id']."';</script>";
    }

}
//$rvalue =array();
if(isset($_GET['id'])){
    $action = "Update";
    $rqdata = array("model"=>"company", "condition"=>" WHERE id = '".$_GET['id']."'");
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
                            <a href="?page=company"><label class="btn btn-xs btn-info">Company List</label></a> 
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
                                    <label>Company #</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Company #" name="company_number" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['company_number']."'"; }else{ echo "value='".$app->createCompanyId()."'"; } ?> required readonly/>
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Company Name</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Company Name" name="company" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['company']."'"; } ?> required />
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Branch</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Branch" name="branch" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['branch']."'"; } ?> required />
                                </div>


                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Address</label>
                                    <textarea class="form-control" placeholder="Address" name="address" required><?php if(isset($_GET['id'])){ echo $rvalue['address']; } ?></textarea>
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Email</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Email" name="email" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['email']."'"; } ?> required />
                                </div>

                                
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Contact #</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Contact #" name="phone" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['phone']."'"; } ?> required />
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


