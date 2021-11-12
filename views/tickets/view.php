
<?php
//error_reporting(E_ALL); ini_set('display_errors', 1);
if(isset($_GET['viewed'])){
    $app->udateNotification($_GET['viewed']);
    echo "<script> window.location.href ='?page=tickets-view&id=129';</script>";
}
$dataS = array(
    'model'=>'tickets',
    'condition'=>" WHERE id = '".$_GET['id']."'"
);
$ticket = $app->getRecord2($dataS);
$ticket=$ticket['data'][0];

$attachments = array(
    'model'=>'attachments',
    'condition'=>" WHERE modelid = '".$_GET['id']."'"
);
$att = $app->getRecord2($dataS);
$att=$att['data'][0];
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if(isset($_POST['comment'])){
     $Eusername=getMyUsers($ticket['uid']); 
     foreach($Eusername as $Ekey => $Eval){} 
     $email_to=$Eval['email'];  //"john.villar@authoritativecontentllc.com";//
     $subject =$ticket['subject'];  
     $name= $_SESSION['username'];
     $Susername=getMyUsers($_SESSION['user_id']); 
     foreach($Susername as $Skey => $Sval){}  
     $email_from= $Sval['email'];
     
     $notiData = array(
            'model'=>'notification',
            'keys'=>'user_id, action, act_id, status,user_id_to',
            'values'=>"'".$_SESSION['user_id']."', '1', '".$_GET['id']."', '1','".$ticket['uid']."'"
        );
    $sendnoti = $app->saveNotification($notiData);
    $gathercoment=$app->selectcomments($_GET['id']);
    foreach($gathercoment as $keyY => $valY){
        $notiData = array(
            'model'=>'notification',
            'keys'=>'user_id, action, act_id, status,user_id_to',
            'values'=>"'".$_SESSION['user_id']."', '1', '".$_GET['id']."', '1','".$valY['uid']."'"
        );
        $Checkvalues="SELECT * FROM tbl_notification WHERE user_id='".$_SESSION['user_id']."' AND action ='1' AND act_id = '".$_GET['id']."' AND user_id_to='".$valY['uid']."'";
        $checkExist = $app->CheckN($Checkvalues);
       
        if($checkExist==0)$sendnoti = $app->saveNotification($notiData);
        
    }
    $commentreplace = str_replace("'","\'",str_replace('"','\"',$_POST['comments']));
   $data2 = array(
            'model'=>'notes',
            'keys'=>'uid, tid, notes, date',
            'values'=>"'".$_SESSION['user_id']."', '".$_GET['id']."', '".$commentreplace."', '".date('Y-m-d h:i:s', time())."'"
        );
    $response = $app->commentscreate($data2);
    
   
    //echo json_encode($response);
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
                    'values'=>"'comments', '".$response['id']."', '".$newFilePath."', '".date('Y-m-d h:i:s', time())."', '".$_SESSION['user_id']."'"
                );
                $rn = $app->create2($datas);
                $rn['message'] = "Successful";
        
            }
          }
        }
    
    
    
    $response['message'] = "Successful";
    
     
     //$email_subject = $_POST['subject'];

    // function died($error) {
    //     $referer = $_SERVER['HTTP_REFERER'];
    //     if (strpos($_SERVER['HTTP_REFERER'],"?") !== false){
    //         $referer = explode("?", $_SERVER['HTTP_REFERER']);
    //         $referer = $referer[0];
    //     }

    //     if (strpos($referer,"email.php") !== false){
    //         $referer = str_replace("email.php","",$referer);

    //     }

    //     echo "<script>window.location.href =  '".$referer."?error=1';</script>";
    //     exit();
    // }


    // validation expected data exists
    // if(!isset($_POST['name']) ||
    //     !isset($_POST['email']) ||
    //     !isset($_POST['subject']) ||
    //     !isset($_POST['comments'])) {
    //     //echo "<script>window.location.href =  '".$referer."?error=1';</script>";
    // }


    $comments = $_POST['comments']; 

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if(!preg_match($email_exp,$email_from)) {
        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if(!preg_match($string_exp,$name)) {
        $error_message .= 'The Name you entered does not appear to be valid.<br />';
    }

    if(strlen($subject) < 2) {
        $error_message .= 'The Comments you entered do not appear to be valid.<br />';
    }


    if(strlen($comments) < 2) {
        $error_message .= 'The Comments you entered do not appear to be valid.<br />';
    }

    // if(strlen($error_message) > 0) {
    //     died($error_message);
    // }

    $email_message = "";


    function clean_string($string) {
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
    }



    //$email_message .= "Name: ".clean_string($name)."<br>";
    //$email_message .= "Email: ".clean_string($email_from)."<br>";
    
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
    
    
    $email_message .= "<tr><td><strong>name : </strong> " . strip_tags($name) . "</td></tr>";
    $email_message .= "<tr><td><strong>Email:  </strong> " . strip_tags($email_from) . " </td></tr>";
	$email_message .= "<tr><td><strong>Ref. #:  </strong> " . strip_tags($ticket['refno']) . " </td></tr>";
	$email_message .= "<tr><td><strong>Subject: </strong>" . strip_tags($subject) . "</td></tr><br>";
    
    $email_message .= '<br><tr><td class="content-block"><strong>Concern:</strong></td></tr>';
    $email_message .= "<tr><td class='content-block'>".$ticket['concern']."</td></tr>";
    $email_message .= '<tr><td class="content-block"><strong>Comment:</strong></td></tr>';
    $email_message .= "<tr><td class='content-block'>".$comments."</td></tr>";
	$email_message .= "<tr><td class='content-block'><a href='".$actual_link."' class='btn-primary'>Click here</a></td></tr>";
    $email_message .= '<tr><td class="content-block">Authoritative Content LLC.</td></tr></table></td></tr>';
	
	$email_message .= '	</td><td></td></tr></table>';	


	
	$email_message .= "</body></html>";
			
    
    //$email_message .= "Comments: ".clean_string($comments)."<br>";
    
    

    // create email headers
    // $headers = 'From: '.$email_from."\r\n".
    //     'Reply-To: '.$email_from."\r\n" .
    //     'X-Mailer: PHP/' . phpversion();
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: '.$email_from."\r\n".
        'Reply-To: '.$email_from."\r\n" ;
    @mail($email_to, $subject, $email_message, $headers);
    //echo "<script>window.location.href =  '".$referer."?success=1';</script>";
    
    
    
}
if(isset($_POST['btnreply'])){
   $replaceReply = str_replace("'","\'",str_replace('"','\"',$_POST['reply'.$_POST['btnreply']]));
   $datax = array(
            'model'=>'reply',
            'keys'=>'uid, cid, reply, date',
            'values'=>"'".$_SESSION['user_id']."', '".$_POST['btnreply']."', '".$replaceReply."', '".date('Y-m-d h:i:s', time())."'"
        );
    $gathercomentid=$app->selectcommentsN($_POST['btnreply']);    
    $notiData = array(
            'model'=>'notification',
            'keys'=>'user_id, action, act_id, status,user_id_to',
            'values'=>"'".$_SESSION['user_id']."', '2', '".$_POST['btnreply']."', '1','".$gathercomentid."'"
        );
    $sendnoti = $app->saveNotification($notiData);
    
    $gathercoment=$app->selectcomments($_GET['id']);
    foreach($gathercoment as $keyY1 => $valY1){
        $notiData = array(
            'model'=>'notification',
            'keys'=>'user_id, action, act_id, status,user_id_to',
            'values'=>"'".$_SESSION['user_id']."', '2', '".$_GET['id']."', '1','".$valY1['uid']."'"
        );
        $Checkvalues="SELECT * FROM tbl_notification WHERE user_id='".$_SESSION['user_id']."' AND action ='2' AND act_id = '".$_POST['btnreply']."' AND user_id_to='".$valY1['uid']."'";
        $checkExist = $app->CheckN($Checkvalues);
       
        if($checkExist==0)$sendnoti = $app->saveNotification($notiData);
        
    }
    
    $gatherReply = $app->selectReplyN($_POST['btnreply']);
    foreach($gatherReply as $keyY => $valY){
        $notiData = array(
            'model'=>'notification',
            'keys'=>'user_id, action, act_id, status,user_id_to',
            'values'=>"'".$_SESSION['user_id']."', '2', '".$_POST['btnreply']."', '1','".$valY['uid']."'"
        );
        $Checkvalues="SELECT * FROM tbl_notification WHERE user_id='".$_SESSION['user_id']."' AND action ='2' AND act_id = '".$_POST['btnreply']."' AND user_id_to='".$valY['uid']."'";
        $checkExist = $app->CheckN($Checkvalues);
       
        if($checkExist==0)$sendnoti = $app->saveNotification($notiData);
        
    }
    
    $response = $app->replycreate($datax);
    
    
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
                    'values'=>"'replies', '".$response['id']."', '".$newFilePath."', '".date('Y-m-d h:i:s', time())."', '".$_SESSION['user_id']."'"
                );
                $rn = $app->create2($datas);
                $rn['message'] = "Successful";
        
            }
          }
        }
    
    
    
    $response['message'] = "Successful";
    $Eusername=getMyUsers($ticket['uid']); 
    $email_to=$Eusername[0]['email'];
    $array_emails = array();
    
   
    foreach($Eusername as $Ekey => $Eval){
        $email_to=$Eval['email'];
    } 
    
    $commentID=$_POST['commentID'];
    $par = array(
        'model'=>'notes',
        'condition'=>" WHERE id ='".$commentID."'"
        );
    $GetUserfromID = $app->getRecord2($par);
    
    //echo "<br><br>".json_encode($GetUserfromID);
    
    $ids = array();
    $GetUsername = getMyUsers($GetUserfromID['data'][0]['uid']);
    $array_emails[] = $GetUsername[0]['email'];
    $email_to = $email_to.",". $GetUsername[0]['email'];
    $ids[] = $GetUserfromID['data'][0]['uid'];
    //echo "<br><br>".json_encode($GetUsername);
    //echo json_encode($ids);
    $replyID = $_POST['replyid'];
    $comments =$GetUserfromID['data'][0]['notes'];
    
    foreach($replyID as $key => $val){
       // echo "<br>===".$val."<===<br>";
        if(!in_array($val, $ids)){
             $ids[] = $val;
             $gsd = getMyUsers($val);
            // echo json_encode($gsd);
             //$array_emails[] = $gsd[0]['email'];
              $email_to = $email_to.",".$gsd[0]['email'];
        }
       
    }
    
    
    //echo json_encode($array_emails);
    
    
    // foreach($GetUserfromID as $guf=>$gufval){
    //     $GetUsername= getMyUsers($gufval['uid']); 
    //     foreach($GetUsername as $GU =>$gun){
    //          $email_to = $email_to.",".$gun['email'];
    //     }
    // }
    
    // $replyID = $_POST['replyid'];
    // $getuserfromreply = $app->selectreply($replyID);
    // foreach($getuserfromreply as $gufr => $gufrval){
    //     $URid = getMyUsers($gufrval['uid']);
    //     foreach($URname as $URkey => $URval){
    //         $email_to = $email_to.",".$URval['email'];
    //     }
    // }
     $email_subject =$ticket['subject'];  
     $name= $_SESSION['username'];
     $Susername=getMyUsers($_SESSION['user_id']); 
     foreach($Susername as $Skey => $Sval){}  
     $email_from= $Sval['email'];
    
    $inputreply = $_POST['reply'.$_POST['btnreply']]; 

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if(!preg_match($email_exp,$email_from)) {
        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if(!preg_match($string_exp,$name)) {
        $error_message .= 'The Name you entered does not appear to be valid.<br />';
    }

    if(strlen($subject) < 2) {
        $error_message .= 'The Comments you entered do not appear to be valid.<br />';
    }


    if(strlen($comments) < 2) {
        $error_message .= 'The Comments you entered do not appear to be valid.<br />';
    }

    // if(strlen($error_message) > 0) {
    //     died($error_message);
    // }

    $email_message = "";
    

    function clean_string($string) {
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
    }


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
    
    $email_message .= "<tr><td><strong>Name: </strong> " . strip_tags($name) . "</td></tr>";
    $email_message .= "<tr><td><strong>Email:  </strong> " . strip_tags($email_from) . " </td></tr>";
	$email_message .= "<tr><td><strong>Ref. #:  </strong> " . strip_tags($ticket['refno']) . " </td></tr>";
	$email_message .= "<tr><td><strong>Subject: </strong>" . strip_tags($email_subject) . "</td></tr>";
	$email_message .= "<tr><td><strong>Concern: </strong>" . strip_tags($ticket['concern']) . "</td></tr><br>";
    
    $email_message .= '<br><tr><td class="content-block"><strong>Comment:</strong></td></tr>';
    $email_message .= "<tr><td class='content-block'>".$comments."</td></tr>";
    $email_message .= '<tr><td class="content-block"><strong>Reply:</strong></td></tr>';
    $email_message .= "<tr><td class='content-block'>".$inputreply."</td></tr>";
	$email_message .= "<tr><td class='content-block'><a href='".$actual_link."' class='btn-primary'>Click here</a></td></tr>";
    $email_message .= '<tr><td class="content-block">Authoritative Content LLC.</td></tr></table></td></tr>';
	
	$email_message .= '	</td><td></td></tr></table>';	


	
	$email_message .= "</body></html>";
    // $email_message .= "<strong>Name: </strong>".clean_string($name)."<br>";
    // $email_message .= "<strong>Email: </strong>".clean_string($email_from)."<br>";
    // $email_message .= "<strong>Ref #: </strong>".clean_string($ticket['refno'])."<br><br>";
    // $email_message .= "<strong>Reply: </strong><br>".clean_string($comments)."<br>";
    // $email_message .= ""."<a href='".$actual_link."'>click here for more details</a>"."<br>"; 
    

    // create email headers
    // $headers = 'From: '.$email_from."\r\n".
    //     'Reply-To: '.$email_from."\r\n" .
    //     'X-Mailer: PHP/' . phpversion();
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: '.$email_from."\r\n".
        'Reply-To: '.$email_from."\r\n" ;
    @mail($email_to, $email_subject, $email_message, $headers);
}
?>



<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i>
                Ticket
                <small class="pull-right">Date: <?php echo date("m/d/y");//$ticket['refno']; ?></small>
            </h2>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
            Reference #: <?php echo " ".$ticket['refno']; ?><br>
            Subject :<strong> <?php echo " ".$ticket['subject']; ?></strong>
           
                <p>
                Concern:
                </p>
               <p> <?php echo " ".$ticket['concern']; ?></p><br>
            <p>
                File Location:<br>
                <?php $loc = $app->uploadloc($ticket['id']);
                $num = 0;
                foreach($loc as $xy =>$xx){ $num++;
                    $fn = explode("/",$xx['filename']);
                    $fn=$fn[1];
                    echo "<a href='".$xx['filename']."' target='_BLANK'>    ".$num.". ".$fn."</a>";echo"<br>";
                } ?>
                
            </p>
            
        </div>
        <!-- /.col -->
        <div class="col-sm-6 invoice-col">
            Submitted By: <?php  $usernamex=getMyUsers($ticket['uid']); echo $usernamex[0]['name'];  ?><br>
            
            Date Submitted: <?php echo $ticket['date_open']; ?><br>
            Date Fixed: <?php echo $ticket['date_fixed']; ?><br>
            <?php if($ticket['status']==0){ $col = "#f39c12"; }else{ $col ="#00a65a"; } ?>
            Status: 
             
              <label style='color: <?php echo $col; ?>;'>
                   <?php if($_SESSION['acl']['update-ticket']==1): ?><a href="?page=ticket-create&id=<?php echo $_GET['id']; ?>" title="UPDATE STATUS" target="_BLANK"><?php endif; ?>
                   <?php echo $app->getStatus($ticket['status']); ?>
                   <?php if($_SESSION['acl']['update-ticket']==1): ?></a> <?php endif; ?> 
              </label>
              <br>
        </div>
       
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->



    <div class="row">
                                    <div class="col-xs-12">
                                            <div id="msg-div">
    
                                                
                                            </div>    
                                    </div>
                                </div>  

    <div class="row">

        <div class="col-md-12">
           
                    <div class="tab-pane active">

                            <div class="widget-content ">
                                 
                            </div>
                            <div id="print" class="myDivToPrint">
                                <div class="box">
                                    <div class="box-header">
                                        <h4 class="" style="font-weight: bold;">

                                         Comment:

                                        </h4>
                                    </div>

                                    <!-- /.box-header -->
                                    <div class="box-body" style ="height: auto;">
                                        
                                       <form method="post"  enctype="multipart/form-data">
                                        <div class="pull-right" style="margin-bottom: 2px;"><label class="btn btn-warning btn-xs" id="commentadd">+file</label></div>
										<textarea name ="comments"placeholder="" style ="" class="form-control" required></textarea>
										
										<input type="file" name="file[]"    multiple="multiple" id="commentfile" class="form-control" style="display:none;">
										<button type="submit" name ="comment" class="btn btn-success green pull-right" style ="margin-bottom:40px; margin-top: 3px;"><i class="fa fa-share"></i> Post</button>
									    
									</form>
									<form method="post" style="margin-top: 20px;" enctype="multipart/form-data">
									 <div class="box-header">
                                        <h4 class="" style="font-weight: bold;">Comments</h4><br><br>
                                         <?php $comselect = $app->selectcomments($_GET['id']);$cx=0;
                                         foreach($comselect as $key =>$val){ 
                                             //echo json_encode($val);
                                         
                                         $Cusername=getMyUsers($val['uid']);
                                         //$fileComments = $app->commentFiles($val['id']);
                                         $dcom = array(
                                            'model'=>'attachments',
                                            'condition'=>" WHERE modelid = '".$val['id']."' AND modelname = 'comments'"
                                        );
                                        $curcc = $app->getRecord2($dcom);
                                        $fileComments=$curcc['data'];
                                         
                                         //echo json_encode($fileComments)."<br><br><br>";
                                         
                                         ?>
                                         
                                         <div class="col-md-12">
                                              <!-- The time line -->
                                              <ul class="timeline">
                                              
                                                <!-- timeline item -->
                                                <li><img src="<?php echo $Cusername[0]['photo']; ?>" class="img-circle new-circle bg-aqua" style="width: 60px; margin-top: -50px;" alt="User Image">
                                    
                                                  <div class="timeline-item">
                                                    <span class="time"><i class="fa fa-clock-o"></i> <?php echo $val['date'];?></span>
                                    
                                                    <h3 class="timeline-header"><a href="#"><?php echo $Cusername[0]['phpro_username']; ?></a> (<?php echo $Cusername[0]['role']; ?>)</h3>
                                    
                                                    <div class="timeline-body" style="word-wrap: break-word;">
                                                      <?php echo $val['notes']; echo "<br>";
                                                      
                                                      if(sizeOf($fileComments)>0){
                                                          $num=0;
                                                          echo "<strong>File(s):</strong><br>";
                                                          foreach($fileComments as $cfk => $cfv){ $num++;
                                                              $fn = explode("/",$cfv['filename']);
                                                              $fn=$fn[1];
                                                              echo "     <a href='".$cfv['filename']."' target='_BLANK'>    ".$num.". ".$fn."</a>";echo"<br>";
                                                          }
                                                      }
                                                      
                                                      ?>
                                                    </div>
                                                    <div class="timeline-footer">
                                                        <strong>Replie(s):</strong>
                                                      <!--<a class="btn btn-primary btn-xs">Read more</a>-->
                                                      <!--<a class="btn btn-danger btn-xs">Delete</a>-->
                                                    </div>
                                                    
                                                    <?php $repselect = $app->selectreply($val['id']);
                                                    foreach($repselect as $repkey =>$repval){ 
                                                        $Rusername=getMyUsers($repval['uid']);
                                                        $dcom = array(
                                                            'model'=>'attachments',
                                                            'condition'=>" WHERE modelid = '".$repval['id']."' AND modelname = 'replies'"
                                                        );
                                                        $currep = $app->getRecord2($dcom);
                                                        $fileReplies=$currep['data'];
                                                    
                                                    
                                                    ?>
                                        				<ul class="comments-list reply-list">
                                        					<li>
                
                                        						<div class="comment-box" style="padding: 3px;  border-bottom: 1px solid #f4f4f4;" >
                                        							<div class="row comment-head">
                                        								 <div class="col-sm-9">
                                        								     <h3 class="timeline-header" style="margin-top: 0px; font-size: 16px; margin-bottom:0px;"><a href="#">
                                        								     <img src="<?php echo $Rusername[0]['photo']; ?>" class="img-circle new-circle bg-aqua" style="width: 25px;;" alt="User Image">
                                        								     <?php $Rss=$Rusername[0]; echo $Rss['phpro_username'];?></a>  (<?php echo $Rss['role']; ?>)</h3></div>
                                        							     <div class="col-sm-3"><i class="fa fa-clock-o"></i> <?php echo $repval['date']; ?></div>
                                        							     
                                        							     </hr>
                                        							</div>
                                        							<div class="comment-content" style="word-wrap: break-word; margin-left: 10px;">
                                        							    <?php 
                                        							    
                                        							    $reply = $repval['reply'];
                                        							    $url = $app->get_string_between($reply, '[link]', '[/link]');
                                        							    //echo $url."<br>";
                                        							    $rep = $app->get_string_between($reply, '[link', '/link]');
                                        							    $rep = "[link".$rep."/link]";
                                        							    //echo $rep."<br>";
                                        							    $reply=str_replace($rep,"<a href='".$url."'>$url</a>",$reply);
                                        							    
                                        							    echo $reply;echo "<br>";
                                        							    
                                        							    
                                        							    if(sizeOf($fileReplies)>0){
                                                                              $num=0;
                                                                              echo "<strong>File(s):</strong><br>";
                                                                              foreach($fileReplies as $cfk => $cfv){ $num++;
                                                                                  $fn = explode("/",$cfv['filename']);
                                                                                  $fn=$fn[1];
                                                                                  echo "     <a href='".$cfv['filename']."' target='_BLANK'>    ".$num.". ".$fn."</a>";echo"<br>";
                                                                              }
                                                                          }
                                        							    
                                        							    
                                        							    ?>
                                        							
                                        							</div>
                                        						</div>
                                        					</li>
                                        
                                        				</ul>
                                        				<input type="hidden" name="replyid[]" class="form-control inputs" value='<?php echo $Rusername[0]['phpro_user_id']; ?>'>  
                                				<?php }?>
                                				  
                                				 <input type="hidden" name="commentID" class="form-control inputs" value= '<?php echo $val['id']; ?>'>
                                            			    <div class="pull-right" style="margin-bottom: 2px;"><label class="btn btn-warning btn-xs" id="replyadd">+file</label></div>
                                                			<input type="text" name=<?php echo"reply".$val['id']; ?> class="form-control inputs">
                                                			<input type="file" name="file[]"    multiple="multiple" id="replyfile" class="form-control" style="display:none;">
                                                			<button name ="btnreply" class="btn btn-info btn-xs" style="float:right; margin-top: 3px;" value=<?php echo $val['id']; ?>><i class="fa fa-reply"></i> reply</button>
                                            		
                                                
                                			 
                                                    
                                                    
                                                  </div>
                                                  
                                                  
                                                </li>
                                            </ul>
                                            
                                            </div>
                                                
                                				<!-- Reply -->
                                				
                                		<?php }?>
                                    </div> 
                                    </form
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>
                    </div>
                    <!-- /.tab-pane -->
                 
                    
                    
                    
                    
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
        </div>
    </div>
    
    
    <div class="row">
        
    </div>    


</section>


<?php

if(isset($_GET['active'])){
    echo "<script>document.getElementById('".$_GET['active']."').click();</script>";
}
?>


<script>

    function makeid() {
      var text = "";
      var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    
      for (var i = 0; i < 5; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    
      return text;
    }

  
   
   $("#commentadd").click(function(){
       var txt =$(this).text();
       if(txt=="+file"){
           $("#commentfile").attr("style","display: inline;");
           $(this).attr("style","background-color: red;");
           $(this).text("-file");
       }else{
           $("#commentfile").attr("style","display: none;");
           $(this).removeAttr("style");
           $(this).text("+file");
       }
       
       
   });
   
   
   $("#replyadd").click(function(){
       var txt =$(this).text();
       if(txt=="+file"){
           $("#replyfile").attr("style","display: inline;");
           $(this).attr("style","background-color: red;");
           $(this).text("-file");
       }else{
           $("#replyfile").attr("style","display: none;");
           $(this).removeAttr("style");
           $(this).text("+file");
       }
       
       
   });


</script>

<!-- /.content -->