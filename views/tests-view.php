
<script>
    function deleteThisD(del){
        if (confirm('Are you sure you want to delete this ' + del + '?')) {
            window.location.href = "?page=<?php echo $_GET['page']; ?>&id=<?php echo $_GET['id']; ?>&delD="+del;
        }
    }

    function deleteThis(id){
        if (confirm('Are you sure you want to delete this?')) {
            window.location.href = "?page=<?php echo $_GET['page']; ?>&id=<?php echo $_GET['id']; ?>&del="+id;
        }
    }

    function setGetParameter(paramName, paramValue)
    {
        var url = window.location.href;
        var hash = location.hash;
        url = url.replace(hash, '');
        if (url.indexOf(paramName + "=") >= 0)
        {
            var prefix = url.substring(0, url.indexOf(paramName));
            var suffix = url.substring(url.indexOf(paramName));
            suffix = suffix.substring(suffix.indexOf("=") + 1);
            suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
            url = prefix + paramName + "=" + paramValue + suffix;
        }
        else
        {
            if (url.indexOf("?") < 0)
                url += "?" + paramName + "=" + paramValue;
            else
                url += "&" + paramName + "=" + paramValue;
        }
        window.location.href = url + hash;
    }

    function reloadWithStatus(val){
        setGetParameter('istatus', val);
    }

</script>

<?php
/*changes*/
 $active='active';
 $active1='';
 if(isset($_GET['tab'])){
    if($_GET['tab']==1){
        $active='';
        $active1='active';
    }else{
        $active='active';
        $active1='';
    }
    
 }   
/*End of Changes*/
$response['message']="";

$data = array("model"=>"laboffered", "condition"=>" WHERE id = '".$_GET['id']."'");
$projects=$app->getRecord2($data);
$department = $projects['data'][0];
// $eawards = json_decode($department['employee_id']);
// $emps = $app->getEmployees();
//echo json_encode($projects);

//exit();
?>

<?php
$color = "#000";
// if(strtoupper($clients['status'])=="LAUNCHED"){
//     $color = MYGREEN;
// }
// if(strtoupper($clients['status'])=="FINISHED"){
//     $color = MYBLUE;
// }
// if(strtoupper($clients['status'])=="WAITING"){
//     $color = MYGOLD;
// }
// if(strtoupper($clients['status'])=="FAILED"){
//     $color = MYRED;
// }


?>

<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header" style="color: <?php echo $color; ?>">
                <i class="fa fa-globe"></i>
                <?php
                 echo strtoupper($department['name'])." (Test View)";
                ?>
                <small class="pull-right">Date: <?php echo date("Y")."-".date("m")."-".date("d"); ?></small>
            </h2>
            <div class="pull-right" style="margin-top: -75px;">
                            <a href="?page=tests"><label class="btn btn-xs btn-info">back</label></a> 
                        </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
            <address>
                <strong><h4><?php echo $department['name']; ?></h4></strong>
                <p><?php echo $department['description']; ?></p><br>
                <strong><h4>Price: <?php echo number_format($department['price'],2); ?></h4></strong>
                <strong><h4>With Test Sample: <?php $arrt=array(0=>"No", 1=>"Yes"); echo $arrt[$department['patient_queing']]; ?></h4></strong>
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-6 invoice-col">
            <address>

            </address>
        </div>
        
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->




<?php

if(isset($_GET['del'])){

    $data = array('model'=>'labmaterials', 'condition'=>" WHERE id = '".$_GET['del']."'");
    $response = $app->delete2($data);
    $response['message'] = "Deleted";
    echo '<script>window.location.href = "?page='.$_GET['page'].'&id='.$_GET['id'].'";</script>';

}

if(isset($_POST['update_save'])){
    $dataArr = array();
    $dataArr2 = array();
    $options = array();
    $type = array();
    $order_data = array();

        foreach ($_POST['title'] as  $value) {
            if(trim($value)!=="")array_push($dataArr,str_replace("'","\'",$value));
        }
        foreach ($_POST['normal'] as  $value) {
            if(trim($value)!=="")array_push($dataArr2,str_replace("'","\'",$value));
        }
        foreach ($_POST['options'] as  $value) {
            if(trim($value)!=="" || trim(strtoupper($value))!=="N/A"){
                if( strpos($value, ",") !== false ) {
                     $options[] = explode(",", trim($value));
                }else{
                     $options[] = array($value);
                }
                //array_push($dataArr2,str_replace("'","\'",$value));
            }else{
                $options[] = array($value);
            } 
        }
        //echo json
        foreach ($_POST['type'] as  $value) {
            if(trim($value)!=="")array_push($type,str_replace("'","\'",$value));
        }

        foreach ($_POST['order_data'] as  $value) {
            if(trim($value)!=="")array_push($order_data,$value);
        }
        //echo json_encode($order_data);
        $data = array('model'=>"result_data",'keys'=>"data_title, normal_range, options, type, order_data");
        $data['values']="data_title = '".json_encode($dataArr)."', 
                         normal_range = '".json_encode($dataArr2)."',
                         options = '".json_encode($options)."',
                         type = '".json_encode($type)."',
                         order_data = '".json_encode($order_data)."'";
        $data['condition'] = " WHERE labtest_id = '".$_GET['id']."'";
        $response = $app->update2($data);
        $response['message'] = "Successful";
}

if(isset($_POST['new_item'])){
     $data = array('model'=>"labmaterials",'keys'=>"test_id, material_id, qty");

    if(isset($_POST['id'])){ //echo json_encode($_POST); exit();
        $data['values']="test_id = '".$_GET['id']."', 
                         material_id = '".str_replace("'","\'",$_POST['material_id'])."',
                         qty = '".str_replace(",","",$_POST['qty'])."'";
        $data['condition'] = " WHERE id = '".$_POST['id']."'";
        $response = $app->update2($data);
        $response['message'] = "Successful";
    }else{
        $date = date("Y")."-".date("m")."-".date("d");

        $data2 = array(
            'model'=>'labmaterials',
            'keys'=>'test_id, material_id, qty',
            'values'=>"'".str_replace("'","\'",$_GET['id'])."', 
                       '".str_replace(",","",$_POST['material_id'])."',
                       '".str_replace(",","",$_POST['qty'])."'"
        );
        $response = $app->create2($data2);
        $response['message'] = "Successful";
    }
}
if(isset($_GET['sme'])){
    $data = array('model'=>"labmaterials",'keys'=>"test_id, material_id, qty");
    $date = date("Y")."-".date("m")."-".date("d");

        $data2 = array(
            'model'=>'labmaterials',
            'keys'=>'test_id, material_id, qty',
            'values'=>"'".str_replace("'","\'",$_GET['id'])."', 
                       '".str_replace(",","",$_GET['mid'])."',
                       '".str_replace(",","",$_GET['qty'])."'"
        );
        $response = $app->create2($data2);
        echo "<script>location.href='?page=tests-view&id=".$_GET['id']."';</script>";

}
if(isset($_POST['r_data'])){
    $data = array('model'=>"result_data",'condition'=>"WHERE labtest_id= '".$_GET['id']."'");
    $response = $app->getRecord2_old($data);
    $dataArr = array();
    $dataArr2 = array();
    $options = array();
    $type = array();

    if($response['data']==null){

        foreach ($_POST['data_title'] as  $value) {
            if(trim($value)!=="")array_push($dataArr,str_replace("'","\'",$value));
        }
        foreach ($_POST['normal_range'] as  $value) {
            if(trim($value)!=="")array_push($dataArr2,str_replace("'","\'",$value));
        }
        foreach ($_POST['choices'] as  $value) {
            if(trim($value)!=="" || trim(strtoupper($value))!=="N/A"){
                if( strpos($value, ",") !== false ) {
                     $options[] = explode(",", $value);
                }else{
                     $options[] = array($value);
                }
                //array_push($dataArr2,str_replace("'","\'",$value));
            }else{
                $options[] = array($value);
            } 
        }
        //echo json
        foreach ($_POST['intype'] as  $value) {
            if(trim($value)!=="")array_push($type,str_replace("'","\'",$value));
        }
        //echo json_encode($_POST['intype']);
        $data2 = array(
                'model'=>'result_data',
                'keys'=>'labtest_id, data_title, normal_range, options, type',
                'values'=>"'".str_replace("'","\'",$_GET['id'])."', 
                           '".json_encode($dataArr)."',
                           '".json_encode($dataArr2)."',
                           '".json_encode($options)."',
                           '".json_encode($type)."'"
            );
        $response = $app->create2($data2);
    }else{
        $dataArr = json_decode($response['data'][0]['data_title']);
        $dataArr2 = json_decode($response['data'][0]['normal_range']);

        $dataArr3 = json_decode($response['data'][0]['options']);
        $dataArr4 = json_decode($response['data'][0]['type']);
        $dataArr5 = json_decode($response['data'][0]['order_data']);

        if($dataArr2==NULL){ $dataArr2=array(); }
        foreach ($_POST['data_title'] as  $value) {
            if(trim($value)!=="")array_push($dataArr,str_replace("'","\'",$value));
        }

        foreach ($_POST['normal_range'] as  $value) {
            if(trim($value)!=="")array_push($dataArr2,str_replace("'","\'",$value));
        }

        foreach ($_POST['choices'] as  $value) {
            if(trim($value)!=="")array_push($dataArr3,str_replace("'","\'",$value));
        }

        foreach ($_POST['intype'] as  $value) {
            if(trim($value)!=="")array_push($dataArr4,str_replace("'","\'",$value));
        }

        foreach ($_POST['input_order'] as  $value) {
            if(trim($value)!=="")array_push($dataArr5,str_replace("'","\'",$value));
        }



        $data = array('model'=>"result_data",'keys'=>"labtest_id, data_title");
        $data['values']="labtest_id = '".$_GET['id']."', 
                         data_title = '".str_replace("'","\'",json_encode($dataArr))."',
                         normal_range = '".str_replace("'","\'",json_encode($dataArr2))."',
                         options = '".str_replace("'","\'",json_encode($dataArr3))."',
                         type = '".str_replace("'","\'",json_encode($dataArr4))."',
                         order_data = '".str_replace("'","\'",json_encode($dataArr5))."'";
        $data['condition'] = " WHERE id = '".$response['data'][0]['id']."'";
        $response = $app->update2($data);
        $response['message'] = "Successful";
    }
}
if(isset($_GET['delD'])){
    $data = array('model'=>"result_data",'condition'=>"WHERE labtest_id= '".$_GET['id']."'");
    $response = $app->getRecord2_old($data);
    $dataArr = array();
    foreach(json_decode($response['data'][0]['data_title']) as $value){
            if($value!==$_GET['delD'])array_push($dataArr,$value);
    }  
   
        $data = array('model'=>"result_data",'keys'=>"labtest_id, data_title");
        $data['values']="labtest_id = '".$_GET['id']."', 
                         data_title = '".str_replace("'","\'",json_encode($dataArr))."'";
        $data['condition'] = " WHERE id = '".$response['data'][0]['id']."'";
        $response = $app->update2($data);
        $response['message'] = "Successful";
        echo '<script> var x = window.location.href; h = x.split("&delD"); window.location.href = h[0]+"&tab=1";</script>';
}
if($response['message']=="Successful"){

                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                Record Saved Successfully!
              </div>';
            }
if($response['message']=="Deleted"){
                echo '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                Record Deleted Successfully!
              </div>';
            }

?>

    <br>

    <div class="row">

        <div class="col-md-12">

            <br>
            <div class="widget-content ">

                <?php 
                    $materials = $app->getMaterials(); 
                    $mymaterials = $app->getMyMaterials("WHERE test_id = '".$_GET['id']."'");
                ?>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li  class="<?php echo $active; ?>"><a href="?page=tests-view&id=<?php echo $_GET['id']; ?>&tab=0" >Materials</a></li>
                    <li class="<?php echo $active1; ?>"><a href="?page=tests-view&id=<?php echo $_GET['id']; ?>&tab=1" >Result Data</a></li>
                </ul> 
                <div class="tab-content">
              
                    <div class="<?php echo $active; ?> tab-pane" id="labmaterials">   
                <label class="btn btn-sm btn-warning pull-right" id="new">Add New</label><br><br>
                <div class="box-body table-responsive">
                    
                        <table id="example1" class="table table-bordered table-striped">
                            <!-- table table-bordered table-striped -->
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th></th>
                                <th style="">Name</th>
                                <th style="">Quantity</th>
                                <th style="">Action</th>
                            </tr>
                            </thead>
                            <tbody id="mtable">
                            <?php $c=0; foreach ($mymaterials as $key => $value): $c++;
                               
                                ?>
                                <tr><form method="POST">
                                    <td><?php echo $c; ?><input type="hidden" name="id" value="<?php echo $value['id']; ?>"></td>
                                    <td><select name="material_id" class="form-control">
                                        <?php 
                                      
                                        foreach($materials as $kkk => $vvv){
                                            $sel = ""; if($kkk==$value['material_id']){ $sel="selected"; }
                                            echo '<option value="'.$kkk.'" '.$sel.'>'.$vvv['name'].'</option>';
                                        }
                                        ?>
                                        </select>
                                    </td>
                                    <td><input name="qty" value='<?php echo $value['qty']; ?>' class="form-control" /></td>
                                    <td>
                                        <?php if($_SESSION['acl']['materials-view']==1): ?>    
                                        <button type="submit" name="new_item" class="btn btn-success btn-xs" value="Save"><i class="fa fa-refresh"></i> Save</button>
                                    <?php endif; ?>

                                         <?php if($_SESSION['acl']['materials-delete']==1): ?>
                                        
                                           <label  class="btn btn-danger btn-xs" onClick="deleteThis('<?php echo $value['id']; ?>')"><i class="fa fa-trash"></i> Delete</label>
                                        <?php endif; ?>

                                    </td>
                                    </form>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th style="">Name</th>
                                <th style="">Quantity</th>
                                <th style="">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                        </div>
                        </div>
                        <div class="<?php echo $active1; ?> tab-pane" id="result_data">
                        <form method="POST">
                        <div class="row" id="addata" style="display: none">  
                           
                          <div class="col-sm-12">
                            <br><br>
                              <table style="" cellspasing="2" cellpadding="8">
                                <tbody id="redata">
                                
                                </tbody>
                                <tfoot>
                                    <td colspan="5">
                                      <div class="form-group" style="float: right;">
                                       <input type="submit" name="r_data" class="btn btn-success btn-sm" value="Save">
                                       <button type="button" id="dcancel" class="btn btn-warning btn-sm"> Cancel</button>
                                      </div>
                                    </td>
                                </tfoot>
                              </table>  
                           </div>
                           
                           <div class="col-sm-4"></div> 
                            
                       </div>
                       <div id="moredata"></div>
                          <label class="btn btn-sm btn-warning pull-right" id="newdata">Add New</label><br><br>  
                          <div class="box-body table-responsive">  
                            <form name="" method="POST">
                            <table id="example2" class="table table-bordered table-striped">
                            
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th style="width:8%;"></th>
                                <th style="">Data needed</th>
                                <th style="">Normal Value</th>
                                <th style="">Options</th>
                                <th style="">Type</th>
                                <th style="">Order Data</th>
                                <th style="">Action</th>
                            </tr>
                            </thead>
                            <tbody id="mtable2">
                            <?php $data = array('model'=>"result_data",'condition'=>"WHERE labtest_id= '".$_GET['id']."'");
                                $titles = array();
                                $normalRange=array();
                                $r_datalab = $app->getRecord2_old($data);
                                $order_data = array();
                                if(sizeOf($r_datalab['data'])>0){ //echo json_encode($r_datalab['data']);
                                    $r_datalab = $r_datalab['data'][0]; // = $r_datalab['data'];
                                    //echo $r_datalab['data_title'];
                                    $titles = json_decode($r_datalab['data_title']);
                                    $normalRange = json_decode($r_datalab['normal_range']);
                                    $options = json_decode($r_datalab['options']);
                                    $type = json_decode($r_datalab['type']);
                                    $order_data = json_decode($r_datalab['order_data']);
                                }
                                else{
                                    $r_datalab = array();
                                }
                                //echo json_encode($order_data);
                                foreach ($titles as $kk=> $value): $c++;
                                if(!isset($order_data[$kk]) || trim($order_data[$kk])=='"'){ $order_data[$kk] = 0; }
                                //else{ echo $order_data[$kk]."<==="; }
                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><input type="text" name="title[]" value="<?php echo $titles[$kk]; ?>" required></td>
                                    <td><input type="text" name="normal[]" value="<?php echo $normalRange[$kk]; ?>" required></td>
                                    <td><?php 
                                        $op = "";
                                        // echo json_encode($options[$kk]);
                                        if(is_array($options[$kk])){ $fc=0; foreach($options[$kk] as $kkh =>$vv){ $fc++; if($fc>1){ $op .=", "; }  $op .= $vv; }  }
                                        else{  $op = "N/A"; }
                                        ?>
                                        <input type="text" name="options[]" value="<?php echo $op; ?>" required>    
                                        </td>
                                    <td>
                                        <select name="type[]" required>
                                            <option value="text" <?php if(trim(strtolower($type[$kk]))=="text"){ echo "selected"; } ?>>Text</option>
                                            <option value="image" <?php if(trim(strtolower($type[$kk]))=="image"){ echo "selected"; } ?>>Image</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="order_data[]" class="od" value="<?php echo $order_data[$kk]; ?>" required>    
                                    </td>
                                    <td>
                                        <label  class="btn btn-danger btn-xs" onClick="deleteThisD('<?php echo $titles[$kk]; ?>')"><i class="fa fa-trash"></i> Delete</label>

                                       
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                
                                <th colspan="6">
                                     <?php if($c>0){ ?>
                                     <input style="float: right;" type="submit" class="btn btn-warning btn-sm" value="Update" name="update_save">
                                    <?php } ?>
                                </th>
                            </tr>
                            </tfoot>
                        </table>
                        </form>
                    </div>
                    </form>
                        </div> 
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
<script>

    $(document).ready(function() {
        $('#example2').dataTable({
            "iDisplayLength": 100
        });
    } );

    function getMaxCurrent(){
        var maxVal = 0;
        $('input[name="order_data[]"]').each(function(){
            maxVal = Math.max(maxVal , parseInt($(this).val()));
        });
        return maxVal;
    }

    function getMaxInput(){
        var maxVal = 0;
        $('input[name="input_order[]"]').each(function(){
            maxVal = Math.max(maxVal , parseInt($(this).val()));
        });
        return maxVal;
    }

    

    var addt = "<tr id='mf'>";
        addt += "<td></td><td><select name='material_id'  id=\"material_id_val\" class='form-control'>";
        <?php 
         foreach($materials as $kkk => $vvv){
            $sel = ""; 
            echo 'addt += "<option value='.$kkk.' $sel>'.$vvv['name'].'</option>";';
         }
        ?>
        addt += "</select></td><td><input name='qty' id=\"qty_val\" value='' class='form-control'/></td><td><label type=\"submit\" class=\"btn btn-success btn-sm\" value=\"save\" onClick=\"saveMe()\" name='new_item'><i class=\"fa fa-plus\"></i>  Save</label>&nbsp;<label type=\"submit\" class=\"btn btn-warning btn-sm\" value=\"save\" onClick=\"redirect()\" name='new_item'><i class=\"fa fa-minus\"></i>  Cancel</label></td></tr>";

    $("#new").click(function(){
        
        $("tr>td.dataTables_empty").remove();
        $("#mtable").append(addt);
        // var nn = $("#mf").html();
        // nn = nn.replace("<form method=\"post\"></form>","<form method=\"post\">");
        // $("#mf").remove();
        // $("#mtable").append(nn);
        $("#new").attr("style","display: none;");
    });
    $("#clck").click(function(){
        $("#moredata").append('<div class="row"><div class="col-sm-2"></div><div class="col-sm-6"><div class="form-group" style="margin-bottom: 0px; "><input type="text" class="form-control" placeholder=" Data title" name="data_title[]" /></div></div><div class="col-sm-4"></div></div>');  
                          
                              
                                    
                                    
                                    
                              
                           
    });

    function saveMe(){
        var mid = "&mid="+$("#material_id_val").val();
        var qty = "&qty="+$("#qty_val").val();
        location.href="?page=<?php echo $_GET['page'] ?>&id=<?php echo $_GET['id'] ?>&sme=1"+mid+qty;
    }
    function redirect(){
        location.href="?page=<?php echo $_GET['page'] ?>&id=<?php echo $_GET['id'] ?>";
    }
    $("#newdata").click(function(){
        var num1 = getMaxCurrent();
        //alert(num);
        var num2 = getMaxInput();
        var usethis = 0;
        if(num2==0){ usethis = num1 + 1;  }
        else{ usethis = num2 + 1; }
        //alert(num);
      $("#addata").show();
      var codeId = makeCodeId(8);
      var ndata = '<tr id="'+codeId+'">';
          ndata =  ndata +  '<td>'; 
          ndata =  ndata +  ' <div class="form-group" style="margin-left: 10px; ">';                                            
          ndata =  ndata +  '   <input type="text" class="form-control" placeholder="Data Title/Name" name="data_title[]" required />';
          ndata =  ndata +  ' </div>';
          ndata =  ndata +  '</td>';
          ndata =  ndata +  '<td>';
          ndata =  ndata +  ' <div class="form-group" style="margin-left: 10px; ">';
          ndata =  ndata +  ' <input type="text" style="width: 300px;" class="form-control" placeholder=" Normal Value" name="normal_range[]" required />';
          ndata =  ndata +  ' </div>';
          ndata =  ndata +  ' </td>';
          ndata =  ndata +  ' <td>';
          ndata =  ndata +  ' <div class="form-group" style="margin-left: 10px; ">';
          ndata =  ndata +  ' <input type="text" style="width: 300px;" class="form-control" placeholder="Choices" name="choices[]" required />';
          ndata =  ndata +  ' </div>';
          ndata =  ndata +  ' </td>';
          ndata =  ndata +  ' <td>';
          ndata =  ndata +  ' <div class="form-group" style="margin-left: 10px; ">';
          ndata =  ndata +  ' <select name="intype[]" required class="form-control">';
          ndata =  ndata +  ' <option value="text">Text</option>';
          ndata =  ndata +  ' <option value="image">Image</option>';
          ndata =  ndata +  ' </select>';    
          ndata =  ndata +  ' </div>';
          ndata =  ndata +  ' </td>';
          ndata =  ndata +  ' <td>';
          ndata =  ndata +  ' <div class="form-group" style="margin-left: 10px; ">';
          ndata =  ndata +  ' <input type="text" style="width: 70px;" class="form-control input_order" placeholder="Order" name="input_order[]" value="'+usethis+'" required />';
          ndata =  ndata +  ' </div>';
          ndata =  ndata +  ' </td>';
          ndata =  ndata +  ' <td>';
          ndata =  ndata +  ' <div class="form-group" style="margin-left: 10px; ">';
          ndata =  ndata +  ' <label class="btn btn-xs btn-danger" onClick="removeThisField(\''+codeId+'\')">x</label>';
          ndata =  ndata +  ' </div>';
          ndata =  ndata +  ' </td>';
          ndata =  ndata +  ' </tr>';
        $("#redata").append(ndata);
      //$("#newdata").hide();
    });
    $("#dcancel").click(function(){
        $("#redata").empty();
      $("#addata").hide();
      //$("#newdata").show();
    });
    function removeThisField(trid){
        $("#"+trid).remove();
        var rowCount = $('#redata tr').length;
        if(rowCount==0){ $("#addata").hide(); }
        //alert(rowCount);
        
    }
</script>    
<!-- /.content -->