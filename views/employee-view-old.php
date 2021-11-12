
<script>


    function deleteThis(id){
        if (confirm('Are you sure you want to delete this?')) {
            window.location.href = window.location.href + '&del='+id;
        }
    }

    function setGetParameter(paramName, paramValue)
    {
        var url = window.location.href;
        var hash = location.hash;
        url = url.replace(hash, '');
        if (url.indexOf(paramName + "=") >= 0)
        {
            var prefix = url.substring(0, url.indexOf(paramName));
            var suffix = url.substring(url.indexOf(paramName));
            suffix = suffix.substring(suffix.indexOf("=") + 1);
            suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
            url = prefix + paramName + "=" + paramValue + suffix;
        }
        else
        {
            if (url.indexOf("?") < 0)
                url += "?" + paramName + "=" + paramValue;
            else
                url += "&" + paramName + "=" + paramValue;
        }
        window.location.href = url + hash;
    }

    function reloadWithStatus(val){
        setGetParameter('istatus', val);
    }

</script>

<?php

error_reporting(E_ALL); ini_set('display_errors', 1);
$response['message']="";
$data =array("model"=>"employee");
if(isset($_POST['updateEmployment'])){
    $data['values']="status = '".$_POST['status']."',
                        position = '".$_POST['position']."',
                        date_hired = '".date('y-m-d',strtotime($_POST['date_hired']))."',
                        date_regularized = '".date('y-m-d',strtotime($_POST['date_regularized']))."',
                        shift_start = '".date("H:i", strtotime($_POST['shift_start']))."',
                        shift_end = '".date("H:i", strtotime($_POST['shift_end']))."',
                        hrs = '".$_POST['hrs']."',
                        rate = '".$_POST['rate']."',
                        employee_type = '".$_POST['employee_type']."',
                        department_id = '".$_POST['department_id']."',
                        monthly = '".$_POST['monthly']."'";
        if(isset($_POST['un'])){  $data['values'] = $data['values'].", un = '".trim($_POST['un'])."'"; }  
        if(isset($_POST['pw'])){  $data['values'] = $data['values'].", up = '".sha1(trim($_POST['up']))."'"; }                 
        $data['condition'] = " WHERE id = '".$_GET['id']."'";
        $response = $app->update2($data);
}
if(isset($_POST['updateme'])){
    
    //echo json_encode($_POST);
    $data['values']="fname = '".str_replace("'","\'",$_POST['fname'])."', 
                        mname = '".str_replace("'","\'",$_POST['mname'])."',
                        lname = '".str_replace("'","\'",$_POST['lname'])."',
                        mobilenumber = '".$_POST['mobilenumber']."',
                        email = '".$_POST['email']."',
                        address = '".str_replace("'","\'",$_POST['address'])."',
                        citytown = '".str_replace("'","\'",$_POST['citytown'])."',
                        province = '".str_replace("'","\'",$_POST['province'])."',
                        country = '".str_replace("'","\'",$_POST['country'])."',
                        zip = '".$_POST['zip']."',
                        birthdate = '".date("Y-m-d",strtotime($_POST['birthdate']))."',
                        emergency_contact = '".$_POST['emergency_contact']."',
                        emergency_mobile = '".$_POST['emergency_mobile']."',
                        saying = '".$_POST['saying']."',
                        skypeid= '".$_POST['skypeid']."'";                 
        $data['condition'] = " WHERE id = '".$_GET['id']."'";
        $response = $app->update2($data);
}

if(isset($_POST['updateSecurity'])){
    $edata = array("model"=>"employee", "condition"=>" WHERE  id = '".$_GET['id']."'");
        $emps = $app->getRecord2($edata);
        $emps = $emps['data'][0];

    $data['values']="un = '".trim($_POST['un'])."'";  
        if(isset($_POST['up'])){
            if(trim($_POST['up'])!=""){
                $data['values'] = $data['values']. ", up = '".sha1(trim($_POST['up']))."'";
            }
        }               
        $data['condition'] = " WHERE id = '".$_GET['id']."'";
        $response = $app->update2($data);
        
        $email_message="";
        $email_subject = " HR Management & Payroll System Login Credentials (Update)";
        $name = $emps['fname']." ".$emps['lname'];
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
    	$email_message .= "<tr><td class='content-block'><a href='http://hr.backoffice-services.net/?page=login' class='btn-primary'>Click here</a></td></tr>";
        $email_message .= '<tr><td class="content-block">'.EMAILFOOTER.'</td></tr></table></td></tr>';
    	
    	$email_message .= '	</td><td></td></tr></table>';	
    
    	$email_message .= "</body></html>";
        if($emps['email_notify']==1){
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= "From: ".EMAILSENDER." \r\n".
            "Reply-To: ".NOREPLY." \r\n" ;
        @mail($emps['email'], $email_subject, $email_message, $headers);
        }
}


if(isset($_POST['updateAcl'])){
  //echo json_encode($_POST);
  $codes = $_POST['actcode'];
  $val = $_POST['aclvalue'];
  foreach($codes as $k=> $v){
    $dar = array("model"=>"acl", 
                 "values"=>" fcontrol = '".$val[$k]."'",
                 "condition"=>" WHERE emp_id = '".$_GET['id']."' AND feature_code = '".trim($v)."'");
    $up = $app->update2($dar);
  }

}


$acl = $app->getMyACL($_GET['id']);
if(sizeOf($acl)==0){
    $app->ACLsetDefault($_GET['id']);
}

$edata = array("model"=>"employee", "condition"=>" WHERE  id = '".$_GET['id']."'");
$emps = $app->getRecord2($edata);
$emps = $emps['data'][0];
$rvalue = $emps;

$shift_start = $rvalue['shift_start'];

$pays = $app->getPayslips("employee_id", $_GET['id']);

if($_SESSION['etimezone']!=""){
    date_default_timezone_set($_SESSION['etimezone']);
}
// echo date_default_timezone_get();
// echo $_SESSION['etimezone'];
// $current_day = date('Y-m-d h:m:s a');
$current_day = date('Y-m-d');
// echo "==".$current_day."==";


// date_default_timezone_set('Asia/Manila');
// echo date_default_timezone_get();
// $current_day = date('Y-m-d h:m:s a');
// echo $current_day."==";

if(isset($_POST['btn_d_filter'])){ $current_day=date('Y-m-d',strtotime($_POST['current_day'])); } 
//echo json_encode($pays);


$department = $app->getDepartments();


?>

<?php
$myStatus = array(0=>"Inactive Employee", 1=>"Active Employee");
$color = "#000";
if($emps['status']==1){
    $color = MYGREEN;
}
// if(strtoupper($clients['status'])=="FINISHED"){
//     $color = MYBLUE;
// }
// if(strtoupper($clients['status'])=="WAITING"){
//     $color = MYGOLD;
// }
if($emps['status']==0){
    $color = MYRED;
}

$activities=array();


?>
<style>
  .nav-tabs>li>a {
        position: relative;
        display: block;
        padding: 5px 5px;
    }

  </style>
<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header" style="color: <?php echo $color; ?>">
                <i class="fa fa-globe"></i>
                <?php
                 echo strtoupper($emps['lname'].", ".$emps['fname']." ".$emps['mname']);
                ?> (Employee View)
                <small class="pull-right">Date: <?php echo date("Y")."-".date("m")."-".date("d"); ?></small>
            </h2>
            <div class="pull-right" style="margin-top: -15px;">
                            <a href="?page=employee"><label class="btn btn-xs btn-info">Employee List</label></a> 
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo $emps['image']; ?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $emps['fname']; ?></h3>

              <p class="text-muted text-center"><?php echo $emps['position']; ?></p>
              <p class="text-muted text-center" style="font-size: 12px; margin-top: -6px;"><?php echo $department[$emps['department_id']]['name']; ?></p>

              <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                  <b>Status:</b> <a class="pull-right" style="color: <?php echo $color; ?>"><?php echo $myStatus[$emps['status']]; ?></a>
              </li>
              <!--  <li class="list-group-item">-->
              <!--    <b>Following</b> <a class="pull-right">543</a>-->
              <!--  </li>-->
              <!--  <li class="list-group-item">-->
              <!--    <b>Friends</b> <a class="pull-right">13,287</a>-->
              <!--  </li>-->
              </ul>

              <!--<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>-->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Saying</strong>

              <p class="text-muted">
                <?php echo $emps['saying']; ?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted"><?php echo $emps['address']."<br>".$emps['citytown']."<br>".$emps['province']."<br>".$emps['country']."<br>".$emps['zip']; ?></p>

              <hr>

              <!--<strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>-->

              <!--<p>-->
              <!--  <span class="label label-danger">UI Design</span>-->
              <!--  <span class="label label-success">Coding</span>-->
              <!--  <span class="label label-info">Javascript</span>-->
              <!--  <span class="label label-warning">PHP</span>-->
              <!--  <span class="label label-primary">Node.js</span>-->
              <!--</p>-->

              <!--<hr>-->

              <!--<strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>-->

              <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>-->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <?php if($_SESSION['acl']['employee-update']==1): ?>
              <li><a href="#activity" data-toggle="tab">Payments</a></li>
              <?php endif; ?>
              <!--<li><a href="#timeline" data-toggle="tab">Timeline</a></li>-->
              <li  class="<?php if(!isset($_POST['btn_d_filter'])){ if(!isset($_POST['bnt_ft'])){ echo "active"; } } ?>"><a href="#settings" data-toggle="tab">Employee Details</a></li>
              <?php if($_SESSION['acl']['employee-update']==1): ?>
              <li><a href="#photo" data-toggle="tab">Employment Details</a></li>
              <?php endif; ?>
              <?php if($_SESSION['acl']['salary-view']==1): ?>
              <li><a href="#salary" data-toggle="tab">Salary History</a></li>
              <?php endif; ?>
              <?php if($_SESSION['acl']['settings-acl']==1): ?>
              <li><a href="#acl" data-toggle="tab">Access Control</a></li>
              <?php endif; ?>
              <?php if($_SESSION['acl']['employee-update']==1): ?>
              <li><a href="#security" data-toggle="tab">Security</a></li>
              <?php endif; ?>
              <?php if($_SESSION['acl']['employee-printscreen']==1 || in_array($emps['team'],$_SESSION['manage'])): ?>
              <li class="<?php if(isset($_POST['btn_d_filter'])){ echo "active"; } ?>"><a href="#printscreen" data-toggle="tab">Print Screen</a></li>
              <?php endif; ?>
              <?php if($_SESSION['acl']['employee-timesheet']==1 || in_array($emps['team'],$_SESSION['manage'])): ?> 
              <li ><a href="#timesheet" data-toggle="tab">Timesheet</a></li>
              <?php endif; ?>
            </ul>
            <div class="tab-content">
              <?php if($_SESSION['acl']['employee-update']==1): ?>            
              <div class=" tab-pane" id="activity">
                  <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <!-- <span class="bg-red">
                   #1
                  </span> -->
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            
            
             
                <?php foreach($pays as $k => $v): 
                $pstat=$app->getPayrollStatus();
                if($v['status']==0){ $bsg = "bg-yellow"; }
                else{ $bsg = "bg-aqua"; }
                ?>  
                <li>
                  <i class="fa fa-money <?php echo $bsg; ?>"></i>

                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i><?php echo date("M jS, Y", strtotime($v['datefrom']))."-".date("M jS, Y", strtotime($v['dateto'])); ?></span>

                    <h3 class="timeline-header"><a href="#">Payroll Code</a> <?php echo $v['payroll_code']; ?></h3>
                    <div class="timeline-body">
                      <b>Basic:</b> <?php echo number_format($v['monthly'],2); ?><br>
                      <b>Bi-monthly:</b> <?php echo number_format($v['monthly']/2,2); ?><br>
                      <b>Incentives:</b> <?php echo number_format($v['incentives'],2); ?><br>
                      <b>Deductions:</b> <?php echo number_format($v['deduction'],2); ?><br>
                      <b>Total:</b> <?php echo number_format($v['total'],2); ?><br>
                      <b>Status:</b> <label class="<?php echo $bsg; ?>" style="padding: 3px 5px 3px 5px;"><?php echo $pstat[$v['status']]; ?></label><br>
                      <b>Note:</b> <?php echo $v['notes']; ?><br>
                    </div>
                    <!-- <div class="timeline-footer">
                      <a class="btn btn-primary btn-xs">Read more</a>
                      <a class="btn btn-danger btn-xs">Delete</a>
                    </div> -->
                  </div>
                </li>
                <?php endforeach; ?>
                <!-- /.post -->
                 <i class="fa fa-clock-o bg-gray"></i>
                </li>
              </ul>

               
              </div>
              <?php endif; ?>
              
              
              <div class="<?php if(!isset($_POST['btn_d_filter'])){ if(!isset($_POST['bnt_ft'])){ echo "active"; } } ?> tab-pane" id="settings">
                <form class="form-horizontal"  name="" method="post" action="">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Employee ID</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Employee ID"  name="employee_number" value='<?php echo $emps['employee_number']; ?>'>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">First Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="First Name"  name="fname" value='<?php echo $emps['fname']; ?>'>
                    </div>
                  </div>
                  <?php if($_SESSION['acl']['employee-update']==1): ?>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Middle Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Middle Name"  name="mname" value='<?php echo $emps['mname']; ?>'>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Last Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Last Name"  name="lname" value='<?php echo $emps['lname']; ?>'>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Mobile Number</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail" placeholder="mobilenumber"  name="mobilenumber" value='<?php echo $emps['mobilenumber']; ?>'>
                    </div>
                  </div>
                  <?php endif; ?>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Skype ID</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail" placeholder="Skype ID"  name="skypeid" value='<?php echo $emps['skypeid']; ?>'>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email"  name="email" value='<?php echo $emps['email']; ?>'>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Address Line 1</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Address" name="address"  value="<?php echo $emps['address']; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">City/Town</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="City/Town" name="citytown"  value='<?php echo $emps['citytown']; ?>'>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Province</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Province" name="province"  value='<?php echo $emps['province']; ?>'>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Country</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Country" name="country"  value='<?php echo $emps['country']; ?>'>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Zip</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Zip" name="zip"  value='<?php echo $emps['zip']; ?>'>
                    </div>
                  </div>
                  <?php if($_SESSION['acl']['employee-update']==1): ?>
                  <div class="form-group">
                        <label for="inputSkills" class="col-sm-2 control-label">Birth Date</label>
                        <div class="col-sm-10">
                            <div class="input-group date col-sm-12">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right" name="birthdate" id="datepicker3" <?php if(isset($_GET['id'])){ echo "value='".date("m/d/Y",strtotime($rvalue['birthdate']))."'"; } ?> required>
                            </div>
                        </div>
                  </div>
                  <?php endif; ?>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Contact In Case Of Emergency</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Contact In Case Of Emergency" name="emergency_contact"  value='<?php echo $emps['emergency_contact']; ?>'>
                    </div>
                  </div>   
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Emergency Contact #</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Emergency Contact #" name="emergency_mobile"  value='<?php echo $emps['emergency_mobile']; ?>'>
                    </div>
                  </div>   
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Saying</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Saying" name="saying" ><?php echo $emps['saying']; ?></textarea>
                    </div>
                  </div>
                  
                 <?php if($_SESSION['acl']['employee-update']==1): ?>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger" name="updateme">Submit</button>
                    </div>
                  </div>
                  <?php endif; ?>
                </form>
              </div>
              <!-- /.tab-pane -->
              
              
              <div class="tab-pane" id="salary">
              <div class="row">
              <div class="col-md-12">
                  
                  <div style="padding:7px; text-align: right;" class="pull-right">
                            <?php if($_SESSION['acl']['salary']==1): ?>
                            <a href="?page=salary-changes&eid=<?php echo $_GET['id']; ?>" type="submit" class="btn btn-success btn-xs">Create Salary</a>
                            <?php endif; ?>

                        </div>
                  
                  <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th></th>
                                <th style="">Date(s)</th>
                                <th style="">Monthly</th>
                                <th style="">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $ds =  array("model"=>"salary", "condition"=>" WHERE employee_id = '".$_GET['id']."' ", "order"=>" ORDER BY datefrom DESC");
                            $salary = $app->getRecord2($ds);
                            $salary=$salary['data'];
                            $c=0; foreach ($salary as $key => $value): $c++;
                                $mto=$value['dateto'];
                                if($mto=="0000-00-00"){ $mto = "Present"; }
                                else{ $mto=date("M jS, Y", strtotime($mto));}
                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo date("M jS, Y", strtotime($value['datefrom']))." to ".$mto; ?></td>
                                    <td><?php echo $value['monthly']; ?></td>
                                    <td>
                                    <?php if($_SESSION['acl']['salary']==1): ?>
                                    <a href="?page=salary-changes&eid=<?php echo $_GET['id']; ?>&id=<?php echo $value['id']; ?>" type="submit" class="btn btn-warning btn-xs">Update Salary</a>
                                    <?php endif; ?>    
                                    </td>
                         
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th style="">Date(s)</th>
                                <th style="">Monthly</th>
                                <th style="">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
              </div>
              </div>
              </div>
              
              
              <!-- acl start -->
              <div class="tab-pane" id="acl">
              <div class="row">
              <div class="col-md-12">  
                <form class="form-horizontal"  name="" method="post" action="">
                <?php
                $acltitle = $app->aclLists();
                $acl = $app->getMyACL($_GET['id']);
                foreach ($acl as $key => $value):
                if (array_key_exists($value['feature_code'],$acltitle)):
                ?>

                  <div class="form-group col-sm-6">
                    <label for="inputName" class="col-sm-8 control-label"><?php echo $acltitle[$value['feature_code']]; ?></label>
                    <input type="hidden" name="actcode[]" value="<?php echo trim($value['feature_code']); ?>">
                    <div class="col-sm-4"> 
                      <select name="aclvalue[]" class="form-control input-sm">
                          <option value="0" <?php if($value['fcontrol']==0){ echo "selected"; } ?>>No</option>
                          <option value="1" <?php if($value['fcontrol']==1){ echo "selected"; } ?>>Yes</option>
                      </select>
                    </div>
                  </div>

                 <?php endif; endforeach; ?>  
                 
                  <div class="form-group  col-sm-6">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger" name="updateAcl">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              </div>
              </div>
              <!-- acl end -->
              
              <div class="tab-pane" id="photo">
                <form class="form-horizontal"  name="" method="post" action=""  enctype="multipart/form-data">
                  <div class="row">
                  <div class="col-sm-5">
                                <div class="form-group"  style="margin-bottom: 0px;">
                                <label>Status</label>
                                <select class="form-control select2 select2-hidden-accessible" id="status" name="status" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                  <option value="0" <?php if(isset($_GET['id'])){ if($rvalue['status']==0){ echo "selected"; } }else{ echo "selected"; } ?>>Inactive</option>
                                  <option value="1" <?php if(isset($_GET['id'])){ if($rvalue['status']==1){ echo "selected"; } } ?>>Active/Employed</option>
                                 
                                </select>
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Position</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Position" name="position" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['position']."'"; } ?> required />
                                </div>
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Date Hired</label>
                                    

                                    <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right" name="date_hired" id="datepicker" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['date_hired']."'"; } ?> required>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Date Regularized</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right" name="date_regularized" id="datepicker2" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['date_regularized']."'"; } ?>>
                                    </div>
                                </div>
                                <div class="form-group"  style="margin-bottom: 0px;">
                                  <label>Shift Start:</label>

                                  <div class="input-group">

                                    <input type="text" class="form-control timepicker" name="shift_start" <?php if(isset($_GET['id'])){ echo "value='".date("g:i a", strtotime($rvalue['shift_start']))."'"; } ?> required>

                                    <div class="input-group-addon">
                                      <i class="fa fa-clock-o"></i>
                                    </div>
                                  </div>
                                  <!-- /.input group -->
                                </div>
                                <div class="form-group"  style="margin-bottom: 0px;">
                                  <label>Shift End:</label>

                                  <div class="input-group">
                                    <input type="text" class="form-control timepicker" name="shift_end" <?php if(isset($_GET['id'])){ echo "value='".date("g:i a", strtotime($rvalue['shift_end']))."'"; } ?> required>

                                    <div class="input-group-addon">
                                      <i class="fa fa-clock-o"></i>
                                    </div>
                                  </div>
                                  <!-- /.input group -->
                                </div>
                                
                                
                            </div>
                            <div class="col-sm-5" style="margin-left: 5px;  ">
                                <div class="form-group" style="margin-bottom: 0px;">
                                <label>Department</label>
                                    <select class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select a Department" name="department_id" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                        <?php
                                         foreach ($department as $key => $value) {
                                              $act="";
                                             if(isset($_GET['id']) && $rvalue['department_id']==$key){ $act="selected";}
                                             echo "<option value='".$key."' ".$act.">".$value['name']."</option>";
                                         }
                                        ?>
                                    </select>   
                                </div>      
                                <div class="form-group"  style="margin-bottom: 0px;">
                                <label>Employee Type</label>
                                <select class="form-control select2 select2-hidden-accessible" id="employee_type" name="employee_type" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                  <option value="0" <?php if(isset($_GET['id'])){ if($rvalue['employee_type']==0){ echo "selected"; } }else{ echo "selected"; } ?>>Full-time</option>
                                  <option value="1" <?php if(isset($_GET['id'])){ if($rvalue['employee_type']==1){ echo "selected"; } } ?>>Part time</option>
                                 
                                </select>
                              </div>

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Hrs/Week</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input id="hrs" type="text" class="form-control" placeholder="Hours/Month" name="hrs" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['hrs']."'"; } ?> required />
                                </div>
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Rate/Hr</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input  id="rate" type="text" class="form-control" placeholder="Hourly Rate" name="rate" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['rate']."'"; } ?> required />
                                </div>
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Rate/Month</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input  id="monthly" type="text" class="form-control" placeholder="Monthly Rate" name="monthly" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['monthly']."'"; } ?> required />
                                </div>
                            <?php if($_SESSION['acl']['employee-update']==1): ?>
                                 <div class="form-group" >
                                    <button style="margin-top: 25px;" type="submit" class="btn btn-danger btn-sm" name="updateEmployment">Submit</button>
                                </div>
                            <?php endif; ?>    

                                
                            </div>

                           
                  
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->


              <div class="tab-pane" id="security">
                <form class="form-horizontal"  name="" method="post" action=""  enctype="multipart/form-data">
                  <div class="row">
                  <div class="col-sm-5">
                      
                      <div class="form-group" style="margin-bottom: 0px; ">
                                <label>Username</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input id="un" type="text" class="form-control" placeholder="username" name="un" <?php if(isset($_GET['id'])){ echo "value='".$rvalue['un']."'"; } ?> required />
                                </div>
                                <div class="form-group" style="margin-bottom: 0px; margin-top: 5px;">
                                <label id="generate" class="btn btn-warning btn-xs">Generate Password</label>
                                </div>
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label> <?php if(isset($_GET['id'])){ echo "(Please leave blank to retain password)"; }else{ echo "Password"; } ?></label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input id="pw" type="text" class="form-control" placeholder="password" name="up" <?php if(isset($_GET['id'])){ echo "value=''"; }else{ echo "required"; } ?>  />
                                </div>  
                                <?php if($_SESSION['acl']['employee-update']==1): ?>
                                <div class="form-group" >
                                    <button style="margin-top: 25px;" type="submit" class="btn btn-danger btn-sm" name="updateSecurity">Update</button>
                                </div>        
                                <?php endif; ?>
                                
                   </div>             
                   </div>
                            
                </form>
              </div>
              
              
              
              
              
              <div class="tab-pane <?php if(isset($_POST['bnt_ft'])){ echo "active";  } ?>" id="timesheet">
                <form class="form-horizontal"  name="" method="post" action=""  enctype="multipart/form-data">
                  <div class="row">
                  <div class="col-sm-12">
                      <div class="row">
                           <?php //echo json_encode($emps); ?>
                           <form method="POST">
                          <div class="col-md-4">
                              <?php
                              $ndate = date("Y-m-d");
                              $edate = date("Y-m-d", strtotime($emps['date_hired']));//strtotime("2018-05-12"));//
                             // echo json_encode($_POST);
                              if(isset($_POST['bnt_ft'])){
                                  $pdate = explode("to", $_POST['ftd']);
                                  $fstart = date("Y-m-d H:i:s",strtotime(trim($pdate[0])));
                                  $fend =  date("Y-m-d H:i:s",strtotime(trim($pdate[1])));
                              }else{
                                  $thes = date("Y-m-d", strtotime($ndate." -1 day"));
                                  $fstart = date("Y-m-d H:i:s",strtotime($thes." ".$emps['shift_start']." - 2 hour"));
                                  $fend =  date("Y-m-d H:i:s",strtotime($ndate." ".$emps['shift_end']." + 6 hour"));
                              }
                              //echo $fstart. " ".$fend;
                              ?>
                              
                              <?php
                      
                        
                      
                      ?>
                              
                              <select class="form-control" name="ftd">
                              <?php 
                              
                              //$edate = date("Y-m-d",$emps['date_hired']);
                              //echo json_encode($emps);
                              while($ndate>$edate){
                                  $start = $ndate;
                                   
                                  $end = date("Y-m-d",strtotime($ndate." -1 day"));
                                  $rstart = date("Y-m-d H:i:s",strtotime($end." ".$emps['shift_start']." - 2 hour"));
                                  $rend =  date("Y-m-d H:i:s",strtotime($start." ".$emps['shift_end']." + 6 hour"));
                                  $sel = "";
                                  if($fstart==$rstart && $fend==$rend){$sel = "selected";}
                                  
                                  echo "<option value=\"".$rstart." to ".$rend."\" $sel>".date("d F, Y", strtotime($rstart))." to ".date("d F, Y",strtotime($rend))."</option>";
                                  $ndate = date("Y-m-d", strtotime($ndate." - 1 day"));
                              }
                              
                              ?>
                              </select>
                              
                              
                          </div>  
                          <div class="col-md-2">
                              <input type="submit" value="filter" class="btn btn-success btn-sm" name="bnt_ft">
                          </div>
                          </form>
                      </div>
                      
                      
                      
                      <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th></th>    
                                <th style="">Date</th>
                                <th style="">Time-in/Time-Out</th>
                                <th style="">Last Active Session</th>
                                <th style="">Estimated Session</th>
                                <th style="">Note</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            
                            function timeComputer($old,$add){
                                $old = explode(":", $old);
                                $add = explode(":", $add);
                                $newHour = $add[0]+$old[0];
                                $newMin = $add[1]+$old[1];
                                $newSec = $add[2]+$old[2];
                                while($newSec>=60){
                                    $newMin = $newMin + 1;
                                    $newSec = $newSec - 60;
                                }
                                while($newMin>=60){
                                    $newHour = $newHour + 1;
                                    $newMin = $newMin - 60;
                                }
                                if($newMin<10){ $newMin = "0".$newMin; }
                                if($newSec<10){ $newSec = "0".$newSec; }
                                if($newHour<10){ $newHour = "0".$newHour; }
                                return $newHour.":".$newMin.":".$newSec;
                            }
                            function getTimeDiff($dtime,$atime)
				{
				    $nextDay=$dtime>$atime?1:0;
				    $dep=explode(':',$dtime);
				    $arr=explode(':',$atime);
				
				
				    $diff=abs(mktime($dep[0],$dep[1],0,date('n'),date('j'),date('y'))-mktime($arr[0],$arr[1],0,date('n'),date('j')+$nextDay,date('y')));
				
				    //Hour
				
				    $hours=floor($diff/(60*60));
				
				    //Minute 
				
				    $mins=floor(($diff-($hours*60*60))/(60));
				
				    //Second
				
				    $secs=floor(($diff-(($hours*60*60)+($mins*60))));
				
				    if(strlen($hours)<2)
				    {
				        $hours="0".$hours;
				    }
				
				    if(strlen($mins)<2)
				    {
				        $mins="0".$mins;
				    }
				
				    if(strlen($secs)<2)
				    {
				        $secs="0".$secs;
				    }
				
				    return $hours.':'.$mins.':'.$secs;
				
				}
				        
                            // $ds =  array("model"=>"timesheet", "condition"=>" WHERE userId = '".$_GET['id']."' ", "order"=>" ORDER BY idno DESC");
                            // $tsheet = $app->getRecord2($ds);
                            
                            $tsheet = $app->getSheetById($_GET['id'], $fstart, $fend);
                            $tsheet=$tsheet['data'];
                            
                          //  echo json_encode($tsheet);
                            
                             $timesheets = array();
                             
                             $c=0; 
                                $realstartDay = 0;
                                /*
                                foreach($tsheet as $key => $value): $c++; $ff=0;
                                $timeinTest = date('H:i:s', strtotime($value['newtimein']." - 1 hour"));
                                
                                $timestart = date("H:i:s", strtotime($shift_start));
                                if($realstartDay==0){
                                    $realstartDate = date('Y-m-d', strtotime($value['newtimein']));
                                    $realstartDay = date('Y-m-d', strtotime($value['newtimein']));
                                    $realstartDate = date("Y-m-d H:i:s", strtotime($realstartDate." ".$timestart." -1 hour"));
                                    $realendDate = date("Y-m-d H:i:s", strtotime($realstartDate." + 11 hour"));
                                    $dti = date('Y-m-d', strtotime($realstartDate));
                                    //$dti = date('Y-m-d', strtotime($value['timeInDate']));
                                    // $datestart = date('Y-m-d H:i:s', strtotime($value['newtimein']));
                                    // $dateend = date("Y-m-d H:i:s", strtotime($dti." ".$timestart." + 11 hour"));
                                    $datestart = $realstartDate;//date('Y-m-d H:i:s', strtotime($value['newtimein']));
                                    $dateend = $realendDate;//date("Y-m-d H:i:s", strtotime($dti." ".$timestart." + 11 hour"));
                                }else{
                                    //$tmpChecker = date("Y-m-d", strtotime($realstartDay." +1 day"));
                                    
                                    $currentDay = date('Y-m-d', strtotime($value['newtimein']." +1 day"));
                                    echo json_encode($value)."<br>";
                                    echo $currentDay."==".$realstartDay."<br>========================================<br><br>";
                                    if($currentDay>$realstartDay){
                                    }else{
                                        $realstartDate = date('Y-m-d', strtotime($value['newtimein']));
                                        $realstartDay = date('Y-m-d', strtotime($value['newtimein']));
                                        $realstartDate = date("Y-m-d H:i:s", strtotime($realstartDate." ".$timestart." -1 hour"));
                                        $realendDate = date("Y-m-d H:i:s", strtotime($realstartDate." + 11 hour"));
                                        $dti = date('Y-m-d', strtotime($realstartDate));
                                        
                                    }
                                }
                                
                                if($timeinTest<=$timestart){
                                    $realstartDate = date('Y-m-d', strtotime($value['newtimein']));
                                    //$realendDate = date('Y-m-d', strtotime($value['newtimein']." + 1 day"));
                                    $realstartDate = date("Y-m-d H:i:s", strtotime($realstartDate." ".$timestart." -1 hour"));
                                    $realendDate = date("Y-m-d H:i:s", strtotime($realstartDate." + 11 hour"));
                                    $dti = date('Y-m-d', strtotime($realstartDate));
                                    //$dti = date('Y-m-d', strtotime($value['timeInDate']));
                                    // $datestart = date('Y-m-d H:i:s', strtotime($value['newtimein']));
                                    // $dateend = date("Y-m-d H:i:s", strtotime($dti." ".$timestart." + 11 hour"));
                                    $datestart = $realstartDate;//date('Y-m-d H:i:s', strtotime($value['newtimein']));
                                    $dateend = $realendDate;//date("Y-m-d H:i:s", strtotime($dti." ".$timestart." + 11 hour"));
                                }
                                else{
                                    $timeinTest2 = date('Y-m-d H:i:s', strtotime($value['newtimein']." - 9 hour"));
                                    if($timeinTest2<=$realstartDate){
                                        
                                    }
                                    $dti = date('Y-m-d', strtotime($value['timeInDate']));
                                }
                                
                                //$datestart = date("Y-m-d H:i:s", strtotime($dti." ".$timestart." - 1 hour"));
                                //$dateend = date("Y-m-d H:i:s", strtotime($dti." ".$timestart." + 11 hour"));
                                $index = $datestart." to ".$dateend;
                                // if(!array_key_exists($value['timeInDate'],$timesheets)){
                                //      $timesheets[$value['timeInDate']]=array("estimated"=>"00:00:00","included"=>array());
                                // }
                                
                                 if(!array_key_exists($index,$timesheets)){
                                     $timesheets[$index]=array("estimated"=>"00:00:00","included"=>array());
                                }
                               
                                
                                //echo $datestart." to ".$dateend."<br>";
                                    
                                if($value['newtimein']!="0000-00-00 00:00:00"){
                                    
                                    if($value['newtimeout']=="0000-00-00 00:00:00"){
                                            $timein = date('Y-m-d H:i:s', strtotime($value['newtimein']));
                                            $lastin = date('Y-m-d H:i:s', strtotime($value['newlastmin']));
                                            $start_date = new DateTime($timein);
                                            $since_start = $start_date->diff(new DateTime($lastin));
                                            
                                            
                                            
                                    }else{
                                            $timein = date('Y-m-d H:i:s', strtotime($value['newtimein']));
                                            $lastin = date('Y-m-d H:i:s', strtotime($value['newtimeout']));
                                            $start_date = new DateTime($timein);
                                            $since_start = $start_date->diff(new DateTime($lastin));
                                    }
                                }else{
                                    if($value['timeOut']=="00:00:00"){
                                            
                                            $timein = date('Y-m-d H:i:s', strtotime($value['timeIn']));
                                            $lastin = date('Y-m-d H:i:s', strtotime($value['lastMinIn']));
                                            if($timein>$lastin){
                                                $ff=1;
                                                $t1 = date('H:i:s', strtotime($timein));
                                                $t2 = date('H:i:s', strtotime("24:00:00"));
                                                $t3 = date('H:i:s', strtotime($lastin));
                                           	$new =  getTimeDiff($t1,$t2);
                                           	$newTime = timeComputer($new,$t3);
                                            }else{
                                            	$start_date = new DateTime($timein);
                                            	$since_start = $start_date->diff(new DateTime($lastin));
                                            }
                                            
                                    }else{
                                            $timein = date('Y-m-d H:i:s', strtotime($value['timeIn']));
                                            $lastin = date('Y-m-d H:i:s', strtotime($value['timeOut']));
                                            if($timein>$lastin){
                                                $ff=1;
                                                $t1 = date('H:i:s', strtotime($timein));
                                                $t2 = date('H:i:s', strtotime("24:00:00"));
                                                $t3 = date('H:i:s', strtotime($lastin));
                                           	$new =  getTimeDiff($t1,$t2);
                                           	$newTime = timeComputer($new,$t3);
                                            }else{
	                                        $start_date = new DateTime($timein);
	                                        $since_start = $start_date->diff(new DateTime($lastin));
                                            }
                                    }
                                }
                                if($ff==1){$time2=$newTime; }else{ $time2 = $since_start->h.":".$since_start->i.":".$since_start->s; }   
                                $time1 = $timesheets[$index]['estimated'];
                                $time1 = timeComputer($time1,$time2);
                                $timesheets[$index]['estimated'] =$time1;
                                $timesheets[$index]['included'][] = $value;
                                
                                ?>
                              
                            <?php endforeach; */ ?>
                            <?php
                            //echo json_encode($timesheets); exit();
                            $c=0;
                            $time1 = "00:00:00";
                            foreach($tsheet as $ttk => $ttv){$c++;
                                /*
                                 $ddd = explode("to",$ttk);
                                echo '<tr><td colspan="6" style="text-align: center; font-weight: bold;">'.date("M d, Y H:i:s", strtotime(trim($ddd[0])))." to ".date("M d, Y H:i:s", strtotime(trim($ddd[1]))).' ('.$ttv['estimated'].') </td></tr>';
                                $c=0;
                                foreach($ttv['included']  as $key => $value){ $c++; $ff=0;
                                if($value['newtimein']!="0000-00-00 00:00:00"){
                                    if($value['newtimeout']=="0000-00-00 00:00:00"){
                                            $timein = date('Y-m-d H:i:s', strtotime($value['newtimein']));
                                            $lastin = date('Y-m-d H:i:s', strtotime($value['newlastmin']));
                                            $start_date = new DateTime($timein);
                                            $since_start = $start_date->diff(new DateTime($lastin));
                                    }else{
                                            $timein = date('Y-m-d H:i:s', strtotime($value['newtimein']));
                                            $lastin = date('Y-m-d H:i:s', strtotime($value['newtimeout']));
                                            $start_date = new DateTime($timein);
                                            $since_start = $start_date->diff(new DateTime($lastin));
                                    }
                                }else{
                                   if($value['timeOut']=="00:00:00"){
                                            
                                            $timein = date('Y-m-d H:i:s', strtotime($value['timeIn']));
                                            $lastin = date('Y-m-d H:i:s', strtotime($value['lastMinIn']));
                                            if($timein>$lastin){
                                                $ff=1;
                                                $t1 = date('H:i:s', strtotime($timein));
                                                $t2 = date('H:i:s', strtotime("24:00:00"));
                                                $t3 = date('H:i:s', strtotime($lastin));
                                           	$new =  getTimeDiff($t1,$t2);
                                           	$newTime = timeComputer($new,$t3);
                                            }else{
                                            	$start_date = new DateTime($timein);
                                            	$since_start = $start_date->diff(new DateTime($lastin));
                                            }
                                            
                                    }else{
                                            $timein = date('Y-m-d H:i:s', strtotime($value['timeIn']));
                                            $lastin = date('Y-m-d H:i:s', strtotime($value['timeOut']));
                                            if($timein>$lastin){
                                                $ff=1;
                                                $t1 = date('H:i:s', strtotime($timein));
                                                $t2 = date('H:i:s', strtotime("24:00:00"));
                                                $t3 = date('H:i:s', strtotime($lastin));
                                           	$new =  getTimeDiff($t1,$t2);
                                           	//echo $new."".$t1."".$t1;
                                           	$newTime = timeComputer($new,$t3);
                                            }else{
	                                        $start_date = new DateTime($timein);
	                                        $since_start = $start_date->diff(new DateTime($lastin));
                                            }
                                    }
                                }
                                if($ff==1){$time2=$newTime; }else{ 
                                
                                $hr = (int) $since_start->h;
                                if($hr<10){ $hr="0".$hr; }  
                                $mn=  (int) $since_start->i;
                                if($mn<10){ $mn="0".$mn; }  
                                $sc=  (int) $since_start->s;
                                if($sc<10){ $sc="0".$hr; }  
                                    
                                $time2 = $hr.":".$mn.":".$sc;
                                }
                                
                                
                                if($value['newtimein']!="0000-00-00 00:00:00"){
                                    $inandout = $value['newtimein']."/".$value['newtimeout'];
                                    $lmin=$value['newlastmin'];
                                }else{
                                    $inandout = $value['timeIn']."/".$value['timeOut'];
                                    $lmin=$value['lastMinIn'];
                                }
                                
                                */
                                 $in = 0;
                                 if($ttv['newtimein']!="0000-00-00 00:00:00"){
                                    if($ttv['newtimeout']=="0000-00-00 00:00:00"){
                                            $lastin = date('Y-m-d H:i:s', strtotime($ttv['newlastmin']));
                                            if($lastin<=$fend){
                                               $in= 1; 
                                            }
                                           
                                    }else{
                                            $lastin = date('Y-m-d H:i:s', strtotime($ttv['newtimeout']));
                                             if($lastin<=$fend){
                                               $in= 1; 
                                            }
                                    }
                                }
                                
                                
                                if($in==1):
                                
                                
                                if($ttv['newtimein']!="0000-00-00 00:00:00"){
                                    $inandout = $ttv['newtimein']." / ".$ttv['newtimeout'];
                                    $lmin = $ttv['newlastmin'];
                                    if($ttv['newtimeout']=="0000-00-00 00:00:00"){
                                            $timein = date('Y-m-d H:i:s', strtotime($ttv['newtimein']));
                                            $lastin = date('Y-m-d H:i:s', strtotime($ttv['newlastmin']));
                                            $start_date = new DateTime($timein);
                                            $since_start = $start_date->diff(new DateTime($lastin));
                                    }else{
                                            $timein = date('Y-m-d H:i:s', strtotime($ttv['newtimein']));
                                            $lastin = date('Y-m-d H:i:s', strtotime($ttv['newtimeout']));
                                            $start_date = new DateTime($timein);
                                            $since_start = $start_date->diff(new DateTime($lastin));
                                    }
                                }else{
                                    $inandout = $ttv['timeIn']." / ".$ttv['timeOut'];
                                    $lmin = $ttv['lastMinIn'];
                                            $timein = date('Y-m-d H:i:s', strtotime($ttv['timeIn']));
                                            $lastin = date('Y-m-d H:i:s', strtotime($ttv['timeOut']));
                                            if($timein>$lastin){
                                                $ff=1;
                                                $t1 = date('H:i:s', strtotime($timein));
                                                $t2 = date('H:i:s', strtotime("24:00:00"));
                                                $t3 = date('H:i:s', strtotime($lastin));
                                           	$new =  getTimeDiff($t1,$t2);
                                           	//echo $new."".$t1."".$t1;
                                           	$newTime = timeComputer($new,$t3);
                                            }else{
	                                        $start_date = new DateTime($timein);
	                                        $since_start = $start_date->diff(new DateTime($lastin));
                                    }
                                }
                                
                                $hr = (int) $since_start->h;
                                if($hr<10){ $hr="0".$hr; }  
                                $mn=  (int) $since_start->i;
                                if($mn<10){ $mn="0".$mn; }  
                                $sc=  (int) $since_start->s;
                                if($sc<10){ $sc="0".$hr; }  
                                    
                                $time2 = $hr.":".$mn.":".$sc;
                                
                                $time1 = timeComputer($time1,$time2);
                                
                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo date("M d, Y", strtotime(trim($ttv['timeInDate']))); ?></td>
                                    <td><?php echo $inandout; ?></td>
                                    <td><?php echo $lmin; ?></td>
                                    <td><?php echo $time2; ?></td>
                                    <td><?php echo $ttv['Note']; ?></td>
                         
                                </tr>
                                    
                                <?php endif; }
                           // }
                            /*
                            $c=0; foreach ($tsheet as $key => $value): $c++;
                            
                            //echo json_encode($value)."<==<br>";
                                //$a = new DateTime(date("h:i:s", strtotime(trim($value['timeIn']))));
                                //$b = new DateTime(date("h:i:s", strtotime(trim($value['lastMinIn'])))); //new DateTime(trim($value['lastMinIn']));
                                
                                $interval = $app->getTimeDiff(trim($value['timeIn']), trim($value['lastMinIn'])); //$a->diff($b);
                                if($value['timeOut']=="00:00:00"){
                                  // $interval = $a->diff($b);
                                  $interval = $app->getTimeDiff(trim($value['timeIn']), trim($value['lastMinIn']));
                                }else{
                                    //$c = new DateTime(date("h:i:s", strtotime(trim($value['timeOut'])))); //new DateTime(trim($value['timeOut']));
                                   // $interval = $a->diff($c);
                                    $interval = $app->getTimeDiff(trim($value['timeIn']), trim($value['timeOut']));
                                }
                                //echo $value['timeInDate']."<<<<br>";
                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo date("M d, Y", strtotime(trim($value['timeInDate']))); ?></td>
                                    <td><?php echo $value['timeIn']."/".$value['timeOut']; ?></td>
                                    <td><?php echo $value['lastMinIn']; ?></td>
                                    <td><?php echo $interval; ?></td>
                                    <td><?php  ?></td>
                         
                                </tr>
                            <?php endforeach; */ ?>
                            <tr>
                              <td colspan="4" style="text-align: right;">Total:</td>
                              <td><?php echo $time1; ?></td>
                              <th style=""></th>
                            </tr>    
                            </tbody>
                            <tfoot>
                            <tr>
                               <th></th>    
                                 <th style="">Date</th>
                                <th style="">Time-in/Time-Out</th>
                                <th style="">Last Active Session</th>
                                <th style="">Estimated Session</th>
                                <th style="">Note</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>            
                   </div>
                   </div>         
                </form>
              </div>
              
              
              
              
              <style>
                @media (min-width: 768px){
                    .modal-dialog {
                        width: 1000px;
                        margin: 30px auto;
                    }
                }    
              </style>
              
              <div class="tab-pane <?php if(isset($_POST['btn_d_filter'])){ echo "active";  } ?>" id="printscreen" >
                <form class="form-horizontal"  name="" method="post" action=""  enctype="multipart/form-data">
                  <div class="row">
                  <div class="col-sm-12">
                      
                      <div class="box-body" style="max-height: 550px; overflow-y : scroll; ">
                        <form method="POST">
                        <div class="row" style="margin-left: 0px;
    margin-top: 0px;
    margin-bottom: 5px;">
                        <div class="col-sm-3">
                        <div class="form-group" style="margin-bottom: 0px; ">
                                    <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right" name="current_day" id="current_day" <?php if(isset($_GET['id'])){ echo "value='".date("m/d/Y",strtotime($current_day))."'"; } ?> >
                                    </div>
                        </div>
                        </div>
                        <div class="col-sm-3">
                               <input type="submit" name="btn_d_filter" class="btn btn-sm btn-success" value="Filter"> 
                            </div>
                            
                        </div></form>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th></th>    
                                <th>Print Screen</th>
                                <th style="">Date</th>
                                <th style="">Time</th>
                                <th style="">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $d1 = date("Y-m-d H:i:s", strtotime($current_day." 00:00:01"));
                            $d2 = date("Y-m-d H:i:s", strtotime($current_day." 23:59:59"));
                            //echo $d1." ".$d2;
                            $ds =  array("model"=>"printscreen", "condition"=>" WHERE userId = '".$_GET['id']."' AND (date = '$current_day' OR (newshotdate >= '$d1' AND newshotdate<='$d2'))", "order"=>" ORDER BY id DESC");
                            $pscreen = $app->getRecord2($ds);
                            $pscreen=$pscreen['data'];
                            $c=0; foreach ($pscreen as $key => $value): $c++;
                                $modalId = "myModal_".$c;
                                
                                $image = imagecreatefromstring($value['photo']); 

                                    ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
                                    imagejpeg($image, null, 80);
                                    $data = ob_get_contents();
                                    ob_end_clean();
                                ?>
                                
                                <div class="modal fade" id="<?php echo $modalId; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <form name="" action="" method="POST">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        
                                        <h4 class="modal-title" id="myModalLabel">
                                        <?php 
                                        if($value['date']=="0000-00-00 00:00:00"){
                                            $time_p=$value['time']; 
                                            $date_p = date("M jS, Y", strtotime($value['date']));
                                            echo date("M jS, Y", strtotime($value['date']))." - ".$time_p; 
                                        }else{
                                            $time_p = date("H:i:s", strtotime($value['newshotdate']));
                                            $date_p = date("M jS, Y", strtotime($d1));
                                            echo date("M jS, Y", strtotime($d1))." - ".$time_p; 
                                        }
                                        
                                        
                                        
                                        ?>    
                                        </h4>
                                      </div>
                                      <div class="modal-body" id="mbody" style="text-align:center;">
                                        <?php echo '<img src="data:image/jpg;base64,' .  base64_encode($data)  . '" style="width: 900px;"/>'; ?>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                    </form>
                                  </div>
                                </div>
                                
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php 
                                    
                                    
                                    echo '<a style ="cursor: pointer;" data-toggle="modal" data-target="#'.$modalId.'" ><img src="data:image/jpg;base64,' .  base64_encode($data)  . '" style="widtyh: 300px; height: 100px;"/></a>';
                                        
                                    //echo $value['photo']; 
                                    
                                    
                                    
                                    ?></td>
                                    <td><?php echo $date_p; ?></td>
                                    <td><?php echo $time_p; ?></td>
                                    <td>
                                     
                                    </td>
                         
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                               <th></th>    
                                <th>Print Screen</th>
                                <th style="">Date</th>
                                <th style="">Time</th>
                                <th style="">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>            
                   </div>
                  </div>          
                </form>
              </div>
              
              
              
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
        
    </div>
    <!-- /.row -->

    

</section>
<!-- /.content -->

<script>


// $("#current_day").keydown(function (e) {
//   if (e.keyCode == 13) {
//       alert(1);
//     location.href = "?page=employee-view&id=<?php echo $_GET['id'] ?>&prdate="+$(this).val();
//   }
// });

function calculate(param){
    var hrs = $("#hrs").val();
    var rate = $("#rate").val();
    var monthly = $("#monthly").val();
    var employee_type = $('#employee_type').val();
    if(employee_type==0){
        $('#rate').attr('readonly', 'true');
        //$('#rate').val(0);
        $('#monthly').removeAttr('readonly');
        if(hrs=="" || hrs==0){
            
            alert("Please enter number of hours first!");
            $("#hrs").focus();
        }else{
            rate = monthly / hrs;
            $("#rate").val(rate);
        }
    }else{
        $('#monthly').attr('readonly', 'true');
        //$('#monthly').val(0);
        $('#rate').removeAttr('readonly');
        if(hrs=="" || hrs==0){
            alert("Please enter number of hours first!");
            $("#hrs").focus();
        }else{
            monthly = rate * hrs;
            $("#monthly").val(monthly);
        }
    }
    
}

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

$("#generate").click(function(){
    var ps = makeRandom();
    //alert(ps);
    $("#pw").val(ps);
});

</script>