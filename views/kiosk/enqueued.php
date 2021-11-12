<?php //session_start(); ?>
<style>
    
    
    .skin-blue .wrapper {
        background:transparent;
    }
    
    body {
        background:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),url('kiosk.jpg') center;
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
    .login-box, .register-box {
        width: 90%;
        margin: 7% auto;
    }

    .btn-kiosk{
      padding: 20px;
      font-size: 20px;
      width: 100%;
      margin-bottom: 20px;
      margin-top: 20px;
    }
    .btn-bread{
      margin-bottom: 10px;
      margin-top: 10px;
      padding: 10px;
      font-size: 20px;\
      width: 100%;
    }
    .login-box, .register-box {
    width: 90%;
     margin: 1% auto; 
}
  .home-div>a{
    font-size: 30px;
  }
   .back-div>a{
    font-size: 30px;
  }


.dropdown.dropdown-lg .dropdown-menu {
    margin-top: -1px;
    padding: 6px 20px;
}
.input-group-btn .btn-group {
    display: flex !important;
}
.btn-group .btn {
    border-radius: 0;
    margin-left: -1px;
}
.btn-group .btn:last-child {
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
}
.btn-group .form-horizontal .btn[type="submit"] {
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
}
.form-horizontal .form-group {
    margin-left: 0;
    margin-right: 0;
}
.form-group .form-control:last-child {
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}
.table{
  background-color: #FFFFFF;
  font-size: 32px;
  font-weight: bold;
}
.theading{
  text-align: center;
}
.t_title{
  background-color: #FFF;
  padding: 8px;
  border-radius: 5px;
  font-size: 35px;
  font-weight: bold;
}
tr:nth-child(even) {background: #FFF}

@media screen and (min-width: 768px) {
    #adv-search {
        width: 500px;
        margin: 0 auto;
    }
    .dropdown.dropdown-lg {
        position: static !important;
    }
    .dropdown.dropdown-lg .dropdown-menu {
        min-width: 500px;
    }
}
</style>

<div class="row">


<?php
$patient = $app->getPatients();
$now = date("Y-m-d");
$nowF = date("Y-m-d H:i:s", strtotime($now." 05:00:00"));
$nowT = date("Y-m-d H:i:s", strtotime($now." 24:59:59"));
$en1 = $app->getEnqueued(" WHERE dtime>='".$nowF."' AND  dtime<='".$nowT."' AND trans_type='Laboratory' ORDER BY dtime ASC");
$en2 = $app->getEnqueued(" WHERE dtime>='".$nowF."' AND  dtime<='".$nowT."' AND trans_type='Check-up' ORDER BY dtime ASC");
// echo json_encode($en1);
?>

 
</div>

<center><img src="header.png" width="" style="margin-top: 15px; height: 100px;" alt="Sohessi Software"></center>

<div class="login-box">
  <div class="login-box-body" style="text-align: center;">
    <div class="row">
      <div class="col-md-4">
        <h3 class="t_title">Payment</h3>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th class="theading">QUEUING #</th>
                    <th class="theading">First Name</th>
                </tr>
            </thead>
            <tbody id="payment">
                <?php foreach($en1 as $k => $v): ?>
                <tr>
                    <td><?php echo $v['queuing_number']; ?></td>
                    <td><?php echo $patient[$v['patient_id']]['fname']." ".$patient[$v['patient_id']]['lname']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
      </div>
      <div class="col-md-4">
         <h3 class="t_title">CONSULTATION QUEUING</h3>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th class="theading">QUEUING #</th>
                    <th class="theading">First Name</th>
                </tr>
            </thead>
            <tbody id="consult">
                <?php foreach($en2 as $k => $v): ?>
                <tr>
                    <td><?php echo $v['queuing_number']; ?></td>
                    <td><?php echo $patient[$v['patient_id']]['fname']." ".$patient[$v['patient_id']]['lname']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
      </div>  
      <div class="col-md-4">
        <h3 class="t_title">LAB TEST QUEUING</h3>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th class="theading">QUEUING #</th>
                    <th class="theading">First Name</th>
                </tr>
            </thead>
            <tbody id="labtest">
                <?php foreach($en1 as $k => $v): ?>
                <tr>
                    <td><?php echo $v['queuing_number']; ?></td>
                    <td><?php echo $patient[$v['patient_id']]['fname']." ".$patient[$v['patient_id']]['lname']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
      </div> 

    </div>
  </div>
</div>


<img src="hn.png" class="img-responsive logo-bottom" width="200" alt="logo">
<script>

 function chechEnqued(){
  $.ajax({
        url: "checkEnqueued.php",
        type: "post",
        data: { en: 102 },
        success: function (response) {
          $("#payment").html(response);

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });

   $.ajax({
        url: "checkEnqueued.php",
        type: "post",
        data: { en: 100 },
        success: function (response) {
          $("#consult").html(response);

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });

    $.ajax({
        url: "checkEnqueued.php",
        type: "post",
        data: { en: 101 },
        success: function (response) {
          $("#labtest").html(response);

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });
}



 chechEnqued();  
    setInterval(function(){ 
        chechEnqued();  
    }, 10000);

</script>  
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->


