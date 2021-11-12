<?php

//echo $_SERVER['HTTP_REFERER']; exit();

//error_reporting(E_ALL); ini_set('display_errors', 1);
$referer = $_SERVER['HTTP_REFERER'];
if (strpos($_SERVER['HTTP_REFERER'],"?") !== false){
       $referer = explode("?", $_SERVER['HTTP_REFERER']);
    $referer = $referer[0];
}

if (strpos($referer,"email.php") !== false){
    $referer = str_replace("email.php","",$referer);

}

//echo $referer; exit();

if(isset($_POST['email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = $_POST['sendto'];//"maverickvillar@gmail.com";
    $email_subject = $_POST['subject'];

    function died($error) {
        $referer = $_SERVER['HTTP_REFERER'];
        if (strpos($_SERVER['HTTP_REFERER'],"?") !== false){
            $referer = explode("?", $_SERVER['HTTP_REFERER']);
            $referer = $referer[0];
        }

        if (strpos($referer,"email.php") !== false){
            $referer = str_replace("email.php","",$referer);

        }

        echo "<script>window.location.href =  '".$referer."?error=1';</script>";
        exit();
    }


    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['subject']) ||
        !isset($_POST['comments'])) {
        //echo "<script>window.location.href =  '".$referer."?error=1';</script>";
    }



    $name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $subject = $_POST['subject']; // not required
    $comments = $_POST['comments']; // required

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

    if(strlen($error_message) > 0) {
        died($error_message);
    }

    $email_message = "";


    function clean_string($string) {
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
    }



    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    // $email_message .= "Subject: ".clean_string($telephone)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";

    // create email headers
    $headers = 'From: '.$email_from."\r\n".
        'Reply-To: '.$email_from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
    echo "<script>window.location.href =  '".$referer."?success=1';</script>";

}
?>