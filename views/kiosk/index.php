<?php //session_start(); ?>
<style>
    
    
    .skin-blue .wrapper {
        background:transparent;
    }
    
    body {
        background:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),url('kiosk.jpg') center;
        height:100vh;
    }
    
    .login-box {
        margin:7% auto 2% auto;
    }
    
    .login-box-body {
        background:#18232e;
        border-radius: 5px;
        padding: 30px 50px 30px 50px;
        opacity:0.9;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
    }
    
    img.logo-bottom {
        display:block;
        margin:30px auto 0 auto;
    }
    
    .login-box-msg {
        color:#94C0BB;
        font-size:15px;
        text-transform:uppercase;
        font-weight:600;
    }
    
    input {
        background:#fff;
    }
    
    input:-webkit-autofill {
     -webkit-box-shadow: 0 0 0 30px white inset;
    }
    
    .checkbox label {
        color:#fff;
        
    }
    
    input.checkbox {
        border:none;
    }

    
    .log-submit .btn-outline {
        border:1px solid white;
    }
    
    .log-submit .btn-outline:hover, .log-submit .btn-outline:active, .log-submit .btn-outline:focus {
        background:#94C0BB;
        border:1px solid #94C0BB;
        color:#fff;
        
        -webkit-transition: all 1s ease;
    	-moz-transition: all 1s ease;
    	-o-transition: all 1s ease;
    	transition: all 1s ease;
    }
    .login-box, .register-box {
        width: 860px;
        margin: 7% auto;
    }

    .btn-kiosk{
      padding: 20px;
      font-size: 20px;
      width: 100%;
      margin-bottom: 20px;
      margin-top: 20px;
    }
    .btn-bread{
      margin-bottom: 10px;
      margin-top: 10px;
      padding: 10px;
      font-size: 20px;\
      width: 100%;
    }
    .login-box, .register-box {
    width: 860px;
     margin: 1% auto; 
}
  .home-div>a{
    font-size: 30px;
  }
   .back-div>a{
    font-size: 30px;
  }


.dropdown.dropdown-lg .dropdown-menu {
    margin-top: -1px;
    padding: 6px 20px;
}
.input-group-btn .btn-group {
    display: flex !important;
}
.btn-group .btn {
    border-radius: 0;
    margin-left: -1px;
}
.btn-group .btn:last-child {
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
}
.btn-group .form-horizontal .btn[type="submit"] {
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
}
.form-horizontal .form-group {
    margin-left: 0;
    margin-right: 0;
}
.form-group .form-control:last-child {
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}
tr:nth-child(even) {background: #FFF}

@media screen and (min-width: 768px) {
    #adv-search {
        width: 500px;
        margin: 0 auto;
    }
    .dropdown.dropdown-lg {
        position: static !important;
    }
    .dropdown.dropdown-lg .dropdown-menu {
        min-width: 500px;
    }
}
</style>
<?php 
    if(isset($_GET['reset'])){ session_destroy(); echo "<script>location.href='?page=kiosk&step=1';</script>"; }
    if(!isset($_SESSION['lab_items'])){
      $_SESSION['lab_items'] = array();
    }

    if(isset($_GET['step'])){
      echo $_GET['step']."<==";
      $step=$_GET['step'];
    }else{
      $step=1;
    }
    if($step!="done"){
      $back = $step - 1;
    }else{
      $back = "";
    }
    

    $message_q= "";
   
    if(isset($_GET['n'])){  
      if($_GET['n']==1){ $_SESSION['patient_type'] = "NEW"; }else{ $_SESSION['patient_type'] = "OLD"; }
    }
    if(isset($_GET['pid'])){  
      $_SESSION['patient_id'] = $_GET['pid']; 
    }
    if(isset($_GET['ecl'])){  
      $queuing_type = array(1=>"Employment Requirement", 2=>"Check-up", 3=>"Individual");
      $_SESSION['transaction_type'] = $_GET['ecl']; 
    }

    if(isset($_GET['ereq'])){
       if($_GET['ereq']==1){
          $_SESSION['patient_class'] = "Pre-employment";
       }else{
          $_SESSION['patient_class'] = "Annual";
       }
    }

    if(isset($_GET['la'])){
       if($_GET['la']==1){
          $_SESSION['myreq'] = "Enquire";
       }else{
          $_SESSION['myreq'] = "Test";
       }
    }

    if(isset($_GET['cid'])){
        $_SESSION['company'] = $_GET['cid'];
       
    }
     
    if(isset($_GET['did'])){  
      $_SESSION['dr_id'] = $_GET['did']; 
      $data = array('model'=>'employee', 'condition'=>"WHERE id = '".$_GET['did']."'",'order'=>'');
      $employee = $app->getRecord2($data);
      $employee = $employee['data'][0];
      $_SESSION['dr_name']  = $employee['prename']." ".$employee['fname']." ".$employee['mname']." ".$employee['lname'];

      $getNewDate = date("Y-m-d H:i:s");
      $qn = $app->getQueingNumber(); //RandomString2(5);
      if(isset($_SESSION['company'])){ $company = $_SESSION['company']; }else{ $company=0; }
      $queue_data = array("model"=>"queuing",
                          "keys"=>"dtime, queuing_number, patient_type, patient_id, trans_type, which, patient_class, status, dr_id, dr_name, date, company",
                          "values"=>"'".$getNewDate."',
                                     '".$qn."',
                                     '".$_SESSION['patient_type']."',
                                     '".$_SESSION['patient_id']."',
                                     'Check-up',
                                     '0',
                                     'Individual',
                                     '0',
                                     '".$_SESSION['dr_id']."',
                                     '".$_SESSION['dr_name']."',
                                     '".date("Y-m-d")."',
                                     '".$company."'");

      $response=$app->create2($queue_data);
      // unset($_SESSION);
      // session_destroy();
      $message_q = "<div style='background-color:#FFF; color: #000; padding: 15px; font-weight: bold;'><hr><h3>Thank You!!!</h3><h4>You're enqueued and your number is </h4><h3>".$qn."</h3><hr></div>";

         
        $ps=$app->getPatients("WHERE id = '".$_SESSION['patient_id']."'");
        //echo json_encode($_SESSION);

        $ddr = $app->getEmployees("WHERE id = '".$_SESSION['dr_id']."'");
        //echo json_encode($ddr);
        
        $dr = "&dr=".$_SESSION['dr_name'];
        $pf = "&pf=".$ddr[trim($_SESSION['dr_id'])]['pf'];
        $qns = "?qn=".$qn;
        $pnum = "&pnum=".$ps[trim($_SESSION['patient_id'])]['patient_number'];
        $pname = "&pname=".$ps[trim($_SESSION['patient_id'])]['fname']." ".$ps[trim($_SESSION['patient_id'])]['lname'];
      echo '<script>var strWindowFeatures = "location=yes,height=570,width=520,scrollbars=yes,status=yes";
var URL = "http://localhost/escpos/index.php'.$qns.$dr.$pf.$pnum.$pname.'";
var win = window.open(URL, "_blank", strWindowFeatures);</script>';


    }

    if(isset($_GET['clabs'])){


        $getNewDate = date("Y-m-d H:i:s");
        $qn = $app->getQueingNumber(); //$app->RandomString2(5);
        if(isset($_SESSION['company'])){ $company = $_SESSION['company']; }else{ $company=0; }
      foreach($_SESSION['lab_items'] as $k => $v){
        $skipwait = 0;
        if($v['lab_pq']==0){
            $skipwait = 1;
        }
        $queue_data = array("model"=>"queuing",
                            "keys"=>"dtime, queuing_number, patient_type, patient_id, trans_type, which, patient_class, status, dr_id, dr_name, date, skipwait, company",
                            "values"=>"'".$getNewDate."',
                                       '".$qn."',
                                       '".$_SESSION['patient_type']."',
                                       '".$_SESSION['patient_id']."',
                                       'Laboratory',
                                       '".$v['lab_id']."',
                                       'Individual',
                                       '0',
                                       '',
                                       '',
                                       '".date("Y-m-d")."',
                                       '".$skipwait."',
                                     '".$company."'");

        $response=$app->create2($queue_data);
        // unset($_SESSION);
        // session_destroy();
      }
        
        $litems = "";
        $c=0;
        $total = 0;
        foreach($_SESSION['lab_items'] as $lk => $lv){ $c++; $conts=""; if($c>1){ $conts = ","; }
          $litems .= $conts.$lv['lab_name']."-".$lv['lab_price'];
          $total = $total + $lv['lab_price'];
        
        }
        $ps=$app->getPatients("WHERE id = '".$_SESSION['patient_id']."'");
        //echo json_encode($ps);
        $lb = "&lb=".$litems;
        $total = "&total=".$total;
        $qns = "?qn=".$qn;
        $pnum = "&pnum=".$ps[trim($_SESSION['patient_id'])]['patient_number'];
        $pname = "&pname=".$ps[trim($_SESSION['patient_id'])]['fname']." ".$ps[trim($_SESSION['patient_id'])]['lname'];

          echo '<script>var strWindowFeatures = "location=yes,height=570,width=520,scrollbars=yes,status=yes";
var URL = "http://localhost/escpos/index.php'.$qns.$lb.$pnum.$pname.$total.'";
var win = window.open(URL, "_blank", strWindowFeatures);</script>';

        //echo $litems;
        $message_q = "<div style='background-color:#FFF; color: #000; padding: 15px;'><hr><h3>Thank You!!!</h3><h4>You're enqueued and your number is </h4><h3>".$qn."</h3><hr></div>";
      //}

    }


    if(isset($_GET['pa'])){


        $getNewDate = date("Y-m-d H:i:s");
        $qn = $app->getQueingNumber();//$app->RandomString2(5);
      foreach($_SESSION['lab_items'] as $k => $v){
        $skipwait = 0;
        if($v['lab_pq']==0){
            $skipwait = 1;
        }
        $queue_data = array("model"=>"queuing",
                            "keys"=>"dtime, queuing_number, patient_type, patient_id, trans_type, which, patient_class, status, dr_id, dr_name, date, skipwait",
                            "values"=>"'".$getNewDate."',
                                       '".$qn."',
                                       '".$_SESSION['patient_type']."',
                                       '".$_SESSION['patient_id']."',
                                       'Laboratory',
                                       '".$v['lab_id']."',
                                       '".$_SESSION['patient_class']."',
                                       '0',
                                       '',
                                       '',
                                       '".date("Y-m-d")."',
                                       '".$skipwait."'");

        $response=$app->create2($queue_data);
        // unset($_SESSION);
        // session_destroy();
        $message_q = "<div style='background-color:#FFF; color: #000; padding: 15px;'><hr><h3>Thank You!!!</h3><h4>You're enqueued and your number is </h4><h3>".$qn."</h3><hr></div>";
      }

    }

    //echo json_encode($_SESSION);

    
 


?>
<div class="row">



  <div class="col-md-2">
    <div class="back-div" style="margin: 15px; font-size: 20px;">
      <?php if($step>1): ?>
    <a href="?page=<?php echo $_GET['page']; ?>&step=<?php echo $back; ?>" class="btn btn-xs btn-success"><i class="fa fa-step-backward"></i> BACK</a>
     
    <?php endif; ?>
    </div> 
   
  </div>
  
  <div class="col-md-8" style="text-align: center;">
      <?php if(isset($_SESSION['patient_type'])): ?>
      <label href="?page=<?php echo $_GET['page']; ?>&step=<?php echo $back; ?>" class="btn btn-xs btn-info btn-bread"><i class="fa fa-user-md"></i> <?php echo $_SESSION['patient_type']; ?> PATIENT</label>
      <?php endif; ?>
  </div>  

  <div class="col-md-2">

     
    <div class="pull-right home-div" style="margin: 15px; font-size: 20px;">
      <a href="?page=<?php echo $_GET['page']; if($step=="done"){ echo "&reset=1"; } ?>" class="btn btn-xs btn-success"><i class="fa fa-home"></i> Home</a>
    </div>  
  </div>
</div>

<center><img src="header.png" width="" style="margin-top: 15px; height: 100px;" alt="Sohessi Software"></center>

<div class="login-box">
<div class="login-box-body" style="text-align: center;">


  <?php if($message_q!=""): ?>
        <?php echo $message_q; ?>
     
  <?php endif; ?>  




  <!-------------------------------------------->
  <!-------------------STEP ONE----------------->
  <!-------------------------------------------->
  <?php 
  if($step==1):
  ?>

     <a href="?page=<?php echo $_GET['page']; ?>&step=2&n=1" class="btn btn-xs btn-success btn-kiosk" data-target="#demo">
        + New Patient
     </a>

     <a href="?page=<?php echo $_GET['page']; ?>&step=2&n=0" class="btn btn-xs btn-warning btn-kiosk" data-target="#demo">
        * Old Patient
     </a>
  <?php 
  endif;
  ?>
  <!-------------------------------------------->
  <!-------------------END  ONE----------------->
  <!-------------------------------------------->



  <!-------------------------------------------->
  <!-------------------STEP TWO----------------->
  <!-------------------------------------------->

<?php 
  if($step==2):

    if(isset($_POST['btn_p'])){
      $date = date("Y")."-".date("m")."-".date("d");
        $data = array('model'=>"patient",
        'keys'=>"prename, fname, mname, lname, address, bdate, bloodtype, date_start, patient_number, phone, citizenship, email, image");
        $data2 = array(
            'model'=>'patient',
            'keys'=>"prename, fname, mname, lname, address, bdate, bloodtype, date_start, patient_number, phone, citizenship, email,occupation,position, gender,image",
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
      
      $email_message .= ' </td><td></td></tr></table>'; 
    
      $email_message .= "</body></html>";
        if(trim(strtoupper($_POST['email']))!="" && trim(strtoupper($_POST['email']))!="NONE" && trim(strtoupper($_POST['email']))!="N/A"){
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= "From: ".EMAILSENDER." \r\n".
            "Reply-To: ".NOREPLY." \r\n" ;
        @mail($_POST['email'], $email_subject, $email_message, $headers);
        }
        
        echo "<script>location.href='?page=".$_GET['page']."&step=3&pid=".$response['id']."'</script>";
    }


    if($_SESSION['patient_type']=="NEW"):
  ?>

    <div class="modal-body">
                        <form name="" method="POST">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group" style="margin-bottom: 0px; ">

                                    <?php if(isset($_GET['id'])): ?>
                                        <input type="hidden" class="form-control input-lg" name="id" value="<?php echo $_GET['id']; ?>" required />
                                    <?php endif; ?>
                                </div>
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Patient #</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control  input-lg" placeholder=" Number" id="patient_number" name="patient_number" value='<?php if(isset($_GET['id'])){ echo $rvalue['patient_number']; }else{ echo $app->createPatientId(); } ?>' required readonly/>
                                </div>
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Prefix</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input tabindex="1" type="text" class="form-control keyboard input-lg" placeholder="Prefix" id="prename" name="prename" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['prename']."'"; } ?>  />
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>First Name</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input tabindex="2" type="text" class="form-control keyboard input-lg" placeholder="First Name" id="fname" name="fname" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['fname']."'"; } ?> required />
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Middle Name</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input tabindex="3" type="text" class="form-control keyboard input-lg" placeholder="Middle Name" name="mname" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['mname']."'"; } ?>  />
                                </div>
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Last Name</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input tabindex="4" type="text" class="form-control keyboard input-lg" placeholder="Last Name" name="lname" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['lname']."'"; } ?> required />
                                </div>



                            </div>
                            <div class="col-sm-4">

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Address</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input tabindex="5" type="text" class="form-control keyboard input-lg" placeholder="Address" name="address" <?php if(isset($_GET['id'])){ echo 'value="'.$rvalue['address'].'"'; } ?> required/>
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Email</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input tabindex="6" type="email" class="form-control keyboard input-lg" placeholder="Email" name="email" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['email']."'"; } ?>  />
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Mobile Number:</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input tabindex="7" type="text" class="form-control keyboard input-lg" placeholder="Mobile Number" name="phone" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['phone']."'"; } ?> />
                                </div>
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Birth Date:</label>
                                    <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input tabindex="8" type="text" class="form-control pull-right  input-lg" name="bdate" id="datepicker3" <?php if(isset($_GET['id'])){ echo "value='".date("m/d/Y",strtotime($rvalue['bdate']))."'"; } ?> required>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Citezen:</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input tabindex="9" type="text" class="form-control keyboard input-lg" placeholder="Citezen" name="citizenship" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['citizenship']."'"; } ?> required/>
                                </div>
                                  

                            </div>
                            <div class="col-sm-4">

                                 <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Gender</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <select tabindex="10" name="gender" class="form-control  input-lg">
                                        <option value="Male" <?php if(isset($_GET['id']) && $rvalue['gender']=="Male"){ echo "selected"; } ?>>Male</option>
                                        <option value="Female" <?php if(isset($_GET['id']) && $rvalue['gender']=="Female"){ echo "selected"; } ?>>Female</option>
                                    </select>    
                                </div>
                                
                                  <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Occupation</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input tabindex="11" type="text" class="form-control keyboard input-lg" placeholder="Occupation" name="occupation" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['occupation']."'"; } ?> />
                                </div>
                              
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Company</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input tabindex="12" type="text" class="form-control keyboard input-lg" placeholder="Company" name="position" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['position']."'"; } ?> />
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Blood Type</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input tabindex="13" type="text" class="form-control keyboard input-lg" placeholder="Blood Type" name="bloodtype" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['bloodtype']."'"; } ?> />
                                </div>

                                 <div class="form-group" style="margin-bottom: 0px; margin-top:25px;">
                                    <input tabindex="14" type="submit" name="btn_p" class="form-control btn btn-success fa fa-plus-square btn-sm" value="NEXT">
                                </div>
                            </div>
                            
                        </div>
                      </form>
                    </div>
                    <div id="keyboard-container"></div>
  <?php else: ?>   
     <div class="form-group" style="margin-bottom: 0px; ">
          <label style="font-weight: bold;">Enter Name/Patient Number</label><br>
          
      </div>
      <form method="POST">
      <div class="input-group" id="adv-search">
                <input type="text" class="form-control keyboard" name="searchfor" placeholder="Name / Patient #" />
                <div class="input-group-btn">
                    <div class="btn-group" role="group">
                        
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>
      </form>    
      <?php if(isset($_POST['searchfor'])): 

        $condition = " WHERE fname LIKE '%".$_POST['searchfor']."%' OR mname LIKE '%".$_POST['searchfor']."%' OR lname LIKE '%".$_POST['searchfor']."%' OR patient_number LIKE '%".$_POST['searchfor']."%'";

        $data = array('model'=>'patient', 'condition'=>$condition,'order'=>' order by lname');

        //echo json_encode($data);

        $employee = $app->getRecord2($data);
        $employee = $employee['data'];


      ?>  
      <div class="box-body table-responsive">
                        
                        <table id="" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th style="width:8px;"></th>
                                <th >ID</th>
                                <th >Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $n=0;
                            foreach($employee as $ke => $value): $n++;
                            ?>
                                <tr>
                                    <td >
                                        <?php echo $n; ?></td>
                                    <td ><?php echo $value['patient_number']; ?></td>
                                    <td ><img src="<?php echo $value['image']; ?>" style="width: 35px; height: 35px;" class="user-image" alt="User Image">
                                    <?php echo $value['lname'].", ".$value['fname']." ".$value['mname']; ?></td>
                                   
                                    <td>
  
                                        <a href="?page=<?php echo $_GET['page']; ?>&step=3&pid=<?php echo $value['id']; ?>">
                                            <label  class="btn btn-info btn-xs"><i class="fa fa-file-text-o"></i> SELECT</label>
                                        </a>
                                  

                                    </td>
                                </tr>
                            <?php  endforeach; ?>

                            </tbody>
                        </table>
    </div> 
    <?php endif; ?>                       
      
  <?php 
    endif;
  endif;
  ?>


  <!-------------------------------------------->
  <!-------------------END TWO----------------->
  <!-------------------------------------------->



  <!-------------------------------------------->
  <!-------------------STEP THREE--------------->
  <!-------------------------------------------->
  <?php if($step==3): ?>

     <a href="?page=<?php echo $_GET['page']; ?>&step=4&ecl=1" class="btn btn-xs btn-success btn-kiosk" data-target="#demo">
        * Employment Requirement
     </a>

     <a href="?page=<?php echo $_GET['page']; ?>&step=4&ecl=2" class="btn btn-xs btn-warning btn-kiosk" data-target="#demo">
        * Check-up
     </a>

     <a href="?page=<?php echo $_GET['page']; ?>&step=4&ecl=3" class="btn btn-xs btn-info btn-kiosk" data-target="#demo">
        * Laboratory Test
     </a>

  <?php endif; ?>  
  <!-------------------------------------------->
  <!-----------------THREE  ONE----------------->
  <!-------------------------------------------->





 <!-------------------------------------------->
  <!-------------------STEP FOUR---------------->
  <!-------------------------------------------->
  <?php if($step==4): ?>
     <?php if($_SESSION['transaction_type']==1): ?>
       <a href="?page=<?php echo $_GET['page']; ?>&step=5&ereq=1" class="btn btn-xs btn-success btn-kiosk" data-target="#demo">
          * Pre-employment
       </a>

       <a href="?page=<?php echo $_GET['page']; ?>&step=5&ereq=2" class="btn btn-xs btn-warning btn-kiosk" data-target="#demo">
          * Annual
       </a>
     <?php endif; ?>

     <?php if($_SESSION['transaction_type']==2): ?>
      

      <div class="form-group" style="margin-bottom: 0px; ">
          <label style="font-weight: bold;">Enter Name/Doctor Number</label><br>
          
      </div>
      <form method="POST">
      <div class="input-group" id="adv-search">
                <input type="text" class="form-control keyboard" name="searchforDoc" placeholder="Doctor / Patient #" />
                <div class="input-group-btn">
                    <div class="btn-group" role="group">
                        
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>
      </form>    
      <?php if(isset($_POST['searchforDoc'])): 

        $condition = " WHERE (fname LIKE '%".$_POST['searchforDoc']."%' OR mname LIKE '%".$_POST['searchforDoc']."%' OR lname LIKE '%".$_POST['searchforDoc']."%' OR employee_number LIKE '%".$_POST['searchforDoc']."%') AND usertype='2'";

        $data = array('model'=>'employee', 'condition'=>$condition,'order'=>' order by fname');

        //echo json_encode($data);

        $employee = $app->getRecord2($data);
        $employee = $employee['data'];


      ?>  
      <div class="box-body table-responsive">
                        
                        <table id="" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th style="width:8px;"></th>
                                <th >ID</th>
                                <th >Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $n=0;
                            foreach($employee as $ke => $value): $n++;
                            ?>
                                <tr>
                                    <td >
                                        <?php echo $n; ?></td>
                                    <td ><?php echo $value['employee_number']; ?></td>
                                    <td ><img src="<?php echo $value['image']; ?>" style="width: 35px; height: 35px;" class="user-image" alt="User Image">
                                    <?php echo $value['prename']." ".$value['fname']." ".$value['mname']." ".$value['lname']; ?></td>
                                    <td>
  
                                        <a href="?page=<?php echo $_GET['page']; ?>&step=done&did=<?php echo $value['id']; ?>">
                                            <label  class="btn btn-info btn-xs"><i class="fa fa-file-text-o"></i> SELECT</label>
                                        </a>
                                  

                                    </td>
                                </tr>
                            <?php  endforeach; ?>

                            </tbody>
                        </table>
    </div> 



     <?php endif; endif; ?>

     <?php if($_SESSION['transaction_type']==3): ?>
       <a href="?page=<?php echo $_GET['page']; ?>&step=5&la=1" class="btn btn-xs btn-success btn-kiosk" data-target="#demo">
          * ENQUIRE
       </a>

       <a href="?page=<?php echo $_GET['page']; ?>&step=5&la=2" class="btn btn-xs btn-warning btn-kiosk" data-target="#demo">
          * LAB TEST
       </a>
     <?php endif; ?>

  <?php endif; ?>  
  <!-------------------------------------------->
  <!-----------------FOUR  ONE------------------>
  <!-------------------------------------------->





  <!-------------------------------------------->
  <!-------------------STEP FIVE---------------->
  <!-------------------------------------------->
  <?php if($step==5): ?>
     <?php if($_SESSION['transaction_type']==1): ?>
      <div class="form-group" style="margin-bottom: 0px; ">
          <label style="font-weight: bold;">Enter Company/ Company #</label><br>
          
      </div>
      <form method="POST">
      <div class="input-group" id="adv-search">
                <input type="text" class="form-control keyboard" name="searchforComp" placeholder="Enter Company/ Company #" />
                <div class="input-group-btn">
                    <div class="btn-group" role="group">
                        
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>
      </form>    
      <?php if(isset($_POST['searchforComp'])): 

        $condition = " WHERE company LIKE '%".$_POST['searchforComp']."%' OR company_number LIKE '%".$_POST['searchforComp']."%' ";

        $data = array('model'=>'company', 'condition'=>$condition,'order'=>' order by company');

        //echo json_encode($data);

        $employee = $app->getRecord2($data);
        $employee = $employee['data'];


      ?>  
      <div class="box-body table-responsive">
                        
                        <table id="" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th style="width:8px;"></th>
                                <th >ID</th>
                                <th >Name</th>
                                <th >Branch</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $n=0;
                            foreach($employee as $ke => $value): $n++;
                            ?>
                                <tr>
                                    <td >
                                        <?php echo $n; ?></td>
                                    <td ><?php echo $value['company_number']; ?></td>
                                    <td ><?php echo $value['company']; ?></td>
                                    <td ><?php echo $value['branch']; ?></td>
                                    <td>
  
                                        <a href="?page=<?php echo $_GET['page']; ?>&step=6&cid=<?php echo $value['id']; ?>">
                                            <label  class="btn btn-info btn-xs"><i class="fa fa-file-text-o"></i> SELECT</label>
                                        </a>
                                  

                                    </td>
                                </tr>
                            <?php  endforeach; ?>

                            </tbody>
                        </table>
    </div> 



     <?php endif; endif; ?>

     



     <?php if($_SESSION['transaction_type']==3): ?>

     <?php if($_SESSION['myreq']=="Test"): ?>

      <div class="form-group" style="margin-bottom: 0px; ">
          <label style="font-weight: bold;">Enter Laboratory Test</label><br>
          
      </div>
      <form method="POST">
      <div class="input-group" id="adv-search">
                <input type="text" class="form-control keyboard" name="searchforLabTest" placeholder="Enter Laboratory Test" />
                <div class="input-group-btn">
                    <div class="btn-group" role="group">
                        
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>
      </form>    
     
      <div class="row">
          <div class="col-md-6">
              <h5 style="background-color: #FFF; color: #000; padding: 10px; font-weight: bold; border-radius: 5px;">CHOICES</h5>
              <?php if(isset($_POST['searchforLabTest'])): 

              $condition = " WHERE name LIKE '%".$_POST['searchforLabTest']."%' OR description LIKE '%".$_POST['searchforLabTest']."%' ";

              $data = array('model'=>'laboffered', 'condition'=>$condition,'order'=>' order by name');

              //echo json_encode($data);

              $employee = $app->getRecord2($data);
              $employee = $employee['data'];


             ?>  
              <div class="box-body table-responsive">
                        
                        <table id="" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th style="width:8px;"></th>
                                <th >Lab Test</th>
                                <th >Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $n=0;
                            foreach($employee as $ke => $value): $n++;
                            ?>
                                <tr>
                                    <td >
                                        <?php echo $n; ?></td>
                                    <td ><?php echo $value['name']; ?></td>
                                    <td > <?php echo number_format($value['price'],2); ?></td>
                                    <td>
  
                                      <label  class="btn btn-info btn-xs" onClick="Addme('<?php echo $value['name']; ?>','<?php echo $value['id']; ?>', '<?php echo $value['price']; ?>', '<?php echo $value['patient_queing']; ?>')"><i class="fa fa-file-text-o"></i> SELECT</label>
                                  

                                    </td>
                                </tr>
                            <?php  endforeach; ?>

                            </tbody>
                        </table>
              </div> 
              <?php endif; ?>
          </div>
          <div class="col-md-6">
              <h5 style="background-color: #FFF; color: #000; padding: 10px; font-weight: bold; border-radius: 5px;">SELECTED</h5>
              <div class="box-body table-responsive">
                        <table id="" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th >Lab Test</th>
                                <th >Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="myitems">
                                <?php 

                                  if(isset($_SESSION['lab_items'])){

                                    foreach($_SESSION['lab_items'] as $k => $v){
                                      echo '<tr id="mytr_'.$v['lab_id'].'"><td>'.$v['lab_name'].'</td><td>'.$v['lab_price'].'</td><td><label  class="btn btn-danger btn-xs" onClick="Removeme('.$v['lab_id'].')"><i class="fa fa-file-text-o"></i> REMOVE</label></td></tr>';
                                    }

                                  }


                                ?>

                            </tbody>
                        </table>
              </div> 
          </div>
          <div id="submitter">
          <?php if(isset($_SESSION['lab_items']) && sizeOf($_SESSION['lab_items'])>0): ?>
            <a href="?page=<?php echo $_GET['page']; ?>&step=done&clabs=<?php echo sizeOf($_SESSION['lab_items']); ?>">
              <label  class="btn btn-success btn-xs" style="font-size: 22px; padding: 5px;"><i class="fa fa-file-text-o"></i> SUBMIT</label>
            </a>  
          <?php endif; ?>
        </div>
      </div>    


     <?php   endif;  endif; ?>





  <?php endif; ?>  
  <!-------------------------------------------->
  <!-----------------FOUR  FIVE------------------>
  <!-------------------------------------------->



  

  <!-------------------------------------------->
  <!-------------------Six START---------------->
  <!-------------------------------------------->
  <?php if($step==6): ?>
     

         
     
      <div class="row">
          <div class="col-md-6">
              <h5 style="background-color: #FFF; color: #000; padding: 10px; font-weight: bold; border-radius: 5px;">CHOICES</h5>
              <?php 
              $addCon="";
              if($_SESSION['patient_class']=="Pre-employment"){
                $addCon = " AND ctype='0' ";
              }else{
                $addCon = " AND ctype='1' ";
              }

              $condition = " WHERE company_id = '".$_SESSION['company']."' ".$addCon;

              $data = array('model'=>'lab_company', 'condition'=>$condition,'order'=>'');
              $employee = $app->getRecord2($data);
              $employee = $employee['data'];

              $labs = $app->getLabs();


             ?>  
              <div class="box-body table-responsive">
                        
                        <table id="" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th style="width:8px;"></th>
                                <th >Lab Test</th>
                                <th >Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $n=0;
                            foreach($employee as $ke => $value): $n++;
                            ?>
                                <tr>
                                    <td >
                                        <?php echo $n; ?></td>
                                    <td ><?php echo $labs[$value['lab_id']]['name']; ?></td>
                                    <td > <?php echo number_format($value['price'],2); ?></td>
                                    <td>
  
                                      <label  class="btn btn-info btn-xs" onClick="Addme('<?php echo $labs[$value['lab_id']]['name']; ?>','<?php echo $labs[$value['lab_id']]['id']; ?>', '<?php echo $value['price']; ?>', '<?php echo $labs[$value['lab_id']]['patient_queing']; ?>')"><i class="fa fa-file-text-o"></i> SELECT</label>
                                  

                                    </td>
                                </tr>
                            <?php  endforeach; ?>

                            </tbody>
                        </table>
              </div> 
              
          </div>
          <div class="col-md-6">
              <h5 style="background-color: #FFF; color: #000; padding: 10px; font-weight: bold; border-radius: 5px;">SELECTED</h5>
              <div class="box-body table-responsive">
                        <table id="" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th >Lab Test</th>
                                <th >Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="myitems">
                                <?php 

                                  if(isset($_SESSION['lab_items'])){

                                    foreach($_SESSION['lab_items'] as $k => $v){
                                      echo '<tr id="mytr_'.$v['lab_id'].'"><td>'.$v['lab_name'].'</td><td>'.$v['lab_price'].'</td><td><label  class="btn btn-danger btn-xs" onClick="Removeme('.$v['lab_id'].')"><i class="fa fa-file-text-o"></i> REMOVE</label></td></tr>';
                                    }

                                  }


                                ?>

                            </tbody>
                        </table>
              </div> 
          </div>
          <div id="submitter">
          <?php if(isset($_SESSION['lab_items']) && sizeOf($_SESSION['lab_items'])>0): ?>
            <a href="?page=<?php echo $_GET['page']; ?>&step=done&pa=<?php echo sizeOf($_SESSION['lab_items']); ?>">
              <label  class="btn btn-success btn-xs" style="font-size: 22px; padding: 5px;"><i class="fa fa-file-text-o"></i> SUBMIT</label>
            </a>  
          <?php endif; ?>
        </div>
      </div>    


     <?php    ?>





  <?php endif; ?>  
  <!-------------------------------------------->
  <!-----------------Six  END------------------>
  <!-------------------------------------------->




  <!--  <center><img src="logo.png" width="75px;" alt="Sohessi Software"><br>SOUTH OCCUPATIONAL HEALTH & SAFETY SERVICES, INC.</center><br> -->
   
  <?php
  //require_once();
  // //$obj = new mmlapi();
  //   $some_name = session_name("hrpanel"); session_set_cookie_params(0, '/', 'localhost/'); ini_set('session.cookie_domain', 'hr.backoffice-services.net'); 
  //session_start();
  


  ?>
    
    <!-- <p class="login-box-msg">SOHESSI SOFTWARE</p>

    <form  method="post" name="loginForm">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username"  name="login_user"   required/>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password"  name="login_pass"  required/>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label style="margin-left: 16px;">
              <input type="checkbox" > Remember Me
            </label>
          </div>
        </div>
        <!-- /.col --
        <div class="col-xs-4 log-submit">
          <input type="submit" class="btn btn-outline" value="Sign In" name="btn_login" />
        </div>
        <!-- /.col --
      </div>
    </form>
    <br> -->


  </div>
</div>


<img src="hn.png" class="img-responsive logo-bottom" width="200" alt="logo">
<script>

  $("#patientInput").on("change",function(){ 
      alert(this).val();
  });


 function Addme(name, id, price, pq){
   $.ajax({
        url: "session_lab.php",
        type: "post",
        data: {post_id: id, post_name: name, post_price: price, post_pq: pq, session_item: 1 },
        success: function (response) {
          if(response=="success"){ 
          var mitems = '<tr id="mytr_'+id+'"><td>'+name+'</td><td>'+price+'</td><td><label  class="btn btn-danger btn-xs" onClick="Removeme('+id+')"><i class="fa fa-file-text-o"></i> REMOVE</label></td>'; 

          $("#myitems").append(mitems);
          $("#submitter").empty();
          var subm = '<a href="?page=<?php echo $_GET['page']; ?>&step=done&clabs=<?php echo sizeOf($_SESSION['lab_items']); ?>"><label  class="btn btn-success btn-xs" style="font-size: 22px; padding: 5px;"><i class="fa fa-file-text-o"></i> SUBMIT</label></a>';  
          $("#submitter").html(subm);
          }
          if(response=="exists"){ 
            alert("Sorry, lab test already selected!");
          }

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });
}
 function Removeme(id){
   $.ajax({
        url: "session_lab_remove.php",
        type: "post",
        data: {post_id: id, session_item: 1 } ,
        success: function (response) {
          if(response=="success"){ 
            $("#mytr_"+id).remove();
          }
          if(response=="exists"){ 
            alert("Sorry, Failed to remove!");
          }

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });
}
</script>  
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->


