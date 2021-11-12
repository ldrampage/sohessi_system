<style>
    
    
    .skin-blue .wrapper {
        background:transparent;
    }
    
    body {
        background:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),url('sh.jpeg') center;
        height:100vh;
    }
    
    .login-box {
        margin:7% auto 2% auto;
    }
    
    .login-box-body {
        background:#18232e;
        border-radius: 5px;
        padding: 30px 50px 30px 50px;
        opacity:0.9;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
    }
    
    img.logo-bottom {
        display:block;
        margin:30px auto 0 auto;
    }
    
    .login-box-msg {
        color:#94C0BB;
        font-size:15px;
        text-transform:uppercase;
        font-weight:600;
    }
    
    input {
        background:#fff;
    }
    
    input:-webkit-autofill {
     -webkit-box-shadow: 0 0 0 30px white inset;
    }
    
    .checkbox label {
        color:#fff;
        
    }
    
    input.checkbox {
        border:none;
    }

    
    .log-submit .btn-outline {
        border:1px solid white;
    }
    
    .log-submit .btn-outline:hover, .log-submit .btn-outline:active, .log-submit .btn-outline:focus {
        background:#94C0BB;
        border:1px solid #94C0BB;
        color:#fff;
        
        -webkit-transition: all 1s ease;
    	-moz-transition: all 1s ease;
    	-o-transition: all 1s ease;
    	transition: all 1s ease;
    }
    
    
</style>

<div class="login-box">
<div class="login-box-body">
   <center><img src="logo.png" width="75px;" alt="Sohessi Software"></center><br>
   
  <?php
  //require_once();
  // //$obj = new mmlapi();
  //   $some_name = session_name("hrpanel"); session_set_cookie_params(0, '/', 'localhost/'); ini_set('session.cookie_domain', 'hr.backoffice-services.net'); 
  //session_start();
  if(isset($_POST['btn_login'])){

    //$data->inputs->uname
    $data = array('method'=>'login',
            'inputs'=>array(
                'uname'=>$_POST['login_user'],
                'upass'=>$_POST['login_pass']
              )
      );
    
    $ruri = SITE_URL;
    $data = $app->userLogin($data);
     if($data==0){

      echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-ban"></i> Access Denied!</h4>
                Invalid Username Or Password!
              </div>';
    }elseif($data['status']==0){
      echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-ban"></i> Access Denied!</h4>
                Sorry your employment is inactive!
              </div>';
    }else{
        $dsp = $app->getRecordById("department",$data['department_id']);
        
        
        //echo ">>>".json_encode($managers)."<<<"; exit();
         
         $app->ACLsetDefault($data['id']);
        //echo json_encode($dsp); exit();

        $_SESSION['login_user'] = $data['fname'];
        $_SESSION['complete_name'] = $data['prename']." ".$data['fname']." ".$data['mname']." ".$data['lname'];
        $_SESSION['username'] = $data['un'];
        $_SESSION['login_photo'] = $data['image'];
        $_SESSION['login_designation'] = $data['position'];
        $_SESSION['login_department'] = $dsp['data'][0]['name'];
        $_SESSION['login_date'] = $data['last_session'];
        $_SESSION['login_id'] = $data['id'];
        $_SESSION['utype'] = $data['usertype'];
        $_SESSION['ps'] = $data['up'];
        $_SESSION['etimezone']="Asia/Manila";
        $_SESSION['category'] = json_decode($data['labcategory']);
        //$du = array("model"=>"employee", "values"=>" last_session=");
        echo '<script>window.location = "'.$ruri.'";</script>';
    }
  }


  ?>
    
    <p class="login-box-msg">SOHESSI SOFTWARE</p>

    <form  method="post" name="loginForm">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username"  name="login_user"   required/>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password"  name="login_pass"  required/>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label style="margin-left: 16px;">
              <input type="checkbox" > Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4 log-submit">
          <input type="submit" class="btn btn-outline" value="Sign In" name="btn_login" />
        </div>
        <!-- /.col -->
      </div>
    </form>
    <br>


  </div>
</div>


<img src="hn.png" class="img-responsive logo-bottom" width="200" alt="logo">

<!-- /.login-box -->

<!-- jQuery 2.2.3 -->


