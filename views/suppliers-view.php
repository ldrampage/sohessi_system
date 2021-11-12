
<script>
    function deleteThisD(del){
        if (confirm('Are you sure you want to delete this ' + del + '?')) {
            window.location.href = "?page=<?php echo $_GET['page']; ?>&id=<?php echo $_GET['id']; ?>" + '&delD='+del;
        }
    }

    function deleteThis(id){
        if (confirm('Are you sure you want to delete this?')) {
            window.location.href = "?page=<?php echo $_GET['page']; ?>&id=<?php echo $_GET['id']; ?>" + '&del='+id;
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
$department = $app->getSuppliers("WHERE id = '".$_GET['id']."'");
$department = $department[$_GET['id']];
// $data = array("model"=>"laboffered", "condition"=>" WHERE id = '".$_GET['id']."'");
// $projects=$app->getRecord2($data);
// $department = $projects['data'][0];
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
                 echo strtoupper($department['business'])." (Supplier View)";
                ?>
                <small class="pull-right">Date: <?php echo date("Y")."-".date("m")."-".date("d"); ?></small>
            </h2>
            <div class="pull-right" style="margin-top: -75px;">
                            <a href="?page=suppliers"><label class="btn btn-xs btn-info">back</label></a> 
                        </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
            <address>
                <strong><h4><?php echo $department['business']; ?></h4></strong>
                <p>
                    <strong>Address:</strong> <?php echo $department['business_address']; ?><br>
                    <strong>Contact Person:</strong> <?php echo $department['fname']." ".$department['lname']; ?><br>
                    <strong>Contact:</strong> <?php echo $department['phone']; //." / ".str_replace("/","",$department['mobile']); ?><br>
                    <strong>Email:</strong> <?php echo $department['email']; ?>

                </p><br>
                
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

    $data = array('model'=>'supmaterials', 'condition'=>" WHERE id = '".$_GET['del']."'");
    $response = $app->delete2($data);
    $response['message'] = "Deleted";
    echo '<script>window.location.href = "?page='.$_GET['page'].'&id='.$_GET['id'].'";</script>';

}

if(isset($_POST['new_item'])){
     $data = array('model'=>"supmaterials",'keys'=>"sup_id, material_id, price");

    if(isset($_POST['id'])){
        $data['values']="sup_id = '".$_GET['id']."', 
                         material_id = '".str_replace("'","\'",$_POST['material_id'])."',
                         price = '".str_replace(",","",$_POST['price'])."'";
        $data['condition'] = " WHERE id = '".$_POST['id']."'";
        $response = $app->update2($data);
        $response['message'] = "Successful";
    }else{
        $date = date("Y")."-".date("m")."-".date("d");

        $data2 = array(
            'model'=>'supmaterials',
            'keys'=>'sup_id, material_id, price',
            'values'=>"'".str_replace("'","\'",$_GET['id'])."', 
                       '".str_replace(",","",$_POST['material_id'])."',
                       '".str_replace(",","",$_POST['price'])."'"
        );
        $response = $app->create2($data2);
        $response['message'] = "Successful";
    }
}
if(isset($_GET['sme'])){
    $data = array('model'=>"supmaterials",'keys'=>"sup_id, material_id, price");
    $date = date("Y")."-".date("m")."-".date("d");

        $data2 = array(
            'model'=>'supmaterials',
            'keys'=>'sup_id, material_id, price',
            'values'=>"'".str_replace("'","\'",$_GET['id'])."', 
                       '".str_replace(",","",$_GET['mid'])."',
                       '".str_replace(",","",$_GET['price'])."'"
        );
        $response = $app->create2($data2);
        //echo "<script>location.href='?page=tests-view&id=".$_GET['id']."';</script>";

}
if(isset($_POST['r_data'])){
    $data = array('model'=>"result_data",'condition'=>"WHERE labtest_id= '".$_GET['id']."'");
    $response = $app->getRecord2_old($data);
    $dataArr = array();
    $dataArr2 = array();
    if($response['data']==null){

        foreach ($_POST['data_title'] as  $value) {
            if(trim($value)!=="")array_push($dataArr,str_replace("'","\'",$value));
        }
        foreach ($_POST['normal_range'] as  $value) {
            if(trim($value)!=="")array_push($dataArr2,str_replace("'","\'",$value));
        }
        $data2 = array(
                'model'=>'result_data',
                'keys'=>'labtest_id, data_title, normal_range',
                'values'=>"'".str_replace("'","\'",$_GET['id'])."', 
                           '".str_replace(",","",json_encode($dataArr))."',
                           '".str_replace(",","",json_encode($dataArr2))."'"
            );
        $response = $app->create2($data2);
    }else{
        $dataArr = json_decode($response['data'][0]['data_title']);
        $dataArr2 = json_decode($response['data'][0]['normal_range']);
        if($dataArr2==NULL){ $dataArr2=array(); }
        foreach ($_POST['data_title'] as  $value) {
            if(trim($value)!=="")array_push($dataArr,str_replace("'","\'",$value));
        }

        foreach ($_POST['normal_range'] as  $value) {
            if(trim($value)!=="")array_push($dataArr2,str_replace("'","\'",$value));
        }



        $data = array('model'=>"result_data",'keys'=>"labtest_id, data_title");
        $data['values']="labtest_id = '".$_GET['id']."', 
                         data_title = '".str_replace("'","\'",json_encode($dataArr))."',
                         normal_range = '".str_replace("'","\'",json_encode($dataArr2))."'";
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
        echo '<script> var x = window.location.href; h = x.split("&delD"); window.location.href = h[0];</script>';
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
                    $mymaterials = $app->getMySupMaterials("WHERE sup_id = '".$_GET['id']."'");
                ?>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li  class="<?php echo $active; ?>"><a href="?page=suppliers-view&id=<?php echo $_GET['id']; ?>&tab=0" >Pricing</a></li>
                    <!-- <li class="<?php echo $active1; ?>"><a href="?page=tests-view&id=<?php echo $_GET['id']; ?>&tab=1" >Result Data</a></li> -->
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
                                <th style="">Price</th>
                                <th style="">Action</th>
                            </tr>
                            </thead>
                            <tbody id="mtable">
                            <?php $c=0; $tabIndex=4; foreach ($mymaterials as $key => $value): $c++;
                                $tabIndex++; 
                                ?>
                                <tr><form method="POST">
                                    <td><?php echo $c; ?><input type="hidden" name="id" value="<?php echo $value['id']; ?>"></td>
                                    <td><select name="material_id"  tabindex="<?php echo $tabIndex; ?>" class="form-control" style="width: 100%;">
                                        <?php 
                                      
                                        foreach($materials as $kkk => $vvv){
                                            $sel = ""; if($kkk==$value['material_id']){ $sel="selected"; }
                                            echo '<option value="'.$kkk.'" '.$sel.'>'.$vvv['name'].'</option>';
                                        }
                                        ?>
                                        </select>
                                    </td>
                                    <?php $tabIndex++; ?>
                                    <td><input  tabindex="<?php echo $tabIndex; ?>" name="price" value='<?php echo $value['price']; ?>' class="form-control" /></td>
                                    <td>

                                        <?php if($_SESSION['acl']['suppliers-view']==1):  $tabIndex++; ?>    
                                        <button  tabindex="<?php echo $tabIndex; ?>" type="submit" name="new_item" class="btn btn-success btn-xs" value="Save"><i class="fa fa-refresh"></i> Save</button>
                                    <?php endif; ?>

                                         <?php if($_SESSION['acl']['suppliers-delete']==1):  $tabIndex++; ?>
                                        
                                           <label  tabindex="<?php echo $tabIndex; ?>"  class="btn btn-danger btn-xs" onClick="deleteThis('<?php echo $value['id']; ?>')"><i class="fa fa-trash"></i> Delete</label>
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
                          <div class="col-sm-2"></div>  
                          <div class="col-sm-6">
                              <div class="form-group" style="margin-bottom: 0px; ">
                                    <!-- <label style="margin-right: 10px;margin-bottom: 10px;">Data Title</label><label class="btn btn-success fa fa-plus" id="clck">More data-title</label> -->
                                    <input type="text" class="form-control" placeholder=" Data title" name="data_title[]" required />
                                    
                              </div>
                              <div class="form-group" style="margin-bottom: 0px; ">
                                    <!-- <label style="margin-right: 10px;margin-bottom: 10px;">Data Title</label><label class="btn btn-success fa fa-plus" id="clck">More data-title</label> -->
                                    <input type="text" class="form-control" placeholder=" Normal Range" name="normal_range[]" required />
                                    
                              </div>
                           </div>
                           <div class="col-sm-2" style="margin-top:30px;">
                            <div class="form-group" style="margin-bottom: 0px; ">
                               <input type="submit" name="r_data" class="btn btn-success btn-sm" value="Save">
                               <button type="button" id="dcancel" class="btn btn-warning btn-sm"> Cancel</button>
                           </div>
                           </div>  
                           <div class="col-sm-4"></div> 
                            
                       </div>
                       <div id="moredata"></div>
                          <label class="btn btn-sm btn-warning pull-right" id="newdata">Add New</label><br><br>  
                          <div class="box-body table-responsive">  
                            <table id="example2" class="table table-bordered table-striped">
                            
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th style="width:8%;"></th>
                                <th style="">Data needed</th>
                                <th style="">Normal Range</th>
                                <th style="">Action</th>
                            </tr>
                            </thead>
                            <tbody id="mtable2">
                            <?php $data = array('model'=>"result_data",'condition'=>"WHERE labtest_id= '".$_GET['id']."'");
                                $titles = array();
                                $normalRange=array();
                                $r_datalab = $app->getRecord2_old($data);
                                if(sizeOf($r_datalab['data'])>0){ //echo json_encode($r_datalab['data']);
                                    $r_datalab = $r_datalab['data'][0]; // = $r_datalab['data'];
                                    $titles = json_decode($r_datalab['data_title']);
                                    $normalRange = json_decode($r_datalab['normal_range']);
                                }
                                else{
                                    $r_datalab = array();
                                }
                                //echo json_encode($r_datalab);
                                foreach ($titles as $kk=> $value): $c++;
                               
                                ?>
                                <tr>
                                    <td><?php echo $c; ?> </td>
                                    <td><?php echo $titles[$kk]; ?></td>
                                    <td><?php echo $normalRange[$kk]; ?></td>
                                    <td>
                                        <label  class="btn btn-danger btn-xs" onClick="deleteThisD('<?php echo $titles[$kk]; ?>')"><i class="fa fa-trash"></i> Delete</label>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th style="width:8%;"></th>
                                <th style="">Data needed</th>
                                <th style="">Normal Range</th>
                                <th style="">Action</th>
                            </tr>
                            </tfoot>
                        </table>
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

    var addt = "<tr id='mf'>";
        addt += "<td></td><td><select name='material_id' id='add_material_id' style=\"width: 100%;\" tabindex=\"1\"  id=\"material_id_val\" class='form-control'>";
        <?php 
         foreach($materials as $kkk => $vvv){
            $sel = ""; 
            echo 'addt += "<option value='.$kkk.' $sel>'.$vvv['name'].'</option>";';
         }
        ?>
        addt += "</select></td><td><input  tabindex=\"2\" name='price' id=\"qty_val\"   class=\"form-control\" value='' class='form-control'/></td><td><label  tabindex=\"3\" type=\"submit\" class=\"btn btn-success btn-sm\" value=\"save\" onClick=\"saveMe()\" name='new_item'><i class=\"fa fa-plus\"></i>  Save</label>&nbsp;<label type=\"submit\" class=\"btn btn-warning btn-sm\" value=\"save\" onClick=\"redirect()\"  tabindex=\"4\" name='new_item'><i class=\"fa fa-minus\"></i>  Cancel</label></td></tr>";

    $("#new").click(function(){
        
        $("tr>td.dataTables_empty").remove();
        $("#mtable").append(addt);
        // var nn = $("#mf").html();
        // nn = nn.replace("<form method=\"post\"></form>","<form method=\"post\">");
        // $("#mf").remove();
        // $("#mtable").append(nn);
        $("#add_material_id").focus();
        $("#new").attr("style","display: none;");
    });
    $("#clck").click(function(){
        $("#moredata").append('<div class="row"><div class="col-sm-2"></div><div class="col-sm-6"><div class="form-group" style="margin-bottom: 0px; "><input type="text" class="form-control" placeholder=" Data title" name="data_title[]" /></div></div><div class="col-sm-4"></div></div>');  
                          
                              
                                    
                                    
                                    
                              
                           
    });

    function saveMe(){
        var mid = "&mid="+$("#material_id_val").val();
        var price = "&price="+$("#qty_val").val();
        location.href="?page=<?php echo $_GET['page'] ?>&id=<?php echo $_GET['id'] ?>&sme=1"+mid+price;
    }
    function redirect(){
        location.href="?page=<?php echo $_GET['page'] ?>&id=<?php echo $_GET['id'] ?>";
    }
    $("#newdata").click(function(){
      $("#addata").show();
      $("#newdata").hide();
    });
    $("#dcancel").click(function(){
      $("#addata").hide();
      $("#newdata").show();
    });
</script>    
<!-- /.content -->