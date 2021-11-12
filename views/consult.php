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


    function deleteThisVital(id, name){
        if (confirm('Are you sure you want to delete '+name+'?')) {
             window.location.href = '?page=<?php echo $_GET['page']; ?>&id=<?php echo $_GET['id']; ?>&qn=<?php echo $_GET['qn']; ?>&tab=<?php echo $_GET['tab']; ?>&del='+id;
        }
    }




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

$dquedata = $app->getEnqueued("WHERE queuing_number = '".$_GET['qn']."'");
$realEnq = array();
foreach($dquedata as $k=>$v){ $realEnq=$v; }
echo json_encode($realEnq);

$updata = array("model"=>"queuing", "values"=>"status='".PAID."'", 
                "condition"=>" WHERE queuing_number = '".$_GET['qn']."' AND trans_type = 'Check-up'  AND dr_id = '".$_SESSION['login_id']."'");
$r=$app->update2($updata);


$response['message']="";
$data =array("model"=>"employee");

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
$patients = $app->getPatients("WHERE id = '".$_GET['id']."'");
$patients = $patients[$_GET['id']];
$color = MYGREEN;
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
                ?> (Patient's Details)
                <small class="pull-right" style="margin-top: -5px; font-weight: bold;"><h4>Date: <?php echo date("Y").", ".date("F")." ".date("d"); ?></h4></small>
            </h2><br>
            <div class="pull-right" style="margin-top: -15px;">
                            <a href="?page=consultation&done=<?php echo $_GET['qn']; ?>"><label class="btn btn-xs btn-info">Finished</label></a> 
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

              <p class="text-muted text-center"><?php echo $patients['occupation']; ?></p>
              <p class="text-muted text-center" style="font-size: 12px; margin-top: -6px;"><?php //echo $department[$patients['department_id']]['name']; ?></p>

              <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                 <!--  <b>Status:</b> <a class="pull-right" style="color: <?php echo $color; ?>"><?php echo $myStatus[$patients['status']]; ?></a> -->
              </li>
              <!--  <li class="list-group-item">-->
              <!--    <b>Following</b> <a class="pull-right">543</a>-->
              <!--  </li>-->
              <!--  <li class="list-group-item">-->
              <!--    <b>Friends</b> <a class="pull-right">13,287</a>-->
              <!--  </li>-->
              </ul>
            <!-- <form action="" method="post" enctype="multipart/form-data">-->
                
            <!--    <?php if($errori!=0){ echo $errori; } ?>-->
            <!--    <?php if($_SESSION['alladmin']==1 || ($_SESSION['etimezone']==$current_emp_timezone && $_SESSION['locadmin']=="Yes")){ ?>-->
            <!--    <div class="form-group">-->
            <!--        <label for="inputName" class="col-sm-12 control-label">Replace Photo:</label><br><br>-->
            <!--        <div class="col-sm-12">-->
            <!--          <input type="file" name="fileToUpload" id="fileToUpload"><br>-->
            <!--          <input type="submit" value="Upload Image" name="photo_up">-->
            <!--        </div>-->
            <!--      </div>-->
            <!--     <?php } ?> -->
            <!--</form>-->
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
                <?php //echo $emps['saying']; ?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted"><?php echo $patients['address']."<br>".$patients['phone']."<br>".$patients['email']; ?></p>

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
              
              <li class="<?php if($tab=="pi"){ echo "active"; } ?>"><a href="?page=<?php echo $_GET['page']; ?>&id=<?php echo $_GET['id']; ?>&qn=<?php echo $_GET['qn']; ?>&tab=pi" >Personal Information</a></li>

              <li class="<?php if($tab=="st"){ echo "active"; } ?>"><a href="?page=<?php echo $_GET['page']; ?>&id=<?php echo $_GET['id']; ?>&qn=<?php echo $_GET['qn']; ?>&tab=st" >Symptoms</a></li>

              <li class="<?php if($tab=="pr"){ echo "active"; } ?>"><a href="?page=<?php echo $_GET['page']; ?>&id=<?php echo $_GET['id']; ?>&qn=<?php echo $_GET['qn']; ?>&tab=pr" >Prescriptions</a></li>

              <li class="<?php if($tab=="vs"){ echo "active"; } ?>"><a href="?page=<?php echo $_GET['page']; ?>&id=<?php echo $_GET['id']; ?>&qn=<?php echo $_GET['qn']; ?>&tab=vs" data-toggle="">Vital Signs</a></li>

              <li class="<?php if($tab=="ds"){ echo "active"; } ?>"><a href="?page=<?php echo $_GET['page']; ?>&id=<?php echo $_GET['id']; ?>&qn=<?php echo $_GET['qn']; ?>&tab=ds" data-toggle="">Diseases</a></li>

              <li class="<?php if($tab=="op"){ echo "active"; } ?>"><a href="?page=<?php echo $_GET['page']; ?>&id=<?php echo $_GET['id']; ?>&qn=<?php echo $_GET['qn']; ?>&tab=op" data-toggle="">Operations</a></li>

              <li class="<?php if($tab=="lr"){ echo "active"; } ?>"><a href="?page=<?php echo $_GET['page']; ?>&id=<?php echo $_GET['id']; ?>&qn=<?php echo $_GET['qn']; ?>&tab=lr" data-toggle="">Lab Results</a></li>
            
              </ul>

               
           </div>
              
              <?php if($tab=="pi"){ ?>
              <div class="<?php if($tab=="pi"){ echo "active"; } ?> tab-pane" id="">
                <form class="form-horizontal"  name="" method="post" action="">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Patient ID</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Employee ID"  name="employee_number" value='<?php echo $patients['patient_number']; ?>' readonly>
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
                    <label for="inputName" class="col-sm-2 control-label">Gender</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Gender"  name="gender" value='<?php echo $patients['gender']; ?>'>
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
                                      <input type="text" class="form-control pull-right" name="birthdate" id="datepicker3" <?php if(isset($_GET['id'])){ echo "value='".date("m/d/Y",strtotime($patients['bdate']))."'"; } ?> required>
                            </div>
                        </div>
                  </div>
                  <?php endif; ?>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Age</label>
                                    <?php
                                    $date = date('Y-m-d', time());
                                    $datehired = new DateTime($patients['bdate']);
                                    $dateNow = new DateTime($date);
                                    $since = $app->diffInMonths($patients['bdate'],$date);
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
                      <input type="text" class="form-control" id="inputEmail" placeholder="mobilenumber"  name="mobilenumber" value='<?php echo $patients['phone']; ?>'>
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
                 
                 

                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Blood Type</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Blood Type" name="bloodtype"  value="<?php echo $patients['bloodtype']; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Citizenship</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Citizenship" name="citizen"  value="<?php echo $patients['citizenship']; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Occupation</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Occupation" name="occupation"  value="<?php echo $patients['occupation']; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Company</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Company" name="company"  value="<?php echo $patients['position']; ?>">
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

              <?php } ?>
              <!-- /.tab-pane -->






              <!---------------------------------------------------->
              <!--------------------Symptoms Start------------------>
              <!---------------------------------------------------->
              <?php if($tab=="st"){ ?>
              
              <div class="<?php if($tab=="st"){ echo "active"; } ?> tab-pane" id="">
              <div class="row">
              <div class="col-md-12">
                  
                  <div style="padding:7px; text-align: right;" class="pull-right">
                            
                            <button data-toggle="collapse" class="btn btn-xs btn-success" data-target="#demo">
                                + New Symptoms
                            </button>
                        

                  </div>



                  <?php 

                    $response=array('action'=>"", 'message'=>"");
                    if(isset($_POST['btn_save'])){
                        
                       
                        $data = array('model'=>"patient_symptoms",'keys'=>"patient_id, queuing_number, symptom_id, datetime, days");
                        //echo json_encode($_POST['manager']);
                        if(isset($_POST['id'])){
                            $data['values']="patient_id = '".$_GET['id']."', 
                                             queuing_number = '".$_GET['qn']."',
                                             symptom_id = '".$_POST['symptom_id']."',
                                             datetime = '".date("Y-m-d H:i:s")."', '".$_POST['days']."'";
                            $data['condition'] = " WHERE id = '".$_POST['id']."'";
                            $response = $app->update2($data);

                        }else{
                            $date = date("Y")."-".date("m")."-".date("d");
                            
                            $data2 = array(
                                'model'=>'patient_symptoms',
                                'keys'=>'patient_id, queuing_number, symptom_id, datetime, days',
                                'values'=>"'".$_GET['id']."', 
                                           '".$_GET['qn']."', 
                                           '".$_POST['symptom_id']."',
                                           '".date("Y-m-d H:i:s")."',
                                           '".$_POST['days']."'"
                            );
                            $response = $app->create2($data2);
                            
                          
                        }

                    }
                  if($response['message']=="Successful"){

                    echo '<br><br><div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        Record Saved Successfully!
                      </div>';
                    }
                    if(isset($_GET['del'])){
                      $deldata = array("model"=>"patient_symptoms", 'condition'=>" WHERE id = '".$_GET['del']."'");
                      $response = $app->delete2($deldata);
                       echo '<br><br><div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        Record Deleted Successfully!
                      </div>';

                    }

                  ?>



                <div id="demo" class="collapse box-body">
             

                    <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <form method="POST" action="?page=<?php echo $_GET['page']; ?>&qn=<?php echo $_GET['qn']; ?>&tab=<?php echo $_GET['tab']; ?>&id=<?php echo $_GET['id']; ?>">
                                <div class="form-group" style="margin-bottom: 0px; ">

                                    <?php if(isset($_GET['vid'])): ?>
                                        <input type="hidden" class="form-control" name="vid" value="<?php echo $_GET['vid']; ?>" required />
                                    <?php endif; ?>
                                </div><br><br>


                                 <div class="form-group">
                                   <?php $symptoms = $app->getSymptoms(); ?>
                                    <label>Symptom</label>
                                    <select class="form-control select2 select2-hidden-accessible" id="symptom_id" name="symptom_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                      <?php foreach($symptoms as $k=> $v){
                                        echo '<option value="'.$k.'" >'.$v['name'].'</option>';
                                      } ?>
                                     
                                    </select>
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Days</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Days" name="days" required />
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; margin-top: 10px;">
                                   <input type="submit" name="btn_save" class="btn btn-success btn-sm">
                                </div>
                                </form>


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
                                <th style="">Symptom</th>
                                <th style="">Days</th>
                                <th style="">Date</th>
                                <th style="">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $mySymptoms = $app->getPatientSymptoms("WHERE patient_id = '".$_GET['id']."' AND queuing_number='".$_GET['qn']."'");
                            //echo json_encode($mySymptoms)."<============";
                            $c=0; foreach ($mySymptoms as $key => $value): $c++;
                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo $symptoms[$value['symptom_id']]['name']; ?></td>
                                    <td><?php echo $value['days']; ?></td>
                                    <td><?php echo date("M jS, Y", strtotime($value['datetime'])); ?></td>
                                    <td>
                                    <?php if($_SESSION['acl']['symptoms-delete']==1): 

                                      $over = $value['days']." day(s)";
                                      ?>
                                   

                                     <label  class="btn btn-danger btn-xs" onClick="deleteThisVital('<?php echo $value['id']; ?>','<?php echo $symptoms[$value['symptom_id']]['name']." (".$over.")"; ?>')"><i class="fa fa-minus"></i> Delete</label>


                                    <?php endif; ?>    

                                    </td>
                         
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th style="">Symptom</th>
                                <th style="">Days</th>
                                <th style="">Date</th>
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
              <!--------------------Symptoms End-------------------->
              <!---------------------------------------------------->






              <!---------------------------------------------------->
              <!----------------Prescription Start------------------>
              <!---------------------------------------------------->
              <?php if($tab=="pr"){ ?>
              
              <div class="<?php if($tab=="pr"){ echo "active"; } ?> tab-pane" id="">
              <div class="row">
              <div class="col-md-12">
                  
                  <div style="padding:7px; text-align: right;" class="pull-right">
                            
                            <button data-toggle="collapse" class="btn btn-xs btn-success" data-target="#demo">
                                + New Prescription
                            </button>
                        

                  </div>



                  <?php 

                    $response=array('action'=>"", 'message'=>"");
                    if(isset($_POST['btn_save'])){
                        
                       
                        $data = array('model'=>"presription",'keys'=>"patient_id, queuing_number, dr_id, dr_name, medecine_id, datetime, qty, times, days");
                        //echo json_encode($_POST['manager']);
                        if(isset($_POST['id'])){
                            $data['values']="patient_id = '".$_GET['id']."', 
                                             queuing_number = '".$_GET['qn']."',
                                             dr_id = '".$_SESSION['login_id']."',
                                             dr_name = '".$_SESSION['complete_name']."',
                                             medecine_id = '".$_POST['medecine_id']."',
                                             datetime = '".date("Y-m-d H:i:s")."',
                                             qty = '".$_POST['qty']."',
                                             times = '".$_POST['times']."',
                                             days = '".$_POST['days']."'";
                            $data['condition'] = " WHERE id = '".$_POST['id']."'";
                            $response = $app->update2($data);

                        }else{
                            $date = date("Y")."-".date("m")."-".date("d");
                            
                            $data2 = array(
                                'model'=>'presription',
                                'keys'=>'patient_id, queuing_number, dr_id, dr_name, medecine_id, datetime, qty, times, days',
                                'values'=>"'".$_GET['id']."', 
                                           '".$_GET['qn']."', 
                                           '".$_SESSION['login_id']."',
                                           '".$_SESSION['complete_name']."',
                                           '".$_POST['medecine_id']."',
                                           '".date("Y-m-d H:i:s")."',
                                           '".$_POST['qty']."',
                                           '".$_POST['times']."',
                                           '".$_POST['days']."'"
                            );
                            $response = $app->create2($data2);
                            
                          
                        }

                    }
                  if($response['message']=="Successful"){

                    echo '<br><br><div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        Record Saved Successfully!
                      </div>';
                    }
                    if(isset($_GET['del'])){
                      $deldata = array("model"=>"presription", 'condition'=>" WHERE id = '".$_GET['del']."'");
                      $response = $app->delete2($deldata);
                       echo '<br><br><div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        Record Deleted Successfully!
                      </div>';

                    }

                  ?>



                <div id="demo" class="collapse box-body">
             

                    <div class="row">
                            <div class="col-sm-6">
                                <form method="POST" action="?page=<?php echo $_GET['page']; ?>&qn=<?php echo $_GET['qn']; ?>&tab=<?php echo $_GET['tab']; ?>&id=<?php echo $_GET['id']; ?>">
                                <div class="form-group" style="margin-bottom: 0px; ">

                                    <?php if(isset($_GET['vid'])): ?>
                                        <input type="hidden" class="form-control" name="vid" value="<?php echo $_GET['vid']; ?>" required />
                                    <?php endif; ?>
                                </div><br><br>

                                <?php  $times = $app->getPresTypes(); ?>

                                 <div class="form-group">
                                    <label>Time Schedule</label>
                                    <select class="form-control" id="times" name="times" style="width: 100%;" >
                                      <?php foreach($times as $k=> $v){
                                        echo '<option value="'.$k.'" >'.$v.'</option>';
                                      } ?>
                                     
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Medicines</label> 
                                    <?php $rMedicines = $app->getMedicines(); ?>
                                    <select class="form-control select2 select2-hidden-accessible" data-placeholder="Select Medicine" name="medecine_id" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                        <?php
                                         foreach ($rMedicines as $key => $value) {
                                              $act="";
                                             if(isset($_GET['id']) &&  in_array($key, $medicines)){  $act="selected"; echo "Yes";}
                                             echo "<option value='".$key."' ".$act.">".$value['name']."</option>";
                                         }
                                        ?>
                                    </select>   
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Days</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Days" name="days" required />
                                </div>
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Quantity</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Quantity" name="qty" required />
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; margin-top: 10px;">
                                   <input type="submit" name="btn_save" class="btn btn-success btn-sm">
                                </div>
                                </form>
                            </div>
                            <div class="col-sm-6">
                              
                              <?php

                                $mySymptoms = $app->getPatientSymptoms("WHERE patient_id = '".$_GET['id']."' AND queuing_number='".$_GET['qn']."'");

                                $con = "";
                                if(sizeOf($mySymptoms)>0){
                                  $con = " WHERE ";
                                  $p=0;
                                  foreach($mySymptoms as $kk => $vv){ $p++;
                                    $contcat="";
                                    if($p>1){ $contcat = " OR "; }
                                    $con .= $contcat.'symptoms LIKE \'%"'.$vv['symptom_id'].'"%\' ';
                                  }
                                }
                                $suggestMedicines = $app->getMedicines($con); 
                              ?>
                              <h4>Suggested Medicines</h4>
                              <ul>
                                <?php foreach ($suggestMedicines as $key => $value) {
                                  echo '<li>'.$value['name'].'</li>';
                                } ?>
                                
                              </ul>  


                            </div>
                        </div>


                </div>    
                <br><br>  
                  
                  <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th></th>
                                <th style="">Medicine</th>
                                <th style="">QTY</th>
                                <th style="">Time Schedule</th>
                                <th style="">Days</th>
                                <th style="">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $presription = $app->getPrescription("WHERE patient_id = '".$_GET['id']."'");
                            //echo json_encode($presription)."<============";
                            $c=0; foreach ($presription as $key => $value): $c++;
                                  echo "<tr><td colspan='6' style='text-align: center;'>(".$value[0]['queuing_number'].") ".date("Y F, d", strtotime($value[0]['datetime']))."</td></tr>";
                             $cc=0; foreach ($value as $rk => $rv): $cc++;
                                ?>
                                <tr>
                                    <td><?php echo $cc; ?></td>
                                    <td><?php echo $rMedicines[$rv['medecine_id']]['name']; ?></td>
                                    <td><?php echo $rv['qty']; ?></td>
                                    <td><?php echo $times[$rv['times']]; ?></td>
                                    <td><?php echo $rv['days']; ?></td>
                                    <td>
                                    <?php if($_SESSION['acl']['prescription-delete']==1): 

                                      $over = $rv['times']." for ".$rv['days'];
                                      ?>
                                   

                                     <label  class="btn btn-danger btn-xs" onClick="deleteThisVital('<?php echo $rv['id']; ?>','<?php echo $rMedicines[$rv['medecine_id']]['name']." (".$over.")"; ?>')"><i class="fa fa-minus"></i> Delete</label>


                                    <?php endif; ?>    

                                    </td>
                         
                                </tr>
                            <?php endforeach; endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th style="">Medicine</th>
                                <th style="">QTY</th>
                                <th style="">Time Schedule</th>
                                <th style="">Days</th>
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
                        
                       
                        $data = array('model'=>"vitalsigns",'keys'=>"patient_id, queuing_number, type, datetime, value");
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
                                'model'=>'vitalsigns',
                                'keys'=>'patient_id, queuing_number, type, datetime, value',
                                'values'=>"'".$_GET['id']."', 
                                           '".$_GET['qn']."', 
                                           '".$_POST['type']."',
                                           '".date("Y-m-d H:i:s")."',
                                           '".$_POST['value']."'"
                            );
                            $response = $app->create2($data2);
                            
                          
                        }

                    }
                  if($response['message']=="Successful"){

                    echo '<br><br><div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        Record Saved Successfully!
                      </div>';
                    }
                    if(isset($_GET['del'])){
                      $deldata = array("model"=>"vitalsigns", 'condition'=>" WHERE id = '".$_GET['del']."'");
                      $response = $app->delete2($deldata);
                       echo '<br><br><div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        Record Deleted Successfully!
                      </div>';

                    }

                  ?>



                <div id="demo" class="collapse box-body">
             

                    <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <form method="POST"  action="?page=<?php echo $_GET['page']; ?>&qn=<?php echo $_GET['qn']; ?>&tab=<?php echo $_GET['tab']; ?>&id=<?php echo $_GET['id']; ?>">
                                <div class="form-group" style="margin-bottom: 0px; ">

                                    <?php if(isset($_GET['vid'])): ?>
                                        <input type="hidden" class="form-control" name="vid" value="<?php echo $_GET['vid']; ?>" required />
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                  <?php $vitalTypes = $app->getVitalTypes();
                                  // echo json_encode($vitalTypes); ?>
                                <label>Type</label>
                                    <select class="form-control" data-placeholder="Select Vital Sign" name="type" style="width: 100%;"  required>
                                        <?php
                                         
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
                                    <input type="text" class="form-control" placeholder="Value" name="value" <?php if(isset($_GET['vid'])){ echo "value='".$rvalue['value']."'"; } ?> required />
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; margin-top: 10px;">
                                   <input type="submit" name="btn_save" class="btn btn-success btn-sm">
                                </div>
                                </form>


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
                                <th style="">Type</th>
                                <th style="">Value</th>
                                <th style="">Date</th>
                                <th style="">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $vsigns = $app->getVitalSigns("WHERE patient_id = '".$_GET['id']."'");
                            //echo json_encode($vsigns);
                            $c=0; foreach ($vsigns as $key => $value): $c++;
                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo $vitalTypes[$value['type']]; ?></td>
                                    <td><?php echo $value['value']; ?></td>
                                    <td><?php echo date("M jS, Y", strtotime($value['datetime'])); ?></td>
                                    <td>
                                    <?php if($_SESSION['acl']['vital-delete']==1): 

                                      $over = str_replace("/"," over ",$value['value']);
                                      ?>
                                   

                                     <label  class="btn btn-danger btn-xs" onClick="deleteThisVital('<?php echo $value['id']; ?>','<?php echo $vitalTypes[$value['type']]." ( ".$over.")"; ?>')"><i class="fa fa-minus"></i> Delete</label>


                                    <?php endif; ?>    

                                    </td>
                         
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th style="">Type</th>
                                <th style="">Value</th>
                                <th style="">Date</th>
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

                  <?php 

                    $response=array('action'=>"", 'message'=>"");
                    if(isset($_POST['btn_save'])){
                        
                       
                        $data = array('model'=>"patient_disease",'keys'=>"patient_id, queuing_number, disease_id, datetime");
                        //echo json_encode($_POST['manager']);
                     
                            $date = date("Y")."-".date("m")."-".date("d");
                            
                            $data2 = array(
                                'model'=>'patient_disease',
                                'keys'=>"patient_id, queuing_number, disease_id, datetime",
                                'values'=>"'".$_GET['id']."', 
                                           '".$_GET['qn']."', 
                                           '".$_POST['disease_id']."',
                                           '".date("Y-m-d H:i:s")."'"
                            );
                            $response = $app->create2($data2);
                            
                         

                    }
                  if($response['message']=="Successful"){

                    echo '<br><br><div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        Record Saved Successfully!
                      </div>';
                    }
                    if(isset($_GET['del'])){
                      $deldata = array("model"=>"patient_disease", 'condition'=>" WHERE id = '".$_GET['del']."'");
                      $response = $app->delete2($deldata);
                       echo '<br><br><div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        Record Deleted Successfully!
                      </div>';

                    }

                  ?>



                <div id="demo" class="collapse box-body">
                

                    <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <form method="POST"  action="?page=<?php echo $_GET['page']; ?>&qn=<?php echo $_GET['qn']; ?>&tab=<?php echo $_GET['tab']; ?>&id=<?php echo $_GET['id']; ?>">
                                 <div class="form-group">
                                   <?php $diseases = $app->getDiseases(); ?>
                                    <label>Disease</label>
                                    <select class="form-control select2 select2-hidden-accessible" id="disease_id" name="disease_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                      <?php foreach($diseases as $k=> $v){
                                        echo '<option value="'.$k.'" >'.$v['name'].'</option>';
                                      } ?>
                                     
                                    </select>
                                </div>

                                <div class="form-group" style="">
                                    <label>Date</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                     <input type="text" class="form-control pull-right" name="datetime" id="datepicker" value='<?php echo date("m/d/Y"); ?>' >
                                </div>
                                <br>
                                <div class="form-group" style="margin-bottom: 0px; margin-top: 15px;">
                                   <input type="submit" name="btn_save" class="btn btn-success btn-sm">
                                </div>
                                </form>


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
                                <th style="">Illness/Disease</th>
                                <th style="">Date</th>
                                <th style="">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $pdisease = $app->getPatientDisease("WHERE patient_id = '".$_GET['id']."'");
                            $c=0; foreach ($pdisease as $key => $value): $c++;
                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo $diseases[$value['disease_id']]['name']; ?></td>
                                    <td><?php echo date("M jS, Y", strtotime($value['datetime'])); ?></td>
                                    <td>
                                    <?php if($_SESSION['acl']['patients-disease-delete']==1): ?>
                                     <label  class="btn btn-danger btn-xs" onClick="deleteThisVital('<?php echo $value['id']; ?>','<?php echo $diseases[$value['disease_id']]['name']." ( ".date("M jS, Y", strtotime($value['datetime'])).")"; ?>')"><i class="fa fa-minus"></i> Delete</label>
                                    <?php endif; ?>    
                                    </td>
                         
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th style="">Illness/Disease</th>
                                <th style="">Date</th>
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

                  <?php 

                    $response=array('action'=>"", 'message'=>"");
                    if(isset($_POST['btn_save'])){
                        
                       
                        $data = array('model'=>"patient_operations",'keys'=>"patient_id, queuing_number, operation_id, datetime");
                        //echo json_encode($_POST['manager']);
                     
                            $date = date("Y")."-".date("m")."-".date("d");
                            
                            $data2 = array(
                                'model'=>'patient_operations',
                                'keys'=>"patient_id, queuing_number, operation_id, datetime",
                                'values'=>"'".$_GET['id']."', 
                                           '".$_GET['qn']."', 
                                           '".$_POST['operation_id']."',
                                           '".date("Y-m-d H:i:s")."'"
                            );
                            $response = $app->create2($data2);
                            
                         

                    }
                  if($response['message']=="Successful"){

                    echo '<br><br><div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        Record Saved Successfully!
                      </div>';
                    }
                    if(isset($_GET['del'])){
                      $deldata = array("model"=>"patient_operations", 'condition'=>" WHERE id = '".$_GET['del']."'");
                      $response = $app->delete2($deldata);
                       echo '<br><br><div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        Record Deleted Successfully!
                      </div>';

                    }

                  ?>



                <div id="demo" class="collapse box-body">
                

                    <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <form method="POST"  action="?page=<?php echo $_GET['page']; ?>&qn=<?php echo $_GET['qn']; ?>&tab=<?php echo $_GET['tab']; ?>&id=<?php echo $_GET['id']; ?>">
                                 <div class="form-group">
                                   <?php $operations = $app->getOperations(); ?>
                                    <label>Surgery/Operation</label>
                                    <select class="form-control select2 select2-hidden-accessible" id="operation_id" name="operation_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                      <?php foreach($operations as $k=> $v){
                                        echo '<option value="'.$k.'" >'.$v['name'].'</option>';
                                      } ?>
                                     
                                    </select>
                                </div>

                                <div class="form-group" style="">
                                    <label>Date</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                     <input type="text" class="form-control pull-right" name="datetime" id="datepicker" value='<?php echo date("m/d/Y"); ?>' >
                                </div>
                                <br>
                                <div class="form-group" style="margin-bottom: 0px; margin-top: 15px;">
                                   <input type="submit" name="btn_save" class="btn btn-success btn-sm">
                                </div>
                                </form>


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
                                <th style="">Operation/Surgery</th>
                                <th style="">Date</th>
                                <th style="">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $pdisease = $app->getPatientOperations("WHERE patient_id = '".$_GET['id']."'");
                            $c=0; foreach ($pdisease as $key => $value): $c++;
                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo $operations[$value['operation_id']]['name']; ?></td>
                                    <td><?php echo date("M jS, Y", strtotime($value['datetime'])); ?></td>
                                    <td>
                                    <?php if($_SESSION['acl']['patients-disease-delete']==1): ?>
                                     <label  class="btn btn-danger btn-xs" onClick="deleteThisVital('<?php echo $value['id']; ?>','<?php echo $operations[$value['operation_id']]['name']." ( ".date("M jS, Y", strtotime($value['datetime'])).")"; ?>')"><i class="fa fa-minus"></i> Delete</label>
                                    <?php endif; ?>    
                                    </td>
                         
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th style="">Illness/Disease</th>
                                <th style="">Date</th>
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
              
              



              <!---------------------------------------------------->
              <!-------------------Start Lab------------------>
              <!---------------------------------------------------->
              <?php if($tab=="lr"){ ?>
              
              <div class="<?php if($tab=="lr"){ echo "active"; } ?> tab-pane" id="">
              <div class="row">
              <div class="col-md-12">
                  
                  <div style="padding:7px; text-align: right;" class="pull-right">
                            
                            <button data-toggle="collapse" class="btn btn-xs btn-success" data-target="#demo">
                                + Request Lab
                            </button> 
                        

                  </div>

                  <?php 

                    $response=array('action'=>"", 'message'=>"");
                    if(isset($_POST['btn_save'])){
                        
                       
                        $data = array('model'=>"patient_operations",'keys'=>"patient_id, queuing_number, operation_id, datetime");
                        //echo json_encode($_POST['manager']);
                     
                            $date = date("Y")."-".date("m")."-".date("d");
                            $qnz = $app->RandomString2(5);
                            $items = $_POST['lab_id'];
                            foreach($items as $kk=>$vv){
                                $data2 = array(
                                'model'=>'queuing',
                                'keys'=>"dtime, queuing_number, patient_type, patient_id, trans_type, which, patient_class, status, date, dr_id, dr_name, skipwait",
                                'values'=>"'".date("Y-m-d H:i:s", strtotime($realEnq['dtime']))."',
                                           '".$qnz."',
                                           'OLD',
                                           '".$_GET['id']."', 
                                           'Laboratory',
                                           '".$vv."',
                                           'Individual',
                                           '0',
                                           '".date("Y-m-d", strtotime($realEnq['dtime']))."',
                                           '".$realEnq['dr_id']."',
                                           '".$realEnq['dr_name']."',
                                           '0'" 
                                );
                                $response = $app->create2($data2);
                            }
                            
                    }
                  if($response['message']=="Successful"){

                    echo '<br><br><div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        Record Saved Successfully!
                      </div>';
                    }
                    if(isset($_GET['del'])){
                      $deldata = array("model"=>"patient_operations", 'condition'=>" WHERE id = '".$_GET['del']."'");
                      $response = $app->delete2($deldata);
                       echo '<br><br><div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        Record Deleted Successfully!
                      </div>';

                    }

                  ?>



                <div id="demo" class="collapse box-body">
                

                    <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <form method="POST"  action="?page=<?php echo $_GET['page']; ?>&qn=<?php echo $_GET['qn']; ?>&tab=<?php echo $_GET['tab']; ?>&id=<?php echo $_GET['id']; ?>">
                                 <div class="form-group">
                                   <?php $operations = $app->getLabTests(); ?>
                                    <label>Lab Procedures</label>
                                    <select class="form-control select2 select2-hidden-accessible" multiple id="operation_id" name="lab_id[]" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                      <?php foreach($operations as $k=> $v){
                                        echo '<option value="'.$k.'" >'.$v['name'].' ('.$v['price'].')</option>';
                                      } ?>
                                     
                                    </select>
                                </div>

                               
                                <br>
                                <div class="form-group" style="margin-bottom: 0px; margin-top: 15px;">
                                   <input type="submit" name="btn_save" class="btn btn-success btn-sm">
                                </div>
                                </form>


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
                                <th style="">Test Procedures</th>
                                <th style="">Date</th>
                                <th style="">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $pdisease = $app->getLabResults("WHERE patient_id = '".$_GET['id']."'");
                            $c=0; foreach ($pdisease as $key => $value): $c++;
                                
                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo $operations[$value['test_id']]['name']; ?></td>
                                    <td><?php echo date("M jS, Y", strtotime($value['date'])); ?></td>
                                    <td>
                                    <?php /* if($_SESSION['acl']['patients-disease-delete']==1): ?>
                                     <label  class="btn btn-danger btn-xs" onClick="deleteThisVital('<?php echo $value['id']; ?>','<?php echo $operations[$value['operation_id']]['name']." ( ".date("M jS, Y", strtotime($value['datetime'])).")"; ?>')"><i class="fa fa-minus"></i> Delete</label>
                                     <?php endif; */ ?>   
                                     <a href="?page=viewresult" class="btn btn-info btn-xs" ><i class="fa fa-plus"></i> View</a>
                                     
                                    </td>
                         
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th style="">Test Procedures</th>
                                <th style="">Date</th>
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
              <!-------------------End Lab-------------------->
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