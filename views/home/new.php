<style>
    .content-wrapper {
        background:linear-gradient(rgba(255, 255, 255, 0.4), rgba(255, 255, 255, 0.4)),url('../../hr.jpeg') no-repeat center center fixed;
         -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    
    .skin-blue .content-header {
        padding: 15px 15px 15px 15px;
        background:white;
    }

    .info-box-icon {
    border-top-left-radius: 2px;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 2px;
    display: block;
    float: left;
    /* height: 50px; */
    width: 50px;
    text-align: center;
    font-size: 45px;
    line-height: 90px;
    background: rgba(0,0,0,0.2);
}
    .info-box-content {
      padding: 5px 10px;
      margin-left: 50px;
  }

</style>

<?php

if(isset($_GET['dqn'])){
  $data = array('model'=>'queuing', 'condition'=>" WHERE queuing_number = '".trim($_GET['dqn'])."' AND date = '".date("Y-m-d",strtotime($_GET['dt']))."'");
    $response = $app->delete2($data);
    $response['message'] = "Deleted";
    echo '<script>window.location.href = "?page='.$_GET['page'].'";</script>';
}

$sql = "SELECT * FROM tbl_department ORDER BY name";
$result = mysqli_query($app->connect(),$sql) or die(mysqli_connect_error());
$departments  = array();
while($fetchData = mysqli_fetch_assoc($result)){
    $departments[$fetchData['id']] = array("name"=>$fetchData['name'],"employee"=>array());
}
     
$sql = "SELECT * FROM tbl_employee ORDER BY usertype"; // WHERE status = '1' 
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


$employeeCounts = $app->getEmployees();
$companyCounts = $app->getCompanies();
$patientCounts = $app->getPatients();
// echo  "<br><br><br>==>".sizeOf($employeeCounts);   

//echo "<br><br><br>===>".json_encode($departments)."<br>";
//$uCount = sizeOf($usersp);


?>


    <section class="content">
      
      <div class="row">
      <div class="col-md-2 col-sm-12  col-xs-12">
          <div class="row">
              <div class="col-md-12 col-sm-12  col-xs-12">
                <?php if($_SESSION['acl']['company']==1): ?>
                <a href="index.php?page=company">  
                <?php endif ?>
                <div class="info-box">
                  <span class="info-box-icon bg-blue"><i class="fa fa-suitcase"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Partners</span>
                    <span class="info-box-number"><?php echo sizeOf($companyCounts); ?></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <?php if($_SESSION['acl']['employee']==1): ?>
                </a>
                <?php endif ?>
                <!-- /.info-box -->
              </div>
              <div class="col-md-12 col-sm-12  col-xs-12">
                <?php if($_SESSION['acl']['patients']==1): ?>
                <a href="index.php?page=patients">  
                <?php endif ?>
                <div class="info-box">
                  <span class="info-box-icon bg-yellow"><i class="fa fa-stethoscope"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Patient(s)</span>
                    <span class="info-box-number"><?php echo sizeOf($patientCounts); ?></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <?php if($_SESSION['acl']['employee']==1): ?>
                </a>
                <?php endif ?>
                <!-- /.info-box -->
              </div>
              <div class="col-md-12 col-sm-12  col-xs-12">
                <?php if($_SESSION['acl']['employee']==1): ?>
                <a href="index.php?page=employee">  
                <?php endif ?>
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Employee(s)</span>
                    <span class="info-box-number"><?php echo sizeOf($employeeCounts); ?></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <?php if($_SESSION['acl']['employee']==1): ?>
                </a>
                <?php endif ?>
                <!-- /.info-box -->
              </div>
          </div>  
        </div>  
        <div class="col-md-10 col-sm-12  col-xs-12">
          <!-- USERS LIST -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Enqueued Patient(s)</h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger"><?php echo $uCount; ?> Patients</span>
                    <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>-->
                    <!--</button>-->
                    <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>-->
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                       <table class="table">
                                <tbody id="enid">
                              </tbody></table>
                    
                    
                    
                  
                </div>
               
              </div>
              <!--/.box -->
        </div>  


           
      </div>
      
    </section>
    
<script>
  function deleteProcess(dt, qn){
    //alert(dt+qn);
    if (confirm('Are you sure you want to delete this '+qn+'?')) {
            window.location.href = "?page=home&dqn="+qn+"&dt="+dt;
        }
  }
</script>  

