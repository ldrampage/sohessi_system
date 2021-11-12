<?php

session_start(); //exit();
if(isset($_GET['logout'])){
        session_destroy();
        echo "<script>window.location = 'index.php?page=login'; </script>";
    }
header('Content-Type: text/html; charset=ISO-8859-1');
include 'core/core.php'; 
$app = new mckirby();
if(isset($_GET['page'])){ $page=$_GET['page']; }else{ $page="home"; }
if(!isset($_SESSION['login_id'])){
  if($page!="login" && $page!="kiosk" && $page!="enqueued"){
    echo "<script>location.href='?page=login';</script>";
  }
}else{

  $_SESSION['acl'] = $app->ACLfeatures($_SESSION['login_id']);
  $useri['photo'] = $_SESSION['login_photo'];
  $useri['username'] = $_SESSION['login_user'];
 //echo "<br><br><br>".json_encode($_SESSION['acl']);
}
//echo "<br><br><br>".json_encode($_SESSION);

?>
<!DOCTYPE html>
<html>

 

<head>
  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>South Occupational Health & Safety Services, Inc. | Software</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="libs/font-awesome-4.6.3/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="libs/ionicons-2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  




  <!-- <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css"> -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <link rel="stylesheet" href="plugins/colorpicker/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  

  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
   

  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="kioskp/jqbtk.css">
  
  <style type="text/css">

  .no-side-bar{
    margin-left: 0px;
  }
  .enable{
    
  }

  .swal2-popup {
      font-size: 1.6rem !important;
  }


  <style>
  .full button span {
    background-color: limegreen;
    border-radius: 32px;
    color: black;
  }
  .partially button span {
    background-color: orange;
    border-radius: 32px;
    color: black;
  }

  .skin-blue .main-header .navbar {
      background-color: #4dc7bc;
  }
  .skin-blue .main-header .logo {
      background-color: #22b7aa;
      color: #fff;
      border-bottom: 0 solid transparent;
  }
  .skin-blue .main-header .logo:hover {
      background-color: #7df0e6;
      color: #222d32;
  }
  .skin-blue .main-header .navbar .sidebar-toggle:hover {
      color: #fff;
      background-color: #45b3a9;
  }
  .e-callout{
      border-radius: 3px;
      margin: 0 0 10px 0;
      padding: 5px 50px 5px 5px;
      text-align: center;
  }
  .skin-blue .main-header li.user-header {
      background-color: #0c9a59;
  }

  .main-header {
      position: fixed;
      max-height: 100px;
      z-index: 1030;
      left: 0;
      top: 0;
      right: 0;
  }

  .input-sm {
    height: 25px;
}
    .profile-user-img{
        max-height: 100px;
    }
    .content {
    min-height: 650px;
    }
    .user-panel>.image>img {
    max-width: 45px;
    max-height: 45px;
    }
 

  </style>


  <script src="libs/js/sha256.js"></script>
<!--   <script src="libs/js/angular.min.js"></script> -->
<!-- <script src="libs/js/ui-bootstrap-tpls-2.0.0.min.js"></script> -->
<!-- <script src="libs/js/angular-route.min.js"></script> -->


<!-- 
 <script src="libs/js/ngStorage.js"></script> -->





<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>


<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>

<!-- <script src="controller/mainController.js"></script> -->

<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="plugins/chartjs/Chart.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script> -->

<script src="plugins/select2/select2.full.min.js"></script>
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>  

<!-- <script src="plugins/daterangepicker/daterangepicker.js"></script> -->

<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>


<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="plugins/daterangepicker/moment.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>

<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="plugins/toastr/toastr.min.js"></script>


<script src="dist/js/demo.js"></script>
<!-- AdminLTE App -->

<!-- AdminLTE for demo purposes -->



  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
 
 <script>
  function makeUser() {
    var text = "";
    var possible = "123456789";

    for (var i = 0; i < 4; i++)
      text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
  }
  function makeRandom() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789!&#@+";

    for (var i = 0; i < 8; i++)
      text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
  }
  function makeCode() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNPQRSTUVWXYZ123456789";

    for (var i = 0; i < 4; i++)
      text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
  }
  function makeCodeId(count=10) {
    var text = "";
    var possible = "ABCDEFGHIJKLMNPQRSTUVWXYZ123456789";

    for (var i = 0; i < count; i++)
      text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
  }
 </script>
</head>
<!--<body class="hold-transition skin-blue sidebar-mini">-->
<body class="skin-blue sidebar-mini fixed sidebar-collapse"><!--hold-transition skin-blue sidebar-mini fixed-->
<!-- <input type="text" class="form-control pull-right" id="datepicker"><br><br> -->
<div class="wrapper">
<?php if(isset($_GET['page'])){ $page = $_GET['page']; }else{ $page = 'home'; } ?>
  
  <?php if($page!="login" && $page!="kiosk" && $page!="enqueued"): require_once('header.php'); endif; ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php if($page!="login" && $page!="kiosk" && $page!="enqueued"): require_once('sidebar-left.php'); endif;   ?>

  <!-- Content Wrapper. Contains page content -->
  <?php 
        switch ($page) {
          case 'login':
               include 'views/login/login.php';
            break;
          case 'kiosk':
               include 'views/kiosk/index.php';
            break;
          case 'enqueued':
               include 'views/kiosk/enqueued.php';
            break;    
          default:
            include('body.php');
            break;
        }
      

      ?>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php //require_once('body.php'); ?>


  <?php if($page!="login" && $page!="kiosk" && $page!="enqueued"): require_once('footer.php'); endif; ?>
  
  
   <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->

      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  

</div>
<!-- ./wrapper -->

<!-- page script -->
<script src="kioskp/jqbtk.js"></script>
<?php if(trim($page)=="home"): //echo "<script>alert('".$page."');</script>"; ?>
    <script>
      function checkEnq(){
       $.ajax({
              url: "enq.php",
              type: "post",
              data:  "",
              success: function (response) {
                // alert(response);    
                 $("#enid").html(response);          

              },
              error: function(jqXHR, textStatus, errorThrown) {
                 console.log(textStatus, errorThrown);
              }


          });
      }
    checkEnq();
    setInterval(function(){ 
        checkEnq();  
    }, 10000);
    
    </script>
  <?php endif; ?>

<?php if(trim($page)=="process-test"): //echo "<script>alert('".$page."');</script>"; ?>
    <script>
      function checkEnq(){
       $.ajax({
              url: "enq.php",
              type: "post",
              data:  "",
              success: function (response) {
                // alert(response);    
                 $("#enid").html(response);          

              },
              error: function(jqXHR, textStatus, errorThrown) {
                 console.log(textStatus, errorThrown);
              }


          });
      }
//checkEnq();
    setInterval(function(){ 
       // checkEnq();  
    }, 10000);
    </script>
  <?php endif; ?>


<script>

   //  $('#timepicker1').timepicker();

    $(function () {
        $("#example1").DataTable();
        $("#example2").DataTable();
//        $('#example2').DataTable({
//            "paging": true,
//            "lengthChange": false,
//            "searching": false,
//            "ordering": true,
//            "info": true,
//            "autoWidth": false
//        });
         $("#example3").DataTable();
         // $('#example1_filter').empty();
         // $('div#example1_filter').html('<label>Search:<input type="text" class="form-control input-sm keyboard" placeholder="" aria-controls="example1"></label>');

         //$("#example1_filter>label>input").addClass("keyboard");
    });

      // $("#example1_filter>input").addClass("keyboard");
       //$('div#example1_filter').find('input').addClass('keyboard');
      
       //$('div#example1_filter').html('<label>Search:<input type="search" class="form-control input-sm keyboard" placeholder="" aria-controls="example1"></label>');

    $('.keyboard').keyboard();
    //alert(1);

//alert(2);
  
   function submitSession(){ 
        <?php if($page!="kiosk" && $page!="login" && $page!="enqueued"): ?>
         $.ajax({
            url: "updateSession.php",
            type: "post",
            data: {"isd": <?php echo $_SESSION['login_id']; ?>},
            success: function (response) {
               // you will get response from your php page (what you echo or print)                 
    
            }
    
        });
         <?php endif; ?>
       
        <?php if($page=="home" || $page=="new"): ?>
        //alert(1);
        /*
        $.ajax({
            url: "checkElapse.php",
            type: "post",
            success: function (response) {
               
              //console.log(response);
              var parsed = JSON.parse(response);

                var arr = [];
                for(var x in parsed){
                  //console.log(parsed[x]['form']);
                  //console.log(parsed[x]['elapse']);
                  if(parsed[x]['elapse']=="Online"){
                  $("#"+parsed[x]['form']).html('<img src="images/online.png" style="margin-top: -2px;width: 10px;">&nbsp;'+parsed[x]['elapse']);
                  }else{
                  $("#"+parsed[x]['form']).html('<img src="images/offline.png" style="margin-top: -2px;width: 10px;">&nbsp;'+parsed[x]['elapse']);
                  }
                }
               
              // console.log(response);
              // you will get response from your php page (what you echo or print)                 
    
            }
    
        });
        /*
        var tarckcheck = "<?php if($page=="new" || $page=="home"){ echo "trackcheckv3.php"; }else{ echo "trackcheck.php"; } ?>";
         $.ajax({
            url: tarckcheck,
            type: "post",
            success: function (response) {
               
              //console.log(response);
              var parsed = JSON.parse(response);

                var arr = [];
                for(var x in parsed){
                  //console.log(parsed[x]+"=>"+x);
                  $("#track_"+x).text(parsed[x]);
                 
                }
               
              // console.log(response);
              // you will get response from your php page (what you echo or print)                 
    
            }
    
        });*/
        <?php endif; ?>
            
    }
    
    submitSession();  
    setInterval(function(){ 

        submitSession();  
    }, 10000);
  
</script>
<script>



    var products = [];


        



    

  function PrintElem(elem, title)
    {
      var mywindow = window.open('', 'PRINT', 'height=400,width=600');


        mywindow.document.write('<html><head><title>' + document.title  + '</title>');

        mywindow.document.write('</head><body >');
      mywindow.document.write('<h3>' + title  + '</h3>');
        mywindow.document.write(document.getElementById(elem).innerHTML);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        mywindow.close();

        return true;

        }




  $(function () {
      //Initialize Select2 Elements
      $(".select2").select2();

      //Datemask dd/mm/yyyy
      $("#datemask").inputmask("yyyy/mm/dd", {"placeholder": "yyyy/mm/dd"});
      //Datemask2 mm/dd/yyyy
      $("#datemask2").inputmask("yyyy/mm/dd", {"placeholder": "yyyy/mm/dd"});
      //Money Euro
      $("[data-mask]").inputmask();

      //Date range picker
      $('#reservation').daterangepicker({format: 'YYYY/MM/DD'});
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'YYYY/MM/DD h:mm A'});
      //Date range as a button
      $('#daterange-btn').daterangepicker(
          {
              ranges: {
                  'Today': [moment(), moment()],
                  'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                  'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                  'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                  'This Month': [moment().startOf('month'), moment().endOf('month')],
                  'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate: moment()
          },
          function (start, end) {
              $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          }
      );
     


      //Date picker
     
      $(".current_day").timepicker({
          autoclose: true
      });
      $('#datepicker').datepicker({
          autoclose: true
      });
      $('#datepicker2').datepicker({
          autoclose: true
      });
      $('#datepicker3').datepicker({
          autoclose: true
      });
      $('#datepicker4').datepicker({
          autoclose: true
      });
    //   $(".timepicker").timepicker({
    //       showInputs: false
    //   });
      

      //iCheck for checkbox and radio inputs
      $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
      });
      //Red color scheme for iCheck
      $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
      });
      //Flat red color scheme for iCheck
      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
      });

      //Colorpicker
      $(".my-colorpicker1").colorpicker();
      //color picker with addon
      $(".my-colorpicker2").colorpicker();

      //Timepicker
      
  });

  function setDateRange(from,to){
    $("#reservation").data('daterangepicker').setStartDate(from);
    $("#reservation").data('daterangepicker').setEndDate(to);
  }











</script>
<!-- material design js -->






</body>
</html>
