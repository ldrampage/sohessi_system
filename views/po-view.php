
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

if(isset($_GET['st'])){
    $data = array('model'=>"po",'keys'=>"status");
        $addme="";
        if(trim(strtoupper($_GET['st']))=="APPROVED"){
            $addItem = ", approved_by = '".$_SESSION['login_id']."', date_approved = '".date("Y-m-d")."', date_forwarded = '', date_received = ''";
        }
        if(trim(strtoupper($_GET['st']))=="RECEIVED"){
            $addItem = ", received_by = '".$_SESSION['login_id']."', date_received = '".date("Y-m-d")."'";
        }
        if(trim(strtoupper($_GET['st']))=="ORDERED"){
            $addItem = ", ordered_by = '".$_SESSION['login_id']."', date_forwarded = '".date("Y-m-d")."', date_received = ''";
        }
        if(trim(strtoupper($_GET['st']))=="PENDING"){
            $addItem = ", pending_by = '".$_SESSION['login_id']."', date_approved = '', date_forwarded = '', date_received = ''";
        }

        $data['values']="status = '".$_GET['st']."'".$addItem;
        $data['condition'] = " WHERE id = '".$_GET['id']."'";
        $response = $app->update2($data);

}

if(isset($_POST['btn_save'])){
    $data = array('model'=>"po",'keys'=>"inclusives");

    $inclusives = array();

    $realmaterial_id = $_POST['realmaterial_id'];
    $material_id = $_POST['material_id'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $amount = $_POST['amount'];

    foreach($realmaterial_id as $mk => $mv){
        $inclusives[] = array("material_id"=>$realmaterial_id[$mk],
                              "supmaterial_id"=>$material_id[$mk],
                              "qty"=>str_replace(",","",$qty[$mk]),
                              "price"=>str_replace(",","",$price[$mk]),
                              "amount"=>str_replace(",","",$amount[$mk]));
    }

        $data['values']="inclusives = '".json_encode($inclusives)."'";
        $data['condition'] = " WHERE id = '".$_GET['id']."'";
        $response = $app->update2($data);
    
}
if(isset($_GET['del'])){

    $data = array('model'=>'supmaterials', 'condition'=>" WHERE id = '".$_GET['del']."'");
    $response = $app->delete2($data);
    $response['message'] = "Deleted";
    echo '<script>window.location.href = "?page='.$_GET['page'].'&id='.$_GET['id'].'";</script>';

}




$department = $app->getPo("WHERE id = '".$_GET['id']."'");
$department = $department[$_GET['id']];
$value = $department;
// $data = array("model"=>"laboffered", "condition"=>" WHERE id = '".$_GET['id']."'");
// $projects=$app->getRecord2($data);
// $department = $projects['data'][0];
// $eawards = json_decode($department['employee_id']);
// $emps = $app->getEmployees();
//echo json_encode($projects);
 $suppliers = $app->getSuppliers();
 $emps = $app->getEmployees();
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

                                $dpo = "";
                                $dpoCount = strlen($department['po_number']);
                                while($dpoCount<6){
                                    $dpo .= "0";
                                    $dpoCount++;
                                }
                                $real_po = POPRE."-".$dpo.$department['po_number'];

$poStatus = $app->getPoStatus();
?>

<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header" style="color: <?php echo $color; ?>">
                <i class="fa fa-globe"></i>
                <?php
                 echo $real_po;
                ?>
                <small class="pull-right">Date: <?php echo date("Y")."-".date("m")."-".date("d"); ?></small>
            </h2>
            <div class="pull-right" style="margin-top: -75px;">
                            <a href="?page=po"><label class="btn btn-xs btn-info">back</label></a> 
                        </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            <address>
                <strong><h4><?php echo $suppliers[$department['supplier_id']]['business']; ?></h4></strong>
                <p>
                    <strong>Prepared By:</strong><?php 

                                    if(array_key_exists($value['prepared_by'], $emps)){
                                        echo  $emps[$value['prepared_by']]['fname']." ".$emps[$value['prepared_by']]['lname']; 
                                    }else{
                                        echo "Not Available";
                                    }
                                    ?></p>
                <p>                    
                    <strong>Approved By:</strong> <?php 

                                    if(array_key_exists($value['approved_by'], $emps)){
                                        echo  $emps[$value['approved_by']]['fname']." ".$emps[$value['approved_by']]['lname']; 
                                    }else{
                                        echo "N/A";
                                    }
                                    ?>
                </p>
                <p>                    
                    <strong>Status:</strong> 


                 

                    <select class="form-control" style="width: 50%;"   name="width" id="changeStatus" required="">
                            <?php foreach($poStatus as $kk=>$vv){ $s=""; 
                                if($value['status']==$vv){$s="selected";}
                                $dis = "";
                                if(strtoupper(trim($vv))=="APPROVED" && $_SESSION['acl']['po-approve']!=1){
                                    $dis=" disabled='disabled'";
                                } 

                                if(strtoupper(trim($vv))=="RECEIVED" && $_SESSION['acl']['po-receive']!=1){
                                    $dis=" disabled='disabled'";
                                } 

                                if(strtoupper(trim($vv))=="ORDERED" && $_SESSION['acl']['po-order']!=1){
                                    $dis=" disabled='disabled'";
                                } 

                                echo "<option value='".$vv."' ".$s." ".$dis.">".$vv."</option>";
                            } ?>
                          </select>

                 
                </p>

                
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <address>
                <p>
                    <strong>Date Created:</strong> <?php if(trim($value['date_created'])=="0000-00-00"){
                                        echo "N/A";
                                     }else{
                                        echo date("M d, Y",strtotime($value['date_created'])); 
                                     } ?>
                </p>
                <p>
                    <strong>Date Approved:</strong> <?php if(trim($value['date_approved'])=="0000-00-00"){
                                        echo "N/A";
                                     }else{
                                        echo date("M d, Y",strtotime($value['date_approved'])); 
                                     } ?>
                </p>
                <p>
                    <strong>Date Ordered:</strong> <?php if(trim($value['date_forwarded'])=="0000-00-00"){
                                        echo "N/A";
                                     }else{
                                        echo date("M d, Y",strtotime($value['date_forwarded'])); 
                                     } ?>
                </p>
                <p>
                    <strong>Date Received:</strong> <?php if(trim($value['date_received'])=="0000-00-00"){
                                        echo "N/A";
                                     }else{
                                        echo date("M d, Y",strtotime($value['date_received'])); 
                                     } ?>
                </p>
                <p>
                </p><br>
            </address>
        </div>
        <div class="col-sm-4 invoice-col">
            <div style="float: right;">
                <a href="http://localhost/sohessi-system\EditableInvoice\po-print.php?id=<?php echo $_GET['id']; ?>" target="_BLANK" class="btn btn-info btn-sm"><i class="fa fa-print"></i> Print</a>
            </div>    
        </div>   
        
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->




<?php



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
$materials = $app->getMaterials();
$supmaterials = $app->getSupMaterials("WHERE sup_id = '".$value['supplier_id']."'");



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
                    <li  class="<?php echo $active; ?>"><a href="?page=po-view&id=<?php echo $_GET['id']; ?>&tab=0" >Inclusive</a></li>
                    <!-- <li class="<?php echo $active1; ?>"><a href="?page=tests-view&id=<?php echo $_GET['id']; ?>&tab=1" >Result Data</a></li> -->
                </ul> 

                <div class="tab-content">
                
                    <div class="<?php echo $active; ?> tab-pane" id="labmaterials">  
                    
                <!-- <label class="btn btn-sm btn-warning pull-right" id="new">Add New</label><br><br> -->
                <div class="box-body table-responsive">
                    <?php if($_SESSION['acl']['po-update']==1): ?>
                    <label id="nItem" class="btn btn-default btn-xs pull-right"><i class="fa fa-plus"></i> New Item</label> 
                <?php endif; ?>
                    <br><br>
                        <form name="user" method="post" >
                        <table id="example100" class="table table-bordered table-striped">
                            <!-- table table-bordered table-striped -->
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th>Item</th>
                                          <th>Qty</th>
                                          <th>Price</th>
                                          <th>Amount</th>
                                          <th></th>
                            </tr>
                            </thead>
                            <?php $inclusives = json_decode($value['inclusives'], true);  ?>
                            <tbody  id="tcontents">
                            <?php 
                            $c=0;
                            $total = 0;
                            foreach($inclusives as $k=>$v): 
                                $v['amount'] = (float) str_replace(",","",$v['amount']);
                                $c++; $total= $total + $v['amount']; 

                               // echo json_encode($v);

                                ?>
                                <tr id="trmat_<?php echo $c; ?>">
                                <td>
                                <input type="hidden" name="realmaterial_id[]" id="realmat_1" value="<?php echo $v['material_id']; ?>">
                                <select class="form-control" onchange="setDetails('<?php echo $c; ?>')" id="mat_<?php echo $c; ?>" name="material_id[]" required="">
                                <?php foreach($supmaterials as $kk=>$vv){ $s=""; 
                                    if($v['supmaterial_id']==$vv['id']){$s="selected";}
                                echo "<option value='".$vv['id']."' ".$s.">".$materials[$vv['material_id']]['name']."</option>";
                              } ?>
                          </select>
                                </td>
                                <td>
                                    <input type="text" name="qty[]" value="<?php echo number_format($v['qty'],2); ?>" onchange="recalculate('<?php echo $c; ?>')" id="qty_<?php echo $c; ?>" class="form-control" required="">
                                
                                </td><td>
                                    <input type="text" name="price[]" value="<?php echo number_format($v['price'],2); ?>" readonly="" id="price_<?php echo $c; ?>" class="form-control" required="">
                                
                                </td><td>
                                    <input type="text" name="amount[]" readonly="" value="<?php echo number_format($v['amount'],2); ?>" id="amount_<?php echo $c; ?>" class="form-control amounts" required="">
                                
                                </td><td>
                                    <?php if($_SESSION['acl']['po-update']==1): ?>
                                    <label class="btn btn-xs btn-danger" onclick="removeItem('mat_<?php echo $c; ?>')">x</label>
                                    <?php endif; ?>
                                </td></tr>
                            <?php endforeach; ?>

                            <?php /*$c=0; foreach ($mymaterials as $key => $value): $c++;
                               
                                ?>
                                <tr><form method="POST">
                                    <td><?php echo $c; ?><input type="hidden" name="id" value="<?php echo $value['id']; ?>"></td>
                                    <td><select name="material_id" class="form-control" style="width: 100%;">
                                        <?php 
                                      
                                        foreach($materials as $kkk => $vvv){
                                            $sel = ""; if($kkk==$value['material_id']){ $sel="selected"; }
                                            echo '<option value="'.$kkk.'" '.$sel.'>'.$vvv['name'].'</option>';
                                        }
                                        ?>
                                        </select>
                                    </td>
                                    <td><input name="price" value='<?php echo $value['price']; ?>' class="form-control" /></td>
                                    <td>
                                        <?php if($_SESSION['acl']['suppliers-view']==1): ?>    
                                        <button type="submit" name="new_item" class="btn btn-success btn-xs" value="Save"><i class="fa fa-refresh"></i> Save</button>
                                    <?php endif; ?>

                                         <?php if($_SESSION['acl']['suppliers-delete']==1): ?>
                                        
                                           <label  class="btn btn-danger btn-xs" onClick="deleteThis('<?php echo $value['id']; ?>')"><i class="fa fa-trash"></i> Delete</label>
                                        <?php endif; ?>

                                    </td>
                                    </form>
                                </tr>
                            <?php endforeach; */ ?>

                            </tbody>
                            <tfoot>
                           <tr>
                                              <th colspan="3" style="text-align: right; margin-right: 5px;">Total</th>
                                              <th style="width: 190px;"><input type="text" id="total" value="<?php echo number_format($total,2); ?>" class="form-control" readonly></th>
                                              <th></th>
                                            </tr>
                            </tfoot>
                        </table>
                        <?php if($_SESSION['acl']['po-update']==1): ?>
                        <div style="float: right;"><input type="submit" name='btn_save' value="Save" class="btn btn-sm btn-success"></div>
                    <?php endif; ?>
                        </form>
                        </div>
                        </div>
                    
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
<script>

    $("#changeStatus").change(function(){
        var st = $(this).val();
        location.href="?page=<?php echo $_GET['page']; ?>&id=<?php echo $_GET['id']; ?>&st="+st;
    });

    function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
      try {
        decimalCount = Math.abs(decimalCount);
        decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

        const negativeSign = amount < 0 ? "-" : "";

        let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
        let j = (i.length > 3) ? i.length % 3 : 0;

        return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
      } catch (e) {
        console.log(e)
      }
    };
// document.getElementById("b").addEventListener("click", event => {
//   document.getElementById("x").innerText = "Result was: " + formatMoney(document.getElementById("d").value);
// });

    var counter = <?php echo $c; ?>;

    $("#supplier_id").on("change", function(){
       
       addItem();
        
    });

    $("#nItem").click(function(){
        addItem();
    });

    function recalculate(num){
        var qty = parseFloat($("#qty_"+num).val().replace(/,/g, ''));
        var price = parseFloat($("#price_"+num).val().replace(/,/g, ''));
        var amount = qty * price;
        $("#amount_"+num).val(formatMoney(amount));
        getTotal();
    }

    function getTotal(){
        var values = $("input[name='amount[]']")
              .map(function(){return $(this).val();}).get();
        console.log(values); 
        var arrayLength = values.length;
        var total = 0;
        for (var i = 0; i < arrayLength; i++) {
            //console.log(values[i]);
            total = total + parseFloat(values[i].replace(/,/g, ''));
            //Do something
        }
        $("#total").val(formatMoney(total));
    }




    function removeItem(item){

        var result = confirm("Are you sure, do you want to remove this item?");
        if (result) {
            $("#tr"+item).remove();
            getTotal();
        }

        
        
    }

    function setDetails(num){
        var supid =  <?php echo $department['supplier_id']; ?>;
        var mgp = $("#mat_"+num).val();
        if(mgp!=""){
          $.ajax({
                url: "getSupMaterials.php",
                type: "post",
                data: { gp: mgp, c: num, sidn: supid } ,
                success: function (response) {
                   var details = JSON.parse(response);
                   $("#realmat_"+num).val(details.material_id);
                   $("#price_"+num).val(details.price);
                   var qty = parseFloat($("#qty_"+num).val());
                   var amount = qty * parseFloat(details.price);
                   $("#amount_"+num).val(formatMoney(parseFloat(amount).toFixed(2)));
                   getTotal();
                   // console.log(details.price);
                   //  console.log(response);
                   // You will get response from your PHP page (what you echo or print)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
                }
          });
       }else{
         alert("Please select supplier");
       }

    }

    function addItem(){

       var supid =  <?php echo $department['supplier_id']; ?>;
       //alert(supid);
       if(supid!=""){
          $.ajax({
                url: "getSupMaterials.php",
                type: "post",
                data: { sid: supid, c: counter} ,
                success: function (response) {
                    counter++;

                    $("#tcontents").append(response);

                   // You will get response from your PHP page (what you echo or print)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
                }
          });
       }else{
         alert("Please select supplier");
       }
    }




    var addt = "<tr id='mf'>";
        addt += "<td></td><td><select name='material_id' style=\"width: 100%;\"  id=\"material_id_val\" class='form-control'>";
        <?php 
         foreach($materials as $kkk => $vvv){
            $sel = ""; 
            echo 'addt += "<option value='.$kkk.' $sel>'.$vvv['name'].'</option>";';
         }
        ?>
        addt += "</select></td><td><input name='price' id=\"qty_val\"   class=\"form-control\" value='' class='form-control'/></td><td><label type=\"submit\" class=\"btn btn-success btn-sm\" value=\"save\" onClick=\"saveMe()\" name='new_item'><i class=\"fa fa-plus\"></i>  Save</label>&nbsp;<label type=\"submit\" class=\"btn btn-warning btn-sm\" value=\"save\" onClick=\"redirect()\" name='new_item'><i class=\"fa fa-minus\"></i>  Cancel</label></td></tr>";

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