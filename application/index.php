<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Authoritative Content LLC | Application Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style type="text/css">
    
    .login-box, .register-box {
    width: 760px;
    margin: 7% auto;
    margin-top: 2%;
}

  </style>
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <?php 
    $message =  "";
    include '../core/core.php';
    $app = new mckirby();  
    $vacancy = $app->getVacancy();


    if(isset($_POST['apply'])){
      //echo json_encode($_POST);
      $allowedExts = array(
        "pdf", 
        "doc", 
        "docx"
      ); 

      $allowedMimeTypes = array( 
        'application/msword',
        'text/pdf',
        'image/gif',
        'image/jpeg',
        'image/png',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
      );
      
      $extension = end(explode(".", $_FILES["file"]["name"]));

      if ( 20000 < $_FILES["file"]["size"]  ) {
        $message =  'Please provide a smaller file [E/1].' ;
      }

      if ( ! ( in_array($extension, $allowedExts ) ) ) {
        $message =  'Please provide another file type [E/2].';
      }

      if ( in_array( $_FILES["file"]["type"], $allowedMimeTypes ) ) 
      {      
        $nf = $app->RandomString(); 
        $fileNew = "../uploads/" .$nf.".".$extension;
        $fileNew2 = "uploads/" .$nf.".".$extension;
        move_uploaded_file($_FILES["file"]["tmp_name"],  $fileNew); 
        $data = array("model"=>"application",
                      "keys"=>"fname, mname, lname, department_id, email, vacancy_id, openletter",
                      "values"=>"'".$_POST['fname']."', '".$_POST['mname']."', '".$_POST['lname']."', '".$vacancy[$_GET['id']]['department_id']."', '".$_POST['email']."', '".$_GET['id']."', '".$_POST['openletter']."'");
        $rid = $app->create2($data);
        //echo json_encode($rid[id])."<=";

        $adata = array("model"=>"attachments", 
                       "keys"=>"amodel, amodel_id, attachment",
                       "values"=>"'application', '".$rid['id']."', '$fileNew2'");
        $rid = $app->create2($adata);
        $message = 1;  
      }
      else
      {
       $message =  'Please provide another file type [E/3].'.$_FILES["file"]["type"];
      }
      
    }


    if(isset($_GET['id'])){  
    
    ?>
    <b><?php echo $vacancy[$_GET['id']]['title']; ?></b>

    </div>
    <b>Description</b>:
    <p>
    <?php echo $vacancy[$_GET['id']]['description']; ?>
    </p>

  <div class="register-box-body">
    <p class="login-box-msg">Fill-up Application Form</p>

    
    <?php

    
    if($message==1){
                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-check"></i> Message!</h4>
                Application submitted successfully!
              </div>';
    }
    if($message!=1 && $message!=""){
          echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-check"></i> Message!</h4>
                '.$message.'!
              </div>';
    }

    ?>


    <form action="" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-6">  
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="First Name" name="fname" required="">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Middle Name" name="mname" required="">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Last Name" name="lname"  required="">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="email" class="form-control" placeholder="Email" value="maverick@authoritativecontentllc.com" name="email" required="">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
      </div>
      <div class="col-md-6">  
        <div class="form-group has-feedback">
          <textarea  rows="6" cols="100" class="form-control" name="openletter" required=""></textarea> 
          <span class="glyphicon glyphicon-file form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="file" class="form-control" placeholder="Resume/CV" name="file" required="">
          <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        </div>

       
        
      </div> 
      <div class="form-group ">
            <button type="submit" name="apply" class="btn btn-primary btn-block btn-flat">Apply</button>
          </div> 
    </form>

    

  </div>
    <?php }else{ } ?>
  
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
