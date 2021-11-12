<!-- Main content -->
<?php

$response=array('action'=>"", 'message'=>"");
if(isset($_POST['btn_save'])){
    $arrd = array();
    $arrd2 = array();
    $data = array('model'=>"result_data",'condition'=>"WHERE id= '".$_POST['txtresultdata']."'");
    $responsex = $app->getRecord2_old($data);
    $responsex = $responsex['data'][0];
   // echo $_POST['txtresultdata'];
    foreach(json_decode($responsex['data_title']) as $val){
        $arrd[$val]=str_replace("'","\'",$_POST['txt_'.str_replace(" ", "_",$val)]);
    }
    
    $data = array('model'=>"labresults",
        'keys'=>"test_id, patient_id, queuing_number, resultdata, normal_range",'values'=>"
        '".str_replace("'","\'",$_POST['test_id'])."',
        '".str_replace("'","\'",$_POST['patient_id'])."',
        '".str_replace("'","\'",$_POST['txtqnum'])."',
        '".json_encode($arrd)."',
        '".json_encode($_POST['normal_range'])."'");
    $response = $app->create2($data);
}


?>

<style>
.form-group {
 margin-bottom: 0px; 
}
</style>
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
            <form name="user" method="post" >
                <div class="modal-content">
                    <div class="modal-header">
                       
                        <h4 class="modal-title" id="myModalLabel">Create Laboratory Result </h4>
                        
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-sm-4">
                                <label>Select Queuing Number</label>
                                <select class="form-control select2 select2-hidden-accessible"  data-placeholder="Select Queuing Number" name="q_number" id="q_number" style="width: 100%;" tabindex="-1" aria-hidden="true" onchange="javascript:search(this.value);" required>
                                    <option value="0">Select Queuing Number</option>
                                    <?php 
                                    $data = array('model'=>"queuing",'condition'=>"WHERE trans_type='Laboratory'");
                                    $q=$app->getRecord2_old($data);
                                    if(isset($_GET['q_num'])){
                                        
                                        foreach ($q['data'] as $key => $value) {
                                            if($_GET['q_num']==$value['id'])echo "<option value='".$value['id']."' selected>".$value['queuing_number']."</option>";
                                            else echo "<option value='".$value['id']."'>".$value['queuing_number']."</option>";
                                        }
                                    }else{
                                        foreach ($q['data'] as $key => $value) {
                                            echo "<option value='".$value['id']."'>".$value['queuing_number']."</option>";
                                        }
                                    }
                                    ?>            
                                </select>
                            </div>
                            <div class="col-sm-8"></div>
                        </div>
                        <div class="row">
                            <?php if(isset($_GET['q_num'])){

                                $data = array('model'=>"queuing",'condition'=>"WHERE id= '".$_GET['q_num']."'");
                                $respon = $app->getRecord2_old($data);
                                $respon = $respon['data'][0];

                                $data = array('model'=>"patient",'condition'=>"WHERE id= '".$respon['patient_id']."'");
                                $patientInfo = $app->getRecord2_old($data);
                                $patientInfo = $patientInfo['data'][0];
                                
                                $data = array('model'=>"result_data",'condition'=>"WHERE labtest_id= '".$respon['which']."'");
                                $resultdata = $app->getRecord2_old($data);
                                $data = array('model'=>"laboffered",'condition'=>"WHERE id= '".$respon['which']."'");
                                $labO = $app->getRecord2_old($data);
                                $labO = $labO['data'][0]['name'];
                                // if(count($resultdata['data'])>0)$resultdata = $resultdata['data'][0];
                               
                                ?>
                                <div class="col-sm-6">
                                    <h4 style ="margin-top: 20px;"><label>PATIENT INFO</label></h4>
                                    <label style="margin-top: 35px;" class="form-control">PATIENT NUMBER:  <?php echo $patientInfo['patient_number'];?></label>
                                    <label class="form-control">FIRST NAME:  <?php echo $patientInfo['fname'];?></label>    
                                    <label class="form-control">MIDDLE NAME:  <?php echo $patientInfo['mname'];?></label>
                                    <label class="form-control">LAST NAME:  <?php echo $patientInfo['lname'];?></label>
                                    <label class="form-control">GENDER:  <?php echo $patientInfo['gender'];?></label>
                                    <label class="form-control">CONTACT NUMBER:  <?php echo $patientInfo['phone'];?></label>
                                    <label class="form-control">ADDRESS:  <?php echo $patientInfo['address'];?></label>
                                    <label class="form-control">BIRTHDATE:  <?php echo $patientInfo['bdate'];?></label>
                                    <label class="form-control">BLOOD TYPE:  <?php echo $patientInfo['bloodtype'];?></label>
                                    <label class="form-control">CITIZENSHIP:  <?php echo $patientInfo['citizenship'];?></label>
                                    <label class="form-control">EMAIL:  <?php echo $patientInfo['email'];?></label>
                                    <label class="form-control">OCCUPATION:  <?php echo $patientInfo['occupation'];?></label>
                                    <label class="form-control">POSITION:  <?php echo $patientInfo['position'];?></label>
                                </div>
                                <div class="col-sm-6">
                                    <h4 style ="margin-top: 20px;"><label><?php echo strtoupper($labO); ?> - RESULT DATA</label></h4>
                                    <input type = "hidden" name ="test_id" value="<?php echo $respon['which']; ?>" required>
                                    <input type = "hidden" name ="patient_id" value="<?php echo $patientInfo['id']; ?>" required>
                                    <div class="row">
                                        <?php if(count($resultdata['data'])>0){ 
                                            $resultdata = $resultdata['data'][0];
                                            $normal_range = json_decode($resultdata['normal_range']);
                                        foreach (json_decode($resultdata['data_title']) as $kk=> $value) {
                                        ?>
                                        <div class="col-sm-6">
                                            <label><?php echo $value;?></label>
                                            <input type="text" class="form-control" placeholder="<?php echo $value;?>" name="<?php echo "txt_".str_replace(' ', '_',$value); ?>"  />  
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Normal/Range</label>
                                            <input type="text" class="form-control" value="<?php echo $normal_range[$kk];?>" name="normal_range[]" readonly />  
                                        </div>
                                        <?php } ?> 
                                         <input type="hidden" name="txtresultdata" value="<?php echo $resultdata['id']; ?>"> 
                                         <input type="hidden" name="txtqnum" value="<?php echo $respon['queuing_number']; ?>"> 
                                         <?php } ?>
                                    </div>     
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="btn_save" class="btn btn-success fa fa-plus-square btn-sm" value="Create">
                    </div>
                </div>
            </form>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
<script type="text/javascript">
   function search(x){
        var h = window.location.href;
        r = h.split('&q_num');
        window.location.href= r[0] + '&q_num=' + x;
        // window.location.href=window.location.href
    }

</script>
