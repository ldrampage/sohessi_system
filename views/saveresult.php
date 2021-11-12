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




$condition = " WHERE  id = '".$_GET['qid']."'";
$rdetails = $app->getEnqueued($condition);
$rdetails = $rdetails[$_GET['qid']];
$labid = $rdetails['which'];
$resultD = $app->getResultData("WHERE labtest_id='".$labid."'");
$realDataResult = array();
foreach ($resultD as $key => $value) {
  $realDataResult = $value;
}
if($rdetails['result_id']==0){
  $saveresultid = 0;
}else{
   $saveresultid = $rdetails['result_id'];
}
// echo json_encode($rdetails)."<br>";
// echo json_encode($realDataResult);


if(isset($_POST['btn_asres'])){
    // $pupdate = $app->update2($data);
    $rval = $_POST['rvalue'];
    $tp = $_POST['type'];
    $tmptitle = $_POST['title'];
    $real_result = array();
    $error_found = 0;
    $normal = $_POST['normal'];
    $ropt = array();
    $tmlopt = $_POST['opt'];
    // echo json_encode($_FILES)."<br><br>";
    // echo json_encode($normal);
    foreach($rval as $k =>$vs){
      // echo "<br>".$k."<==";
      $v = $vs;
      if (strpos($tmlopt[$k], ',') !== false) {
          $ropt[$k] = explode(",",$tmlopt[$k]);
      }else{
          $ropt[$k] = array($tmlopt[$k]);
      }
      if(strtolower(trim($tp[$k]))=="image"){
          $error = "";
          $check = getimagesize($_FILES["image_".$k]["tmp_name"]);
          if($check !== false) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["image_".$k]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $new_target_file = $target_dir.$app->RandomString(20).".".$imageFileType;
            if ($_FILES["image_".$k]["size"] > 500000) {
                $error = "Sorry, your file is too large.";
                $error_found = 1;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $error_found = 1;
            }
            if($error==""){
              if (move_uploaded_file($_FILES["image_".$k]["tmp_name"], $new_target_file)) {
                  $real_result[] = $new_target_file;
                  //echo "The file ". basename( $_FILES["image_".$k]["name"]). " has been uploaded.";
              } else {
                  echo "Sorry, there was an error uploading your file.";
                  $error_found = 1;
              }
            }
          }
      }else{
         $real_result[] = $v;
      }
    }
    // echo json_encode($real_result);
    // echo $error_found; exit();
    //echo json_encode($_POST['opt']); exit();

    if($error_found==0){
    $data = array("model"=>"labresults",
                  "keys"=>"test_id, patient_id, queuing_number, resultdata, normal_range, date, note, enid, titles, options, types, medtech_id, pathologist_id",
                  "values"=>"'".$labid."', '".$_GET['id']."', '".$_GET['qn']."', '".json_encode($real_result)."', '".json_encode($_POST['normal'])."', '".date("Y-m-d")."', '".str_replace("'","\'",$_POST['note'])."', '".$_SESSION['login_id']."', '".json_encode($_POST['title'])."', '".json_encode($ropt)."', '".json_encode($_POST['type'])."', '".$_POST['medTech']."', '".$_POST['pathologist']."'");
    $pcreate = $app->create2($data);
    $saveresultid = $pcreate['id'];
    $data = array("model"=>"queuing",
                  "condition"=>" WHERE id =  '".$_GET['qid']."'",
                  "values"=>"result_id='".$saveresultid."'");
    $pupdate = $app->update2($data);
    }
}

if(isset($_POST['btn_usres'])){

    $rval = $_POST['rvalue'];
    $tp = $_POST['type'];
    $real_result = array();
    $error_found = 0;
    $normal = $_POST['normal'];
    foreach($normal as $k =>$vs){

      $v = $rval[$k];
      if(strtolower(trim($tp[$k]))=="image"){
          $error = "";
          $check = getimagesize($_FILES["image_".$k]["tmp_name"]);
          if($check !== false) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["image_".$k]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $new_target_file = $target_dir.$app->RandomString(20).".".$imageFileType;
            if ($_FILES["image_".$k]["size"] > 500000) {
                $error = "Sorry, your file is too large.";
                $error_found = 1;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $error_found = 1;
            }
            if($error==""){
              if (move_uploaded_file($_FILES["image_".$k]["tmp_name"], $new_target_file)) {
                  $real_result[] = $new_target_file;
                  //echo "The file ". basename( $_FILES["image_".$k]["name"]). " has been uploaded.";
              } else {
                  echo "Sorry, there was an error uploading your file.";
                  $error_found = 1;
              }
            }
          }
          if($error!=""){
            $real_result[] = $v;
          }
      }else{
         $real_result[] = $v;
      }
    }


    $data = array("model"=>"labresults",
                  "condition"=>" WHERE test_id = '".$labid."' AND  patient_id= '".$_GET['id']."' AND queuing_number = '".$_GET['qn']."'",
                  "values"=>"resultdata='".json_encode($_POST['rvalue'])."', normal_range='".json_encode($_POST['normal'])."', dateupdate='".date("Y-m-d")."', note = '".str_replace("'","\'",$_POST['note'])."', upid='".$_SESSION['login_id']."', medtech_id='".$_POST['medTech']."', pathologist_id='".$_POST['pathologist']."'");
    $pupdate = $app->update2($data);
}

if($saveresultid!=0){
   $theRealResultData = $app->getPatientResults("WHERE id = '".$saveresultid."'");
   $theRealResultData = $theRealResultData[$saveresultid];
   $trrdvalues = json_decode($theRealResultData['resultdata']);
   //echo json_encode($trrdvalues);
}
// result_id
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
                 echo ucfirst(strtoupper($patients['lname']).", ".ucfirst($patients['fname'])." ".ucfirst($patients['mname']));
                ?> (Employee View)
                <small class="pull-right">Date: <?php echo date("Y")."-".date("m")."-".date("d"); ?></small>
            </h2>
            <div class="pull-right" style="margin-top: -15px;">
                            <a href="?page=process-test"><label class="btn btn-xs btn-info">Back</label></a> 
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
        				<!-- <input type='file'  name="fileToUpload" id="imageUpload" accept=".png, .jpg, .jpeg" /> -->
        				<!-- <label for="imageUpload"></label> -->
        			</div>
        			<div class="" >
        				<!--<div id="imagePreview" style="background-image: url('<?php echo $emps['image']; ?>');">-->
        				    
        				<!--</div>-->
        				<img class="profile-user-img img-responsive img-circle" src="<?php echo $patients['image']; ?>" alt="User profile picture">
        			</div>
		        </div>
		     
		        <!-- <input type="submit" value="Change Photo" name="photo_up"> -->
		        
		      </form>  
              <h3 class="profile-username text-center"><?php ucfirst($patients['fname'])." ".ucfirst($patients['fname']); ?></h3>

              <p class="text-muted text-center"><?php echo ucfirst($patients['occupation']); ?></p>
              <p class="text-muted text-center" style="font-size: 12px; margin-top: -6px;"><?php //echo $department[$patients['department_id']]['name']; ?></p>

              
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

              <p class="text-muted"><?php echo $patients['address']."<br>".$patients['phone']."<br>".$patients['email']; ?></p>

              <hr>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          
<div class="box-body">

   <?php  
                  $secmessage="";
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


              <div class="form-group row" style="margin-bottom: 5px;">
                    <label for="inputSkills" class="col-sm-3 control-label" style="text-align: right;">TITLE</label>

                    <label for="inputSkills" class="col-sm-4 control-label" style="text-align: left;">Result</label>
                    <label for="inputSkills" class="col-sm-4 control-label" style="text-align: left;">Normal</label>
                  </div>

          <form method="POST"  enctype="multipart/form-data">  
          <?php 
          //echo json_encode($realDataResult);

          if(sizeOf($realDataResult)==0){
            echo '<div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                      <h4><i class="icon fa fa-check"></i> Alert!</h4>
                      Sorry, You still did not add result data neededfor this lab test procedure. Please click <a href=\'?page=tests-view&id='.$labid.'&tab=1\' target=\'_BLANK\'>here</a>.
                    </div>';
                    exit();
          }
          if($saveresultid!=0){
            $lr = $app->getLabResults("WHERE id='".$saveresultid."'");
            $pdata = json_decode($lr[$saveresultid]['titles']);
            $type = json_decode($lr[$saveresultid]['types']);
            $options = json_decode($lr[$saveresultid]['options']);
            $order_data = json_decode($lr[$saveresultid]['order_data']);
            $normals = json_decode($realDataResult['normal_range']);
            //echo json_encode($pdata);
          }else{
            $pdata_tmp = json_decode($realDataResult['data_title']);
            $type_tmp = json_decode($realDataResult['type']);
            $options_tmp = json_decode($realDataResult['options']);
            $order_data_tmp = json_decode($realDataResult['order_data']);
            $normals_tmp = json_decode($realDataResult['normal_range']);
            $pdata = array();
            $type = array();
            $options = array();
            $order_data = array();
            $normals = array();
            foreach($order_data_tmp as $k => $v){
              //echo $v."<br>".json_encode($pdata_tmp[$k])."<br>".json_encode($type_tmp[$k])."<br>".json_encode($options_tmp[$k])."<br>===================<br>";
              $ind = $v - 1;
              $order_data[$ind] = $v;
              $pdata[$ind] = $pdata_tmp[$k];
              $type[$ind] = $type_tmp[$k];
              $options[$ind] = $options_tmp[$k];
              $normals[$ind] = $normals_tmp[$k];
            }
          }
          
          ksort($pdata);
          
          //echo json_encode($pdata);
          

        

          if(is_array($pdata)){
            foreach($pdata as $k=>$v){
             // echo $k."<br>";
            ?>

                 <div class="form-group row" style="margin-bottom: 5px;">
                    <label for="inputSkills" class="col-sm-3 control-label" style="text-align: right;"><?php echo $v; ?></label>
                    <input type="hidden" class="form-control" id="inputSkills" placeholder="Value" name="type[]"  value="<?php echo $type[$k]; ?>" required>
                   
                    <input type="hidden" class="form-control" id="inputSkills" placeholder="Value" name="title[]"  value="<?php echo $v; ?>" required>
                    <div class="col-sm-4">
                      <?php 
                      if($type[$k]=="image"){ $req = "";
                         if($saveresultid==0){ $req = "required";  }
                         echo '<input type="file" name="image_'.$k.'" id="fileToUpload" '.$req.'>';
                         if($saveresultid!=0){
                          echo '<input type="HIDDEN" name="rvalue[]" id="fileToUpload" VALUE="'.$trrdvalues[$k].'">';
                         }
                      }else{
                      if(!in_array("n/a",$options[$k]) && !in_array("N/A",$options[$k]) && !in_array("NONE",$options[$k]) && !in_array("none",$options[$k])){ ?>
                        <select class="form-control" name="rvalue[]">
                          <?php foreach($options[$k] as $kk => $vv){ $sel="";
                              if($saveresultid!=0 && strtolower(trim($trrdvalues[$k]))==strtolower(trim($vv))){ $sel="selected"; }
                              echo "<option value='".$vv."' ".$sel.">".$vv."</option>";
                          } ?>
                        </select>
                      <?php }else{ ?>  
                      <input type="text" class="form-control" id="inputSkills" placeholder="Value" name="rvalue[]"  value="<?php if($saveresultid!=0){ echo $trrdvalues[$k]; } ?>" required>
                      <?php }
                      } 
                      $dropt = array(); $ccvc=0;
                      //echo json_encode($options[$k]);
                      foreach($options[$k] as $kk => $vv){ $ccvc++; if($ccvc>1){ $dropt .= ",".$vv; }else{ $dropt = $vv; }  }

                      ?>

                       <input type="hidden" class="form-control" id="inputSkills" placeholder="Value" name="opt[]"  value="<?php echo $dropt; ?>" required>
                    </div>
                    <div class="col-sm-4">

                      <input type="text" class="form-control" id="inputSkills" placeholder="Normal" name="normal[]"  value="<?php echo $normals[$k]; ?>" required readonly>
                      
                    </div>
                   
                  </div>
            
            <?php  
            } 
          }
          ?>
          <br>
          <?php 
            $medTechs = $app->getEmployees("WHERE department_id = 7 and position = 'medical technologist'");
            $pathologists = $app->getEmployees("WHERE department_id = 7 and position = 'pathologist'");
          ?>
          <div class="form-group row" style="margin-bottom: 5px;">
                    <label for="inputSkills" class="col-sm-3 control-label" style="text-align: right;"></label>
             
                    <div class="col-sm-8">
                      <strong>Medical Techonologist</strong>
                      <select class="form-control" name="medTech" >
                        <?php 
                          foreach($medTechs as $medTech) {
                        ?>
                        <option value="<?php echo $medTech['id']; ?>"><?php echo $medTech['fname'] . ' ' . $medTech['mname'] . ' ' . $medTech['lname']; ?></option>
                        <?php } ?>
                      </select>
                      <strong>Pathologist</strong>
                      <select class="form-control" name="pathologist">
                        <?php 
                          foreach($pathologists as $pathologist) {
                        ?>
                        <option value="<?php echo $pathologist['id']; ?>"><?php echo $pathologist['fname'] . ' ' . $pathologist['mname'] . ' ' . $pathologist['lname']; ?></option>
                        <?php } ?>
                      </select>
                      <strong>Note</strong>
                      <textarea name="note" class="form-control"><?php if($saveresultid!=0){ echo $theRealResultData['note'];  } ?></textarea><br>
                      <?php if($saveresultid==0): ?>
                      <input type="submit" class="btn btn-success btn-sm pull-right" id="inputSkills" placeholder="" value="Save" name="btn_asres" style="float: right;">
                      <?php else: ?>
                       <input type="submit" class="btn btn-success btn-sm pull-right" id="inputSkills" placeholder="" value="Update"  name="btn_usres" style="float: right;"> 
                      <?php endif; ?>  
                     
                     
                    </div>
                    <div class="col-sm-4">
                      
                    </div>
                  </div>

          </div>

        </form>
            <!-- /.box-body -->


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