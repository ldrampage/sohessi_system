<!-- Main content -->
<?php
 error_reporting(E_ALL); ini_set('display_errors', 1);
$response=array('action'=>"", 'message'=>"");
$cur = array("subject"=>"","concern"=>"","status"=>"");
if(isset($_POST['btn_save'])){
     date_default_timezone_set('America/New_York');
        $date = date('Y-m-d h:i:s', time());

    $data = array('model'=>"tickets");

    if(isset($_POST['id'])){
        $dataf = array('model'=>"tickets");
        //if($_POST['status']==1){
            $dataf['values']="status = '".$_POST['status']."', date_fixed = '".$date."', priority = '".$_POST['priority']."'";
        //}else{
        //    $data['values']="status = '".$_POST['status']."'";
        //}
        $dataf['condition'] = " WHERE id = '".$_POST['id']."'";
        
        $response = $app->update2($dataf);
        if($_POST['status']==1){
            $statusX=" Closed";
        //}else $statusX=" Open";
        $email_to ="";
        $adminUsers = getAdminUsers();  
        //echo json_encode($adminUsers);
        $p = 0;
        foreach($adminUsers as $k => $v){
            $pcon = "";
            if($p>0){ $pcon=",";  }
            if($v['email']!=""){
                //echo $p.") ".$v['email']."<br>";
                $email_to = $email_to.$pcon.$v['email'];
                $p++; 
            }
           
        } 
        $curx = $app->getRecord2($dataf);
        //echo $curx['data'][0]['concern'];
       
        $Eusername=getMyUsers($curx['data'][0]['uid']); 
        
        $email_to=$email_to.",".$Eusername[0]['email'];
        
        $email_message = "";
        $name= $_SESSION['username'];    
        $Eusername=getMyUsers($_SESSION['user_id']); 
        $email_subject = $curx['data'][0]['subject'];
        
         
        
        $email_message .= '<html>';
        $email_message .= '<head><meta name="viewport" content="width=device-width" /><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
        $email_message .= '<style>';
        $email_message .='* {margin: 0;font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;}img {max-width: 100%;}';
        $email_message .='body {background-color: #f6f6f6;}'; 
        $email_message .= 'table td {vertical-align: top;}.body-wrap {background-color: #f6f6f6; width: 100%;}.container {display: block !important;max-width: 600px !important;margin: 0 auto !important;clear: both !important;}';
        $email_message .= '.content {max-width: 600px; margin: 0 auto;display: block; padding: 20px;}';
        $email_message .= '.main {background-color: #fff;border: 1px solid #e9e9e9;border-radius: 3px;}.content-wrap { padding: 20px;}.content-block {padding: 0 0 20px;}';
        $email_message .= '.header {width: 100%;margin-bottom: 20px;}.footer { width: 100%;clear: both;color: #999;padding: 20px;}.footer p, .footer a, .footer td {color: #999; font-size: 12px;}';
        $email_message .= 'a {color: #348eda;text-decoration: underline;}';
        $email_message .= '.btn-primary { text-decoration: none;color: #FFF;background-color: #348eda;border: solid #348eda; border-width: 10px 20px;line-height: 2em;font-weight: bold;text-align: center;cursor: pointer;display: inline-block;border-radius: 5px;text-transform: capitalize;}';
    
        $email_message .= '</style>';
        $email_message .= '<title></title></head>';
        $email_message .= '<body itemscope itemtype="http://schema.org/EmailMessage" style="width: 100% !important; height: 100%; line-height: 1.6em;"><table class="body-wrap">';
       
        
        $email_message .= '<tr><td></td>';
        
        $email_message .= "<td class='container' width='600'><div class='content'><table class='main' width='100%' cellpadding='0' cellspacing='0'>";
        $email_message .= "<tr><td class='alert alert-warning'></td></tr><tr>";
        $email_message .= '<td class="content-wrap"><table width="100%" cellpadding="0" cellspacing="0">';
        
        $email_message .= "<tr><td><strong>Ticket Update</strong></td></tr><br>";
        $email_message .= "<tr><td><strong>Update by: </strong> " . strip_tags($name) . "</td></tr>";
        $email_message .= "<tr><td><strong>Email:  </strong> " . strip_tags(trim($Eusername[0]['email'])) . " </td></tr>";
    	//$email_message .= "<tr><td><strong>Ref. #:  </strong> " . strip_tags($ticket['refno']) . " </td></tr>";
    	$email_message .= "<tr><td><strong>Subject: </strong>" . strip_tags($email_subject) . "</td></tr>";
    	$email_message .= "<tr><td><strong>Status: </strong>" . strip_tags($statusX) . "</td></tr><br>";
        
        $email_message .= '<br><tr><td class="content-block"><strong>Concern:</strong></td></tr>';
        $email_message .= "<tr><td class='content-block'>".trim($curx['data'][0]['concern'])."</td></tr>";
        //$email_message .= '<tr><td class="content-block"><strong>Comment:</strong></td></tr>';
        //$email_message .= "<tr><td class='content-block'>".$comments."</td></tr>";
    	$email_message .= "<tr><td class='content-block'><a href='http://support.backoffice-services.net/?page=tickets-view&id=".$_POST['id']."' class='btn-primary'>click here</a></td></tr>";
        $email_message .= '<tr><td class="content-block">Authoritative Content LLC.</td></tr></table></td></tr>';
    	
    	$email_message .= '	</td><td></td></tr></table>';	
    
    
    	
    	$email_message .= "</body></html>";
    	//echo $email_message;
        
        // $email_message = "Name: ".trim($name)."<br>";
        // $email_message .= "Email: ".trim($Eusername[0]['email'])."<br>";
        
        // $email_message .= "Comments: ".trim($_POST['concern'])."<br>";
        // $email_message .= ""."<a href='http://support.backoffice-services.net/?page=tickets-view&id=".$_POST['id']."'>click here</a>"."<br>"; 
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: '.$Eusername[0]['email']."\r\n".
            'Reply-To: '.$Eusername[0]['email']."\r\n" ;
           // echo "<br>".$headers; 
        
            
            
        @mail($email_to, $email_subject, $email_message, $headers);
        
        }
        
    }else{
        
        $dts = array(
        'model'=>'tickets'
        );
        $cur = $app->getRecord2($dts);
        $count=$cur['affected'];
        $n=$count+1;
        
        $ran = $app->RandomString2(5);
        $rid = "AC-".$ran."-".$n;

        $data2 = array(
            'model'=>'tickets',
            'keys'=>'uid, subject, concern, status, refno, date_open, priority',
            'values'=>"'".$_SESSION['user_id']."', '".str_replace("'","\'",$_POST['subject'])."', '".str_replace("'","\'",$_POST['concern'])."', '0', '".$rid."', '".$date."', '".$_POST['priority']."'"
        );
        //echo "<br>".json_encode($data2);
        $response = $app->create2($data2);
        if($response['message']==null) echo "<br> Error Saving Ticket!";
       // $response['message'] = "Successful";
        //echo $response['message'];
    if($response['message']!=null){
         $total = count($_FILES['file']['name']);
   
        // Loop through each file
        for($i=0; $i<$total; $i++) {
          // echo "<br><br>".$_FILES['file']['tmp_name'][$i];
          //Get the temp file path
          $tmpFilePath = $_FILES['file']['tmp_name'][$i];
        
          //Make sure we have a filepath
          if ($tmpFilePath != ""){
            //Setup our new file path
            $newFilePath = "uploads/" . $_FILES['file']['name'][$i];
        
            //Upload the file into the temp dir
            if(move_uploaded_file($tmpFilePath, $newFilePath)) {
        
              $datas = array(
                    'model'=>'attachments',
                    'keys'=>'modelname, modelid, filename, date, uid',
                    'values'=>"'tickets', '".$response['id']."', '".$newFilePath."', '".$date."', '".$_SESSION['user_id']."'"
                );
                $rn = $app->create2($datas);
                $rn['message'] = "Successful";
        
            }
          }
        }
    
    $email_message = "";
    $email_to ="";
    $adminUsers = getAdminUsers();  
    //echo json_encode($adminUsers);
    $p = 0;
    foreach($adminUsers as $k => $v){
        $pcon = "";
        if($p>0){ $pcon=",";  }
        if($v['email']!=""){
            //echo $p.") ".$v['email']."<br>";
            $email_to = $email_to.$pcon.$v['email'];
            $p++; 
        }
       
    }     
    $name= $_SESSION['username'];    
    $Eusername=getMyUsers($_SESSION['user_id']); 
    $email_subject = $_POST['subject'];    
    
        $email_message .= '<html>';
        $email_message .= '<head><meta name="viewport" content="width=device-width" /><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
        $email_message .= '<style>';
        $email_message .='* {margin: 0;font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;}img {max-width: 100%;}';
        $email_message .='body {background-color: #f6f6f6;}'; 
        $email_message .= 'table td {vertical-align: top;}.body-wrap {background-color: #f6f6f6; width: 100%;}.container {display: block !important;max-width: 600px !important;margin: 0 auto !important;clear: both !important;}';
        $email_message .= '.content {max-width: 600px; margin: 0 auto;display: block; padding: 20px;}';
        $email_message .= '.main {background-color: #fff;border: 1px solid #e9e9e9;border-radius: 3px;}.content-wrap { padding: 20px;}.content-block {padding: 0 0 20px;}';
        $email_message .= '.header {width: 100%;margin-bottom: 20px;}.footer { width: 100%;clear: both;color: #999;padding: 20px;}.footer p, .footer a, .footer td {color: #999; font-size: 12px;}';
        $email_message .= 'a {color: #348eda;text-decoration: underline;}';
        $email_message .= '.btn-primary { text-decoration: none;color: #FFF;background-color: #348eda;border: solid #348eda; border-width: 10px 20px;line-height: 2em;font-weight: bold;text-align: center;cursor: pointer;display: inline-block;border-radius: 5px;text-transform: capitalize;}';
    
        $email_message .= '</style>';
        $email_message .= '<title></title></head>';
        $email_message .= '<body itemscope itemtype="http://schema.org/EmailMessage" style="width: 100% !important; height: 100%; line-height: 1.6em;"><table class="body-wrap">';
       
        
        $email_message .= '<tr><td></td>';
        
        $email_message .= "<td class='container' width='600'><div class='content'><table class='main' width='100%' cellpadding='0' cellspacing='0'>";
        $email_message .= "<tr><td class='alert alert-warning'></td></tr><tr>";
        $email_message .= '<td class="content-wrap"><table width="100%" cellpadding="0" cellspacing="0">';
        
        $email_message .= "<tr><td><strong>New Ticket </strong></td></tr><br>";
        $email_message .= "<tr><td><strong>From: </strong> " . strip_tags($name) . "</td></tr>";
        $email_message .= "<tr><td><strong>Email:  </strong> " . strip_tags(trim($Eusername[0]['email'])) . " </td></tr>";
    	//$email_message .= "<tr><td><strong>Ref. #:  </strong> " . strip_tags($ticket['refno']) . " </td></tr>";
    	$email_message .= "<tr><td><strong>Subject: </strong>" . strip_tags($email_subject) . "</td></tr><br>";
        
        $email_message .= '<br><tr><td class="content-block"><strong>Concern:</strong></td></tr>';
        $email_message .= "<tr><td class='content-block'>".trim($_POST['concern'])."</td></tr>";
        //$email_message .= '<tr><td class="content-block"><strong>Comment:</strong></td></tr>';
        //$email_message .= "<tr><td class='content-block'>".$comments."</td></tr>";
    	$email_message .= "<tr><td class='content-block'><a href='http://support.backoffice-services.net/?page=tickets-view&id=".$response['id']."' class='btn-primary'>click here</a></td></tr>";
        $email_message .= '<tr><td class="content-block">Authoritative Content LLC.</td></tr></table></td></tr>';
    	
    	$email_message .= '	</td><td></td></tr></table>';	
    
    
    	
    	$email_message .= "</body></html>";
    	
    	//echo $email_message;
    
    // $email_message = "Name: ".trim($name)."<br>";
    // $email_message .= "Email: ".trim($Eusername[0]['email'])."<br>";
    
    // $email_message .= "Comments: ".trim($_POST['concern'])."<br>";
    // $email_message .= ""."<a href='http://support.backoffice-services.net/?page=tickets-view&id=".$response['id']."'>click here</a>"."<br>"; 
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: '.$Eusername[0]['email']."\r\n".
        'Reply-To: '.$Eusername[0]['email']."\r\n" ;
      // echo "<br>".$headers; 
    
        
     // $email_to ="john.villar@authoritativecontentllc.com";  
      @mail($email_to, $email_subject, $email_message, $headers);
    }
   }

}

if(isset($_GET['id'])){
    $action = "Update";

    $ds = array(
        'model'=>'tickets',
        'condition'=>" WHERE id = '".$_GET['id']."'"
    ); 
    $cur = $app->getRecord2($ds); 
    $cur=$cur['data'][0];
}else{ $action = "Create";

    $cur['priority'] = 1;
}



?>
<section class="content" >


    <div class="row">
        <div class="col-xs-12">

            <?php

            if($response['message']=="Successful"){

                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                Record Saved Successfully!
              </div>';
            }


            ?>


        </div>
        <div class="col-xs-12">
            <form name="user" method="post"  enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                        <h4 class="modal-title" id="myModalLabel"><?php echo $action; ?> Ticket</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <div class="form-group" style="margin-bottom: 0px; ">

                                    <?php if(isset($_GET['id'])): ?>
                                        <input type="hidden" class="form-control" name="id" value="<?php echo $_GET['id']; ?>" required />
                                    <?php endif; ?>
                                </div>


                                 <?php if(!isset($_GET['id'])): ?>
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Subject</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="subject" id="subjectx" name="subject" oninput ="inputSubjectX()" <?php if(isset($_GET['id'])){ echo "value='".$cur['subject']."'"; } ?> required />
                                </div>


                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Concern</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <textarea id="concern" class="form-control" placeholder="concern" id ="concern" name="concern" required><?php if(isset($_GET['id'])){ echo "value='".$cur['concern']."'"; } ?></textarea>    
                                </div>
                                
                                <?php endif; ?>
                                
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Priority</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                   
                                    <select name="priority" class="form-control">
                                        <option value="1" <?php if($cur['priority']==1){ echo "selected"; } ?>>Minor</option>
                                        <option value="2" <?php if($cur['priority']==2){ echo "selected"; } ?>>Moderate</option>
                                        <option value="3" <?php if($cur['priority']==3){ echo "selected"; } ?>>Major</option>
                                    </select>    
                                </div>
                                
                                <?php if(isset($_GET['id'])): ?>
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Status</label>
                                    <?php $options = $app->getStatus(); ?>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <select name="status"  class="form-control"  required>
                                        <?php foreach($options as $k => $v): $s=""; if($k==$cur['status']): $s="selected"; endif;?>
                                            <option value="<?php echo $k; ?>" <?php echo $s; ?>><?php echo $v; ?></option>
                                        <?php endforeach; ?>    
                                    </select>    
                                </div>
                                <?php endif; ?>
                                <?php if(!isset($_GET['id'])): ?>
                                <div class="pull-right"><label class="btn btn-success btn-xs" id="addfile"> + Add Another</label> </div>
                                <div id="ups">
                                   
                                
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>File</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="file" class="form-control" placeholder="file" name="file[]"    multiple="multiple"/>
                                </div>
                                </div>
                                <?php endif; ?>
                                
                                

                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="btn_save" class="btn btn-success fa fa-plus-square btn-sm" value="<?php echo $action; ?>">
                    </div>
                </div>
            </form>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
<script>
    $("#domain").on("change", function(){
        $("#webfolder").val($(this).val());
    });
    $("#addfile").click(function(){
       // alert(1);
        $("#ups").append('<div class="form-group" style="margin-bottom: 0px; "><input type="file" class="form-control" placeholder="file" name="file[]"    multiple="multiple"/></div>');
    });
</script>

<script>
function inputSubjectX() {
    var x = document.getElementById("subjectx").value;
    var str =x.replace(/[^A-Za-z0-9\-, .?/]/g, "");
    document.getElementById("subjectx").value=str;
}

</script>
