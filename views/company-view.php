
<script>


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
$response['message']="";




$data = array("model"=>"company", "condition"=>" WHERE id = '".$_GET['id']."'");
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
                 echo strtoupper($department['company']." ".$department['company_number'])." (Test View)";
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
                <strong><h4>Company: <?php echo $department['company']." - ".$department['branch']; ?></h4></strong>
                <p><?php echo $department['address']; ?></p><br>
                <strong><h4>Phone: <?php echo $department['phone']; ?></h4></strong>
                <strong><h4>Email: <?php echo $department['email']; ?></h4></strong>
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

    $data = array('model'=>'lab_company', 'condition'=>" WHERE id = '".$_GET['del']."'");
    $response = $app->delete2($data);
    $response['message'] = "Deleted";
    echo '<script>window.location.href = "?page='.$_GET['page'].'&id='.$_GET['id'].'";</script>';

}

if(isset($_POST['new_item'])){
     $data = array('model'=>"lab_company",'keys'=>"company_id, lab_id, ctype");

    if(isset($_POST['id'])){
        $data['values']="company_id = '".$_GET['id']."', 
                         lab_id = '".str_replace("'","\'",$_POST['lab_id'])."',
                         ctype = '".str_replace(",","",$_POST['ctype'])."',
                         price = '".str_replace(",","",$_POST['price'])."',
                         note = '".str_replace("'","\'",$_POST['note'])."'";
        $data['condition'] = " WHERE id = '".$_POST['id']."'";
        $response = $app->update2($data);
        $response['message'] = "Successful";
    }else{
        $date = date("Y")."-".date("m")."-".date("d");

        $data2 = array(
            'model'=>'lab_company',
            'keys'=>'company_id, lab_id, ctype, price, note',
            'values'=>"'".str_replace("'","\'",$_GET['id'])."', 
                       '".str_replace(",","",$_POST['lab_id'])."',
                       '".str_replace(",","",$_POST['ctype'])."',
                       '".str_replace(",","",$_POST['price'])."',
                       '".str_replace("'","\'",$_POST['note'])."'"
        );
        $response = $app->create2($data2);
        $response['message'] = "Successful";
    }
}
if(isset($_GET['sme'])){
    $data = array('model'=>"lab_company",'keys'=>"company_id, lab_id, ctype");
    $date = date("Y")."-".date("m")."-".date("d");

        $data2 = array(
            'model'=>'lab_company',
            'keys'=>'company_id, lab_id, ctype, price, note',
            'values'=>"'".str_replace("'","\'",$_GET['id'])."', 
                       '".str_replace(",","",$_GET['lab_id'])."',
                       '".str_replace(",","",$_GET['ctype'])."',
                       '".str_replace(",","",$_GET['price'])."',
                       '".str_replace("'","\'",$_GET['note'])."'"
        );
        $response = $app->create2($data2);
        echo "<script>location.href='?page=company-view&id=".$_GET['id']."';</script>";

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


  $rctype = $app->getLabCompTypes();          

?>




    <br>

    <div class="row">

        <div class="col-md-12">

            <br>
            <div class="widget-content ">

                <?php 
                    $Labs = $app->getLabTests(); 
                    $mylabcomp = $app->getMyLabCompany("WHERE company_id = '".$_GET['id']."'");
                   // echo json_encode($mylabcomp);
                ?>
                <label class="btn btn-sm btn-warning pull-right" id="new">Add New</label><br><br>
                <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <!-- table table-bordered table-striped -->
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th></th>
                                <th style="">Lab Test</th>
                                <th style="">Type</th>
                                <th style="">Note</th>
                                <th style="width: 80px;">Price</th>
                                <th style="">Action</th>
                            </tr>
                            </thead>
                            <tbody id="mtable">
                            <?php $c=0; foreach ($mylabcomp as $key => $value): $c++; $real_price=0;
                               
                                ?>
                                <tr><form method="POST" action="?page=<?php echo $_GET['page'] ?>&id=<?php echo $_GET['id']; ?>">
                                    <td><?php echo $c; ?><input type="hidden" name="id" value="<?php echo $value['id']; ?>"></td>
                                    <td>
                                        <!-- <select name="lab_id" class="form-control"> -->
                                        <select class="form-control select2 select2-hidden-accessible" id="" name="lab_id" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                        <?php 
                                        //echo $materials[$value['material_id']]['name']; 
                                        foreach($Labs as $kkk => $vvv){
                                            $sel = ""; if($kkk==$value['lab_id']){ $sel="selected"; $real_price=$vvv['price']; }
                                            echo '<option value="'.$kkk.'" '.$sel.'>'.$vvv['name'].' ('.number_format($vvv['price'],2).')</option>';
                                        }
                                        ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="ctype" class="form-control">
                                        <option value="0" <?php if($value['ctype']==0){ echo "selected"; } ?>>Pre-employment</option>
                                        <option value="1" <?php if($value['ctype']==1){ echo "selected"; } ?>>Annual</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" style="text-align: left; width:100%;" name="note" value="<?php echo $value['note']; ?>">
                                    </td>
                                    <td>
                                        <input type="text" style="text-align: right; width:100%;" name="price" value="<?php echo number_format($value['price'],2); ?>">
                                    </td>    
                                    <td>
                                        <?php if($_SESSION['acl']['company-view']==1): ?>    
                                        <button type="submit" name="new_item" class="btn btn-success btn-xs" value="Save"><i class="fa fa-refresh"></i> Save</button>
                                    <?php endif; ?>

                                         <?php if($_SESSION['acl']['company-delete']==1): ?>
                                        
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
                                <th style="">Lab Test</th>
                                <th style="">Type</th>
                                <th style="">Price</th>
                                <th style="">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>


            </div>
            
        </div>
    </div>
</section>
<script>

    var addt = "<tr id='mf'>";
        addt += "<td></td><td><select class=\"form-control select2 \" id=\"lab_id\" name=\"lab_id\" style=\"width: 100%;\" tabindex=\"-1\" aria-hidden=\"true\" required>";
        <?php 
        //<select name='lab_id'  id=\"lab_id\" class='form-control'>
         
         foreach($Labs as $kkk => $vvv){
                                            $sel = ""; 
                                            echo 'addt += "<option value='.$kkk.' $sel>'.$vvv['name'].' ('.number_format($vvv['price'],2).')</option>";';
                                        }
        ?>
        addt += "</select></td><td><select name=\"ctype\" id=\"ctype\" class=\"form-control\"><option value=\"0\" >Pre-employment</option><option value=\"1\">Annual</option></select></td><td><input type=\"text\" style=\"text-align: right; width:100%; \" name=\"note\" id=\"note\" value=\"\"></td><td><input type='text' style='text-align: left;' name='price' required id='price'></td><td><label type=\"submit\" class=\"btn btn-success btn-xs\" value=\"save\" onClick=\"saveMe()\" name='new_item'><i class=\"fa fa-plus\"></i>  Save</label>&nbsp;<label type=\"submit\" class=\"btn btn-xs btn-warning btn-xs\" value=\"save\" onClick=\"redirect()\" name='new_item'><i class=\"fa fa-minus\"></i>  Cancel</label></td></tr>";



 
    $("#new").click(function(){
        
        $("tr>td.dataTables_empty").remove();
        $("#mtable").append(addt);
        // var nn = $("#mf").html();
        // nn = nn.replace("<form method=\"post\"></form>","<form method=\"post\">");
        // $("#mf").remove();
        // $("#mtable").append(nn);
        $("#new").attr("style","display: none;");
    });


    function saveMe(){
        var ctype = "&ctype="+$("#ctype").val();
        var lab_id = "&lab_id="+$("#lab_id").val();
        var price = "&price="+$("#price").val();
        var note = "&note="+$("#note").val();
        location.href="?page=<?php echo $_GET['page'] ?>&id=<?php echo $_GET['id'] ?>&sme=1"+ctype+lab_id+price+note;
    }
    function redirect(){
        location.href="?page=<?php echo $_GET['page'] ?>&id=<?php echo $_GET['id'] ?>";
    }

</script>    
<!-- /.content -->