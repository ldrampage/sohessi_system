<style>
       
       	.avatar-upload {
		position: relative;
		max-width: 205px;
		margin: 5px auto;
    	}
    	.avatar-upload .avatar-edit {
    		position: absolute;
    		right: 12px;
    		z-index: 1;
    		top: 10px;
    	}
    	.avatar-upload .avatar-edit input {
    		display: none;
    	}
    	.avatar-upload .avatar-edit input + label {
    		display: inline-block;
    		width: 34px;
    		height: 34px;
    		margin-bottom: 0;
    		border-radius: 100%;
    		background: #FFFFFF;
    		border: 1px solid transparent;
    		box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
    		cursor: pointer;
    		font-weight: normal;
    		transition: all 0.2s ease-in-out;
    	}
    	.avatar-upload .avatar-edit input + label:hover {
    		background: #f1f1f1;
    		border-color: #d6d6d6;
    	}
    	.avatar-upload .avatar-edit input + label:after {
    		content: "\f040";
    		font-family: 'FontAwesome';
    		color: #000;
    		position: absolute;
    		top: 7px;
    		left: 0;
    		right: 0;
    		text-align: center;
    		margin: auto;
    	}
    	.avatar-upload .avatar-preview {
    		width: 100px;
    		height: 100px;
    		position: relative;
    		border-radius: 100%;
    		border: 6px solid #F8F8F8;
    		box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
    	}
    	.avatar-upload .avatar-preview > div {
    		width: 100%;
    		height: 100%;
    		border-radius: 100%;
    		background-size: cover;
    		background-repeat: no-repeat;
    		background-position: center;
    	}
      .page-header {
    margin: 0px 0 0px 0;
    font-size: 22px;
}
    

   </style>


<script>


    function deleteThisVital(id, name){
        if (confirm('Are you sure you want to delete '+name+'?')) {
             window.location.href = '?page=<?php echo $_GET['page']; ?>&tab=<?php echo $_GET['tab']; ?>&del='+id;
        }
    }




    function deleteThis(id){
        if (confirm('Are you sure you want to delete this?')) {
            window.location.href = window.location.href + '&del='+id;
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

error_reporting(E_ALL); ini_set('display_errors', 1);


$color = MYGREEN;


?>

<style>
  .nav-tabs>li>a {
        position: relative;
        display: block;
        padding: 5px 5px;
    }

  </style>
<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header" style="color: <?php echo $color; ?>">
                <i class="fa fa-globe"></i>
                Purchasing
                <small class="pull-right" style="margin-top: -5px; font-weight: bold;"><h4>Date: <?php echo date("Y").", ".date("F")." ".date("d"); ?></h4></small>
            </h2><br>
            <div class="pull-right" style="margin-top: -15px;">
                     
            </div>
        </div>

        <div class="row">
        <div class="col-xs-12 table-responsive">

         <!--   <div class="pull-right" style="">
                            <a href="?page=materials"><label class="btn btn-xs btn-info">back</label></a> 
                        </div><br> -->

         <!--  <table class="table table-striped">
            <thead>
            <tr>
              <th>Legend</th>
              <th>Value</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>Name</td>
              <td><?php echo $supply['name']; ?></td>
            </tr>
            <tr>
              <td>Description</td>
              <td><?php echo $supply['description']; ?></td>
            </tr>
            <tr>
              <td>Unit</td>
              <td><?php echo $supply['unit']; ?></td>
            </tr>
            <tr>
              <td>Reorder Level</td>
              <td><?php echo $supply['reorder_level']; ?></td>
            </tr>
            <tr>
              <td>Stocks</td>
              <td style="color: <?php echo $color; ?>; font-weight: bold;"><?php echo $stock; ?></td>
            </tr>
           
            </tbody>
          </table> -->
        </div>
        <!-- /.col -->
      </div>

        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
    <!-- Main content -->
    <section class="content">

      <div class="row">
       
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <?php if(isset($_GET['tab'])){ $tab=$_GET['tab']; }else{ $tab="requests"; } //echo $tab; ?>  
            <ul class="nav nav-tabs">

              <li class="<?php if($tab=="requests"){ echo "active"; } ?>"><a href="?page=<?php echo $_GET['page']; ?>&tab=requests" >Requests</a></li>
              <?php if(isset($_SESSION['acl']['orders'])):  ?> 
              <li class="<?php if($tab=="orders"){ echo "active"; } ?>"><a href="?page=<?php echo $_GET['page']; ?>&tab=orders" >Orders</a></li>
              <?php endif; ?>
                <?php if(isset($_SESSION['acl']['payments'])):  ?> 
               <li class="<?php if($tab=="payments"){ echo "active"; } ?>"><a href="?page=<?php echo $_GET['page']; ?>&tab=payments" >Payments</a></li>
               <?php endif; ?>
              </ul>

               
           </div>
              
             


              <!---------------------------------------------------->
              <!--------------------Requests Start------------------>
              <!---------------------------------------------------->
              <?php if($tab=="requests"){ ?>
              
              <div class="<?php if($tab=="st"){ echo "active"; } ?> tab-pane" id="">
              <div class="row">
              <div class="col-md-12">
                  
                  <div style="padding:7px; text-align: right;" class="pull-right">
                            <?php if(isset($_GET['received'])): ?>
                            <button id="btnrec" data-toggle="collapse" class="btn btn-xs btn-success" data-target="#demo">
                                + Add Stock
                            </button>
                          <?php endif; ?>
                        

                  </div>



                  <?php 

                    $response=array('action'=>"", 'message'=>"");
                    if(isset($_POST['btn_save'])){
                        
                       
                        $data = array('model'=>"materials_new",'keys'=>"material_id, dateinput, expiry, qty, datereceived");
                        //echo json_encode($_POST['manager']);
                        if(isset($_POST['id'])){
                            $data['values']="material_id = '".$_GET['id']."', 
                                             dateinput = '".date("Y-m-d H:i:s")."',
                                             expiry = '".date("Y-m-d H:i:s", strtotime($_POST['expiry']))."',
                                             qty = '".$_POST['qty']."',
                                             datereceived = '".date("Y-m-d H:i:s", strtotime($_POST['datereceived']))."'";
                            $data['condition'] = " WHERE id = '".$_POST['id']."'";
                            $response = $app->update2($data);

                        }else{
                            $date = date("Y")."-".date("m")."-".date("d");
                            
                            $data2 = array(
                                'model'=>'materials_new',
                                'keys'=>'material_id, dateinput, expiry, qty, datereceived',
                                'values'=>"'".$_GET['id']."', 
                                           '".date("Y-m-d H:i:s")."', 
                                           '".date("Y-m-d H:i:s", strtotime($_POST['expiry']))."',
                                           '".$_POST['qty']."',
                                           '".date("Y-m-d H:i:s", strtotime($_POST['datereceived']))."'"
                            );
                            $response = $app->create2($data2);
                            
                            $pup = array('model'=>"purchaserequest",
                                         'values'=>"stocked='1'",
                                         'condition'=>"WHERE id='".$_POST['received']."'");
                            $response = $app->update2($pup);
                           // echo "<script>location.href='?page=".$_GET['page']."&id=".$_GET['id']."&tab=".$_GET['tab']."';</script>";
                          
                        }

                    }
                  if($response['message']=="Successful"){

                    echo '<br><br><div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        Record Saved Successfully!
                      </div>';
                    }
                    if(isset($_GET['del'])){
                      $deldata = array("model"=>"purchaserequest", 'condition'=>" WHERE id = '".$_GET['del']."'");
                      $response = $app->delete2($deldata);
                       echo '<br><br><div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        Record Deleted Successfully!
                      </div>';

                    }

                  ?>



                <div id="demo" class="collapse box-body">
                    

                    <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <form method="POST" action="?page=<?php echo $_GET['page']; ?>&tab=<?php echo $_GET['tab']; ?>&id=<?php echo $_GET['id']; ?>">

                                <?php 

                                if(isset($_GET['received'])){
                                  $recv = $app->getPurchaseRequest("WHERE id = '".$_GET['received']."'");
                                  $recv=$recv[$_GET['received']];
                                  echo '<input type="hidden" name="received" value="'.$_GET['received'].'">';
                                }

                                ?>   

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Date Received:</label>
                                    <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right" name="datereceived" id="datepicker2" <?php if(isset($_GET['id'])){ echo "value='".date("m/d/Y")."'"; } ?> >
                                    </div>
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Expiry Date:</label>
                                    <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right" name="expiry" id="datepicker3" <?php if(isset($_GET['id'])){ echo "value='".date("m/d/Y")."'"; } ?> >
                                    </div>
                                </div>


                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Qty</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="number" class="form-control" placeholder="Quantity" name="qty" value='<?php echo $recv['qty']; ?>' required readonly/>
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; margin-top: 10px;">
                                   <input type="submit" name="btn_save" class="btn btn-success btn-sm">
                                </div>
                                </form>


                            </div>
                            <div class="col-sm-2"></div>
                        </div>


                </div>    
                <br><br>  
                  
                   <?php

                                $requests = $app->getPurchaseRequest("");
                                $state = $app->purchaseRequestStatus();
                                $supply = $app->getmaterials("");
                                ?>
                  <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th></th>
                                <th style="">Date Requested</th>
                                <th style="">Name</th>
                                <th style="">QTY</th>
                                <th style="">Status</th>
                                <!-- <th style="">Action</th> -->
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            //echo json_encode($presription)."<============";
                            $c=0; 
                             $cc=0; foreach ($requests as $rk => $rv): $cc++;
                             
                                ?>
                                <tr>
                                    <td><?php echo $cc; ?></td>
                                    <td><?php echo date("Y, F d", strtotime($rv['date'])); ?></td>
                                    <td><?php echo $supply[$rv['material_id']]['name']; ?></td>
                                    <td><?php echo $rv['qty']; ?></td>
                                    <td><?php 

                                  

                                    if($rv['status']==0) { $col = MYGOLD; }
                                    if($rv['status']==1) { $col = MYBLUE; }
                                    if($rv['status']==2) { $col = MYGREEN; }
                                    if($rv['status']==3) { $col = MYRED; }

                                    $str = "<label style='color:".$col.";'>".$state [$rv['status']]."</label>";
                                    echo $str;


                                    ?></td>
                                    <?php /*
                                   

                                    </td>*/ ?>
                         
                                </tr>
                            <?php  endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th style="">Date Requested</th>
                                <th style="">QTY</th>
                                <th style="">Status</th>
                                <!-- <th style="">Action</th> -->
                            </tr>
                            </tfoot>
                        </table>
                    </div>
              </div>
              </div>
              </div>
              
              <?php } ?>
              <!---------------------------------------------------->
              <!--------------------Requests End-------------------->
              <!---------------------------------------------------->






              <!---------------------------------------------------->
              <!----------------Orders Start------------------>
              <!---------------------------------------------------->
              <?php if($tab=="orders"){ ?>
              
              <div class="<?php if($tab=="pr"){ echo "active"; } ?> tab-pane" id="">
              <div class="row">
              <div class="col-md-12">
                  
                  <div style="padding:7px; text-align: right;" class="pull-right">
                            
                            <button data-toggle="collapse" class="btn btn-xs btn-success" data-target="#demo">
                                + Create Order
                            </button>
                        

                  </div>



                  <?php 

                    $response=array('action'=>"", 'message'=>"");
                    if(isset($_POST['btn_save'])){
                        
                        
                        $data = array('model'=>"ordered",'keys'=>"order_number, date, inclusives, status");
                        //echo json_encode($_POST['manager']);
                        if(isset($_POST['id'])){




                            $data['values']="status = '".$_POST['status']."'";
                            $data['condition'] = " WHERE id = '".$_POST['id']."'";
                            $response = $app->update2($data);

                            $current = $app->getOrdered("WHERE id = '".$_POST['id']."'");
                            $current = $current[$_POST['id']];

                            $drequests = json_decode($current['inclusives']);
                            if($_POST['status']==0){ $lstatus = 1; }
                            if($_POST['status']==1){ $lstatus = 2; }
                            if($_POST['status']==2){ $lstatus = 3; }
                            foreach($drequests as $dkk => $dvv){
                              $data = array("model"=>"purchaserequest");
                              $data['values']="status = '".$lstatus."'";
                              $data['condition'] = " WHERE id = '".$dvv."'";
                              $response = $app->update2($data);
                            }


                        }else{
                            $date = date("Y")."-".date("m")."-".date("d");
                            
                            $data2 = array(
                                'model'=>'ordered',
                                'keys'=>'order_number, date, inclusives, status',
                                'values'=>"'".$app->createOrderId()."', 
                                           '".date("Y-m-d H:i:s")."',
                                           '".json_encode($_POST['req_id'])."',
                                           '0'"
                            );
                            $response = $app->create2($data2);
                            $recz = $_POST['req_id'];
                            foreach($recz as $rrk => $rrv){
                              $dataru = array("model"=>"purchaserequest",
                                              "values"=>"status='1'",
                                              "condition"=>"WHERE id='".$rrv."'");
                              $response = $app->update2($dataru);
                            }
                            
                          
                        }

                    }
                  if($response['message']=="Successful"){

                    echo '<br><br><div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        Record Saved Successfully!
                      </div>';
                    }
                    if(isset($_GET['del'])){

                      $current = $app->getOrdered("WHERE id = '".$_GET['del']."'");
                      $current = $current[$_GET['del']];

                      $drequests = json_decode($current['inclusives']);

                      foreach($drequests as $dkk => $dvv){
                        $data = array("model"=>"purchaserequest");
                        $data['values']="status = '0'";
                        $data['condition'] = " WHERE id = '".$dvv."'";
                        $response = $app->update2($data);
                      }
                      $deldata = array("model"=>"ordered", 'condition'=>" WHERE id = '".$_GET['del']."'");
                      $response = $app->delete2($deldata);
                       echo '<br><br><div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        Record Deleted Successfully!
                      </div>';

                    }

                  ?>

                <?php 

                $state = $app->purchaseRequestStatus();
                $requests = $app->getPurchaseRequest();
                $state = $app->orderStatus();
                $materials = $app->getMaterials();
                if(isset($_GET['upt'])): 
                $current = $app->getOrdered("WHERE id = '".$_GET['upt']."'");
                $current = $current[$_GET['upt']];
                ?>


                  <div class="row">
                      <div class="col-sm-6">
                               <div class="row">
                                    <div class="col-sm-12">
                                        <form method="POST"  action="?page=<?php echo $_GET['page']; ?>&tab=<?php echo $_GET['tab']; ?>">
                                        <div class="form-group">
                                        <input type="hidden" name="id" value="<?php echo $_GET['upt']; ?>">
                                        <label>Status</label>
                                            <select class="form-control select2 select2-hidden-accessible"  data-placeholder="Select Status" name="status" id="status" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                                <?php
                                                 foreach ($state as $key => $value) {
                                                      $act="";
                                                     if($current['status']==$key){ $act="selected";}
                                                     echo "<option value='".$key."' ".$act.">".$value."</option>";
                                                 }
                                                ?>
                                            </select>   
                                        </div>
                                        <div class="form-group" style="margin-bottom: 0px; margin-top: 10px;">
                                           <input type="submit" name="btn_save" class="btn btn-success btn-sm">
                                           <a href="?page=<?php echo $_GET['page']; ?>&tab=<?php echo $_GET['tab']; ?>" class="btn btn-warning btn-sm">Cancel</a>
                                        </div>                                             
                                        </form>
                                    </div>
                                </div>
                      </div>
                           
                  </div>


                
                <?php endif; ?>  




                <div id="demo" class="collapse box-body">
             

                    <div class="row">
                            <div class="col-sm-6">
                               <div class="row">
                                    <div class="col-sm-12">
                                        <form method="POST"  action="?page=<?php echo $_GET['page']; ?>&tab=<?php echo $_GET['tab']; ?>">
                                        <div class="box-body table-responsive">
                                        <table id="example" class="table table-bordered table-striped">
                                            <thead style="background:#4DC7BC; color:#fff;">
                                            <tr>
                                                <th></th>
                                                <th style="">Name</th>
                                                <th style="">QTY</th>
                                                <th style="">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody id="theps">

                                            </tbody>
                                        </table>
                                        </div>    
                                        <div class="form-group" style="margin-bottom: 0px; margin-top: 15px;" id="btn_container">
                                           <!-- <input type="submit" name="btn_save" class="btn btn-success btn-sm"> -->
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                
                                 <?php

                                $requests = $app->getPurchaseRequest("WHERE status = '0'");
                                
                                $supply = $app->getmaterials("");
                                ?>
                  <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th></th>
                                <th style="">Date Requested</th>
                                <th style="">Name</th>
                                <th style="">QTY</th>
                                <th style="">Status</th>
                                <th style="">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            //echo json_encode($presription)."<============";
                            $c=0; 
                             $cc=0; foreach ($requests as $rk => $rv): $cc++;
                             
                                ?>
                                <tr>
                                    <td><?php echo $cc; ?></td>
                                    <td><?php echo date("Y, F d", strtotime($rv['date'])); ?></td>
                                    <td><?php echo $supply[$rv['material_id']]['name']; ?></td>
                                    <td><?php 

                                  

                                    if($rv['status']==0) { $col = MYGOLD; }
                                    if($rv['status']==1) { $col = MYBLUE; }
                                    if($rv['status']==2) { $col = MYGREEN; }
                                    if($rv['status']==3) { $col = MYRED; }

                                    $str = "<label style='color:".$col.";'>".$state [$rv['status']]."</label>";
                                    echo $str;


                                    ?></td>

                                    <td>
                                      <button class="btn btn-xs btn-success" onClick="addtoCart('<?php echo $rv['id']; ?>','<?php echo $supply[$rv['material_id']]['name']; ?>','<?php echo $rv['qty']; ?>');">
                                          + Add to Order
                                      </button>
                                    </td>  
                         
                                </tr>
                            <?php  endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th style="">Date Requested</th>
                                <th style="">Name</th>
                                <th style="">QTY</th>
                                <th style="">Status</th>
                                <th style="">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                            


                            </div>
                        </div>


                </div>    
                <br><br>  
                    <?php
                        $orders = $app->getOrdered("");
                        $state = $app->purchaseRequestStatus();
                        $requests = $app->getPurchaseRequest();
                        $state = $app->orderStatus();
                        $materials = $app->getMaterials();
                                ?>
                  <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th></th>
                                <th style="">Order Number</th>
                                <th style="">Date Ordered</th>
                                <th style="">Inclusives</th>
                                <th style="">Order Status</th>
                                <th style="">Paymenet Status</th>
                                <th style="">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            
                            //echo json_encode($presription)."<============";
                            $c=0; 
                             $cc=0; foreach ($orders as $rk => $rv): $cc++;
                                ?>
                                <tr style="font-weight: bold;">
                                    <td><?php echo $cc; ?></td>
                                    <td><?php echo $rv['order_number']; ?></td>
                                    <td><?php echo date("Y, F d", strtotime($rv['date'])); ?></td>
                                    <td><?php 

                                    $reds = json_decode($rv['inclusives']); 
                                    //echo json_encode($reds);
                                    foreach($reds as $krrr=> $vrrr){
                                      echo $materials[$requests[$vrrr]['material_id']]['name']." (".$requests[$vrrr]['qty']." ".$materials[$requests[$vrrr]['material_id']]['unit'].")<br>";
                                    }

                                    ?></td>
                                    <td><?php 

                                    if($rv['status']==0){
                                      $col = MYGOLD;
                                    }
                                    if($rv['status']==1){
                                      $col = MYGREEN;
                                    }
                                    if($rv['status']==2){
                                      $col = MYRED;
                                    }

                                    echo "<label style='color: ".$col.";'>".$state[$rv['status']]."</label>"; 


                                    ?></td>
                                    <td><?php 

                                    if($rv['pstatus']==0){
                                      $col = MYRED;
                                    }
                                    if($rv['pstatus']==1){
                                      $col = MYGREEN;
                                    }
                                    $ps = array(0=>"Unpaid", 1=>"Paid");
                                    echo "<label style='color: ".$col.";'>".$ps[$rv['pstatus']]."</label>"; 


                                    ?></td>

                                    <td>
                                    <?php if($_SESSION['acl']['orders-delete']==1 && $rv['status']==0): 

                                      ?>
                                   

                                     <label  class="btn btn-danger btn-xs" onClick="deleteThisVital('<?php echo $rv['id']; ?>','<?php echo $rv['order_number']; ?>')"><i class="fa fa-minus"></i> Delete</label>


                                    <?php endif; ?>   

                                    <?php if($_SESSION['acl']['orders-update']==1): 
                                      ?>
                                     <a  class="btn btn-warning btn-xs" href="?page=<?php echo $_GET['page']; ?>&tab=<?php echo $_GET['tab']; ?>&upt=<?php echo $rv['id'];  ?>"><i class="fa fa-plus"></i> Change Order Status</a>


                                    <?php endif; ?>   


                                    

                                    </td>
                         
                                </tr>
                            <?php  endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th style="">Order Number</th>
                                <th style="">Date Ordered</th>
                                <th style="">Inclusives</th>
                                <th style="">Order Status</th>
                                <th style="">Paymenet Status</th>
                                <th style="">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
              </div>
              </div>
              </div>
              
              <?php } ?>
              <!---------------------------------------------------->
              <!----------------Orders End-------------------->
              <!---------------------------------------------------->






              <!---------------------------------------------------->
              <!-----------------Payments Start------------------>
              <!---------------------------------------------------->
              <?php if($tab=="payments"){ ?>
              
              <div class="<?php if($tab=="payments"){ echo "active"; } ?> tab-pane" id="">
              <div class="row">
              <div class="col-md-12">
                  
                  <div style="padding:7px; text-align: right;" class="pull-right">
                            
                            <button data-toggle="collapse" class="btn btn-xs btn-success" data-target="#demo">
                                + Create Payment
                            </button>
                        

                  </div>



                  <?php 

                    $response=array('action'=>"", 'message'=>"");
                    if(isset($_POST['btn_save'])){
                        
                       
                        $data = array('model'=>"orderpayments",'keys'=>"patient_id, queuing_number, type, datetime, value");
                        //echo json_encode($_POST['manager']);
                        if(isset($_POST['id'])){
                            $data['values']="name = '".$_POST['name']."', 
                                             description = '".$_POST['description']."', 
                                             brands = '".json_encode($_POST['brands'])."',
                                             diseases = '".json_encode($_POST['diseases'])."',
                                             symptoms = '".json_encode($_POST['symptoms'])."'";
                            $data['condition'] = " WHERE id = '".$_POST['id']."'";
                            $response = $app->update2($data);

                        }else{
                            $date = date("Y")."-".date("m")."-".date("d");
                            $add1="";
                            $add2="";
                            if($_POST['type']==1){
                              $add1 = ", check_number, check_date, account_number, bank_name, bank_branch";
                              $add2 = ", '".$_POST['check_number']."', '".date("Y-m-d",strtotime($_POST['check_date']))."', '".$_POST['account_number']."', '".$_POST['bank_name']."', '".$_POST['bank_branch']."'";
                            }

                            $data2 = array(
                                'model'=>'orderpayments',
                                'keys'=>'order_id, payment_date, amount, type'.$add1,
                                'values'=>"'".$_POST['order_id']."', 
                                           '".date("Y-m-d",strtotime($_POST['payment_date']))."', 
                                           '".str_replace(",","",$_POST['amount'])."',
                                           '".$_POST['type']."'".$add2
                            );
                            $response = $app->create2($data2);
                            $dataO = array("model"=>"ordered");
                            $dataO['values']="pstatus = '1'";
                            $dataO['condition'] = " WHERE id = '".$_POST['order_id']."'";
                            $response = $app->update2($dataO);
                            
                          
                        }

                    }
                  if($response['message']=="Successful"){

                    echo '<br><br><div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        Record Saved Successfully!
                      </div>';
                    }
                    if(isset($_GET['del'])){

                            


                     $current = $app->getPayments("WHERE id = '".$_GET['del']."'");
                      $current = $current[$_GET['del']];


                      $dataO = array("model"=>"ordered");
                            $dataO['values']="pstatus = '0'";
                            $dataO['condition'] = " WHERE id = '".$current['order_id']."'";
                            $response = $app->update2($dataO);

                      $deldata = array("model"=>"orderpayments", 'condition'=>" WHERE id = '".$_GET['del']."'");
                      $response = $app->delete2($deldata);
                       echo '<br><br><div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        Record Deleted Successfully!
                      </div>';

                    }

                  ?>



                <div id="demo" class="collapse box-body">
             

                    <div class="row">
                            <div class="col-sm-6">
                                <form method="POST"  action="?page=<?php echo $_GET['page']; ?>&tab=<?php echo $_GET['tab']; ?>">
                               <div id="additionals_order">

                                </div> 

                                <div class="form-group">
                               
                                <label>Type</label>
                                    <select class="form-control" data-placeholder="Select Payment Type" name="type" style="width: 100%;" id="ptype" required>
                                        <option value="0">Cash</option>
                                        <option value="1">Check</option>
                                    </select>   
                                </div> 

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Payment Date:</label>
                                    <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right" name="payment_date" id="datepicker3" <?php echo "value='".date("m/d/Y")."'"; ?> >
                                    </div>
                                </div>


                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Amount</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Amount" name="amount"  required/>
                                </div>

                                <div id="additionals">

                                </div>  

                                <div class="form-group" style="margin-bottom: 0px; margin-top: 10px;" id="btnsss">
                                   
                                </div>
                                </form>


                            </div>
                            <div class="col-sm-6">
                               <?php
                        $orders = $app->getOrdered("WHERE pstatus = '0' AND status !='3' ");
                        $state = $app->purchaseRequestStatus();
                        $requests = $app->getPurchaseRequest();
                        $state = $app->orderStatus();
                        $materials = $app->getMaterials();
                                ?>
                  <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th></th>
                                <th style="">Order Number</th>
                                <th style="">Date Ordered</th>
                                <th style="">Inclusives</th>
                                <th style="">Status</th>
                                <th style="">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            
                            //echo json_encode($presription)."<============";
                            $c=0; 
                             $cc=0; foreach ($orders as $rk => $rv): $cc++;
                                ?>
                                <tr style="font-weight: bold;">
                                    <td><?php echo $cc; ?></td>
                                    <td><?php echo $rv['order_number']; ?></td>
                                    <td><?php echo date("Y, F d", strtotime($rv['date'])); ?></td>
                                    <td><?php 

                                    $reds = json_decode($rv['inclusives']); 
                                    //echo json_encode($reds);
                                    foreach($reds as $krrr=> $vrrr){
                                      echo $materials[$requests[$vrrr]['material_id']]['name']." (".$requests[$vrrr]['qty']." ".$materials[$requests[$vrrr]['material_id']]['unit'].")<br>";
                                    }

                                    ?></td>
                                    <td><?php 

                                    if($rv['status']==0){
                                      $col = MYGOLD;
                                    }
                                    if($rv['status']==1){
                                      $col = MYGREEN;
                                    }
                                    if($rv['status']==2){
                                      $col = MYRED;
                                    }

                                    echo "<label style='color: ".$col.";'>".$state[$rv['status']]."</label>"; 


                                    ?></td>
                                    <td>
                                 
                                   

                                     <label  class="btn btn-success btn-xs" onClick="selectThis('<?php echo $rv['id']; ?>','<?php echo $rv['order_number']; ?>')"><i class="fa fa-minus"></i> Select</label>

                                    

                                    </td>
                         
                                </tr>
                            <?php  endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th style="">Order Number</th>
                                <th style="">Date Ordered</th>
                                <th style="">Inclusives</th>
                                <th style="">Status</th>
                                <th style="">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                            </div>
                        </div>


                </div>    
                <br><br>  
                  
                  <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th></th>
                                <th style="">Order Number</th>
                                <th style="">Payment Date</th>
                                <th style="">Type</th>
                                <th style="">Amount</th>
                                <th style="">Account Number</th>
                                <th style="">Bank Name</th>
                                <th style="">Branch Name</th>
                                <th style="">Check Number</th>
                                <th style="">Check Date</th>
                                <th style="">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $pstate = $app->paymentStatus();
                            $payments = $app->getPayments();
                            $orders = $app->getOrdered("");
                            $ptype = array(0=>"Cash",1=>"Check");
                            $c=0; foreach ($payments as $key => $value): $c++;
                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo $orders[$value['order_id']]['order_number']; ?></td>
                                    <td><?php echo date("M jS, Y", strtotime($value['payment_date'])); ?></td>
                                    <td><?php echo $ptype[$value['type']]; ?></td>
                                    <td><?php echo number_format($value['amount'],2); ?></td>
                                    <td><?php echo $value['account_number']; ?></td>
                                    <td><?php echo $value['bank_name']; ?></td>
                                    <td><?php echo $value['bank_branch']; ?></td>
                                    <td><?php echo $value['check_number']; ?></td>
                                    <td><?php 
                                    if($value['type']==1){
                                    echo date("M jS, Y", strtotime($value['check_date'])); 
                                    }?></td>
                                    <td>
                                    <?php if($_SESSION['acl']['payments-delete']==1): 

                                      $over = str_replace("/"," ",number_format($value['amount'],2));
                                      ?>
                                   

                                     <label  class="btn btn-danger btn-xs" onClick="deleteThisVital('<?php echo $value['id']; ?>','Payment for <?php echo $orders[$value['order_id']]['order_number']." (".$over.")"; ?>')"><i class="fa fa-minus"></i> Delete</label>


                                    <?php endif; ?>    

                                    </td>
                         
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th style="">Order Number</th>
                                <th style="">Payment Date</th>
                                <th style="">Type</th>
                                <th style="">Amount</th>
                                <th style="">Account Number</th>
                                <th style="">Bank Name</th>
                                <th style="">Branch Name</th>
                                <th style="">Check Number</th>
                                <th style="">Check Date</th>
                                <th style="">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
              </div>
              </div>
              </div>
              
              <?php } ?>
              <!---------------------------------------------------->
              <!-----------------Payments End-------------------->
              <!---------------------------------------------------->



              
              
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
        
    </div>
    <!-- /.row -->
    
    

    

</section>
<!-- /.content -->

<script>



function addtoCart(id, name, qty){
  var a = document.getElementById("reqid_"+id);
  if(a){
    alert("Already exist on cart");
  }else{
    var thebtn = '<input type="submit" name="btn_save" id="rbtn" class="btn btn-success btn-sm">';
    var rowCount = $('#datadable tr').length;
    var newNumber = rowCount+1;
    var html = "";
    html += "<tr id='reqid_"+id+"' class='specific-class'>";
      html += "<td style='text-align: center;'>";
        html += newNumber;
      html += "</td>"; 
      html += "<td>";
        html += "<input type='hidden' name='req_id[]' value='"+id+"'>";
        html += name;
      html += "</td>"; 
      html += "<td style='text-align: center;'>";
        html += qty;
      html += "</td>"; 
      html += "<td style='text-align: center;'>";
        html += "<button class=\"btn btn-xs btn-danger\" onclick=\"removeme('reqid_"+id+"');\">- remove</button>";
      html += "</td>"; 
    html += "</tr>";

    $("#theps").append(html);

      $("#btn_container").html(thebtn);

    }
}

function removeme(id){
  $("#"+id).remove();
  var ccp = $('.specific-class').length;
   
  if(ccp){

  }else{
      $("#rbtn").remove();
  }
}

function selectThis(id, name){
  var ccp = $('#selected_order').length;
    var html = ""; 
    html += '<div class="form-group" style="margin-bottom: 0px; ">';
        html += '<label>Order Number</label>';
        html += '<input type="hidden" value="'+id+'" class="form-control" placeholder="Order Number" name="order_id" readonly required/>';
         html += '<input type="text" value="'+name+'" class="form-control" placeholder="Order Number" name="order_number" readonly required/>';
    html += '</div>';   
    $("#additionals_order").empty();
    $("#additionals_order").html(html);
    $("#btnsss").html('<input type="submit" name="btn_save" class="btn btn-success btn-sm">');
}



$("#ptype").change(function(){
  $("#additionals").empty();

  if($(this).val()==1){ //alert($(this).val());
  var html = ""; 
    html += '<div class="form-group" style="margin-bottom: 0px; ">';
        html += '<label>Bank Name</label>';
        html += '<input type="text" class="form-control" placeholder="Bank Name" name="bank_name"  required/>';
    html += '</div>';   
    html += '<div class="form-group" style="margin-bottom: 0px; ">';
        html += '<label>Account Number</label>';
        html += '<input type="text" class="form-control" placeholder="Account Number" name="account_number" required/>';
    html += '</div>'; 
    html += '<div class="form-group" style="margin-bottom: 0px; ">';
        html += '<label>Bank Branch</label>';
        html += '<input type="text" class="form-control" placeholder="Bank Branch" name="bank_branch"  required/>';
    html += '</div>'; 
    html += '<div class="form-group" style="margin-bottom: 0px; ">';
        html += '<label>Check Number</label>';
        html += '<input type="text" class="form-control" placeholder="Check Number" name="check_number" required/>';
    html += '</div>'; 
    html +='<div class="form-group" style="margin-bottom: 0px; ">';
      html +=  '<label>Payment Date:</label>';
        html +=  '<div class="input-group date">';
          html +=  '<div class="input-group-addon">';
            html +=  '<i class="fa fa-calendar"></i>';
          html +=  '</div>';
          html +=  '<input type="text" class="form-control pull-right" name="check_date " id="datepicker1" value="<?php echo date("m/d/Y"); ?>" >';
      html +=  '</div>';
    html +=  '</div>';
     //alert(html);
    $("#additionals").html(html);
  }

});



<?php if(isset($_GET['received'])): ?>

  
  $("document").ready(function() {
    setTimeout(function() {
        $("#btnrec").click();
    },100);
});

<?php endif; ?>  

</script>