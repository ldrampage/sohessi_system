<?php
define("DB_HOST", "66.198.240.16");
define("DB_USER", "backoff2_hrm23");
define("DB_PASS", "iIiaAamMm777");
define("DB_NAME", "backoff2_hr");
define("modelPreName","tbl_");
class mckirby{
    function connect($data=null){
        return mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }
    
    function RandomString($length = 50) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    public function login($un,$pass){ 
          $model = modelPreName . "employee";
          $sql = "SELECT * FROM $model WHERE ( un = '".trim($un)."' OR email = '".trim($un)."') AND up = '".trim($pass)."' AND status = '1'";
          $result = mysqli_query(self::connect(),$sql) or die(mysqli_connect_error()); 
          //return $sql;
          if(mysqli_num_rows($result)==0){
             return "id:0;etimezone:Invalid;"; 
          }else{
            $data = mysqli_fetch_assoc($result);
            if($data['etimezone']==""){ $data['etimezone']="Asia/Manila";}
            
            return "id:".$data['id'].";etimezone:".$data['etimezone'].";"; 
          }
    }
    public function closeSession($uid, $tid, $lastmin){
          $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
          
          $model = modelPreName . "timesheet";
          $sql = "UPDATE $model SET newtimeout = '" .$lastmin. "' WHERE userId = '" .$uid. "' AND id='".$tid."' ";
          //return $sql; 
          if($mysqli->query($sql)){ 
               //return $id;
          }else{
               //return 0;
          }
    }
    public function checkActiveSessions($id, $xcept){
         $model = modelPreName . "timesheet";
          $sql = "SELECT * FROM $model WHERE userId = '".$id."' AND newtimein!='0000-00-00 00:00:00' AND newtimeout='0000-00-00 00:00:00' AND id != '".$xcept."'";
          $result = mysqli_query(self::connect(),$sql) or die(mysqli_connect_error()); 
          while($data = mysqli_fetch_assoc($result)){
                //echo json_encode($data)."<br>";
                //echo $id." == ".$data['id']." == ".$data['newlastmin']."<br>";
                $this->closeSession($id,$data['id'],$data['newlastmin']);
          }
    }
    
    public function createSheet($data){
          $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
          $id = $this->RandomString(35);
          $model = modelPreName . "timesheet";
          $sql = "INSERT INTO $model(id, userId, client, project, newtimein, newlastmin, timeInDate)VALUES('".$id."', '".trim($data['uid'])."', 'Authoritative Content LLC', 'Daily Tasks', '".trim($data['timein'])."', '".trim($data['timein'])."', '".trim($data['date'])."')";
          //return $sql; 
          if($mysqli->query($sql)){
               $this->checkActiveSessions(trim($data['uid']),$id);
               return $id;
           }else{
               return 0;
           }
          //$result = mysqli_query(self::connect(),$sql) or die(mysqli_connect_error()); 
    }
    
    public function createBreak($data){
          $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
          $id = $this->RandomString(45);
          $model = modelPreName . "breaks";
          $sql = "INSERT INTO $model(id, userId, client, project, breakType, breakDate, newTimeStart)VALUES('".$id."', '".trim($data['userId'])."', 'Authoritative Content LLC...', 'Daily Tasks', '".trim($data['breakType'])."', '".trim($data['breakDate'])."', '".trim($data['newTimeStart'])."')";
          //return $sql; 
          if($mysqli->query($sql)){ 
               return $id;
           }else{
               return 0;
           }
          //$result = mysqli_query(self::connect(),$sql) or die(mysqli_connect_error()); 
    }
    //$queryString = "UPDATE tbl_breaks SET newTimeEnd = '" .$current_time. "' WHERE userId = '" .$_POST['userId']. "' AND id='".$_POST['breakid']."' " ;
    public function updateBreak($data){
          $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
          $id = $this->RandomString(45);
          $model = modelPreName . "breaks";
          $sql = "UPDATE $model SET newTimeEnd = '" .$data['newTimeEnd']. "' WHERE userId = '" .$data['userId']. "' AND id='".$data['breakid']."' ";
          //return $sql; 
          if($mysqli->query($sql)){ 
               return $id;
           }else{
               return 0;
           }
          //$result = mysqli_query(self::connect(),$sql) or die(mysqli_connect_error()); 
    }
    
    public function getSettings(){
          $model = modelPreName . "settings";
          $sql = "SELECT * FROM $model";
          $result = mysqli_query(self::connect(),$sql) or die(mysqli_connect_error()); 
          $total = mysqli_num_rows($result);
            $index = 0;
            $responseData="";
            while($fetchData = mysqli_fetch_assoc($result)){
                $responseData = $responseData . $fetchData['setting_name'] . ":" . $fetchData['setting_value'].";";
            }
          return $responseData;
    }
}
?>