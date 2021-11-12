
<script>


    function deleteThis(id, name){
        if (confirm('Are you sure you want to delete '+name+'?')) {
            window.location.href = window.location.href + '&del='+id;
        }
    }

</script>



<?php

//$app->autoGenerateIds();
if(isset($_GET['estatus'])){ $estatus=$_GET['estatus']; }else{ $estatus=1; }
if(isset($_GET['ut'])){ $ut=$_GET['ut']; }else{ $ut=0; }
if(isset($_GET['dept'])){ $dept=$_GET['dept']; }else{ $dept=0; }

$module = explode("-",$page);
$title = ucfirst($module[0]);
$response['action']="none";
error_reporting(E_ALL); ini_set('display_errors', 1); 


$response=array('action'=>"", 'message'=>"");
$daction = "";


if(isset($_POST['d1'])){
    $d1 = date("Y-m-d", strtotime($_POST['d1']));
}else{
     $d1 = date("Y-m-d");
}

if(isset($_POST['d2'])){
    $d2 = date("Y-m-d", strtotime($_POST['d2']));
}else{
     if(isset($_POST['d1'])){
        $d2 = date("Y-m-d", strtotime($_POST['d1']));
    }else{
         $d2 = date("Y-m-d");
    }
}




$data = array('model'=>'transaction','order'=>' ');
$conditions = "WHERE realdate >= '".$d1."' AND realdate <= '".$d2."'";
$st = 0;
if(isset($_POST['status']) && $_POST['status']!=0){
    $st = $_POST['status'];
    if($_POST['status']==1){
        $conditions .= " AND payment_id<>'0' ";
    }else{
        $conditions .= " AND payment_id='0' ";
    }
    
}
$byval = 0;
$rby = 0;
if(isset($_POST['byid_val']) && $_POST['byid_val']!=0){
    $byval = $_POST['byid_val'];
    $rby = $_POST['by'];
    if($_POST['by']==1){
        $conditions .= " AND company = '".$_POST['byid_val']."' ";
    }
    if($_POST['by']==2){
        $conditions .= " AND md = '".$_POST['byid_val']."' ";
    }
    
}
// echo $conditions;
$data = array('model'=>'transaction', 'condition'=>$conditions,'order'=>' order by realdate');

//echo json_encode($data);


$employee = $app->getRecord2($data);
$employee = $employee['data'];
$patients = $app->getPatients();
$comps = $app->getCompanies();
        $doctors = $app->getDoctors();
//echo json_encode(sizeOf($department));


//$data = array('model'=>'employee', 'order'=>' order by lname', 'condition'=>"",
  //  'joint'=>"SELECT * FROM tbl_category ".$conditions);
//echo json_encode($data);
//$categories = $app->getRecordJoint($data);//$app->getRecord($data);
//echo json_encode($projects);
//$projects = $projects['data'];


//echo json_encode($clients);
?>

<div class="message-box">
    <?php

    if($response['action']=="delete"){ $daction = "deleted"; }
    if( $response['action']=="update"){ $daction = "updated"; }
    if( $response['action']=="create"){ $daction = "created"; }



    ?>

</div>

<section class="content" >


    <div class="row">

        <div class="col-md-12">



            <div class="widget-content ">
                <div>

                <?php if( $response['message']=="Successful"){
                    echo '<br><div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">x</a>
                    <strong>Success!</strong> Record '.$daction.' successfully.
                </div>';
                }
                ?>



            </div>
            <div id="print" class="myDivToPrint">
                <div class="box">
                    <form method="POST" action="">
                        <input type="hidden" value="reports" name="page">
                        <input type="hidden" value="transactions" name="t">
                    <div class="box-header">
                        
                        
                        <div class="row" style="margin-top: 5px;">
                            <div class="col-md-12" style="margin-bottom: 10px;">
                                 <label for="inputSkills" class="col-sm-12 control-label"><h3 class="box-title" style="font-weight: bold;     line-height: 1.5;">Transaction <?php echo $title; ?></h3></label>
                            </div>    

                            
                            <div class="col-md-2" >
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Date From</label>
                                    

                                    <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right dd1" name="d1" id="datepicker" <?php  echo "value='".date("m/d/Y",strtotime($d1))."'";  ?> >
                                    </div>
                                </div>
                            
                            </div>
                            <div class="col-md-2" >

                               <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Date To</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right dd2" name="d2" id="datepicker2" <?php  echo "value='".date("m/d/Y",strtotime($d2))."'";  ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2" >

                               <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>By</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <select class="form-control input-sm " name="by" id="by">
                                                <option value="0">All</option>
                                                <option value="1">Referred By Company</option>
                                                <option value="2">Referred By MD</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2" >

                               <div class="form-group" style="margin-bottom: 0px; ">
                                    <label id="byid">By</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <select class="form-control input-sm filterme" name="byid_val" id="byid_val">
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2" >

                               <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Status</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <select class="form-control input-sm filterme" name="status" id="status">
                                                <option value="0" <?php if($st==0){ echo "selected"; } ?>>All</option>
                                                <option value="1" <?php if($st==1){ echo "selected"; } ?>>Paid</option>
                                                <option value="2" <?php if($st==2){ echo "selected"; } ?>>Unpaid</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2" >
                                <input type="submit" value="filter" class="btn btn-success btn-sm" style="margin-top: 11%;"></div>
                            
                        </div>    
                    </div>
                    </form>



                    <!-- /.box-header -->
                    
                    <div class="box-body table-responsive">
                        
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th style="width:8px;"></th>
                                <th >QN</th>
                                <th >Patient</th>
                                <th >Date</th>
                                <th >OR</th>
                                <th >Charge No.</th>
                                <th >Credit No.</th>
                                <th >Inclusives</th>
                                <th >Total Amount</th>
                                <th >VAT</th>
                                <th >WHT</th>
                                <th >Net</th>
                                <th >Amount Paid</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            <?php $n=0;

                            $r_total_amount = 0;
                            $r_vat = 0;
                            $r_wht = 0;
                            $r_net = 0;
                            $r_amount_paid = 0;

                            foreach($employee as $ke => $value):  $n++;
                                $r_total_amount = $r_total_amount + $value['total_amount'];
                                $r_vat = $r_vat + $value['vat'];
                                $r_wht = $r_wht + $value['wht'];
                                $r_net = $r_net + $value['net'];
                                $r_amount_paid = $r_amount_paid + $value['amount_paid'];
                            ?>
                                <tr>
                                    <td >
                                        <?php echo $n; ?></td>
                                    <td ><?php echo $value['queuing_number']; ?></td>
                                    <td ><img src="<?php echo $patients[$value['patient_id']]['image']; ?>" style="width: 35px; height: 35px;" class="user-image" alt="User Image">
                                    <?php echo $patients[$value['patient_id']]['lname'].", ".$patients[$value['patient_id']]['fname']." ".$patients[$value['patient_id']]['mname']; ?></td>
                                    <td ><?php
                                   echo  date('F d, Y h:i A', strtotime($value['realdate']));
                                    ?></td>
                                    <td ><?php echo $value['or_number']; ?></td>
                                    <td ><?php echo $value['charge_slip']; ?></td>
                                    <td ><?php echo $value['credit_slip']; ?></td>
                                    <td ><?php echo $value['charge_slip']; ?></td>
                                    <td ><?php echo number_format($value['total_amount'],2); ?></td>
                                    <td ><?php echo number_format($value['vat'],2); ?></td>
                                    <td ><?php echo number_format($value['wht'],2); ?></td>
                                    <td ><?php echo number_format($value['net'],2); ?></td>
                                    <td ><?php echo number_format($value['amount_paid'],2); ?></td>
                                   
                                </tr>
                            <?php  endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th style="width:8px;"></th>
                                <th >QN</th>
                                <th >Patient</th>
                                <th >Date</th>
                                <th >OR</th>
                                <th >Charge No.</th>
                                <th >Credit No.</th>
                                <th >Inclusives</th>
                                <th >Total Amount</th>
                                <th >VAT</th>
                                <th >WHT</th>
                                <th >Net</th>
                                <th >Amount Paid</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
    </div> 
    </div>
    <script>
        byChange();
        $("#by").change(function(){
            byChange();
        });


        function byChange(){

            var by = $("#by").val();
            <?php if($rby!=0){ echo "$(\"#by\").val(".$rby."); by=".$rby.";"; } ?>
            var html = "<option value='0'>All</option>";
            var title = "";
            if(by==0){
                title = "Walk-in";
            }
            if(by==1){
                title = "Select Company";
                <?php
                foreach($comps as $k => $v){ $sel = "";
                    if($rby==1 && $byval==$v['id']){ $sel = "selected"; }
                    echo "html = html + '<option value=\"".$v['id']."\" ".$sel.">".$v['company']."</option>';";
                }
                ?>
            }
            if(by==2){
                title = "Select MD";
                <?php
                foreach($doctors as $k => $v){ $sel = "";
                    if($rby==2 && $byval==$v['id']){ $sel = "selected"; }
                    echo "html = html + '<option value=\"".$v['id']."\" ".$sel.">".$v['prename']." ".$v['fname']." ".$v['lname']."</option>';";
                }
                ?>
            }
            $("#byid_val").html(html);
            $("#byid").text(title);
        }
      
    
        $("#estatus").on("change", function(e){
            var es = "&estatus="+$("#estatus").val();
            var ut = "&status="+$("#ut").val();
            var dept = "&dept="+$("#dept").val();
            location.href = 'index.php?page=reports&t=employee'+es+ut+dept;
        });
        
        $(".dd1").on("change", function(e){
            var dd1 = "&d1="+$(".dd1").val();
            location.href = 'index.php?page=reports&t=transactions'+dd1+dd2;
        });

       $(".dd2").on("change", function(e){
            var dd2 = "&d2="+$(".dd2").val();
            location.href = 'index.php?page=reports&t=transactions'+dd1+dd2;
        });
        
        

    </script>