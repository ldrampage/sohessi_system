<!-- Main content -->
<?php

$response=array('action'=>"", 'message'=>"");

if(isset($_POST['btn_save'])){
   //echo json_encode($_POST);
    $data = array('model'=>"expenses",'keys'=>"name, description, date, amount");
     //$tmd = explode("/",$_POST['expdate']); 
     //$d = $tmd[2]."-".$tmd[0]."-".$tmd[1];
     $d= date('Y-m-d',strtotime($_POST['expdate']));
     //echo $d;
    if(isset($_POST['id'])){
        $data['values']="name = '".str_replace("'","\'",$_POST['name'])."', description = '".str_replace("'","\'",$_POST['description'])."', date = '".$d."', amount = '".str_replace(",","",$_POST['amount'])."', receipt = '".$_POST['receipt']."'";
        $data['condition'] = " WHERE id = '".$_POST['id']."'";
        $response = $app->update2($data); //model, model_id,
        $dpdata = array("model"=>"payments",
                        "values"=>"amount = '".str_replace(",","",$_POST['amount'])."', 
                                note = '".str_replace("'","\'",$_POST['name'])."', 
                                payment_date = '".$d."', 
                                date_received = '".$d."', 
                                received_by = '".$_SESSION['login_id']."', 
                                receipt_number = '".$_POST['receipt']."'",
                        "condition"=>" WHERE model='expenses' AND model_id = '".$_POST['id']."'");
        $rpd = $app->update2($dpdata);

        $dpdatau = array("model"=>"payments",
                        "values"=>"amount='".str_replace(",","",$_POST['amount'])."',
                                    payment_date='".$d."',
                                    note='".str_replace("'","\'",$_POST['name'])."',
                                    updated_at='".date("Y-m-d")."',
                                    updated_by='".$_SESSION['login_id']."',
                                    receipt_number='".$_POST['receipt']."'",
                        "condition"=>"WHERE model = 'expenses' AND model_id = '".$_POST['id']."'");
        $rpd = $app->update2($dpdatau);


    }else{
        $date = date("Y")."-".date("m")."-".date("d");
        $data2 = array(
            'model'=>'expenses',
            'keys'=>'name, description, date, amount, receipt',
            'values'=>"'".str_replace("'","\'",$_POST['name'])."', '".str_replace("'","\'",$_POST['description'])."', '".$d."', '".str_replace(",","",$_POST['amount'])."', '".$_POST['receipt']."'"
        );
        $response = $app->create2($data2);
        $response['message'] = "Successful";

        $dpdata = array("model"=>"payments",
                        "keys"=>"amount, payment_type, model, model_id, status, payment_date, note, received_by, date_received, payment_class, created_at, cashflow, receipt_number",
                        "values"=>"'".str_replace(",","",$_POST['amount'])."',
                                    'cash',
                                    'expenses',
                                    '".$response['id']."',
                                    'PAID',
                                    '".$d."',
                                    '".str_replace("'","\'",$_POST['name'])."',
                                    '".$_SESSION['login_id']."',
                                    '".$d."',
                                    'expenses-payment',
                                    '".$date."', 
                                    'out',
                                    '".$_POST['receipt']."'");
        $rpd = $app->create2($dpdata);
      
    }

}
//$rvalue =array();
if(isset($_GET['id'])){
    $action = "Update";
    $rqdata = array("model"=>"expenses", "condition"=>" WHERE id = '".$_GET['id']."'");
    $department = $app->getRecord2($rqdata);
    $rvalue = $department['data'][0];
    //echo json_encode($rvalue);

}else{ $action = "Create"; }
$department = $app->getDepartments();
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
                            <a href="?page=expenses"><label class="btn btn-xs btn-info">Expenses List</label></a> 
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

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Amount</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Amount" id="amount" name="amount" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['amount']."'"; } ?> required />
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Receipt No.:</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Receipt No." id="receipt" name="receipt" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['receipt']."'"; } ?> required />
                                </div>

                                <div class="form-group">
                                    <label>Date</label>
                                    
                                    <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right" name="expdate" id="datepicker" <?php if(isset($_GET['id'])){ echo "value='".date("m/d/Y",strtotime($rvalue['date']))."'"; } ?>>
                                    </div>
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


