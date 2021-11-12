<!-- Main content -->
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$response=array('action'=>"", 'message'=>"");
if(isset($_POST['btn_save'])){

    $data = array('model'=>"po",'keys'=>"supplier_id, date_created, prepared_by, status, po_number, inclusives");

    $inclusives = array();

    $realmaterial_id = $_POST['realmaterial_id'];
    $material_id = $_POST['material_id'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $amount = $_POST['amount'];

    foreach($realmaterial_id as $mk => $mv){
        $inclusives[] = array("material_id"=>$realmaterial_id[$mk],
                              "supmaterial_id"=>$material_id[$mk],
                              "qty"=>$qty[$mk],
                              "price"=>$price[$mk],
                              "amount"=>$amount[$mk],);
    }


    if(isset($_POST['id'])){
        $data['values']="name = '".str_replace("'","\'",$_POST['name'])."', 
                         description = '".str_replace("'","\'",$_POST['description'])."',
                         qty = '".str_replace(",","",$_POST['qty'])."',
                         reorder_level = '".str_replace(",","",$_POST['reorder_level'])."',
                         supplier_ids = '".json_encode($_POST['supplier_ids'])."'";
        $data['condition'] = " WHERE id = '".$_POST['id']."'";
        $response = $app->update2($data);
    }else{
        $date = date("Y")."-".date("m")."-".date("d");
        $pos = $app->getPo();
        $pon = 0;
        foreach($pos as $kp => $vp){
            if($vp['po_number']>$pon){ $pon = $vp['po_number']; }
        }
        $rpon = $pon + 1;
        $data2 = array(
            'model'=>'po',
            'keys'=>'supplier_id, date_created, prepared_by, status, po_number, inclusives',
            'values'=>"'".str_replace("'","\'",$_POST['supplier_id'])."', 
                       '".date("Y-m-d")."',
                       '".$_SESSION['login_id']."',
                       'Pending' ,
                       '".$rpon."',
                       '".json_encode($inclusives)."' "
        );
        $response = $app->create2($data2);
        $response['message'] = "Successful";
      
    }

}
//$rvalue =array();
if(isset($_GET['id'])){
    $action = "Update";
    $rqdata = array("model"=>"po", "condition"=>" WHERE id = '".$_GET['id']."'");
    $department = $app->getRecord2($rqdata);
    $rvalue = $department['data'][0];
    //echo json_encode($rvalue);

}else{ $action = "Create"; }
// echo "asdasdsad";
$suppliers = $app->getSuppliers();
// echo "asdasdsad";
// echo json_encode($suppliers);
$module = explode("-",$page);

?>
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
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                        <h4 class="modal-title" id="myModalLabel"><?php echo $action." ".ucfirst($module[0]); ?> </h4>
                        <div class="pull-right" style="margin-top: -25px;">
                            <a href="?page=po"><label class="btn btn-xs btn-info">PO List</label></a> 
                        </div>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label>Suppliers</label> 
                                        <?php //echo json_encode($teamed); ?>
                                            <select class="form-control select2 select2-hidden-accessible"  data-placeholder="Select Suppliers" name="supplier_id" id="supplier_id" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                                <option value="">Select Supplier</option>
                                                <?php
                                                 $suppliers = $app->getSuppliers();
                                                 $arrays = json_decode($rvalue['supplier_ids'],true);
                                                 foreach ($suppliers as $key => $value) {
                                                      $act="";
                                                     if(isset($_GET['id']) &&  in_array($key, $arrays)){  $act="selected"; echo "Yes";}
                                                     echo "<option value='".$key."' ".$act.">".$value['business']."</option>";
                                                 }
                                                ?>
                                            </select>   
                                        </div>   
                                    </div>   
                                    <div class="col-md-4">

                                    </div>   
                                    <div class="col-md-4">

                                    </div>    
                                </div>        
                            </div>
                            <div class="col-sm-12">
                                <div class="box">
                                    <div class="box-header">
                                      <h3 class="box-title">Purchase Order</h3>

                                      <div class="box-tools">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                         <!--  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                          <div class="input-group-btn">
                                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                          </div> -->
                                          <label id="nItem" class="btn btn-default btn-xs pull-right"><i class="fa fa-plus"></i> New Item</label>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body table-responsive no-padding">
                                      <table class="table table-hover">
                                        <tr>
                                          <th>Item</th>
                                          <th>Qty</th>
                                          <th>Price</th>
                                          <th>Amount</th>
                                          <th></th>
                                        </tr>
                                        <tbody id="tcontents">
                                        </tbody> 
                                        <tfoot id="tfooter">
                                            <tr>
                                              <th colspan="3" style="text-align: right; margin-right: 5px;">Total</th>
                                              <th style="width: 190px;"><input type="text" id="total" class="form-control" readonly></th>
                                              <th></th>
                                            </tr>
                                        </tfoot> 
                                      </table>
                                    </div>
                                    <!-- /.box-body -->
                                  </div>

                            </div>
                            <div class="col-sm-12"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="btn_save" class="btn btn-success fa fa-plus-square btn-sm" value="<?php echo $action; ?>">
                    </div>
                </div>
            </form>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
<script>

    var counter = 0;

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
        var supid =  $("#supplier_id").val();
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

       var supid =  $("#supplier_id").val();
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


</script>