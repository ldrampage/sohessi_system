<!-- Main content -->
<?php

$response=array('action'=>"", 'message'=>"");
if(isset($_POST['btn_save'])){
   
    $data = array('model'=>"employee",
        'keys'=>"fname, mname, lname, department_id, position, un, up, email, image,
                 date_hired, date_regularized, status, address, usertype, 
                 birthdate, mobilenumber, date_exit");

    if(isset($_POST['id'])){
        $additionals = "";
        if(isset($_POST['pf'])){
            $additionals .= ", pf = '".$_POST['pf']."'";
        }
        if(isset($_POST['sp'])){
            $additionals .= ", sp = '".$_POST['sp']."'";
        }
        if(isset($_POST['category'])){
            $additionals .= ", labcategory = '".json_encode($_POST['category'])."'";
        }
        $data['values']="prename = '".str_replace("'","\'",$_POST['prename'])."',
                        fname = '".str_replace("'","\'",$_POST['fname'])."', 
                        mname = '".str_replace("'","\'",$_POST['mname'])."',
                        lname = '".str_replace("'","\'",$_POST['lname'])."',
                        department_id = '".str_replace("'","\'",$_POST['department_id'])."',
                        address = '".str_replace("'","\'",$_POST['address'])."',
                        position = '".str_replace("'","\'",$_POST['position'])."',
                        email = '".str_replace("'","\'",$_POST['email'])."',
                        date_hired = '".date('y-m-d',strtotime($_POST['date_hired']))."',
                        date_regularized = '".date('y-m-d',strtotime($_POST['date_regularized']))."',
                        
                        address = '".str_replace("'","\'",$_POST['address'])."',
                        usertype = '".str_replace("'","\'",$_POST['usertype'])."',
                        birthdate = '".date('Y-m-d',strtotime($_POST['birthdate']))."',
                        mobilenumber = '".str_replace("'","\'",$_POST['mobilenumber'])."'".$additionals;
        if(isset($_POST['un'])){ if(trim($_POST['un']!="")){  $data['values'] = $data['values'].", un = '".trim($_POST['un'])."'"; }  }
        if(isset($_POST['up'])){  if(trim($_POST['up']!="")){   $data['values'] = $data['values'].", up = '".sha1(trim($_POST['up']))."'"; }      }           
        $data['condition'] = " WHERE id = '".$_POST['id']."'";
        $response = $app->update2($data);
    }else{


        $date = date("Y")."-".date("m")."-".date("d");
        $additionals = "";
        $additionals2 = "";
        if(isset($_POST['pf'])){
            $additionals .= ", pf";
            $additionals2 .= ", '".$_POST['pf']."'";
        }
        if(isset($_POST['sp'])){
            $additionals .= ", sp";
            $additionals2 .= ", '".$_POST['sp']."'";
        }
        if(isset($_POST['category'])){
            $additionals .= ", labcategory";
            $additionals2 .= ", '".json_encode($_POST['category'])."'";
        }
        $data2 = array(
            'model'=>'employee',
            'keys'=>"prename, fname, mname, lname, department_id, position, un, up, email, image,
                 date_hired, date_regularized, status, address, usertype, 
                 birthdate, mobilenumber, employee_number".$additionals,
            'values'=>"'".str_replace("'","\'",$_POST['prename'])."', 
                        '".str_replace("'","\'",$_POST['fname'])."', 
                       '".str_replace("'","\'",$_POST['mname'])."', 
                       '".str_replace("'","\'",$_POST['lname'])."', 
                       '".str_replace("'","\'",$_POST['department_id'])."', 
                       '".str_replace("'","\'",$_POST['position'])."', 
                       '".trim($_POST['un'])."', 
                       '".sha1(trim($_POST['up']))."', 
                       '".str_replace("'","\'",$_POST['email'])."', 
                       'uploads/user.png',
                       '".date('Y-m-d',strtotime($_POST['date_hired']))."', 
                       '".date('Y-m-d',strtotime($_POST['date_regularized']))."', 
                       '1', 
                       '".str_replace("'","\'",$_POST['address'])."', 
                       '".str_replace("'","\'",$_POST['usertype'])."', 
                       '".date('Y-m-d',strtotime($_POST['birthdate']))."',
                       '".str_replace("'","\'",$_POST['mobilenumber'])."',
                       '".str_replace("'","\'",$_POST['employee_number'])."'".$additionals2
        );
        $response = $app->create2($data2);
        $response['message'] = "Successful";
        $email_message="";
        $email_subject = SOFTWARE_NAME." Login Credentials";
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
        
        $email_message .= "<tr><td><strong>Name: </strong> " . strip_tags($name) . "</td></tr>";
    	$email_message .= "<tr><td><strong>Username:  </strong> " . $_POST['un'] . " </td></tr>";
    	$email_message .= "<tr><td><strong>Password: </strong>" . $_POST['up'] . "</td></tr>";
    	$email_message .= "<tr><td class='content-block'><a href='".MAINURL."' class='btn-primary'>Click here</a></td></tr>";
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
    $rqdata = array("model"=>"employee", "condition"=>" WHERE id = '".$_GET['id']."'");
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
                            <a href="?page=employee"><label class="btn btn-xs btn-info">Employee</label></a> 
                        </div>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group" style="margin-bottom: 0px; ">

                                    <?php if(isset($_GET['id'])): ?>
                                        <input type="hidden" class="form-control" name="id" value="<?php echo $_GET['id']; ?>" required />
                                    <?php endif; ?>
                                </div>
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Employee #</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Employee Number" id="employee_number" name="employee_number" value='<?php if(isset($_GET['id'])){ echo $rvalue['employee_number']; }else{ echo $app->createEmployeeId(); } ?>' required readonly/>
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
                            <div class="col-sm-3">

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Address</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Address" name="address" <?php if(isset($_GET['id'])){ echo 'value="'.$rvalue['address'].'"'; } ?> />
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Email</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="email" class="form-control" placeholder="Email" name="email" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['email']."'"; } ?> required />
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Mobile Number:</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Mobile Number" name="mobilenumber" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['mobilenumber']."'"; } ?> />
                                </div>
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Birth Date:</label>
                                    <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right" name="birthdate" id="datepicker3" <?php if(isset($_GET['id'])){ echo "value='".date("m/d/Y",strtotime($rvalue['birthdate']))."'"; } ?> >
                                    </div>
                                </div>
                                

                                
                               

                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label>Department</label>
                                    <select class="form-control select2 select2-hidden-accessible"  data-placeholder="Select a Department" name="department_id" id="department_id" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                        <?php
                                         foreach ($department as $key => $value) {
                                              $act="";
                                             if(isset($_GET['id']) && $rvalue['department_id']==$key){ $act="selected";}
                                             if(isset($_GET['department-id']) && $_GET['department-id']==$key){ $act="selected";}
                                             echo "<option value='".$key."' ".$act.">".$value['name']."</option>";
                                         }
                                        ?>
                                    </select>   
                                </div>      
                                 
                                <div class="form-group">
                                    <label>Employee Type</label>
                                    <?php 
                                    $types = $app->getUserTypes();
                                    ?>
                                    <select class="form-control select2 select2-hidden-accessible" id="usertype" name="usertype" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                        
                                        <?php foreach($types as $k => $v){ if($k>0){ $sl="";
                                                if(isset($_GET['id']) && $rvalue['usertype']==$k){ $sl = "selected"; }
                                                echo "<option value='$k' $sl>$v</option>";
                                            }
                                        } ?>
                                      
                                    </select>
                                </div>
                                 <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Position</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Position" name="position" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['position']."'"; } ?> />
                                </div>

                                 <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Date Hired</label>
                                    

                                    <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right" name="date_hired" id="datepicker" <?php if(isset($_GET['id'])){ echo "value='".date("m/d/Y",strtotime($rvalue['date_hired']))."'"; } ?> >
                                    </div>
                                </div>
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Date Regularized</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right" name="date_regularized" id="datepicker2" <?php if(isset($_GET['id'])){ echo "value='".date("m/d/Y",strtotime($rvalue['date_regularized']))."'"; } ?>>
                                    </div>
                                </div>

                                
                                
                                
                            </div>
                            <div class="col-sm-3">
                                <div id="additionals" style="display: <?php if(isset($_GET['id']) && $rvalue['usertype']==2){ echo "inline";  }else{ echo "none";  } ?>;">
                                        <div class="form-group" style="margin-bottom: 0px; ">
                                         <label>Professional Fee</label>
                                        <input type="text" class="form-control" placeholder="Professional Fee" id="dpf" value="<?php if(isset($_GET['id'])){ echo $rvalue['pf']; } ?>" name="pf"  />
                                         </div>
                                         <div class="form-group" style="margin-bottom: 0px; ">
                                        <label>Specialization</label>
                                         <input type="text" class="form-control"  id="dsp" value="<?php if(isset($_GET['id'])){ echo $rvalue['sp']; } ?>" placeholder="Specialization" name="sp"  />
                                         </div>
                                </div> 

                                <div id="additionals2" style="display: <?php if(isset($_GET['id']) && $rvalue['usertype']==3){ echo "inline";  }else{ echo "inline";  } ?>;">
                                 <div class="form-group" style="margin-bottom: 0px; ">
                                         <label>Lab Test Category</label>
                                        <select class="form-control select2" id="category" name="category[]"  multiple="multiple" style="width: 100%;"

                                         <?php $tcat = $app->getTestCategory();
                                            echo "<option value=\"\">SELECT</option>";
                                            foreach($tcat as $k=> $v){
                                                $ac=""; if(isset($_GET['id'])){ 
                                                    $allCategory = json_decode($rvalue['labcategory']);
                                                    if(in_array($k,$allCategory)){
                                                        $ac="selected"; 
                                                    }
                                                    
                                                }
                                                echo '<option value="'.$k.'" '.$ac.'>'.$v['name'].'</option>';
                                            } ?>

                                         </select></div>
                                </div>    
                                
                                

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Username</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input id="un" type="text" class="form-control" placeholder="username" name="un" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['un']."'"; } ?> required />
                                </div>
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label> <?php if(isset($_GET['id'])){ echo "(Please leave blank to retain password)"; }else{ echo "Password"; } ?></label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input id="pw" type="text" class="form-control" placeholder="password" name="up" <?php if(isset($_GET['id'])){ echo "value=''"; }else{ echo "required"; } ?>  />
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

//additionals

$('#usertype').change(function(e){
    var val = $(this).val();
    //alert(val);
    var htmlInsert = "";
    //$("#additionals").empty();
    if(val==2){
          $("#additionals").attr("style","display: inline;");
          $("#dpf").attr("required",true);
         $("#dsp").attr("required",true);
    }else{
         $("#additionals").attr("style","display: none;");
         $("#dpf").removeAttr('required');
         $("#dsp").removeAttr('required');
    }
    if(val==3){
         // htmlInsert +='<div class="form-group" style="margin-bottom: 0px; ">';
         // htmlInsert +='<label>Lab Test Category</label>';
         // htmlInsert +=' <select class="form-control select2" id="category" name="category[]"  multiple="multiple" style="width: 100%;" >';

         // <?php $tcat = $app->getTestCategory();
         //    echo "htmlInsert +='<option value=\"\">SELECT</option>';";foreach($tcat as $k=> $v){
         //        $ac=""; if(isset($_GET['id'])){ 
         //            $allCategory = json_decode($rvalue['labcategory']);
         //            if(in_array($k,$allCategory)){
         //                $ac="selected"; 
         //            }
                    
         //        }
         //        echo 'htmlInsert +=\'<option value="'.$k.'" '.$ac.'>'.$v['name'].'</option>\';';
         //    } ?>

         // htmlInsert +='</select></div>';
         // $("#additionals").html(htmlInsert);
         $("#additionals2").attr("style","display: inline;");
   
    }else{
        // $("#additionals2").attr("style","display: none;");
        $("#additionals2").attr("style","display: inline;");
    }

});

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