
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
    $data['values']="fname = '".$_POST['fname']."', 
                        mname = '".$_POST['mname']."',
                        lname = '".$_POST['lname']."',
                        email = '".$_POST['email']."',
                        address = '".$_POST['address']."',
                        saying = '".$_POST['saying']."'";                 
        $data['condition'] = " WHERE id = '".$_GET['id']."'";
        $response = $app->update2($data);
}

if(isset($_POST['updateSecurity'])){
    $data['values']="un = '".trim($_POST['un'])."'";  
        if(isset($_POST['up'])){
            if(trim($_POST['up'])!=""){
                $data['values'] = $data['values']. ", up = '".sha1(trim($_POST['up']))."'";
            }
        }               
        $data['condition'] = " WHERE id = '".$_GET['id']."'";
        $response = $app->update2($data);
}
$edata = array("model"=>"employee", "condition"=>" WHERE  id = '".$_GET['id']."'");
$emps = $app->getRecord2($edata);
$emps = $emps['data'][0];
$rvalue = $emps;


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
            <div class="pull-right" style="margin-top: -75px;">
                            <a href="?page=expenses"><label class="btn btn-xs btn-info">Expenses List</label></a> 
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

              <p class="text-muted"><?php echo $emps['address']; ?></p>

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
              <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
              <!--<li><a href="#timeline" data-toggle="tab">Timeline</a></li>-->
              <li><a href="#settings" data-toggle="tab">Employee Details</a></li>
              <li><a href="#photo" data-toggle="tab">Employement Details</a></li>
              <li><a href="#security" data-toggle="tab">Security</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                  
                <?php foreach($activities as $k => $v): ?>  
                <!-- Post -->
                <br>
                <form method = "POST">
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="<?php echo $user['photo']; ?>" alt="user image">
                        <span class="username">
                          <a href=<?php echo 'http://support.backoffice-services.net/?page=tickets-view&id='.$v['id']; ?>><?php echo $v['subject']; ?></a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description"><?php echo $v['date_open']; ?></span>
                  </div>
                  <!-- /.user-block -->
                  <h5><strong>Concern</strong></h5>
                  <p style="margin-left:20px;">
                   <?php echo "  ".$v['concern']; ?>
                   <br>
                   
                  </p>
                  
                  <?php $commentS = $app->selectcomments($v['id']);$cx=0;
                                         foreach($commentS as $Ckey =>$Cval){ 
                                         $cx++;
                                         $Cusername=getMyUsers($Cval['uid']);
                                         
                                         
                                         ?>
                 <h5><strong>Comment(s)</strong></h5><br>
                 
                  <div class="col-md-12">
                     
                    <ul class="timeline">
                        <li><img src="<?php echo $Cusername[0]['photo']; ?>" class="img-circle img-bordered-sm" style="width: 40px; margin-left:15px" alt="User Image">
                          <div class="timeline-item">
                              <span class="time"><i class="fa fa-clock-o"></i> <?php echo $Cval['date'];?></span>
                                    
                             <h3 class="timeline-header"><a href="#"><?php echo $Cusername[0]['phpro_username']; ?></a> (<?php echo $Cusername[0]['role']; ?>)</h3>
                              <div class="timeline-body" style="word-wrap: break-word;">
                                   <?php /*$commentS = $app->selectcomments($v['id']); foreach($commentS as $Ckey => $Cval){*/echo $Cval['notes']; echo "<br>"; ?>
                                    <div class="timeline-footer" ><br>
                                            <strong>Replie(s):</strong>   <br>                              
                                        </div>
                                    <?php $repselect = $app->selectreply($Cval['id']);
                    
                                    foreach($repselect as $repkey =>$repval){$Rusername=getMyUsers($repval['uid']); ?>
                                        
                                        <ul class="comments-list reply-list" >
                                            <li>
                                                <div class="comment-box" style="padding: 3px;  border-bottom: 1px solid #f4f4f4;" >
                                                    <div class="row comment-head">
                                                        <div class="col-sm-9">
                                                            <h3 class="timeline-header" style="margin-top: 0px; font-size: 16px; margin-bottom:0px;"><a href="#">
                                                            <img src="<?php echo $Rusername[0]['photo']; ?>" class="img-circle new-circle bg-aqua" style="width: 25px;;" alt="User Image">
                                                            <?php $Rusername=getMyUsers($repval['uid']); $Rss=$Rusername[0]; echo $Rss['phpro_username'];?></a>  (<?php echo $Rss['role']; ?>)</h3></div>
                                                            <!--<div class="col-sm-3"><i class="fa fa-clock-o"></i> <?php //echo $repval['date']; ?></div>-->
                                                            <span class="time"><i class="fa fa-clock-o"></i> <?php echo $repval['date'];?></span>                        
                                                                                     </hr>
                                                        </div>
                                                    <div class="comment-content" style="word-wrap: break-word;">
                                                        <?php echo $repval['reply'];echo "<br>";?>
                                                                                
                                                    </div>
                                                </div>
                                            </li>
                                                    
                                        </ul>
                                        <input type="hidden" name="replyid[]" class="form-control inputs" value='<?php echo $Rusername[0]['phpro_user_id']; ?>'>                        
                                <?php }?>
                                 
                              </div>
                          </div>
                        </li>
                    </ul>
                   </div>
                   
                   
                  
                   
                   
                  <!--<ul class="list-inline">-->
                    
                  <!--  <li class="pull-right">-->
                  <!--    <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments-->
                  <!--      (5)</a></li>-->
                  <!--  </ul>-->
                   
                    
                    <input name =<?php echo"reply".$Cval['id'];?> class="form-control input-sm" type="text" placeholder="Type a reply" style="width:93%;">
                    <button name ="btnreply" class="btn btn-info btn-xs" style="float:right; margin-top: -25px;" value=<?php echo $Cval['id']; ?>><i class="fa fa-reply"></i> reply</button>
                    
                   
                    <?php }?>
                </div>
                
               
                 </form> 
                <?php endforeach; ?>
                <!-- /.post -->

               
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-envelope bg-blue"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                      <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                      <div class="timeline-body">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                        quora plaxo ideeli hulu weebly balihoo...
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">Read more</a>
                        <a class="btn btn-danger btn-xs">Delete</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-user bg-aqua"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                      <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                      </h3>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-comments bg-yellow"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                      <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                      <div class="timeline-body">
                        Take me to your leader!
                        Switzerland is small and neutral!
                        We are more like Germany, ambitious and misunderstood!
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-camera bg-purple"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                      <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                      <div class="timeline-body">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->
              
              <div class="tab-pane" id="settings">
                <form class="form-horizontal"  name="" method="post" action="">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">First Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="First Name"  name="fname" value='<?php echo $emps['fname']; ?>'>
                    </div>
                  </div>
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
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email"  name="email" value='<?php echo $emps['email']; ?>'>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Address" name="address"  value='<?php echo $emps['address']; ?>'>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Saying</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Saying" name="saying" ><?php echo $emps['saying']; ?></textarea>
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
                                      <input type="text" class="form-control pull-right" name="date_hired" id="datepicker" <?php if(isset($_GET['id'])){ echo "value='".date('m/d/Y',strtotime($rvalue['date_hired']))."'"; } ?> required>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Date Regularized</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right" name="date_regularized" id="datepicker2" <?php if(isset($_GET['id'])){ echo "value='".date('m/d/Y',strtotime($rvalue['date_regularized']))."'"; } ?>>
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

                                 <div class="form-group" >
                                    <button style="margin-top: 25px;" type="submit" class="btn btn-danger btn-sm" name="updateEmployment">Submit</button>
                                </div>

                                
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
                                <div class="form-group" >
                                    <button style="margin-top: 25px;" type="submit" class="btn btn-danger btn-sm" name="updateSecurity">Update</button>
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