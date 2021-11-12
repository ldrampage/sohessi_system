<!-- Main content -->
<?php

$response=array('action'=>"", 'message'=>"");
if(isset($_POST['btn_save'])){
   
    $data = array('model'=>"patient",
        'keys'=>"prename, fname, mname, lname, address, bdate, bloodtype, date_start, patient_number, phone, citizenship, email, image");

    if(isset($_POST['id'])){
        $data['values']="prename = '".str_replace("'","\'",$_POST['prename'])."',
                        fname = '".str_replace("'","\'",$_POST['fname'])."', 
                        mname = '".str_replace("'","\'",$_POST['mname'])."',
                        lname = '".str_replace("'","\'",$_POST['lname'])."',
                        address = '".str_replace("'","\'",$_POST['address'])."',
                        bdate = '".date('y-m-d',strtotime($_POST['bdate']))."',
                        bloodtype = '".str_replace("'","\'",$_POST['bloodtype'])."',
                        patient_number = '".str_replace("'","\'",$_POST['patient_number'])."',
                        phone = '".str_replace("'","\'",$_POST['phone'])."',
                        citizenship = '".str_replace("'","\'",$_POST['citizenship'])."',
                        gender = '".str_replace("'","\'",$_POST['gender'])."',
                        occupation = '".str_replace("'","\'",$_POST['occupation'])."',
                        position = '".str_replace("'","\'",$_POST['position'])."',
                        email = '".str_replace("'","\'",$_POST['email'])."'";
               
        $data['condition'] = " WHERE id = '".$_POST['id']."'";
        $response = $app->update2($data);
    }else{


        $date = date("Y")."-".date("m")."-".date("d");

        $data2 = array(
            'model'=>'patient',
            'keys'=>"prename, fname, mname, lname, address, bdate, bloodtype, date_start, patient_number, phone, citizenship, email, gender,occupation,position, image",
            'values'=>"'".str_replace("'","\'",$_POST['prename'])."', 
                        '".str_replace("'","\'",$_POST['fname'])."', 
                       '".str_replace("'","\'",$_POST['mname'])."', 
                       '".str_replace("'","\'",$_POST['lname'])."', 
                       '".str_replace("'","\'",$_POST['address'])."', 
                       '".date('Y-m-d',strtotime($_POST['bdate']))."', 
                       '".str_replace("'","\'",$_POST['bloodtype'])."', 
                       '".date('Y-m-d',strtotime($date))."',
                       '".str_replace("'","\'",$_POST['patient_number'])."', 
                       '".str_replace("'","\'",$_POST['phone'])."', 
                       '".str_replace("'","\'",$_POST['citizenship'])."', 
                       '".str_replace("'","\'",$_POST['email'])."', 
                       '".str_replace("'","\'",$_POST['occupation'])."', 
                       '".str_replace("'","\'",$_POST['position'])."', 
                       '".str_replace("'","\'",$_POST['gender'])."', 
                       'uploads/user.png'"
        );
        $response = $app->create2($data2);
        $response['message'] = "Successful";
        $email_message="";
        $email_subject = "Sohessi Official Website";
        $name = $_POST['fname']." ".$_POST['lname'];
        $email_message .= '<html>';
        $email_message .= '<head><meta name="viewport" content="width=device-width" /><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
        $email_message .= '<style>';
        $email_message .='* {margin: 0;font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;}img {max-width: 100%;}';
        $email_message .='body {background-color: #f6f6f6;}'; 
        $email_message .= 'table td {vertical-align: top;}.body-wrap {background-color: #f6f6f6; width: 100%;}.container {display: block !important;max-width: 600px !important;margin: 0 auto !important;clear: both !important;}';
        $email_message .= '.content {max-width: 600px; margin: 0 auto;display: block; padding: 20px;}';
        $email_message .= '.main {background-color: #fff;border: 1px solid #e9e9e9;border-radius: 3px;}.content-wrap { padding: 20px;}.content-block {padding: 0 0 20px;}';
        $email_message .= '.header {width: 100%;margin-bottom: 20px;}.footer { width: 100%;clear: both;color: #999;padding: 20px;}.footer p, .footer a, .footer td {color: #999; font-size: 12px;}';
        $email_message .= 'a {color: #348eda;text-decoration: underline;}';
        $email_message .= '.btn-primary { text-decoration: none;color: #FFF;background-color: #348eda;border: solid #348eda; border-width: 10px 20px;line-height: 2em;font-weight: bold;text-align: center;cursor: pointer;display: inline-block;border-radius: 5px;text-transform: capitalize;}';
    
        $email_message .= '</style>';
        $email_message .= '<title></title></head>';
        $email_message .= '<body itemscope itemtype="http://schema.org/EmailMessage" style="width: 100% !important; height: 100%; line-height: 1.6em;"><table class="body-wrap">';
       
        
        $email_message .= '<tr><td></td>';
        
        $email_message .= "<td class='container' width='600'><div class='content'><table class='main' width='100%' cellpadding='0' cellspacing='0'>";
        $email_message .= "<tr><td class='alert alert-warning'></td></tr><tr>";
        $email_message .= '<td class="content-wrap"><table width="100%" cellpadding="0" cellspacing="0">';
        
        $email_message .= "<tr><td><strong>Hello, we are happy for choosing and trusting us. Please be informed that you can always visit us for more details at our official website, Thank you!!! </strong></td></tr>";
    	$email_message .= "<tr><td class='content-block'><a href='sohessi.com' class='btn-primary'>Click here</a></td></tr>";
        $email_message .= '<tr><td class="content-block">'.EMAILFOOTER.'</td></tr></table></td></tr>';
    	
    	$email_message .= '	</td><td></td></tr></table>';	
    
    	$email_message .= "</body></html>";
        if(trim(strtoupper($_POST['email']))!="" && trim(strtoupper($_POST['email']))!="NONE" && trim(strtoupper($_POST['email']))!="N/A"){
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= "From: ".EMAILSENDER." \r\n".
            "Reply-To: ".NOREPLY." \r\n" ;
        @mail($_POST['email'], $email_subject, $email_message, $headers);
        }
      
    }

}
//$rvalue =array();
if(isset($_GET['id'])){
    $action = "Update";
    $rqdata = array("model"=>"patient", "condition"=>" WHERE id = '".$_GET['id']."'");
    $department = $app->getRecord2($rqdata);
    $rvalue = $department['data'][0];
    //echo json_encode($rvalue);

}else{ $action = "Create"; }


$department = $app->getDepartments();
//echo json_encode($department);



$module = explode("-",$page);

?>

<style>
.form-group {
 margin-bottom: 0px; 
}
</style>
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
                            <a href="?page=patients"><label class="btn btn-xs btn-info">Patients</label></a> 
                        </div>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group" style="margin-bottom: 0px; ">

                                    <?php if(isset($_GET['id'])): ?>
                                        <input type="hidden" class="form-control" name="id" value="<?php echo $_GET['id']; ?>" required />
                                    <?php endif; ?>
                                </div>
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Patient #</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder=" Number" id="patient_number" name="patient_number" value='<?php if(isset($_GET['id'])){ echo $rvalue['patient_number']; }else{ echo $app->createPatientId(); } ?>' required readonly/>
                                </div>
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Prefix</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Prefix" id="prename" name="prename" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['prename']."'"; } ?> required />
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>First Name</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="First Name" id="fname" name="fname" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['fname']."'"; } ?> required />
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Middle Name</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Middle Name" name="mname" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['mname']."'"; } ?>  />
                                </div>
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Last Name</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Last Name" name="lname" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['lname']."'"; } ?> required />
                                </div>



                            </div>
                            <div class="col-sm-4">

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Address</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Address" name="address" <?php if(isset($_GET['id'])){ echo 'value="'.$rvalue['address'].'"'; } ?> required/>
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Email</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="email" class="form-control" placeholder="Email" name="email" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['email']."'"; } ?> required />
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Mobile Number:</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Mobile Number" name="phone" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['phone']."'"; } ?> required/>
                                </div>
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Birth Date:</label>
                                    <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right" name="bdate" id="datepicker3" <?php if(isset($_GET['id'])){ echo "value='".date("m/d/Y",strtotime($rvalue['bdate']))."'"; } ?> required>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Citezen:</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Citezen" name="citizenship" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['citizenship']."'"; } ?> required/>
                                </div>
                                

                                
                               

                            </div>
                            <div class="col-sm-4">

                                 <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Gender</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <select name="gender" class="form-control">
                                        <option value="Male" <?php if(isset($_GET['id']) && $rvalue['gender']=="Male"){ echo "selected"; } ?>>Male</option>
                                        <option value="Female" <?php if(isset($_GET['id']) && $rvalue['gender']=="Female"){ echo "selected"; } ?>>Female</option>
                                    </select>    
                                </div>
                                
                                  <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Occupation</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Occupation" name="occupation" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['occupation']."'"; } ?> required/>
                                </div>
                              
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Company</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Company" name="position" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['position']."'"; } ?> required/>
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Blood Type</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Position" name="bloodtype" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['bloodtype']."'"; } ?> required/>
                                </div>

                                

                                
                                
                                
                            </div>
                            
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


<script>



$('#fname').on('change',function(e){
    var un = $(this).val();
    <?php if(!isset($_GET['id'])): ?>
        var ext = makeUser();
        var pass = makeRandom();
        un = un.substring(0,3) + ext;
        $("#un").val(un);
        $("#pw").val(pass);
    <?php endif; ?>

});
$('#rate').on('input',function(e){
    calculate("rate");
});
$('#monthly').on('input',function(e){
    calculate("monthly");
});
$('#hrs').on('input',function(e){
    calculate("hrs");
});
$('#employee_type').on('change',function(e){
    var employee_type = $(this).val();
    var param = "monthly";
    //alert(employee_type);
    if(employee_type==0){
        $('#rate').val(0);
        param = "monthly";
    }else{
        $('#monthly').val(0);
        param = "rate";
    }
    calculate(param);
});

</script>