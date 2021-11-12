
<?php

$sql = "SELECT * FROM tbl_department ORDER BY name";
$result = mysqli_query($app->connect(),$sql) or die(mysqli_connect_error());
$departments  = array();
while($fetchData = mysqli_fetch_assoc($result)){
    $departments[$fetchData['id']] = array("name"=>$fetchData['name'],"employee"=>array());
}
    
$sql = "SELECT * FROM tbl_employee WHERE status = '1' ORDER BY usertype";
$result = mysqli_query($app->connect(),$sql) or die(mysqli_connect_error());
$usersp=array();
$active=0;
$inactive=0;
$uCount=0;
while($fetchData = mysqli_fetch_assoc($result)){
    $uCount++;
    if($fetchData['status']==0){ $inactive=$inactive+1; }
    if($fetchData['status']==1){ $active=$active+1; }
    $departments[$fetchData['department_id']]['employee'][] = $fetchData;
    $usersp=$fetchData;
}
    
//echo "<br><br><br>===>".json_encode($departments)."<br>";
//$uCount = sizeOf($usersp);


?>


    <section class="content" >
      

      <div class="row">
        <?php /*
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-ticket"></i></span>

            <div class="info-box-content">
              <a href="index.php?page=tickets&status=0"><span class="info-box-text">Open Tickets</span></a>
              <span class="info-box-number"><?php echo $allOpen; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-ticket"></i></span>

            <div class="info-box-content">
              <a href="index.php?page=tickets&status=0"><span class="info-box-text">Closed Tickets</span></a>
              <span class="info-box-number"><?php echo $allClosed; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-ticket"></i></span>

            <div class="info-box-content">
              <a href="index.php?page=tickets&status=all"><span class="info-box-text">All Tickets</span></a>
              <span class="info-box-number"><?php echo $alltickets; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        */ ?>
        <div class="col-md-4 col-sm-4  col-xs-12">
          <?php if($_SESSION['acl']['employee']==1): ?>
          <a href="index.php?page=employee">  
          <?php endif ?>
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Employees</span>
              <span class="info-box-number"><?php echo $uCount; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <?php if($_SESSION['acl']['employee']==1): ?>
          </a>
          <?php endif ?>
          <!-- /.info-box -->
        </div>
        
        <div class="col-md-4 col-sm-4  col-xs-12">
            <?php if($_SESSION['acl']['employee']==1): ?>
          <a href="index.php?page=employee&status=1">  
          <?php endif ?>
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Active Employees</span>
              <span class="info-box-number"><?php echo $active; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <?php if($_SESSION['acl']['employee']==1): ?>
          </a>
          <?php endif ?>
          <!-- /.info-box -->
        </div>
        
        <div class="col-md-4 col-sm-4 col-xs-12">
          <?php if($_SESSION['acl']['employee']==1): ?>
          <a href="index.php?page=employee&status=0">  
          <?php endif ?>
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Inactive Employees</span>
              <span class="info-box-number"><?php echo $inactive; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <?php if($_SESSION['acl']['employee']==1): ?>
          </a>
          <?php endif ?>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      
      <div class="row">
        <?php /*<div class="col-sm-6">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Calendar</h3>

              <div class="box-tools-removeit pull-right">
                <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>-->
                <!--</button>-->
                <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <canvas id="pieChart" height="155" width="205" style="width: 205px; height: 155px;"></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <ul class="chart-legend clearfix">
                    <li><i class="fa fa-circle-o text-green"></i> On-Leave</li>
                    <li><i class="fa fa-circle-o text-yellow"></i> Present</li>
                    <li><i class="fa fa-circle-o text-aqua"></i> All Employee</li>
                  </ul>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
            
            <!-- /.footer -->
          </div>
        </div>  */?>
        <div class="col-md-12">
              <!-- USERS LIST -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Employees</h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger"><?php echo $uCount; ?> Employees</span>
                    <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>-->
                    <!--</button>-->
                    <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>-->
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="row">
                     <?php
                    
                    foreach($departments as $dk => $dv):
                        if(sizeOf($dv['employee'])>0):
                        echo '<div class="col-md-12" style="text-align: center; text-align: center;
    border-bottom: 1px solid #eee; margin-bottom: 10px;"><h4 style="color: #3c8dbc;">'.$dv['name']."</h4>";
                        echo '<ul class="users-list clearfix">';
                        
                        foreach($dv['employee'] as $uk => $v){  ?>
                            <li>
                              <?php if($_SESSION['acl']['employee-view']==1): ?><a href="index.php?page=employee-view&id=<?php echo $v['id']; ?>"><?php endif; ?>
                              <img src="<?php echo $v['image']; ?>" style="width: 45px;height: 45px;" alt="User Image">
                              <a class="users-list-name" href="#"><?php echo $v['fname']; ?></a>
                              <span id="track_<?php echo $v['id']; ?>" class="tracking"></span>
                              <span class="users-list-date" id="time-<?php echo $v['id']; ?>">
                                  <img src="<?php 
                                  if(trim($app->time_elapsed_string($v['last_session']))=="Online"){ 
                                  echo 'images/online.png'; }
                                  else{ echo 'images/offline.png'; }?>" style="margin-top: -2px;width: 10px;height: 10px;">&nbsp;<?php echo $app->time_elapsed_string($v['last_session']); ?></span>
                              <!--<span class="users-list-date">Today</span>-->
                              <?php if($_SESSION['acl']['employee-view']==1): ?></a><?php endif; ?>
                            </li>
                       <?php  }
                        
                        echo '</ul></div><hr>';
                        endif;
                    endforeach;    
                    
                    
                    ?>
                    </div>
                    
                  
                </div>
               
              </div>
              <!--/.box -->
            </div>
      </div>      
      
    </section>
    
    <script>
  
  </script>

