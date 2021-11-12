   <style>
       
       	.avatar-upload {
		position: relative;
		max-width: 205px;
		margin: 50px auto;
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
    		width: 192px;
    		height: 192px;
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
   
   <?php 
   error_reporting(E_ALL); ini_set('display_errors', 1); 
   $data=array("model"=>"employee");

  $secmessage = "";
 if(isset($_POST['btn_cp'])){
    if(sha1(trim($_POST['p0']))==trim($_SESSION['ps'])){
      if(trim($_POST['p1'])!=trim($_POST['p2'])){
        $secmessage = "Mismatched password!!";
      }else{
        $data['values']="up = '".sha1(trim($_POST['p1']))."'";                 
        $data['condition'] = " WHERE id ='".$_SESSION['login_id']."'";
        $response = $app->update2($data);
        $secmessage = "Success";
        $_SESSION['ps'] = sha1(trim($_POST['p1']));
      }
    }else{
      $secmessage = "Access Denied!";
    }
 }

   if(isset($_POST['updateme'])){
       $data['values']="fname = '".str_replace("'","\'",$_POST['fname'])."', 
                        mname = '".str_replace("'","\'",$_POST['mname'])."',
                        lname = '".str_replace("'","\'",$_POST['lname'])."',
                        mobilenumber = '".$_POST['mobilenumber']."',
                        email = '".$_POST['email']."',
                        address = '".str_replace("'","\'",$_POST['address'])."',
                        birthdate = '".date("Y-m-d",strtotime($_POST['birthdate']))."'";                 
        $data['condition'] = " WHERE id ='".$_SESSION['login_id']."'";
        $response = $app->update2($data);
   }
 

   if(isset($_POST['changephoto'])){
       $target_dir = "uploads/";
       $newfilename = $app->RandomString(20);
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        $target_file = $target_dir . $newfilename.".".$imageFileType;
 
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "<script> alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
             echo "<script> alert('Sorry, your file was not uploaded.');</script>";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
                $dataPar = array(
                   'photo'=>$target_file,
                   'id'=> $_SESSION['login_id']
                   );
               $app->updatePhoto($dataPar);
            } else {
                 echo "<script> alert('Sorry, there was an error uploading your file.');</script>";
            }
        }
   }
   
   
   $user=$app->getMyUsers($_SESSION['login_id']); 
   //echo json_encode($user); 
   $user=$user[0];
   
   // $shift_start = $user['shift_start'];
     $department = $app->getDepartments();
    $condition = " WHERE uid = '". $_SESSION['login_id']."'";

   //$pays = $app->getPayslips("employee_id", $_SESSION['login_id']);

    // $ds = array(
    //     'model'=>'tickets',
    //     'condition'=>$condition
    // );
    // $cur = $app->getRecord2($ds);
    // $tickets=$cur['data'];
    $tickets=array();
   ?>
   

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <?php if(isset($_GET['tab'])){ $tab=$_GET['tab']; }else{ $tab=1; } ?>
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo $user['image']; ?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $user['fname']; ?></h3>

              <p class="text-muted text-center"><?php echo $user['position']; ?></p>
              <p class="text-muted text-center" style="font-size: 12px; margin-top: -6px;"><?php echo $department[$user['department_id']]['name']; ?></p>

              <!--<ul class="list-group list-group-unbordered">-->
              <!--  <li class="list-group-item">-->
              <!--    <b>Followers</b> <a class="pull-right">1,322</a>-->
              <!--  </li>-->
              <!--  <li class="list-group-item">-->
              <!--    <b>Following</b> <a class="pull-right">543</a>-->
              <!--  </li>-->
              <!--  <li class="list-group-item">-->
              <!--    <b>Friends</b> <a class="pull-right">13,287</a>-->
              <!--  </li>-->
              <!--</ul>-->

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
              
              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted"><?php echo $user['address']; ?></p>

              <hr>

            
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <!--<li><a href="#timeline" data-toggle="tab">Timeline</a></li>-->
              <li  <?php if($tab==1){ echo 'class="active"'; } ?>><a href="?page=<?php echo $_GET['page']; ?>&tab=1">User Info</a></li>
              <li <?php if($tab==2){ echo 'class="active"'; } ?>><a href="?page=<?php echo $_GET['page']; ?>&tab=2" >Photo</a></li>
              <li <?php if($tab==3){ echo 'class="active"'; } ?>><a href="?page=<?php echo $_GET['page']; ?>&tab=3">Security</a></li>
            </ul>
            <div class="tab-content">
              
              
              <div class="tab-pane  <?php if($tab==1){ echo 'active'; } ?>" id="settings">
                <form class="form-horizontal"  name="" method="post" action="">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">First Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="First Name"  name="fname" value='<?php echo $user['fname']; ?>'>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Middle Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Middle Name"  name="mname" value='<?php echo $user['mname']; ?>'>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Last Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Last Name"  name="lname" value='<?php echo $user['lname']; ?>'>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Mobile Number</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail" placeholder="mobilenumber"  name="mobilenumber" value='<?php echo $user['mobilenumber']; ?>'>
                    </div>
                  </div>
                 
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email"  name="email" value='<?php echo $user['email']; ?>' readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Address Line 1</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Address" name="address"  value="<?php echo $user['address']; ?>">
                    </div>
                  </div>
                  
                  <div class="form-group">
                        <label for="inputSkills" class="col-sm-2 control-label">Birth Date</label>
                        <div class="col-sm-10">
                            <div class="input-group date col-sm-12">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right" name="birthdate" id="datepicker3" <?php if(isset($_GET['id'])){ echo "value='".date("m/d/Y",strtotime($user['birthdate']))."'"; } ?> required>
                            </div>
                        </div>
                  </div>
                 
                  
                  
                 
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger" name="updateme">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
              
              
              <div class="tab-pane <?php if($tab==2){ echo 'active'; } ?>" id="photo">
                <form class="form-horizontal"  name="" method="post" action="?page=<?php echo $_GET['page']; ?>&tab=2"  enctype="multipart/form-data">
                  
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Upload Photo</label>

                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="file" placeholder="Photo" name="file"  value='<?php echo $user['photo']; ?>'>
                    </div>
                  </div>
           
                  
                 
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger" name="changephoto">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
              
              
              <div class="tab-pane <?php if($tab==3){ echo 'active'; } ?>" id="timesheet" style="height: 500px; overflow: scroll;">
                <form class="form-horizontal"  name="" method="post" action="?page=<?php echo $_GET['page']; ?>&tab=3"  enctype="multipart/form-data">
                  <div class="row">
                  <div class="col-sm-12">
                      
                    <div class="box-body" >
                        
                    <!-- Form Element sizes -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Change Password</h3>
            </div>
            <div class="box-body">

                  <?php  

                  if($secmessage == "Success"){
                    echo '<div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                      <h4><i class="icon fa fa-check"></i> Alert!</h4>
                      Password Changed Successfully!
                    </div>';
                  }

                  if($secmessage != "Success" && $secmessage != ""){
                    echo '<div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                      <h4><i class="icon fa fa-check"></i> Alert!</h4>
                      '.$secmessage.'
                    </div>';
                  }
                  

                ?>

              
              
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-4 control-label">Current Password</label>

                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="inputSkills" placeholder="Passord" name="p0"  value="" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-4 control-label">New Password</label>

                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="inputSkills" placeholder="New Passord" name="p1"  value="" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-4 control-label">Retype Password</label>

                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="inputSkills" placeholder="Retype Passord" name="p2"  value="" required>
                    </div>
                  </div>
                  <input type="submit" name="btn_cp" class="btn btn-sm btn-success pull-right" value="Change Password">
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          

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
  