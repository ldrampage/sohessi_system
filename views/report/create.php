<!-- Main content -->
<link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<?php
 error_reporting(E_ALL); ini_set('display_errors', 1);
$response=array('action'=>"", 'message'=>"");
$cur = array("subject"=>"","concern"=>"","status"=>"");
if(isset($_POST['btn_save'])){
     date_default_timezone_set('America/New_York');
        $date = date('Y-m-d h:i:s', time());

    $data = array('model'=>"reports");

    if(isset($_POST['id'])){
        $dataf = array('model'=>"reports");
        $dataf['values']="uid = '".$_SESSION['user_id']."', content = '".$_POST['content']."'";
        $dataf['condition'] = " WHERE id = '".$_POST['id']."'";
        
        $response = $app->update2($dataf);
       
        
        $email_message = "";
        $name= $_SESSION['username'];    
        $Eusername=getMyUsers($_SESSION['user_id']); 
        $email_subject = "";//$curx['data'][0]['subject'];
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
    	//$email_message .= "<tr><td><strong>Status: </strong>" . strip_tags($statusX) . "</td></tr><br>";
        
        $email_message .= '<br><tr><td class="content-block"><strong>Concern:</strong></td></tr>';
        //$email_message .= "<tr><td class='content-block'>".trim($curx['data'][0]['concern'])."</td></tr>";
        //$email_message .= '<tr><td class="content-block"><strong>Comment:</strong></td></tr>';
        //$email_message .= "<tr><td class='content-block'>".$comments."</td></tr>";
    	$email_message .= "<tr><td class='content-block'><a href='http://support.backoffice-services.net/?page=tickets-view&id=".$_POST['id']."' class='btn-primary'>click here</a></td></tr>";
        $email_message .= '<tr><td class="content-block">Authoritative Content LLC.</td></tr></table></td></tr>';
    	
    	$email_message .= '	</td><td></td></tr></table>';	
    
    
    	
    	$email_message .= "</body></html>";
        
        // $email_message = "Name: ".trim($name)."<br>";
        // $email_message .= "Email: ".trim($Eusername[0]['email'])."<br>";
        
        // $email_message .= "Comments: ".trim($_POST['concern'])."<br>";
        // $email_message .= ""."<a href='http://support.backoffice-services.net/?page=tickets-view&id=".$_POST['id']."'>click here</a>"."<br>"; 
        
        // ///sadasdas
        // $headers  = 'MIME-Version: 1.0' . "\r\n";
        // $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        // $headers .= 'From: '.$Eusername[0]['email']."\r\n".
        //     'Reply-To: '.$Eusername[0]['email']."\r\n" ;
        //   // echo "<br>".$headers; 
        
            
            
        // @mail($email_to, $email_subject, $email_message, $headers);
        
        
        
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
            'model'=>'reports',
            'keys'=>'uid, content, date',
            'values'=>"'".$_SESSION['user_id']."', '".$_POST['content']."', '".$date."'"
        );
       // echo "<br>".json_encode($data2);
        $response = $app->create2($data2);
        $response['message'] = "Successful";
        
       
    $email_message = "";
    $email_to ="";
   
    $name= $_SESSION['username'];    
    $Eusername=getMyUsers($_SESSION['user_id']); 
    $email_subject = "Word Report";//$_POST['subject'];    
    
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
        $email_message .= "<tr><td class='content-block'>".trim($_POST['content'])."</td></tr>";
        //$email_message .= '<tr><td class="content-block"><strong>Comment:</strong></td></tr>';
        //$email_message .= "<tr><td class='content-block'>".$comments."</td></tr>";
    	$email_message .= "<tr><td class='content-block'><a href='http://support.backoffice-services.net/?page=tickets-view&id=".$response['id']."' class='btn-primary'>click here</a></td></tr>";
        $email_message .= '<tr><td class="content-block">Authoritative Content LLC.</td></tr></table></td></tr>';
    	
    	$email_message .= '	</td><td></td></tr></table>';	
    
    
    	
    	$email_message .= "</body></html>";
    
    // $email_message = "Name: ".trim($name)."<br>";
    // $email_message .= "Email: ".trim($Eusername[0]['email'])."<br>";
    
    // $email_message .= "Comments: ".trim($_POST['concern'])."<br>";
    // $email_message .= ""."<a href='http://support.backoffice-services.net/?page=tickets-view&id=".$response['id']."'>click here</a>"."<br>"; 
   
   //old
    // $headers  = 'MIME-Version: 1.0' . "\r\n";
    // $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // $headers .= 'From: '.$Eusername[0]['email']."\r\n".
    //     'Reply-To: '.$Eusername[0]['email']."\r\n" ;
    //   // echo "<br>".$headers; 
    
        
        
    // @mail($email_to, $email_subject, $email_message, $headers);
      
    }

}

if(isset($_GET['id'])){
    $action = "Update";

    $ds = array(
        'model'=>'reports',
        'condition'=>" WHERE id = '".$_GET['id']."'"
    ); 
    $cur = $app->getRecord2($ds); 
    $cur=$cur['data'][0];
}else{ $action = "Create"; }



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



                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Report Content</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                             
                                    <div class="box-body pad">
                                      <form>
                                        <textarea class="textarea" name="content" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php if(isset($_GET['id'])){ echo $cur['content']; } ?></textarea>
                                      </form>
                                    </div></div>
                                
                              
                               
                                
                                

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
<script src="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
  $(function () {
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
  });
</script>
<script>
    $("#domain").on("change", function(){
        $("#webfolder").val($(this).val());
    });
</script>

