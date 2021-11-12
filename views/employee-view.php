<style>
       
        .avatar-upload {
        position: relative;
        max-width: 205px;
        margin: 5px auto;
        }
        .avatar-upload .avatar-edit {
            position: absolute;
            right: 12px;
            z-index: 1;
            top: 10px;
        }
        .avatar-upload .avatar-edit input {
            display: none;
        }
        .avatar-upload .avatar-edit input + label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #FFFFFF;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
        }
        .avatar-upload .avatar-edit input + label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }
        .avatar-upload .avatar-edit input + label:after {
            content: "\f040";
            font-family: 'FontAwesome';
            color: #000;
            position: absolute;
            top: 7px;
            left: 0;
            right: 0;
            text-align: center;
            margin: auto;
        }
        .avatar-upload .avatar-preview {
            width: 100px;
            height: 100px;
            position: relative;
            border-radius: 100%;
            border: 6px solid #F8F8F8;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }
        .avatar-upload .avatar-preview > div {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
    

   </style>
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


if(isset($_POST['btn_saveacl'])){
    //feature_code
    //fcontrol
    $feature_code = $_POST['feature_code'];
    $fcontrol = $_POST['fcontrol'];
    foreach($feature_code as $k => $v){
        $data = array("model"=>"acl",
                      "values"=>"fcontrol='".$fcontrol[$k]."'",
                      "condition"=>" WHERE emp_id='".$_GET['id']."' AND feature_code='".$v."'");
        //echo json_encode($data)."<br>";
        $response = $app->update2($data);

    }
    //echo json_encode($_POST);
}


$errori = 0;
if(isset($_POST['photo_up'])){
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check === false) {
            $errori = "File is not an image.";;
        } 
    
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $errori =  "Sorry, your file is too large.";
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $errori = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
        $target_file = $target_dir. $app->RandomString(50).".".$imageFileType;
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
             $data['values']="image = '".$target_file."'";                
        $data['condition'] = " WHERE id = '".$_GET['id']."'";
        $response = $app->update2($data);
        } else {
            $errori = "Sorry, there was an error uploading your file.";
        }
    
}





$department = $app->getDepartments();
$patients = $app->getEmployees("WHERE id = '".$_GET['id']."'");
$patients = $patients[$_GET['id']];
$color = MYGREEN;

$myAcl = $app->getACL("WHERE emp_id = '".$_GET['id']."'");
//echo json_encode($myAcl);
$acl_titles = $app->aclLists();
$utp = $app->getUserTypes();
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
                 echo strtoupper($patients['lname'].", ".$patients['fname']." ".$patients['mname']);
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
            <div class="box-body box-profile" style="text-align: center;">
              <!--<img class="profile-user-img img-responsive img-circle" src="<?php echo $emps['image']; ?>" alt="User profile picture">-->
              <form action="" method="post" enctype="multipart/form-data">
                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input type='file'  name="fileToUpload" id="imageUpload" accept=".png, .jpg, .jpeg" />
                        <label for="imageUpload"></label>
                    </div>
                    <div class="" >
                        <!--<div id="imagePreview" style="background-image: url('<?php echo $emps['image']; ?>');">-->
                            
                        <!--</div>-->
                        <img class="profile-user-img img-responsive img-circle" src="<?php echo $patients['image']; ?>" alt="User profile picture">
                    </div>
                </div>
             
                <input type="submit" value="Change Photo" name="photo_up">
                
              </form>  
              <h3 class="profile-username text-center"><?php echo $patients['prename'].". ".$patients['fname']." ".$patients['fname']; ?></h3>

              <p class="text-muted text-center"><?php echo $patients['position']; ?></p>
              <p class="text-muted text-center" style="font-size: 12px; margin-top: -6px;"><?php echo $department[$patients['department_id']]['name']; ?></p>

              <ul class="list-group list-group-unbordered">
           
              </ul>
        
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
             <!--  <strong><i class="fa fa-book margin-r-5"></i> Saying</strong> -->

              <p class="text-muted">
                <?php //echo $emps['saying']; ?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted"><?php echo $patients['address']."<br>".$patients['mobilenumber']."<br>".$patients['email']; ?></p>

              <hr>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <?php if(isset($_GET['tab'])){ $tab=$_GET['tab']; }else{ $tab="pi"; } //echo $tab; ?>  
            <ul class="nav nav-tabs">
              
              <li class="<?php if($tab=="pi"){ echo "active"; } ?>"><a href="?page=<?php echo $_GET['page']; ?>&id=<?php echo $_GET['id']; ?>&tab=pi" >Personal Information</a></li>
              <?php if($_SESSION['acl']['access-controls']==1): ?>
              <li class="<?php if($tab=="pr"){ echo "active"; } ?>"><a href="?page=<?php echo $_GET['page']; ?>&id=<?php echo $_GET['id']; ?>&tab=pr" >Access Control</a></li>
          <?php endif; ?>
              </ul>

               
           </div>
              
              <?php if($tab=="pi"){ ?>
              <div class="<?php if($tab=="pi"){ echo "active"; } ?> tab-pane" id="">
                <form class="form-horizontal"  name="" method="post" action="">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Employee Number</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Employee Number"  name="employee_number" value='<?php echo $patients['employee_number']; ?>' readonly>
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Prefix</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="First Name"  name="fname" value='<?php echo $patients['prename']; ?>'>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">First Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="First Name"  name="fname" value='<?php echo $patients['fname']; ?>'>
                    </div>
                  </div>
                  <?php if($_SESSION['acl']['employee-update']==1): ?>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Middle Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Middle Name"  name="mname" value='<?php echo $patients['mname']; ?>'>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Last Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Last Name"  name="lname" value='<?php echo $patients['lname']; ?>'>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Position</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Position"  name="position" value='<?php echo $patients['position']; ?>'>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Department</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Position"  name="position" value='<?php echo $department[$patients['department_id']]['name']; ?>'>
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Birth Date</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Birth Date"  name="   birthdate" value='<?php echo $patients['birthdate']; ?>'>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Age</label>
                                    <?php
                                    $date = date('Y-m-d', time());
                                    $datehired = new DateTime($patients['birthdate']);
                                    $dateNow = new DateTime($date);
                                    $since = $app->diffInMonths($patients['birthdate'],$date);
                                    //echo $since. " Month(s)"; 
                                    
                                    $interval = $datehired->diff($dateNow);
                                    $years = $interval->format('%y');
                                    $months = $interval->format('%m');
                                    $days = $interval->format('%d');
                                    $age = "";
                                    if($years!=0){
                                        $age .= " $years Year(s)";
                                    }
                                    if($months!=0){
                                        if($years!=0){
                                            $age .=  ", $months Month(s)";
                                        }else{
                                            $age .=  " $months Month(s)";
                                        }
                                    }
                                    if($days!=0){
                                        if($years!=0 || $months!=0 ){
                                            $age .=  ", $days Day(s)";
                                        }else{
                                            $age .=  " $days Day(s)";
                                        }
                                    }
                                    ?>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Age"  name="age" value='<?php echo $age; ?>'>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Mobile Number</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail" placeholder="mobilenumber"  name="mobilenumber" value='<?php echo $patients['mobilenumber']; ?>'>
                    </div>
                  </div>
                  <?php endif; ?>
                
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email"  name="email" value='<?php echo $patients['email']; ?>'>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Address" name="address"  value="<?php echo $patients['address']; ?>">
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
                                      <input type="text" class="form-control pull-right" name="birthdate" id="datepicker3" <?php if(isset($_GET['id'])){ echo "value='".date("m/d/Y",strtotime($patients['birthdate']))."'"; } ?> required>
                            </div>
                        </div>
                  </div>
                  <?php endif; ?>

                   <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Type Of User</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Type Of User" name="usertype"  value="<?php echo $utp[$patients['usertype']]."(".$patients['usertype'].")"; ?>">
                    </div>
                  </div>

                  <?php if($patients['usertype']==3): ?>

                    <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Lab Category</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Lab Category" name="bloodtype"  value="<?php echo $patients['labcategory']; ?>">
                    </div>
                  </div>

                  <?php endif; ?>  

                  <?php if($patients['usertype']==2): ?>

                    <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Specialization</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Specialization" name="sp"  value="<?php echo $patients['sp']; ?>">
                    </div>
                  </div>

                   <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Professional Fee</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Professional Fee" name="pf"  value="<?php echo $patients['pf']; ?>">
                    </div>
                  </div>

                  <?php endif; ?> 
                  
                  
                 <?php if($_SESSION['acl']['employee-update']==1): ?>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger" name="updateme">Submit</button>
                    </div>
                  </div>
                  <?php endif; ?>
                </form>
              </div>

              <?php } ?>
              <!-- /.tab-pane -->



              <!---------------------------------------------------->
              <!----------------Prescription Start------------------>
              <!---------------------------------------------------->
              <?php if($tab=="pr"){ ?>
              
              <div class="<?php if($tab=="pr"){ echo "active"; } ?> tab-pane" id="">
              <div class="row">
              <div class="col-md-12">
                  
                  <div style="padding:7px; text-align: right;" class="pull-right">
                            
                        

                  </div>
                  <div class="box-body table-responsive"><div class="row"><form method="POST">
                  <?php
                  $includes = array();
                  foreach ($myAcl as $key => $value) {
                      $incn = $value['emp_id'].$value['feature_code'];
                      if(!in_array($incn, $includes)){
                        $includes[] = $incn;
                      }else{
                        $dldata = array("model"=>"acl", "condition"=>" WHERE id = '".$value['id']."'");
                        $d = $app->delete($dldata);
                      }
                      if(array_key_exists($value['feature_code'], $acl_titles)){
                      echo '<div class="col-md-6">';
                        //echo json_encode($value);
                        $sel1= "";
                        $sel2= "";
                        if($value['fcontrol']==1){ $sel1= "selected"; }
                        if($value['fcontrol']==0){ $sel2= "selected"; }
                        echo '<div class="form-group">';
                        echo '<label for="inputSkills" class="col-sm-12 control-label">'.$acl_titles[$value['feature_code']].'</label>';
                         echo '<input type="hidden" value="'.$value['feature_code'].'" name="feature_code[]">';
                        echo '<select name="fcontrol[]" class="form-control">';
                            echo '<option value="1" '.$sel1.'>Yes</option>';
                            echo '<option value="0" '.$sel2.'>No</option>';
                        echo '</select>';
                      echo '</div></div>';
                    }
                  }

                  ?>
                  <input type="submit" name="btn_saveacl" value="SAVE" class="btn-success btn-sm pull-right" style="margin-right: 10px;">
                  </form></div></div>
              </div>
              </div>
              </div>
              
              <?php } ?>
              <!---------------------------------------------------->
              <!----------------Prescription End-------------------->
              <!---------------------------------------------------->






              <!---------------------------------------------------->
              <!-----------------Vital Signs Start------------------>
              <!---------------------------------------------------->
              <?php if($tab=="vs"){ ?>
              
              <div class="<?php if($tab=="vs"){ echo "active"; } ?> tab-pane" id="">
              <div class="row">
              <div class="col-md-12">
                  
                  <div style="padding:7px; text-align: right;" class="pull-right">
                            
                            <button data-toggle="collapse" class="btn btn-xs btn-success" data-target="#demo">
                                + New Vital Signs
                            </button>
                        

                  </div>



                  <?php 

                    $response=array('action'=>"", 'message'=>"");
                    if(isset($_POST['btn_save'])){
                        
                       
                        $data = array('model'=>"medicines",'keys'=>"name, description, brands, diseases, symptoms");
                        //echo json_encode($_POST['manager']);
                        if(isset($_POST['id'])){
                            $data['values']="name = '".$_POST['name']."', 
                                             description = '".$_POST['description']."', 
                                             brands = '".json_encode($_POST['brands'])."',
                                             diseases = '".json_encode($_POST['diseases'])."',
                                             symptoms = '".json_encode($_POST['symptoms'])."'";
                            $data['condition'] = " WHERE id = '".$_POST['id']."'";
                            $response = $app->update2($data);

                        }else{
                            $date = date("Y")."-".date("m")."-".date("d");
                            
                            $data2 = array(
                                'model'=>'medicines',
                                'keys'=>'name, description, brands, diseases, symptoms',
                                'values'=>"'".$_POST['name']."', 
                                           '".$_POST['description']."', 
                                           '".json_encode($_POST['brands'])."',
                                           '".json_encode($_POST['diseases'])."',
                                           '".json_encode($_POST['symptoms'])."'"
                            );
                            $response = $app->create2($data2);
                            
                          
                        }

                    }
                  ?>



                <div id="demo" class="collapse box-body">
                    <?php if(isset($_GET['vid'])){

                        $rqdata = array("model"=>"vitalsigns", "condition"=>" WHERE id = '".$_GET['vid']."'");
                        $department = $app->getRecord2($rqdata);
                        $rvalue = $department['data'][0];

                    } ?>

                    <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <div class="form-group" style="margin-bottom: 0px; ">

                                    <?php if(isset($_GET['vid'])): ?>
                                        <input type="hidden" class="form-control" name="vid" value="<?php echo $_GET['vid']; ?>" required />
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                <label>Type</label>
                                    <select class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select Diseases" name="diseases[]" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                        <?php
                                         $vitalTypes = $app->getVitalTypes();
                                         foreach ($vitalTypes as $key => $value) { $act="";
                                             if(isset($_GET['vid']) && $_GET['vid']==$key){  $act="selected"; }
                                             echo "<option value='".$key."' ".$act.">".$value."</option>";
                                         }
                                        ?>
                                    </select>   
                                </div> 

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Value</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="name" name="name" <?php if(isset($_GET['vid'])){ echo "value='".$rvalue['value']."'"; } ?> required />
                                </div>



                            </div>
                            <div class="col-sm-2"></div>
                        </div>


                </div>    
                <br><br>  
                  
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
              
              <?php } ?>
              <!---------------------------------------------------->
              <!-----------------Vital Signs End-------------------->
              <!---------------------------------------------------->





              <!---------------------------------------------------->
              <!-------------------Start Disease-------------------->
              <!---------------------------------------------------->
              <?php if($tab=="ds"){ ?>
              
              <div class="<?php if($tab=="ds"){ echo "active"; } ?> tab-pane" id="">
              <div class="row">
              <div class="col-md-12">
                  
                  <div style="padding:7px; text-align: right;" class="pull-right">
                            
                            <button data-toggle="collapse" class="btn btn-xs btn-success" data-target="#demo">
                                + New Disease
                            </button>
                        

                  </div>



                <div id="demo" class="collapse box-body">
                Lorem ipsum dolor text....
                </div>    
                <br><br>  
                  
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
              
              <?php } ?>
              <!---------------------------------------------------->
              <!---------------------End Disease-------------------->
              <!---------------------------------------------------->




              <!---------------------------------------------------->
              <!-------------------Start Operation------------------>
              <!---------------------------------------------------->
              <?php if($tab=="op"){ ?>
              
              <div class="<?php if($tab=="op"){ echo "active"; } ?> tab-pane" id="">
              <div class="row">
              <div class="col-md-12">
                  
                  <div style="padding:7px; text-align: right;" class="pull-right">
                            
                            <button data-toggle="collapse" class="btn btn-xs btn-success" data-target="#demo">
                                + New Operation
                            </button>
                        

                  </div>



                <div id="demo" class="collapse box-body">
                Lorem ipsum dolor text....
                </div>    
                <br><br>  
                  
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
              
              <?php } ?>
              <!---------------------------------------------------->
              <!-------------------End Operation-------------------->
              <!---------------------------------------------------->
              
              
              
              
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



</script>