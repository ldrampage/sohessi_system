<?php
include "core/api.php";
$app = new mckirby();
function base64_to_jpeg($base64_string, $output_file) {
    // open the output file for writing
    $ifp = fopen( $output_file, 'wb' ); 

    // split the string on commas
    // $data[ 0 ] == "data:image/png;base64"
    // $data[ 1 ] == <actual base64 string>
    $data = explode( ',', $base64_string );

    // we could add validation here with ensuring count( $data ) > 1
    fwrite( $ifp, base64_decode( $data[ 1 ] ) );

    // clean up the file resource
    fclose( $ifp ); 

    return $output_file; 
}      

function orig_base64_to_jpeg( $base64_string, $output_file ) {
    $ifp = fopen( $output_file, "wb" ); 
    fwrite( $ifp, base64_decode( $base64_string) ); 
    fclose( $ifp ); 
    return( $output_file ); 
}  
        
        
if(isset($_POST['action_taken'])){
        //echo json_encode($_POST);
        if(trim($_POST['etimezone'])==""){
            $timezone = "Asia/Manila";
        }else{
            $timezone = $_POST['etimezone'];
        }
        
        date_default_timezone_set($timezone);
        $ldate = date('Y-m-d', time());
        $current_time_old = date("Y-m-d H:i:s", time());
        
        $ldate = date('Y-m-d', time());
        $current_time = date("H:i:s", time());
        //$image = base64_to_jpeg($_POST['image'],"tmp.jpg");
        //$image = orig_base64_to_jpeg($_POST['image'],"tmp.jpg");
        
         //$image= base64_decode($_POST['image']);
         //$image=imagecreatefromstring($image);
         //$image= str_split($image,16);
        
        $image = str_replace('data:image/png;base64,', '', $_POST['image']);
        $image = str_replace(' ', '+', $image );
	$image = base64_decode($image);
        
        $sql = "INSERT INTO tbl_printscreen(userId,newshotdate,photo)VALUES('" . $_POST['uid'] ."','" .$current_time_old. "','".addslashes($image)."')";
       // echo $sql ."<<"; 
        $result = mysqli_query($app->connect(),$sql) or die(mysqli_connect_error());
        echo json_encode($result); 
       
         
}




?>