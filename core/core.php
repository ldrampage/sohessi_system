<?php
error_reporting(E_ALL); ini_set('display_errors', '1');
ini_set('max_execution_time', 1000);

date_default_timezone_set('Asia/Manila');
define("SERVER_IP", "localhost");// "192.168.1.101");
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");  //slc2019
define("DB_NAME", "sohessidb");
define("SITE_URL", "http://".SERVER_IP."/sohessi-system");

define("ENQ", 0);
define("PROCESSED", 1);
define("PAID", 2);
define("ONPROCESS", 3);
define("RESULT", 4);
define("FINISHED", 5);

define("URL_SEPARATOR", "/");
define("FILE_SEPARATOR", "\\");
define("ROOT_DIR", realpath(__DIR__ . '/..'));
define("CORE_DIR", dirname(__FILE__));
define('modelPreName', 'tbl_');
define('preName', '');
define('PREID', 'SHS-');



define('MAINURL', 'http://'.SERVER_IP.'/sohessi-system');

define("MYBLUE","#00c0ef");
define("MYRED","#dd4b39");
define("MYGREEN","#00a65a");
define("MYGOLD","#f39c12");

define("EMAILSENDER","hr@sohessi.com");
define("NOREPLY","noreply@sohessi.com");
define("EMAILFOOTER","South Occupational Health & Environmental Safety Services, Inc.");
define("INCLUDEONLY","PHILIPPINES");
define("SOFTWARE_NAME","Sohessi Software");
define("POPRE","PON");

$db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
$trans_type = array(0=>"Cash", 1=>"Credit");
//echo ROOT_DIR."<br><br><br><br>";

//ERROR MESSAGES

// 1. mysql connection failed
define("DB_CONNECTION_FAILED", "Sorry, centralized database is out of reach. Please call support for details.");


//SUCCESS MESSAGES
define("DB_CONNECTION_SUCCESS", "Connection has been established.");

class mckirby{






/*
$times = array();

$times[] = "12:59";
$times[] = "0:58";
$times[] = "0:02";

// pass the array to the function
echo AddPlayTime($times);
 
function AddPlayTime($times) {
    $minutes = 0; //declare minutes either it gives Notice: Undefined variable
    // loop throught all the times
    foreach ($times as $time) {
        list($hour, $minute) = explode(':', $time);
        $minutes += $hour * 60;
        $minutes += $minute;
    }

    $hours = floor($minutes / 60);
    $minutes -= $hours * 60;

    // returns the time already formatted
    return sprintf('%02d:%02d', $hours, $minutes);
}

*/
function numtowords($num){ 
$decones = array( 
            '01' => "One", 
            '02' => "Two", 
            '03' => "Three", 
            '04' => "Four", 
            '05' => "Five", 
            '06' => "Six", 
            '07' => "Seven", 
            '08' => "Eight", 
            '09' => "Nine", 
            10 => "Ten", 
            11 => "Eleven", 
            12 => "Twelve", 
            13 => "Thirteen", 
            14 => "Fourteen", 
            15 => "Fifteen", 
            16 => "Sixteen", 
            17 => "Seventeen", 
            18 => "Eighteen", 
            19 => "Nineteen" 
            );
$ones = array( 
            0 => " ",
            1 => "One",     
            2 => "Two", 
            3 => "Three", 
            4 => "Four", 
            5 => "Five", 
            6 => "Six", 
            7 => "Seven", 
            8 => "Eight", 
            9 => "Nine", 
            10 => "Ten", 
            11 => "Eleven", 
            12 => "Twelve", 
            13 => "Thirteen", 
            14 => "Fourteen", 
            15 => "Fifteen", 
            16 => "Sixteen", 
            17 => "Seventeen", 
            18 => "Eighteen", 
            19 => "Nineteen" 
            ); 
$tens = array( 
            0 => "",
            2 => "Twenty", 
            3 => "Thirty", 
            4 => "Forty", 
            5 => "Fifty", 
            6 => "Sixty", 
            7 => "Seventy", 
            8 => "Eighty", 
            9 => "Ninety" 
            ); 
$hundreds = array( 
            "Hundred", 
            "Thousand", 
            "Million", 
            "Billion", 
            "Trillion", 
            "Quadrillion" 
            ); //limit t quadrillion 

$num = number_format($num,2,".",","); 
$num_arr = explode(".",$num); 
$wholenum = $num_arr[0]; 
$decnum = $num_arr[1]; 
$whole_arr = array_reverse(explode(",",$wholenum)); 
krsort($whole_arr); 
$rettxt = ""; 
foreach($whole_arr as $key => $i){ 
    if($i < 20){ 
        $rettxt .= $ones[$i]; 
    }
    elseif($i < 100){ 
        $rettxt .= $tens[substr($i,0,1)]; 
        $rettxt .= " ".$ones[substr($i,1,1)]; 
    }
    else{ 
        $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
        $rettxt .= " ".$tens[substr($i,1,1)]; 
        $rettxt .= " ".$ones[substr($i,2,1)]; 
    } 
    if($key > 0){ 
        $rettxt .= " ".$hundreds[$key]." "; 
    } 

} 
$rettxt = $rettxt." peso/s";

if($decnum > 0){ 
    $rettxt .= " and "; 
    if($decnum < 20){ 
        $rettxt .= $decones[$decnum]; 
    }
    elseif($decnum < 100){ 
        $rettxt .= $tens[substr($decnum,0,1)]; 
        $rettxt .= " ".$ones[substr($decnum,1,1)]; 
    }
    $rettxt = $rettxt." centavo/s"; 
} 
return $rettxt;}

function convertNumberToWord($num = false)
{
    $num = str_replace(array(',', ' '), '' , trim($num));
    if(! $num) {
        return false;
    }
    $num = (int) $num;
    $words = array();
    $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
        'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
    );
    $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
    $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
        'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
        'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
    );
    $num_length = strlen($num);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $num = substr('00' . $num, -$max_length);
    $num_levels = str_split($num, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ( $tens < 20 ) {
            $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
        } else {
            $tens = (int)($tens / 10);
            $tens = ' ' . $list2[$tens] . ' ';
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ' ' . $list1[$singles] . ' ';
        }
        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
    } //end for loop
    $commas = count($words);
    if ($commas > 1) {
        $commas = $commas - 1;
    }
    return implode(' ', $words);
}


 function diffInMonths($date1, $date2)
{
    //$date1 = date("Y-m-d", strtotime($date1));
    $date1 = new DateTime(date("Y-m-d", strtotime($date1)));
    $date2 = new DateTime(date("Y-m-d", strtotime($date2)));
    $diff =  $date1->diff($date2);

    $months = $diff->y * 12 + $diff->m + $diff->d / 30;

    return (int) round($months);
}

    
   
  function getStatus($id=null){
      $status = array(0=>"Open", 1=>"Closed");
      if($id==null){
        return $status;
      }else{
        return $status[$id];
      }
   }
   
   

   function number_of_working_days($from, $to) {
    $workingDays = [1, 2, 3, 4, 5]; # date format = N (1 = Monday, ...)
    $holidayDays = ['*-12-25', '*-01-01', '2013-12-23']; # variable and fixed holidays

    $from = new DateTime($from);
    $to = new DateTime($to);
    $to->modify('+1 day');
    $interval = new DateInterval('P1D');
    $periods = new DatePeriod($from, $interval, $to);

    $days = 0;
    foreach ($periods as $period) {
        if (!in_array($period->format('N'), $workingDays)) continue;
        if (in_array($period->format('Y-m-d'), $holidayDays)) continue;
        if (in_array($period->format('*-m-d'), $holidayDays)) continue;
        $days++;
    }
    return $days;
}

   function getLeaveStatus(){
    return array("filed", "canceled", "approved");
   }
   function getPayrollStatus(){
    return array("0"=>"In Progress", 1=>"Released");
   }
   
   function aclLists(){
       return array(
         "home"=>"Home", 
         "profile"=>"Profile", 
         "employee"=>"View Employee List",   
         "employee-create"=>"Create New Employee",
         "employee-update"=>"Update Employee",
         "employee-view"=>"View Employee Details",
         "employee-delete"=>"Delete Employee",

         "patients"=>"View Patient List",   
         "patients-create"=>"Create New Patient",
         "patients-update"=>"Update Patient",
         "patients-view"=>"View Patient Details",
         "patients-delete"=>"Delete Patient",

         "patients-disease-create"=>"Create New Patient Disease",
         "patients-disease-delete"=>"Delete Patient Disease",

         "department"=>"View Department List",   
         "department-create"=>"Create New Department",
         "department-update"=>"Update Department",
         "department-view"=>"View Department Details",
         "department-delete"=>"Delete Department",

         "company"=>"View Company List",   
         "company-create"=>"Create New Company",
         "company-update"=>"Update Company",
         "company-view"=>"View Company Details",
         "company-lab"=>"Company Lab Tests",
         "company-delete"=>"Delete Lab",

         "tests"=>"View Test List",   
         "tests-create"=>"Create New Test",
         "tests-update"=>"Update Test",
         "tests-view"=>"View Test Details",
         "tests-delete"=>"Delete Test",

         "testcategory"=>"View Test Category List",   
         "testcategory-create"=>"Create New Test Category",
         "testcategory-update"=>"Update Test Category",
         "testcategory-view"=>"View Test Category Details",
         "testcategory-delete"=>"Delete Test Category",

         "materials"=>"View Materials List",   
         "materials-create"=>"Create New Materials",
         "materials-update"=>"Update Materials",
         "materials-view"=>"View Material Details",
         "materials-delete"=>"Delete Material",

         "process"=>"Process", 
         "process-delete"=>"Delete Process", 
         "saveresult"=>"Add Result",

         // "patient"=>"View Patient List",   
         // "patient-create"=>"Create New Patient",
         // "patient-update"=>"Update Patient",
         // "patient-view"=>"View Patient Details",
         // "patient-delete"=>"Delete Patients",

         "transactions"=>"View Transactions List",   
         "transactions-create"=>"Create New Transaction",
         "transactions-update"=>"Update Transaction",
         "transactions-view"=>"View Transaction Details",
         "transactions-delete"=>"Delete Transaction",

         "consultation"=>"Consultation",
         "consult"=>"Process Consultation",
         "patient-test"=>"Patients for Lab Tests",
         "process-test"=>"Process Patient's Lab Test",
         "result-create"=>"Create Patient Result",
         "patient-result"=>"Patient Result",
         "result-update"=>"Update Result",
         "result-print"=>"Print Result",
         "result-view"=>"View Result",
         
         "access-controls"=>"Access Controls",

         "medicines"=>"View Medicines List",   
         "medicines-create"=>"Create New Medicine",
         "medicines-update"=>"Update Medicine",
         "medicines-view"=>"View Medicine Details",
         "medicines-delete"=>"Delete Medicine",

         "diseases"=>"View Disease List",   
         "diseases-create"=>"Create New Disease",
         "diseases-update"=>"Update Disease",
         "diseases-view"=>"View Disease Details",
         "diseases-delete"=>"Delete Disease",


         "suppliers"=>"View Supplier List",   
         "suppliers-create"=>"Create New Supplier",
         "suppliers-update"=>"Update Supplier",
         "suppliers-view"=>"View Supplier Details",
         "suppliers-delete"=>"Delete Supplier",

         "expenses"=>"View Expenses List",   
         "expenses-create"=>"Create New Expenses",
         "expenses-update"=>"Update Expenses",
         "expenses-view"=>"View Expenses Details",
         "expenses-delete"=>"Delete Expenses",

         "billings"=>"View Billings List",   
         "billings-create"=>"Create New Billings",
         "billings-update"=>"Update Billing",
         "billings-view"=>"View Billing Details",
         "billings-delete"=>"Delete Billing",

         "returns"=>"View Return List",   
         "returns-create"=>"Create New Return",
         "returns-update"=>"Update Return",
         "returns-view"=>"View Return Details",
         "returns-delete"=>"Delete Return",

         "payments"=>"View Payment List",   
         "payments-create"=>"Create New Payment",
         "payments-update"=>"Update Payment",
         "payments-view"=>"View Payment Details",
         "payments-delete"=>"Delete Payment",

         "po"=>"View P.O. List",   
         "po-create"=>"Create New P.O.",
         "po-update"=>"Update P.O.",
         "po-view"=>"View P.O. Details",
         "po-delete"=>"Delete P.O.",
         "po-approve"=>"Approve P.O.",
         "po-receive"=>"Receive P.O.",
         "po-order"=>"Order P.O.",

         "symptoms"=>"View Symptom List",   
         "symptoms-create"=>"Create New Symptom",
         "symptoms-update"=>"Update Symptom",
         "symptoms-view"=>"View Symptom Details",
         "symptoms-delete"=>"Delete Symptom",

         "operations"=>"View Operation List",   
         "operations-create"=>"Create New Operation",
         "operations-update"=>"Update Operation",
         "operations-view"=>"View Operation Details",
         "operations-delete"=>"Delete Operation",

         "prescription"=>"View Prescription List",   
         "prescription-create"=>"Create New Prescription",
         "prescription-update"=>"Update Prescription",
         "prescription-view"=>"View Prescription Details",
         "prescription-delete"=>"Delete Prescription",

         "brands"=>"View Brand List",   
         "brands-create"=>"Create New Brand",
         "brands-update"=>"Update Brand",
         "brands-view"=>"View Brand Details",
         "brands-delete"=>"Delete Brand",

         "vital"=>"View Vital Sign List",   
         "vital-create"=>"Create New Vital Sign",
         "vital-update"=>"Update Vital Sign",
         "vital-view"=>"View Vital Sign Details",
         "vital-delete"=>"Delete Vital Sign",

         "prescription"=>"View Prescription List",   
         "prescription-create"=>"Create Prescription",
         "prescription-update"=>"Update Prescription",
         "prescription-view"=>"View Prescription Details",
         "prescription-delete"=>"Delete Prescription",

         "transaction"=>"View Transactions",
         "transaction-create"=>"Process Payment",
         "transaction-update"=>"Update Payment",
         "transaction-view"=>"View Transaction",

         "settings"=>"Settings",
         "reports"=>"Reports",
         "access-log"=>"View Access Logs",
         "acl"=>"View Access Control",
         "crete-lab-result"=>"Create Laboratory Result"
                
       );
   }
   
   
   function aclfew(){
       return array(
         "home"=>"Home", 
         "profile"=>"Profile", 

       );
   }


   function getPoStatus(){
   	 $st = array("Pending", "Approved", "Ordered", "Received");
   	 return $st;
   }
   
   
   function getLastSession($id){
       $data = array('model'=>'timesheet', 'condition'=>" WHERE userId = '".$id."'",'order'=>"ORDER BY newtimein DESC  LIMIT 1");
      // echo json_encode($data);
      $department = $this->getRecord2($data);
      $department = $department['data']; 
      $ar = "0000-00-00 00:00:00";
      foreach ($department as $key => $value) {
          if($value['newtimeout']!="0000-00-00 00:00:00"){
               $ar = $value['newtimeout'];
          }else{
              $ar = $value['newlastmin'];
          }
       
      }
      return $ar;
   }
   
   function checkIfManager($id){
          $data = array('model'=>'team', 'condition'=>"");// WHERE team_manager = '".$id."'",'order'=>"");
          $team = $this->getRecord2($data);
          $team = $team['data'];
          $ar = array();
          //echo json_encode($team);
          if(sizeOf($team)>0){
              foreach ($team as $key => $value) {
                //$ar[$value['id']] = $value;
                $managers = json_decode($value['team_manager']);
                if(in_array($id,$managers)){
                    $ar[] = $value['id'];
                }
              }
          }
          
          //echo json_encode($ar);
          return $ar;
   }
   
   
   function getTimeDiff($dtime,$atime)
{
    $nextDay=$dtime>$atime?1:0;
    $dep=explode(':',$dtime);
    $arr=explode(':',$atime);


    $diff=abs(mktime($dep[0],$dep[1],0,date('n'),date('j'),date('y'))-mktime($arr[0],$arr[1],0,date('n'),date('j')+$nextDay,date('y')));

    //Hour

    $hours=floor($diff/(60*60));

    //Minute 

    $mins=floor(($diff-($hours*60*60))/(60));

    //Second

    $secs=floor(($diff-(($hours*60*60)+($mins*60))));

    if(strlen($hours)<2)
    {
        $hours="0".$hours;
    }

    if(strlen($mins)<2)
    {
        $mins="0".$mins;
    }

    if(strlen($secs)<2)
    {
        $secs="0".$secs;
    }

    return $hours.':'.$mins.':'.$secs;

}

 
   
   function saveLog($action, $eid, $model, $oldvalue, $newvalue, $condition=null){
        if($condition==null){ $condition=""; } 
        $date = date('Y-m-d h:i:s', time());
        $data = array("model"=>"logs", 
                          "keys"=>"action, tmodel, date, oldvalue, newvalue, eid, conditionstring",
                          "values"=>"'".$action."', '".$model."', '".$date."', '".$oldvalue."', '".$newvalue."', '".$eid."', '".$condition."'");
                          
        $logs = $this->create2($data);                      
   }

   

   
   function getIps($condition){
      $data = array('model'=>'ips', 'condition'=>$condition,'order'=>' order by date DESC');
      //echo $condition."<br><br><br>";
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }




   function getMyACL($id){
      $data = array('model'=>'acl', 'condition'=>" WHERE emp_id = '".$id."'",'order'=>' order by feature_code');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }

   

   function getDepartments($condition=""){
      $data = array('model'=>'department', 'condition'=>$condition,'order'=>' order by name');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }

   function getResultData($condition=""){
      $data = array('model'=>'result_data', 'condition'=>$condition,'order'=>' order by id');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }

   function getPatientResults($condition=""){
      $order = "";
      if (strpos(strtoupper($condition), 'ORDER') === false) {
          $order = ' order by id';
      }
      $data = array('model'=>'labresults', 'condition'=>$condition,'order'=>$order);
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }

   

   function getLabMaterials($condition=""){
      $data = array('model'=>'labmaterials', 'condition'=>$condition,'order'=>' order by id');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }

   function getLabCategories($condition=""){
      $data = array('model'=>'labcategory', 'condition'=>$condition,'order'=>' order by name');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }

   function getCompanies($condition=""){
      $data = array('model'=>'company', 'condition'=>$condition,'order'=>' order by company');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }

   function getDoctors($condition=""){
     if($condition==""){ $condition="WHERE usertype='2'"; }
     else{ $condition .=" AND usertype='2'"; }
      $data = array('model'=>'employee', 'condition'=>$condition,'order'=>' order by fname');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }

   function getPo($condition=""){
      $order = "";
      if (strpos(strtoupper($condition), 'ORDER') === false) {
          $order = ' ORDER BY date_created ASC';
      }
      $data = array('model'=>'po', 'condition'=>$condition,'order'=>$order);
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }


   function getEnqueuedSimple($condition=""){
      if (strpos(strtoupper($condition), 'ORDER') !== false && strpos(strtoupper($condition), 'BY')) {
        $order="";
      }else{
          $order = "order by dtime";
      }
     
      $data = array('model'=>'queuing', 'condition'=>$condition,'order'=>$order);
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }


   function getEnqueuedSimpleMaxQ($condition=""){
      if (strpos(strtoupper($condition), 'ORDER') !== false && strpos(strtoupper($condition), 'BY')) {
        $order="";
      }else{
          $order = "order by dtime";
      }
     
      $data = array('model'=>'queuing', 'condition'=>$condition,'order'=>$order);
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $max = 0;
      foreach ($department as $key => $value) {
        $curval = explode("-",$value['queuing_number']);
        $thenum = (int) trim($curval[1]);
        if($max < $thenum){
          $max = $thenum;
        }
      }
      return $max;
   }


   function getEnqueued($condition=""){
      if (strpos(strtoupper($condition), 'ORDER') !== false && strpos(strtoupper($condition), 'BY')) {
        $order="";
      }else{
          $order = "order by dtime";
      }
      $settings = $this->getSettingsByName();
      $patients = $this->getPatients();
      $emplyees = $this->getEmployees();
      $ladoffered = $this->getLabTests();
      //echo json_encode(settings);
      $emplyees[0] = array("pf"=>$settings['doctor_default_fee']['value']);
      //echo json_encode($patients);
      
      $data = array('model'=>'queuing', 'condition'=>$condition,'order'=>$order);
      $department = $this->getRecord2($data);
      //echo json_encode($department);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        if(array_key_exists($value['patient_id'], $patients)){
          $ar[$value['id']] = $value;
        $ar[$value['id']]['patient_number'] = $patients[$value['patient_id']]['patient_number'];



        $ar[$value['id']]['name'] = $patients[$value['patient_id']]['prename']." ".$patients[$value['patient_id']]['fname']." ".$patients[$value['patient_id']]['lname'];
        if($value['trans_type']=="Check-up"){
          $ar[$value['id']]['item_name'] = "Consultation";
          if(!array_key_exists($value['dr_id'], $emplyees)){ $dkey=0; }else{ $dkey=$value['dr_id']; }
          $ar[$value['id']]['price'] = $emplyees[$dkey]['pf'];
        }else{

            $ar[$value['id']]['item_name'] = $ladoffered[$value['which']]['name'];
            $company = $value['company'];
            if($company==0){
              // $total=$total+$v['price']; 
              // $rprice = $v['price'];
              $ar[$value['id']]['price'] = $ladoffered[$value['which']]['price'];

            }else{
              $labcomps = $this->getMyLabCompanyByTest("WHERE company_id='".$company."'");
             //echo json_encode($labcomps)."=>".$company;
              //echo json_encode($v);
              // $total=$total + $labcomps[$v['which']]['price'];
              // $rprice = $labcomps[$v['which']]['price'];
              if(array_key_exists($value['which'], $labcomps)){
                $ar[$value['id']]['price'] = $labcomps[$value['which']]['price'];
              }else{
                $ar[$value['id']]['price'] = $ladoffered[$value['which']]['price'];
              }
              
            }


          
        }

        }
        
        
        
      }

      return $ar;
   }


   function getEnqueuedByCat($condition=""){
      $settings = $this->getSettingsByName();
      $patients = $this->getPatients();
      $emplyees = $this->getEmployees();
      $ladoffered = $this->getLabTests();
      //echo json_encode(settings);
      $emplyees[0] = array("pf"=>$settings['doctor_default_fee']['value']);
      //echo json_encode($patients);
      $data = array('model'=>'queuing', 'condition'=>$condition,'order'=>' order by dtime');
      $department = $this->getRecord2($data);
      //echo json_encode($department);
      $department = $department['data'];
      $ar = array();

      //echo json_encode($department);
      foreach ($department as $key => $value) {
        if($_SESSION['category']==""){ $_SESSION['category']=array(); }

        if(array_key_exists($value['which'], $ladoffered)){
          if(in_array($ladoffered[$value['which']]['category'], $_SESSION['category'])){
            $ar[$value['id']] = $value;
            $ar[$value['id']]['patient_number'] = $patients[$value['patient_id']]['patient_number'];
            $ar[$value['id']]['name'] = $patients[$value['patient_id']]['prename']." ".$patients[$value['patient_id']]['fname']." ".$patients[$value['patient_id']]['lname'];
            if($value['trans_type']=="Check-up"){
              $ar[$value['id']]['item_name'] = "Consultation";
              if(!array_key_exists($value['dr_id'], $emplyees)){ $dkey=0; }else{ $dkey=$value['dr_id']; }
              $ar[$value['id']]['price'] = $emplyees[$dkey]['pf'];
            }else{
                //echo json_encode($_SESSION['category']).$ladoffered[$value['which']]['category']."<br>";


                $ar[$value['id']]['item_name'] = $ladoffered[$value['which']]['name'];
                $company = $value['company'];
                if($company==0){
                  // $total=$total+$v['price']; 
                  // $rprice = $v['price'];
                  $ar[$value['id']]['price'] = $ladoffered[$value['which']]['price'];

                }else{
                  $labcomps = $this->getMyLabCompanyByTest("WHERE company_id='".$company."'");
                 //echo json_encode($labcomps)."=>".$company;
                  //echo json_encode($v);
                  // $total=$total + $labcomps[$v['which']]['price'];
                  // $rprice = $labcomps[$v['which']]['price'];
                  $ar[$value['id']]['price'] = $labcomps[$value['which']]['price'];
                }


              
            }
          }

        }else{

        }

        
        
        
      }

      return $ar;
   }

   function getSettings($condition=""){
      $data = array('model'=>'settings', 'condition'=>$condition,'order'=>' order by name');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }

   function getSettingsByName($condition=""){
      $data = array('model'=>'settings', 'condition'=>$condition,'order'=>' order by name');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['name']] = $value;
      }
      return $ar;
   }

   function getBillings($condition=""){
      if (strpos(strtoupper($condition), 'ORDER') !== false && strpos(strtoupper($condition), 'BY')) {
        $order="";
      }else{
          $order = "order by id ASC";
      }
      $data = array('model'=>'billings', 'condition'=>$condition);
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }

   function getExpenses($condition=""){
      if (strpos(strtoupper($condition), 'ORDER') !== false && strpos(strtoupper($condition), 'BY')) {
        $order="";
      }else{
          $order = "order by id ASC";
      }
      $data = array('model'=>'expenses', 'condition'=>$condition);
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }

   // function getBrands($condition=""){
   //    $data = array('model'=>'brands', 'condition'=>$condition,'order'=>' order by name');
   //    $department = $this->getRecord2($data);
   //    $department = $department['data'];
   //    $ar = array();
   //    foreach ($department as $key => $value) {
   //      $ar[$value['id']] = $value;
   //    }
   //    return $ar;
   // }

   function getTransactions($condition=""){
      $data = array('model'=>'transaction', 'condition'=>$condition,'order'=>' order by id');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }


   function getEnqTrans($condition=""){
      $data = array('model'=>'queuing', 'condition'=>$condition,'order'=>' order by id');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        if(!array_key_exists($value['date'], $ar)){
            $ar[$value['date']] = array();
        }
        if(!array_key_exists($value['date'], $ar)){
            $ar[$value['date']][$value['queuing_number']]  = array();
        }
        $ar[$value['date']][$value['queuing_number']][] = $value;
      }
      return $ar;
   }

   function getTransactionsToday($condition=""){
      $data = array('model'=>'transaction', 'condition'=>$condition,'order'=>' order by id');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['queuing_number']] = $value;
      }
      return $ar;
   }

   function getTransactionsTodayQN($condition=""){
      $data = array('model'=>'transaction', 'condition'=>$condition,'order'=>' order by id');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[] = $value['queuing_number'];
      }
      return $ar;
   }

   function getPatients($condition=""){
      $data = array('model'=>'patient', 'condition'=>$condition,'order'=>' order by fname');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }

   function getVitalSigns($condition=""){
      $data = array('model'=>'vitalsigns', 'condition'=>$condition,'order'=>' order by datetime DESC');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }

   function getQueuing($condition=""){
      $data = array('model'=>'queuing', 'condition'=>$condition,'order'=>' order by dtime');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }

   function getACL($condition=""){
      $data = array('model'=>'acl', 'condition'=>$condition,'order'=>' order by feature_code');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }

   function getBrands($condition=""){
      $data = array('model'=>'brands', 'condition'=>$condition,'order'=>' order by name');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }

   function getDiseases($condition=""){
      $data = array('model'=>'diseases', 'condition'=>$condition,'order'=>' order by name');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }

   function getPatientDisease($condition=""){
      $data = array('model'=>'patient_disease', 'condition'=>$condition,'order'=>' order by datetime DESC');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }

   function getTestCategory($condition=""){
      $data = array('model'=>'labcategory', 'condition'=>$condition,'order'=>' order by name');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }

   function getOperations($condition=""){
      $data = array('model'=>'operations', 'condition'=>$condition,'order'=>' order by name');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }

   function getPatientOperations($condition=""){
      $data = array('model'=>'patient_operations', 'condition'=>$condition,'order'=>' order by datetime DESC');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }


  function getSuppliers($condition=""){
      $data = array('model'=>'suppliers', 'condition'=>$condition,'order'=>' order by business');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   } 

   function getSupMaterials($condition=""){
      $data = array('model'=>'supmaterials', 'condition'=>$condition,'order'=>'');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }   

   function getMaterialprice($condition=""){
      $data = array('model'=>'materialprice', 'condition'=>$condition,'order'=>' order by id');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }   

   function getMaterials($condition=""){
      $data = array('model'=>'materials', 'condition'=>$condition,'order'=>' order by name');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }

function getMyMaterials($condition=""){
      $data = array('model'=>'labmaterials', 'condition'=>$condition,'order'=>'');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }


   function getMySupMaterials($condition=""){
      $data = array('model'=>'supmaterials', 'condition'=>$condition,'order'=>'');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }

  function getLabTests($condition=""){
      $data = array('model'=>'laboffered', 'condition'=>$condition,'order'=>' order by name');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }
  
   function getLabResults($condition=""){
      $data = array('model'=>'labresults', 'condition'=>$condition,'order'=>' order by date DESC');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }
  

    function getMyLabCompany($condition=""){
      $data = array('model'=>'lab_company', 'condition'=>$condition,'order'=>'');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }
   function getMyLabCompanyByTest($condition=""){
      $data = array('model'=>'lab_company', 'condition'=>$condition,'order'=>'');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['lab_id']] = $value;
      }
      return $ar;
   }


   function getLabs($condition=""){
      $data = array('model'=>'laboffered', 'condition'=>$condition,'order'=>'');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }


   function getSymptoms($condition=""){
      $data = array('model'=>'symptoms', 'condition'=>$condition,'order'=>'');
      //echo $condition;
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }

   function getPatientSymptoms($condition=""){
      $data = array('model'=>'patient_symptoms', 'condition'=>$condition,'order'=>' ORDER BY datetime DESC');
      //echo $condition;
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }

   function getPrescription($condition=""){
      $data = array('model'=>'presription', 'condition'=>$condition,'order'=>' ORDER BY datetime DESC');
      //echo $condition;
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        if(!array_key_exists($value['queuing_number'], $ar)){ $ar[$value['queuing_number']]=array(); }
        $ar[$value['queuing_number']][] = $value;
      }
      return $ar;
   }

   function getMedicines($condition=""){
      $data = array('model'=>'medicines', 'condition'=>$condition,'order'=>' ORDER BY name');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
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
    
   
   function getEmployees($condition=null){
      if($condition==null){
          $condition = " ";
      } 
      $data = array('model'=>'employee', 'condition'=>$condition,'order'=>' ORDER BY fname');
      $department = $this->getRecord2($data);
      $department = $department['data'];
      //echo json_encode($department);
      $ar = array();
      foreach ($department as $key => $value) {
        $ar[$value['id']] = $value;
      }
      return $ar;
   }
   
   function getOnOff(){
       return array(0=>"ON",1=>"OFF");
   }
   
   function getWebDirectory($domain){
       //$domain = strtolower($domain);
       $root = str_replace("kirbypanel",$domain,ROOT_DIR);
       return $root;
   }

   function saveAccsessLog($data){
     
       $saveData = array("model"=>"logs", 
            'keys'=>'uid, date, feature, title, action, webfile, oldvalue, newvalue',
            'values'=>"'".$data['uid']."', '".$data['date']."', '".$data['feature']."', '".$data['title']."', '".$data['action']."', '".$data['webfile']."', '".$data['logs']['old']."', '".$data['logs']['new']."'",
       );
       
       $rs = $this->create2($saveData);
   }
   
   function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
    
    
  
   
   function getLabCompTypes(){
     return array(0=>"Pre-employment", 1=>"Annual");
   }
   

   function getUserTypes(){
    return array(0=>"Super", 
                 1=>"Administrator", 
                 2=>"Doctor", 
                 3=>"Lab Technician",
                 4=>"Cashier",
                 5=>"Information Staff",
                 6=>"Accounting Staff",
                 7=>"Others");
   }

   function getTestCategoryE(){
    return array(0=>"Category 1", 
                 1=>"Administrator", 
                 2=>"Doctor", 
                 3=>"Lab Technician",
                 4=>"Cashier",
                 5=>"Information Staff",
                 6=>"Accounting Staff",
                 7=>"Others");
   }


   function getPresTypes(){
    return array(0=>"Once a day", 
                 1=>"Twice a day", 
                 2=>"Three Times a day", 
                 3=>"Every Hour",
                 4=>"Every Two Hours",
                 5=>"Every Three Hours",
                 6=>"Every Four Hours",
                 7=>"Every Five Hours",
                 6=>"Every Six Hours");
   }

   function getVitalTypes(){
    return array(0=>"Pulse rate", 
                 1=>"Blood Pressure", 
                 2=>"Resperation Rate", 
                 3=>"Temperature");
   }
   
   function ACLfeatures($id){
       $data = array("model"=>"acl", "condition"=>" WHERE emp_id = '".$id."'");
       $ret = $this->getRecord2($data);
       $new_array = array();
       foreach($ret['data'] as $k => $v){
         $new_array[trim($v['feature_code'])] = $v['fcontrol'];
       }
       $new_array['profile']=1;
       return $new_array;
   }

   function ACLsetDefault($id){
       $default=array("profile",
                      "home");

       foreach($this->aclLists() as $k=> $v){
         $d = array("model"=>"acl", "condition"=>" WHERE emp_id = '".$id."' AND feature_code = '".trim($k)."'");
         $rc = $this->getRecord2($d);
         if(sizeOf($rc['data'])==0){
          $vsa=0;
          if(trim($k)=="home"){ $vsa = 1; }
          if (in_array(trim($k), $default)){ $vsa=1; }
          $indata = array("model"=>"acl", 
                    "keys"=>"emp_id, feature_code, fcontrol",
                    "values"=>"'".$id."', '".trim($k)."', '".$vsa."'"
                    );
          $this->create2($indata,1);
         }
       }
       //exit();
   }


   

   function getCategoryNames(){
      $dataS = array(
          'model'=>'labcategory'
      );
      $categories = $this->getRecord2($dataS);
      $categories=$categories['data'];
      $r=array();
      foreach($categories as $k => $v){
        $r[$v['id']] = $v['name'];
      }
      return $r;
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

    function createPatientId($length = 8) {
        $id = "SHS-".date("Y").date("m").date("d")."-";
        $characters = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $id.$randomString;
    }


    function createEmployeeId($length = 4) {
        $id = "SEN-".date("Y").date("m").date("d")."-";
        $characters = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $id.$randomString;
    }

    function createCompanyId($length = 4) {
        $id = "COM-".date("Y").date("m").date("d")."-";
        $characters = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $id.$randomString;
    }

    function getQueingNumber(){
      $date = date("Y-m-d");
      $dname = date("D");
      $condition = "WHERE date = '".$date."'";
      $max = $this->getEnqueuedSimpleMaxQ($condition);
      $nexIs = $max + 1;

      while(strlen($nexIs)<3){
        $nexIs = "0".$nexIs;
      }

      $id = $dname."-".$nexIs;
      return $id;
      
    }
    
    function RandomString2($length = 50) {
        $characters = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    
    function createID(){ 
        $Ran = $this->RandomString2(10);
        $id=PREID.$Ran;
        return $id;
    }
    
    function autoGenerateIds(){
        $data = $this->getEmployees();
        foreach($data as $k=>$v){
            //echo $v['fname']." creating ID...<br>";
            if(trim($v['employee_number'])==""){
                $myid = $this->createID();
                $ud = array("model"=>"employee", "values"=>" employee_number='".$myid."'", "condition"=>" WHERE id = '".$v['id']."'");
                $up = $this->update2($ud);
            }
        }
    }
    
    

    function connect($data=null){
        return mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }


    function checkUserExist($data){
          $model = modelPreName . "user";
          if (array_key_exists("method",$data)){
            if($data['method']=="login"){
                    $sql = "SELECT * FROM $model WHERE user_Uname = '".$data['inputs']['uname']."' AND user_Upass = '".sha1($data['inputs']['upass'])."'";
            }else{
                    $sql = "SELECT * FROM $model WHERE user_Uname = '".$data['inputs']['uname']."'";
              }
          }else{
                  $sql = "SELECT * FROM $model WHERE user_Uname = '".$data['inputs']['uname']."'";
              }
          $result = mysqli_query(self::connect(),$sql) or die(mysqli_connect_error()); 
          //echo $sql;
          if(mysqli_num_rows($result)==0){
             return mysqli_num_rows($result); 
          }else{
            return mysqli_fetch_assoc($result);
          }
    }


    function updatePhoto($data){
        $ds = array("model"=>"employee", 'values'=>"image = '".$data['photo']."'", 'condition'=>" WHERE id = '".$data['id']."'");
        $r=$this->update2($ds);
    }

    function userLogin($data){
          $model = modelPreName . "employee";
          $sql = "SELECT * FROM $model WHERE ( un = '".$data['inputs']['uname']."' OR email = '".$data['inputs']['uname']."') AND up = '".sha1($data['inputs']['upass'])."'";
          $result = mysqli_query(self::connect(),$sql) or die(mysqli_connect_error()); 
          //echo $sql;
          if(mysqli_num_rows($result)==0){
             return mysqli_num_rows($result); 
          }else{
            return mysqli_fetch_assoc($result);
          }
    }

    function getRecordById($model,$id){
        //$model = modelPreName . $model;
        $dataq = array(
          'model'=>$model,
          'condition'=>" WHERE id = '".$id."'"
        );
        //echo json_encode($dataq);
        return $this->getRecord2($dataq);
    }

    function getMyUsers($id=null){
      $c="";
      if($id!=null){ $c = " WHERE id = '$id'"; }
      $dataq = array(
          'model'=>'employee',
          'order'=>" ORDER BY fname",
          'condition'=>$c
        );
        //echo json_encode($dataq);
      $u = $this->getRecord2($dataq);
      //echo json_encode($u);
     return $u['data'];
    }

    function getRecordJoint($data){
        if(!self::connect()){
            return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
        }
        else{
            if (array_key_exists("order",$data)){
                $orderKey = $data['order'];
                $order = " order by ".$orderKey;
            }
            else{ $order = ""; }

            //$sql = "SELECT * FROM ".$data['model']." ".$data['condition']." ".$order;
            $sql = $data['joint'];
            //echo $sql;
            $result = mysqli_query(self::connect(),$sql) or die(mysqli_connect_error());
            $total = mysqli_num_rows($result);
            $index = 0;
            //echo $total;
            $responseData=array();
            while($fetchData = mysqli_fetch_assoc($result)){
                //return json_encode(array('status' => '200', 'message'=>'Successful', 'affected'=>$total, 'data'=>$fetchData));
                //echo json_encode($fetchData)."<br><br>";
                if (array_key_exists("secpass",$fetchData)){
                    $fetchData['secpass'] = '';
                }
                $responseData[$index] = $fetchData;
                $index++;
            }
            return $responseData;

        }
    }

    function getRecord($data){
      if(!self::connect()){
          return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
      } 
      else{
          $model = 'tbl_'.$data['model'];
          $modelName = $data['model']. '_';
          $conditions = ''; $values = ''; $realCount = 0; $conditionCount = 0;
          if (array_key_exists("order",$data)){ 
              $orderKey = $data['order'];
              $order = " order by ".$orderKey; 
              }
          else{ $order = ""; }
              
          if (array_key_exists("keys",$data)){
                  if(is_array($data['keys'])){
                  foreach ($data['keys'] as $keyCount => $valueCount){$realCount++;}
                  $count = 0; 
                  if($realCount>0){
                  foreach ($data['keys'] as $key => $value){
                    if($count<$realCount && $count>0){ $comma = ', '; }else{ $comma = ' '; }
                    $values = $values . $comma . $modelName . ucfirst($value). " ";
                    $count++;
                  } }
                  else{
                      $values = " * ";
                  }
                }else{
                  $values = $data['keys'];
                  //$values = " ".$data->keys." ";
                }
          }else{
                  $values = " * ";
          }
              //echo $values;
              if (array_key_exists("conditions",$data)){
                foreach ($data['conditions'] as $keyCount => $valueCount){$conditionCount++;}
              if($conditionCount>0){
                  $conditions = ' WHERE ';
                  foreach ($data['conditions'] as $key => $value){
                      
                      if(strpos($value, "(AND)") !== false){
                          $operator = "AND ";
                          $value = str_replace(" (AND)","",$value);
                      }elseif(strpos($value, "(OR)") !== false){
                          $operator = "OR ";
                          $value = str_replace(" (OR)","",$value);
                      }else{
                        $operator = '';
                      }
                      if($key=="id"){
                        $conditions = $conditions . $key. " = '".$value."' " . $operator;
                      }else{
                        $conditions = $conditions . $modelName .ucfirst($key). " = '".$value."' " . $operator;
                      }
                  } 
                }
              }
              //return json_encode(array('status' => '200', 'message'=>'Successful', 'affected'=>$conditions.' '.$values));
              $sql = "SELECT $values FROM $model $conditions ".$order;
             //echo $sql;
              //echo $sql;
              //return json_encode(array('status' => '200', 'message'=>'Successful', 'affected'=>$sql));
              $result = mysqli_query(self::connect(),$sql) or die(mysqli_connect_error()); 
              //echo 1;
              $total = mysqli_num_rows($result);
               $index = 0;
               $responseData=array();

               while($fetchData = mysqli_fetch_assoc($result)){
                   //return json_encode(array('status' => '200', 'message'=>'Successful', 'affected'=>$total, 'data'=>$fetchData));
                  if (array_key_exists("user_Secpass",$fetchData)){
                    $fetchData['user_Secpass'] = '';
                  }
                   $responseData[$index] = $fetchData;
                   $index++;
               }
              //if($data->model=="user"){ $responseData['user_Secpass'] = ""; } 
              if (array_key_exists("method",$data)){
              if($data['method']=="login"){return array('status' => '200', 'message'=>'Successful', 'affected'=>$total, 'data'=>$responseData);}
              else{return array('status' => '200', 'message'=>'Successful', 'affected'=>$total, 'data'=>$responseData);}
              }
              else{return array('status' => '200', 'message'=>'Successful', 'affected'=>$total, 'data'=>$responseData);}
              
      }
    }

    function create2($data,$p=null){
        if(!self::connect()){
            return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
        }
        else{
            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $keys = $data['keys'];
            $values = $data['values'];
            $model = 'tbl_'.$data['model'];
            $sql = "INSERT INTO $model($keys) VALUES($values)";
            // if($data['model']=="payments") echo "<br>".$sql."<br>";
             
            if($mysqli->query($sql)){
               //echo $data['model']." >".$p."<";
                if($data['model']!="logs" && ($p==NULL || trim($p)=="") && isset($_SESSION['login_id'])){
                    
                    $this->saveLog("CREATE", $_SESSION['login_id'], $data['model'], "", str_replace(']',"",str_replace('[',"",str_replace("'","\'",$values))), "id=\'".$mysqli->insert_id."\'");
                }
                return array('status' => '200', 'action'=>'create','message'=>'Successful', 'id'=>$mysqli->insert_id);
            }
           
        }

    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    function update2($data, $exempt=null){
        if (array_key_exists("condition",$data)){ $condition = $data['condition']; }else{ $condition = ""; }
        $values = $data['values'];
        $model = 'tbl_'.$data['model'];
        //$sql = "SELECT * FROM $model ".$condition;
        //echo $model .$condition;
        $datap = array('model'=>$data['model'], 'condition'=>$condition);
        $oa = $this->getRecord2($datap);
        if(sizeOf($oa['data'])>0){
          $oa = json_encode($oa['data'][0]);
          $sql = "UPDATE $model set $values $condition";
          // echo $sql;
          $result = mysqli_query(self::connect(),$sql) or die(mysqli_connect_error());
          if($exempt==null){
          $this->saveLog("UPDATE", $_SESSION['login_id'], $data['model'], $oa, str_replace(']',"",str_replace('[',"",str_replace("'","\'",$values))), str_replace("'","\'",$condition));
          }
          return array('status' => '200', 'action'=>'update', 'message'=>'Successful', 'affected'=>1);
        }
        
    }


    function delete2($data){

        if(!self::connect()){
            return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
        }
        else{
            if (array_key_exists("condition",$data)){ $condition = $data['condition']; }else{ $condition = ""; }
            $model = 'tbl_'.$data['model'];
            $sql = "DELETE FROM $model ".$condition;
            
            $datap = array('model'=>$data['model'], 'condition'=>$condition);
            $oa = $this->getRecord2($datap);
            if(sizeOf($oa['data'])>0){
            $oa = json_encode($oa['data'][0]); 
            $result = mysqli_query(self::connect(),$sql) or die(mysqli_connect_error());
            $this->saveLog("DELETE", $_SESSION['login_id'], $data['model'], $oa, "", str_replace("'","\'",$condition));
            }
            return array('status' => '200', 'action'=>"delete",'message'=>'Successful', 'affected'=>1);
        }

    }

    function getRecordDirect($data){
        if(!self::connect()){
            return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
        }
        else{
            if (array_key_exists("condition",$data)){ $condition = $data['condition']; }else{ $condition = ""; }
            if (array_key_exists("order",$data)){ $order = $data['order']; }else{ $order = ""; }
            $model = 'tbl_'.$data['model'];
            $sql = "SELECT * FROM $model ".$condition." ".$order;
            $result = mysqli_query(self::connect(),$sql) or die(mysqli_connect_error());
            //echo json_encode($result);
            return $result;
        }
    }

    function getRecord2_old($data){
        if(!self::connect()){
            return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
        }
        else{
            if (array_key_exists("condition",$data)){ $condition = $data['condition']; }else{ $condition = ""; }
            if (array_key_exists("order",$data)){ $order = $data['order']; }else{ $order = ""; }
            $model = 'tbl_'.$data['model'];
            $sql = "SELECT * FROM $model ".$condition." ".$order;
            // echo $sql;
            $result = mysqli_query(self::connect(),$sql) or die(mysqli_connect_error());
            $total = mysqli_num_rows($result);
            $index = 0;
            $responseData=array();
            while($fetchData = mysqli_fetch_assoc($result)){
                if (array_key_exists("secpass",$fetchData)){
                    $fetchData['secpass'] = '';
                }
                $responseData[$index] = array();
                foreach($fetchData as $key=> $value){
                    $responseData[$index][$key]=$value;
                }
                //$responseData[$index] = $fetchData;
                $index++;
            }
            
            


            if (array_key_exists("method",$data)){
                if($data['method']=="login"){return array('status' => '200', 'message'=>'Successful', 'affected'=>$total, 'data'=>$responseData);}
                else{return array('status' => '200', 'message'=>'Successful', 'affected'=>$total, 'data'=>$responseData);}
            }
            else{
               // echo json_encode($responseData);
                return array('status' => '200', 'message'=>'Successful', 'affected'=>$total, 'data'=>$responseData);
                
            }

        }
    }
    
    
     function getRecord2($data){
        if(!self::connect()){
            return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
        }
        else{
            if (array_key_exists("condition",$data)){ $condition = $data['condition']; }else{ $condition = ""; }
            if (array_key_exists("order",$data)){ $order = $data['order']; }else{ $order = ""; }
            $model = 'tbl_'.$data['model'];
            $sql = "SELECT * FROM $model ".$condition." ".$order;
             // if($data['model']=="po") echo $sql;
            $result = mysqli_query(self::connect(),$sql) or die(mysqli_connect_error());
            $total = mysqli_num_rows($result);
            $index = 0;
            $responseData=array();
            while($fetchData = mysqli_fetch_assoc($result)){
                // if (array_key_exists("secpass",$fetchData)){
                //     $fetchData['secpass'] = '';
                // }
                //echo json_encode($fetchData);
                $responseData[$index] = array();
                // foreach($fetchData as $key=> $value){
                //     $responseData[$index]["$key"]=$value;
                // }
                $responseData[$index] = $fetchData;
                $index++;
            }
            
            //echo json_encode($responseData);


            if (array_key_exists("method",$data)){
                if($data['method']=="login"){return array('status' => '200', 'message'=>'Successful', 'affected'=>$total, 'data'=>$responseData);}
                else{return array('status' => '200', 'message'=>'Successful', 'affected'=>$total, 'data'=>$responseData);}
            }
            else{
               // echo json_encode($responseData);
                return array('status' => '200', 'message'=>'Successful', 'affected'=>$total, 'data'=>$responseData);
                
            }

        }
    }
    
    function getDistinct($data){
        if(!self::connect()){
            return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
        }
        else{
            if (array_key_exists("condition",$data)){ $condition = $data['condition']; }else{ $condition = ""; }
            if (array_key_exists("order",$data)){ $order = $data['order']; }else{ $order = ""; }
            $model = $data['model'];
            //echo $order;
            //echo $order;
            $sql = "SELECT  * FROM $model ".$condition." ".$order;
            //$sql = "SELECT * FROM (SELECT DISTINCT Country FROM Customers);";
//            echo "<br>1.".$data['condition']."<br>";
//            echo "2.".$data['conditions']."<br>";
//            echo "3".$condition;
            //echo $sql."<br>";
            $result = mysqli_query(self::connect(),$sql) or die(mysqli_connect_error());
            //echo 1;
            $total = mysqli_num_rows($result);
            $index = 0;
            $responseData=array();
            while($fetchData = mysqli_fetch_assoc($result)){
                if (array_key_exists("secpass",$fetchData)){
                    $fetchData['secpass'] = '';
                }
                $responseData[$index] = $fetchData;
                $index++;
            }
            
            


            if (array_key_exists("method",$data)){
                if($data['method']=="login"){return array('status' => '200', 'message'=>'Successful', 'affected'=>$total, 'data'=>$responseData);}
                else{return array('status' => '200', 'message'=>'Successful', 'affected'=>$total, 'data'=>$responseData);}
            }
            else{
               // echo json_encode($responseData);
                return array('status' => '200', 'message'=>'Successful', 'affected'=>$total, 'data'=>$responseData);
                
            }

        }
    }


    function getRecordInnerJoin($sql){
        if(!self::connect()){
            return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
        }
        else{
            $result = mysqli_query(self::connect(),$sql) or die(mysqli_connect_error());
            $total = mysqli_num_rows($result);
            $index = 0;
            $responseData=array();
            while($fetchData = mysqli_fetch_assoc($result)){
                if (array_key_exists("secpass",$fetchData)){
                    $fetchData['secpass'] = '';
                }
                $responseData[$index] = $fetchData;
                $index++;
            }
           return array('status' => '200', 'message'=>'Successful', 'affected'=>$total, 'data'=>$responseData);
            

        }
    }


    function create($data){
      //echo json_encode($sata);
      if(!self::connect()){
          return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
      } 
      else{
          //(DB_HOST, DB_USER, DB_PASS, DB_NAME);
          $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
          $model = modelPreName.$data['model'];
          $modelName = $data['model']. '_';
          $keys = ''; $values = ''; $realCount =0;
          foreach ($data['inputs'] as $keyCount => $valueCount){$realCount++;}
          //return self::checkUserExist($data);
          if($data['model'] == "user"){
            if(self::checkUserExist($data)<1){
                $count = 0; 
                foreach ($data['inputs'] as $key => $value){
                    if($count<$realCount && $count>0){ $comma = ', '; }else{ $comma = ''; }
                    if($key!="id"){ $keys = $keys . $comma . $modelName .ucfirst($key); }
                    else{ $keys = $keys . $comma . $key; }
                    $values = $values . $comma . "'".$value."'";
                    $count++;
                } 
                //return $keys. $realCount . ' '.$count;
                $sql = "INSERT INTO $model($keys) VALUES($values)";

                //$result = mysqli_query(self::connect(),$sql) or die(mysqli_connect_error());
                $sql = "INSERT INTO $model($keys) VALUES($values)";
                $result = $mysqli->query($sql);
                return array('status' => '200', 'message'=>'Successful', 'id'=>$mysqli->insert_id);
            }else{
                return array('status' => '202', 'message'=>'Exist');
            }
          }else{
              $count = 0; 
              //echo json_encode($data);
                foreach ($data['inputs'] as $key => $value){
                    if($count<$realCount && $count>0){ $comma = ', '; }else{ $comma = ''; }
                    if($key!="id"){ $keys = $keys . $comma . $modelName .ucfirst($key); }
                    else{ $keys = $keys . $comma . $key; }
                    $values = $values . $comma . "'".$value."'";
                    $count++;
                } 
                //return $keys. $realCount . ' '.$count;
                
                $sql = "INSERT INTO $model($keys) VALUES($values)";
                $result = $mysqli->query($sql);
                //$result = mysqli_query(self::connect(),$sql) or die(mysqli_connect_error()); 
                return array('status' => '200', 'message'=>'Successful', 'id'=>$mysqli->insert_id);
          }
          
      }
            
    } 


    function update($data){
      $model = 'tbl_'.$data['model'];
          $modelName = $data['model']. '_';
          $conditions = ''; $values = ''; $realCount = 0; $conditionCount = 0;
         
          $count=0;   
          $keys="";
          $realCount = sizeof($data['inputs']);
          foreach ($data['inputs'] as $key => $value){
                    if($count<$realCount && $count>0){ $comma = ', '; }else{ $comma = ''; }
                    if($key!="id"){ $theKey =  $modelName .ucfirst($key); }
                    else{ $theKey = $key; }
                    $values = $values . $comma . " ".$theKey."='".$value."'";
                    $count++;
                } 
              //echo $values;
              if (array_key_exists("conditions",$data)){
                foreach ($data['conditions'] as $keyCount => $valueCount){$conditionCount++;}
              if($conditionCount>0){
                  $conditions = ' WHERE ';
                  foreach ($data['conditions'] as $key => $value){
                      
                      if(strpos($value, "(AND)") !== false){
                          $operator = "AND ";
                          $value = str_replace(" (AND)","",$value);
                      }elseif(strpos($value, "(OR)") !== false){
                          $operator = "OR ";
                          $value = str_replace(" (OR)","",$value);
                      }else{
                        $operator = '';
                      }
                      if($key=="id"){
                        $conditions = $conditions . $key. " = '".$value."' " . $operator;
                      }else{
                        $conditions = $conditions . $modelName .ucfirst($key). " = '".$value."' " . $operator;
                      }
                  } 
                }
              }
              //return json_encode(array('status' => '200', 'message'=>'Successful', 'affected'=>$conditions.' '.$values));
              $sql = "update $model set $values $conditions ";
              //echo $sql;
              $result = mysqli_query(self::connect(),$sql) or die(mysqli_connect_error()); 
              return array('status' => '200', 'message'=>'Successful', 'affected'=>1);              
    }


    function delete($data){

      if(!self::connect()){
          return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
      } 
      else{
          $count=0;
          $conditions="";
          $conditionCount =0;
          if (array_key_exists("conditions",$data)){
            $conditionCount = sizeof($data['conditions']);
              foreach ($data['conditions'] as $keyCount => $valueCount){$conditionCount++;}
              if($conditionCount>0){
                  $conditions = ' WHERE ';
                  foreach ($data['conditions'] as $key => $value){
                      
                      if(strpos($value, "(AND)") !== false){
                          $operator = "AND ";
                          $value = str_replace(" (AND)","",$value);
                      }elseif(strpos($value, "(OR)") !== false){
                          $operator = "OR ";
                          $value = str_replace(" (OR)","",$value);
                      }else{
                        $operator = '';
                      }
                      if($key=="id"){
                        $conditions = $conditions . $key. " = '".$value."' " . $operator;
                      }else{
                        $conditions = $conditions . $modelName .ucfirst($key). " = '".$value."' " . $operator;
                      }
                  } 
                }
              }

           $model = "tbl_".$data['model']; 
           $sql = "DELETE FROM $model ".$conditions;
           //echo $sql;
           $result = mysqli_query(self::connect(),$sql) or die(mysqli_connect_error()); 
           return array('status' => '200', 'message'=>'Successful', 'affected'=>1); 
      }

    }



    function getRecordLike($data){
      if(!self::connect()){
          return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
      } 
      else{
                if (array_key_exists("order",$data)){ 
              $orderKey = $data['order'];
              $order = " order by ".$orderKey; 
              }
          else{ $order = ""; }
          
              $sql = "SELECT * FROM ".$data['model']." ".$data['condition']." ".$order;
              //echo $sql;
              $result = mysqli_query(self::connect(),$sql) or die(mysqli_connect_error()); 
              $total = mysqli_num_rows($result);
               $index = 0;
               $responseData=array();
               while($fetchData = mysqli_fetch_assoc($result)){
                   //return json_encode(array('status' => '200', 'message'=>'Successful', 'affected'=>$total, 'data'=>$fetchData));
                  if (array_key_exists("user_Secpass",$fetchData)){
                    $fetchData['user_Secpass'] = '';
                  }
                   $responseData[$index] = $fetchData;
                   $index++;
               }
             return $responseData;
              
      }
    }


    function checkExist($data){

      if(!self::connect()){
          return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
      } 
      else{
          $realCount = sizeOf($data['inputs']);
          $count=0;
          if($realCount >0) {$where = " WHERE ";}else{$where = '';}
          foreach ($data['inputs'] as $key => $value){
                    if($count==$realCount || $count==0){ $comma = ''; }else{ $comma = ' AND '; }
                      $where = $where . $comma . $key . " = '".mysqli_escape_string(self::connect(),  $value)."' ";
                    $count++;
          } 
           $model = "tbl_".$data['model']; 
           $sql = "SELECT * FROM $model ".$where;
           //echo $sql;
           //exit();
           $result = mysqli_query(self::connect(),$sql) or die(mysqli_connect_error()); 
           $total = mysqli_num_rows($result);
           return $total; 
      }

    }

     function faqscreate($data){
        //  echo"<br>";
        // echo json_encode($data);
        if(!self::connect()){
            return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
        }
        else{
            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $keys = $data['keys'];
            $values = $data['values'];
            $model = 'tbl_'.$data['model'];
            $sql = "INSERT INTO $model($keys) VALUES($values)";
            //echo "<br>".$sql."<br>";
            $result = $mysqli->query($sql);
            //return array('status' => '200', 'action'=>'create','message'=>'Successful', 'id'=>$mysqli->insert_id);
        }

    }
    function faqsviewall(){
       $result =array();
        if(!self::connect()){
            return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
        }
        else{
            
             $mysqlix = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
             
             //$model = "tbl_".$data['model']; 
             $sql = "SELECT * FROM tbl_faqs";
             $result = $mysqlix->query($sql);
             return $result;
            
             
        }

    }
    function faqsview($id){
       $result =array();
        if(!self::connect()){
            return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
        }
        else{
            
             $mysqlix = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
             
             //$model = "tbl_".$data['model']; 
             $sql = "SELECT * FROM tbl_faqs WHERE id = '".$id."'";
             $result = $mysqlix->query($sql);
             return $result;
            
             
        }

    }
    function faqsupdate($id,$parent,$question,$answer){
       $result =array();
        if(!self::connect()){
            return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
        }
        else{
        
             $mysqliy = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
             $values ="parent ='".$parent."',question ='".$question."',answer ='".$answer."'";
             $condition = "WHERE id ='".$id."'";
              $sql = "UPDATE tbl_faqs set $values $condition";
             $result = $mysqliy->query($sql);
             //$result = mysqli_query(self::connect(),$sql) or die(mysqli_connect_error()); 
             //return $result;
            
             
        }

    }

     function faqsdelete($id){
       $result =array();
        if(!self::connect()){
            return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
        }
        else{
             $mysqliy = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
             $condition = "WHERE id ='".$id."'";
             $sql = "DELETE FROM tbl_faqs $condition";
             $result = $mysqliy->query($sql);
        }

    }
    
    function uploadloc($id){
       $result =array();
        if(!self::connect()){
            return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
        }
        else{
            
             $mysqlix = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
             $sql = "SELECT * FROM tbl_attachments WHERE modelid = '".$id."' AND modelname = 'tickets'";
             $result = $mysqlix->query($sql);
             return $result;
            
             
        }

    }
    
    function commentFiles($id){
       $result =array();
        if(!self::connect()){
            return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
        }
        else{
            
             $mysqlix = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
             $sql = "SELECT * FROM tbl_attachments WHERE modelid = '".$id."' AND modelname = 'comments'";
             //echo $sql;
             $result = $mysqlix->query($sql); 
             return $result;
            
             
        }

    }
    
    function commentscreate($data){
        //  echo"<br>";
        // echo json_encode($data);
        if(!self::connect()){
            return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
        }
        else{
            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $keys = $data['keys'];
            $values = $data['values'];
            $model = 'tbl_'.$data['model'];
            $sql = "INSERT INTO $model($keys) VALUES($values)";
            //echo "<br>".$sql."<br>";
            $result = $mysqli->query($sql);
            //return array('status' => '200', 'action'=>'create','message'=>'Successful', 'id'=>$mysqli->insert_id);
            return array('id'=>$mysqli->insert_id);
        }

    }
    function selectcomments($id){
       $result =array();
        if(!self::connect()){
            return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
        }
        else{
            
             $mysqlix = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
             
             //$model = "tbl_".$data['model']; 
             $sql = "SELECT * FROM tbl_notes WHERE tid = '".$id."'ORDER BY date";
             $result = $mysqlix->query($sql);
             return $result;
            
             
        }

    }
    function replycreate($data){
        //  echo"<br>";
        // echo json_encode($data);
        if(!self::connect()){
            return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
        }
        else{
            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $keys = $data['keys'];
            $values = $data['values'];
            $model = 'tbl_'.$data['model'];
            $sql = "INSERT INTO $model($keys) VALUES($values)";
            //echo "<br>".$sql."<br>";
            $result = $mysqli->query($sql);
            return array('id'=>$mysqli->insert_id);
            //return array('status' => '200', 'action'=>'create','message'=>'Successful', 'id'=>$mysqli->insert_id);
        }

    }
    
     function selectreply($id){
       $result =array();
        if(!self::connect()){
            return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
        }
        else{
            
             $mysqlix = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
             
             //$model = "tbl_".$data['model']; 
             $sql = "SELECT * FROM tbl_reply WHERE cid = '".$id."' ORDER BY date";
             $result = $mysqlix->query($sql);
             return $result;
            
             
        }

    }
    
    function selectcommentID($id){
       $result =array();
        if(!self::connect()){
            return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
        }
        else{
            
             $mysqlix = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
             
             //$model = "tbl_".$data['model']; 
             $sql = "SELECT * FROM tbl_notes WHERE id = '".$id."'ORDER BY date";
             $result = $mysqlix->query($sql);
             return $result;
            
             
        }

    }
    //function time_elapsed_string($datetime, $full = false) {
    function time_elapsed_string($datetime, $full = false, $timezone = null) {
        
        if($timezone==null){
            $timezone='America/New_York';
        }else{
            date_default_timezone_set($timezone);
            if($timezone==""){
                $timezone="Asia/Manila";
            }
        }
        //echo $timezone."<=="; 
        date_default_timezone_set($timezone);
       // date_default_timezone_set('America/New_York');
         //echo $datetime."<==<br>";
        
        $actual= date('Y-m-d H:i:s', time());
        $actual= date('Y-m-d H:i:s', strtotime($actual." -3 minute"));
        if($datetime>=$actual){
            return "Online";
        }else{
            $now = new DateTime($actual);
            $ago = new DateTime($datetime);
            
            //$now= date('Y-m-d h:i:s', time());
            //$ago = date('Y-m-d h:i:s', $datetime);
            
            $diff = $now->diff($ago);
    
            //echo $diff; //."<===";
            //exit();
        
            $diff->w = floor($diff->d / 7);
            $diff->d -= $diff->w * 7;
        
            $string = array(
                'y' => 'year',
                'm' => 'month',
                'w' => 'week',
                'd' => 'day',
                'h' => 'hour',
                'i' => 'minute',
                's' => 'second',
            );
            foreach ($string as $k => &$v) {
                //echo "====<br>".$k.": ".$diff->$k."<br>";
                if ($diff->$k) {
                    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                } else {
                    //$string[$k] = 00;
                    unset($string[$k]);
                }
            }
        
            if (!$full) $string = array_slice($string, 0, 1);
            //echo json_encode($string);
            //if($string['s'])
            if (strpos($string['s'], 'second') !== false) {
               return "Online";
            }else{
                if($datetime!='0000-00-00 00:00:00')return $string ? implode(', ', $string) . ' ago' : 'Online';
                else return "offline";
                
            }
        }
        
    }
    
    function saveNotification($data){
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $keys = $data['keys'];
        $values = $data['values'];
        $model = 'tbl_'.$data['model'];
        $sql = "INSERT INTO $model($keys) VALUES($values)";
            //echo "<br>".$sql."<br>";
        if($mysqli->query($sql)){
            return array('status' => '200', 'action'=>'create','message'=>'Successful', 'id'=>$mysqli->insert_id);
        }
        
    }
    
    function notify($id){
        $mysqlix = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
             
             //$model = "tbl_".$data['model']; 
        $sql = "SELECT * FROM tbl_notification WHERE user_id_to = '".$id."' ORDER BY id DESC";
        $result = $mysqlix->query($sql);
        $x=0;
        foreach($result as $key => $val){
            $data[$x]['user_id']=$val['user_id'];
            if($val['action']==1) $data[$x]['action']='comment';
            else if($val['action']==2)  $data[$x]['action']='reply';
            $data[$x]['act_id']=$val['act_id'];
            $data[$x]['status']=$val['status'];
            $data[$x]['id']=$val['id'];
            $x++;
        }
        return $data;
    }
    
    function SelectTicket($id){
        $mysqlix = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
             
             //$model = "tbl_".$data['model']; 
        $sql = "SELECT * FROM tbl_tickets WHERE id = '".$id."'";
        $result = $mysqlix->query($sql);
        foreach($result as $key => $val ){}
        $data['subject']=$val['subject'];
        $data['id']=$val['id'];
        return $data;
    }
    
    function CheckN($sql){
       // echo '<br>'.$ql;
         $mysqlix = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
         $result = $mysqlix->query($sql);
        $x = 0;
        foreach($result as $key => $val ){
            $x=1;
        }
        return $x;
    }
    
    function udateNotification($id){
        $values = 'status=0';
        $model = 'tbl_notification';
        
        $sql = "UPDATE $model set $values Where id ='".$id."'";
        //echo $sql;
        $result = mysqli_query(self::connect(),$sql) or die(mysqli_connect_error());
    }
    
    
    function selectcommentsN($id){
       $result =array();
        if(!self::connect()){
            return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
        }
        else{
            
             $mysqlix = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
             
             //$model = "tbl_".$data['model']; 
             $sql = "SELECT * FROM tbl_notes WHERE id = '".$id."'";
             $result = $mysqlix->query($sql);
             foreach($result as $key => $val){}
             return $val['uid'];
             
        }

    }
    
    function selectReplyN($id){
       $result =array();
        if(!self::connect()){
            return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
        }
        else{
            
             $mysqlix = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
             
             //$model = "tbl_".$data['model']; 
             $sql = "SELECT * FROM tbl_reply WHERE cid = '".$id."";
             $result = $mysqlix->query($sql);
             //foreach($result as $key => $val){}
             return $result;
            
             
        }

    }
    
    function selectcommentsNx($id){
       $result =array();
        if(!self::connect()){
            return array('status' => '300', 'message'=>'Sorry for the inconvenience, we are under maintenance.');
        }
        else{
            
             $mysqlix = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
             
             //$model = "tbl_".$data['model']; 
             $sql = "SELECT * FROM tbl_notes WHERE id = '".$id."'";
             $result = $mysqlix->query($sql);
             foreach($result as $key => $val){}
             $data['id']= $val['tid'];
             $data['subject']= $val['notes'];
             return $data;
             
        }

    }
}




?>


