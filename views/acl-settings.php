<!-- Main content -->
<?php

$response=array('action'=>"", 'message'=>"");

if(isset($_POST['btn_save'])){
   //echo json_encode($_POST);
    $data = array('model'=>"award",'keys'=>"name, description, employee_id");

    if(isset($_POST['id'])){
        $data['values']="name = '".$_POST['name']."', description = '".$_POST['description']."', employee_id = '".json_encode($_POST['employee_id'])."'";
        $data['condition'] = " WHERE id = '".$_POST['id']."'";
        $response = $app->update2($data);
    }else{
        $date = date("Y")."-".date("m")."-".date("d");

        $data2 = array(
            'model'=>'award',
            'keys'=>'name, description, employee_id',
            'values'=>"'".$_POST['name']."', '".$_POST['description']."', '".json_encode($_POST['employee_id'])."'"
        );
        $response = $app->create2($data2);
        $response['message'] = "Successful";
      
    }
}
//$rvalue =array();
if(isset($_GET['id'])){
    $action = "Update";
    $rqdata = array("model"=>"award", "condition"=>" WHERE id = '".$_GET['id']."'");
    $department = $app->getRecord2($rqdata);
    $rvalue = $department['data'][0];
    $rvalue['employee_id'] = json_decode($rvalue['employee_id']);
    //echo json_encode($rvalue);

}else{ $action = "Create"; }

$emps = $app->getEmployees();
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
                            <a href="?page=employee&status=1"><label class="btn btn-xs btn-info">Employee List</label></a> 
                        </div>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                          <div class="col-md-12">  
                            <form class="form-horizontal"  name="" method="post" action="">
                            <?php
                            
                            $exclude=array("SALARY","PAYROLL","LEAVETYPE","EXPENSES","ACCESS","SETTINGS");
                            
                            $acltitle = $app->aclLists();
                            $aclfew = $app->aclfew();
                            //$acl = $app->getMyACL($_GET['id']);
                            foreach ($acltitle as $key => $value):
                                if (in_array($value, $aclfew)):
                            //if (array_key_exists($value['feature_code'],$acltitle)):
                            ?>
            
                              <div class="form-group">
                                <label for="inputName" class="col-sm-4 control-label" style="text-align: right;"><?php echo $value; ?></label>
                                <input type="hidden" name="actcode[]" value="<?php echo trim($key); ?>">
                                <div class="col-sm-8"> 
                                  <select name="aclvalue[]" class="form-control">
                                      <option value="0" >No</option>
                                      <option value="1" >Yes</option>
                                  </select>
                                </div>
                              </div>
            
                             <?php //endif; 
                            endif;  endforeach; ?>  
                             
                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" class="btn btn-danger" name="updateAcl">Submit</button>
                                </div>
                              </div>
                            </form>
                          </div>
                          </div>
                    </div>
                    
                </div>
            </form>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->


