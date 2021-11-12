<?php


if(isset($_GET['image'])){
}else{
}

include "core/core.php";
$app = new mckirby();
$ldate = date('Y-m-d', time());
$current_time = date("H:i:s", time());
$sql = "SELECT * FROM tbl_timesheet WHERE userId = '".$_GET['id']."' ORDER BY idno DESC LIMIT 50";
$result = mysqli_query($app->connect(),$sql) or die(mysqli_connect_error());
$records=array();

$sql2 = "SELECT * FROM tbl_breaks WHERE userId = '".$_GET['id']."' ORDER BY brno DESC LIMIT 50";
$result2 = mysqli_query($app->connect(),$sql2) or die(mysqli_connect_error());
$sql3 = "SELECT * FROM tbl_printscreen WHERE userId = '".$_GET['id']."' ORDER BY id DESC LIMIT 20";
$result3 = mysqli_query($app->connect(),$sql3) or die(mysqli_connect_error());


function formatDateTime($diff){
    $years   = floor($diff / (365*60*60*24)); 
    $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
    $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
    
    $hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
    
    $minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 
    
    $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60)); 
}
function timeComputer($old,$add){
    $old = explode(":", $old);
    $add = explode(":", $add);
    $newHour = $add[0]+$old[0];
    $newMin = $add[1]+$old[1];
    $newSec = $add[2]+$old[2];
    while($newSec>=60){
        $newMin = $newMin + 1;
        $newSec = $newSec - 60;
    }
    while($newMin>=60){
        $newHour = $newHour + 1;
        $newMin = $newMin - 60;
    }
    if($newMin<10){ $newMin = "0".$newMin; }
    if($newSec<10){ $newSec = "0".$newSec; }
    if($newHour<10){ $newHour = "0".$newHour; }
    return $newHour.":".$newMin.":".$newSec;
}



?>

<table style="width: 100%;">
    
    <tr>
     <td style="width: 40%;  vertical-align: top;">
         <?php
         echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               Time In     
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; |
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
               Time Out
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|  &nbsp;&nbsp;&nbsp;&nbsp;   Last Minute Active    |  &nbsp;&nbsp;&nbsp;&nbsp;   Computed     <hr>";
               $old = "0000-00-00";
               $time1 = "00:00:00";
               $c = 0;
        while($fetchData = mysqli_fetch_assoc($result)){
            $c++;
            if($old!=$fetchData['timeInDate']){
                if($c>1){
                    echo "Total Hours: $time1 <br><hr><br>";
                    $time1 = "00:00:00";
                }
                echo $fetchData['timeInDate']."<br><br>";
                $old=$fetchData['timeInDate'];
            }
            if($fetchData['newtimeout']=="0000-00-00 00:00:00"){
                $timein = date('Y-m-d H:i:s', strtotime($fetchData['newtimein']));
                $lastin = date('Y-m-d H:i:s', strtotime($fetchData['newlastmin']));
                $start_date = new DateTime($timein);
                $since_start = $start_date->diff(new DateTime($lastin));
            }else{
                $timein = date('Y-m-d H:i:s', strtotime($fetchData['newtimein']));
                $lastin = date('Y-m-d H:i:s', strtotime($fetchData['newtimeout']));
                $start_date = new DateTime($timein);
                $since_start = $start_date->diff(new DateTime($lastin));
            }
            
            $time2 = $since_start->h.":".$since_start->i.":".$since_start->s;
            //$time2 = date('H:i:s', $diff);
            $time1 = timeComputer($time1,$time2);
            echo $fetchData['id']."<br>";
            echo $fetchData['newtimein']." | ".$fetchData['newtimeout']." | ".$fetchData['newlastmin']." | ".$time1."<hr>";
        }
        
        
         
        ?>
         
     </td>
     <td style="width: 30%; border-left: 1px solid #eee; vertical-align: top;">
         
          <?php
           echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               Break Start     
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
               Break End   <hr>";
        while($fetchData = mysqli_fetch_assoc($result2)){
            echo $fetchData['newTimeStart']." | ".$fetchData['newTimeEnd']."<hr>";
        }
         
        ?>
         
         
     </td>
      <td style="width: 30%; border-left: 1px solid #eee; vertical-align: top;">
         
          <?php
           echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              Image   
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              Date   
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp
               Time  <hr>";
               
        while($fetchData = mysqli_fetch_assoc($result3)){
            //echo $fetchData['photo']."<br>";
              $image = imagecreatefromstring($fetchData['photo']); 
              ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
              imagejpeg($image, null, 80);
              $data = ob_get_contents();
              ob_end_clean();
              echo '<img src="data:image/jpg;base64,' .  base64_encode($data)  . '" style="width: 100px;"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;';
              echo $fetchData['newshotdate']."/".$fetchData['date']."|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$fetchData['time']."<hr>";
        }
         
        ?>
         
         
     </td>
    </tr>

</table>    