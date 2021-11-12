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
             window.location.href = '?page=<?php echo $_GET['page']; ?>&id=<?php echo $_GET['id']; ?>&tab=<?php echo $_GET['tab']; ?>&del='+id;
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






$response['message']="";
$data =array("model"=>"employee");

$errori = 0;
if(isset($_POST['photo_up'])){
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check === false) {
            $errori = "File is not an image.";;
        } 
    
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $errori =  "Sorry, your file is too large.";
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $errori = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
        $target_file = $target_dir. $app->RandomString(50).".".$imageFileType;
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
             $data['values']="image = '".$target_file."'";                
        $data['condition'] = " WHERE id = '".$_GET['id']."'";
        $response = $app->update2($data);
        } else {
            $errori = "Sorry, there was an error uploading your file.";
        }
    
}





$department = $app->getDepartments();
$supply = $app->getmaterials("WHERE id = '".$_GET['id']."'");
$supply = $supply[$_GET['id']];

$received = $app->getmaterialsNew("WHERE material_id = '".$_GET['id']."'");
//$received = $received[$_GET['id']];
//echo json_encode($received);
$AlltoalMaterials = 0;
$allconsumed = $supply['qty'];
foreach($received as $k => $v){
  $AlltoalMaterials = $AlltoalMaterials + $v['qty'];
}
$stock = $AlltoalMaterials - $allconsumed;

$todanger_range =  $supply['reorder_level'] + 10;

//echo json_encode($supply);
$color = MYGREEN;

if($stock > $supply['reorder_level'] && $stock <=$todanger_range){
  $color = MYGOLD;
}
if($stock <= $supply['reorder_level']){
  $color = MYRED;
}

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
                <?php
                 echo strtoupper($supply['name']);
                ?> (Supply Details)
                <small class="pull-right" style="margin-top: -5px; font-weight: bold;"><h4>Date: <?php echo date("Y").", ".date("F")." ".date("d"); ?></h4></small>
            </h2><br>
            <div class="pull-right" style="margin-top: -15px;">
                     
            </div>
        </div>

        <div class="row">
        <div class="col-xs-12 table-responsive">

           <div class="pull-right" style="">
                            <a href="?page=materials"><label class="btn btn-xs btn-info">back</label></a> 
                        </div><br>

          <table class="table table-striped">
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
          </table>
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
            <?php if(isset($_GET['tab'])){ $tab=$_GET['tab']; }else{ $tab="st"; } //echo $tab; ?>  
            <ul class="nav nav-tabs">
              <li class="<?php if($tab=="st"){ echo "active"; } ?>"><a href="?page=<?php echo $_GET['page']; ?>&id=<?php echo $_GET['id']; ?>&tab=st" >Received</a></li>

              <li class="<?php if($tab=="pr"){ echo "active"; } ?>"><a href="?page=<?php echo $_GET['page']; ?>&id=<?php echo $_GET['id']; ?>&tab=pr" >Request Purchase</a></li>

            
              </ul>

               
           </div>
              
             


              <!---------------------------------------------------->
              <!--------------------Symptoms Start------------------>
              <!---------------------------------------------------->
              <?php if($tab=="st"){ ?>
              
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
                      $deldata = array("model"=>"materials_new", 'condition'=>" WHERE id = '".$_GET['del']."'");
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
                  
                  <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th></th>
                                <th style="">Date Received</th>
                                <th style="">Expiry Date</th>
                                <th style="">Qty</th>
                                <!-- <th style="">Action</th> -->
                            </tr>
                            </thead>
                            <tbody>
                            <?php 

                            $mySymptoms = $app->getMaterialsNew("WHERE material_id = '".$_GET['id']."'");
                            $c=0; foreach ($mySymptoms as $key => $value): $c++;
                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo date("Y, F d",strtotime($value['datereceived'])); ?></td>
                                    <td><?php echo date("Y, F d",strtotime($value['expiry'])); ?></td>
                                    <td><?php echo $value['qty']; ?></td>
                                    <?php /*
                                    <td>
                                    <?php if($_SESSION['acl']['symptoms-delete']==1): 

                                      $over = $value['days']." day(s)";
                                      ?>
                                   

                                     <label  class="btn btn-danger btn-xs" onClick="deleteThisVital('<?php echo $value['id']; ?>','<?php echo $symptoms[$value['symptom_id']]['name']." (".$over.")"; ?>')"><i class="fa fa-minus"></i> Delete</label>


                                    <?php endif; ?>    

                                    </td> */ ?>
                         
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th style="">Date Received</th>
                                <th style="">Expiry Date</th>
                                <th style="">Qty</th>
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
              <!--------------------Symptoms End-------------------->
              <!---------------------------------------------------->






              <!---------------------------------------------------->
              <!----------------Prescription Start------------------>
              <!---------------------------------------------------->
              <?php if($tab=="pr"){ ?>
              
              <div class="<?php if($tab=="pr"){ echo "active"; } ?> tab-pane" id="">
              <div class="row">
              <div class="col-md-12">
                  
                  <div style="padding:7px; text-align: right;" class="pull-right">
                            
                            <button data-toggle="collapse" class="btn btn-xs btn-success" data-target="#demo">
                                + Request Purchase
                            </button>
                        

                  </div>



                  <?php 

                    $response=array('action'=>"", 'message'=>"");
                    if(isset($_POST['btn_save'])){
                        
                       
                        $data = array('model'=>"purchaserequest",'keys'=>"material_id, qty, status, date");
                        //echo json_encode($_POST['manager']);
                        if(isset($_POST['id'])){
                            $data['values']="material_id = '".$_GET['id']."', 
                                             qty = '".$_POST['qty']."',
                                             status = '0',
                                             date = '".date("Y-m-d H:i:s")."'";
                            $data['condition'] = " WHERE id = '".$_POST['id']."'";
                            $response = $app->update2($data);

                        }else{
                            $date = date("Y")."-".date("m")."-".date("d");
                            
                            $data2 = array(
                                'model'=>'purchaserequest',
                                'keys'=>'material_id, qty, status, date',
                                'values'=>"'".$_GET['id']."', 
                                           '".$_POST['qty']."',
                                           '0',
                                           '".date("Y-m-d H:i:s")."'"
                            );
                            $response = $app->create2($data2);
                            
                          
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
                            <div class="col-sm-6">
                                <form method="POST" action="?page=<?php echo $_GET['page']; ?>&tab=<?php echo $_GET['tab']; ?>&id=<?php echo $_GET['id']; ?>">
                                
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Quantity</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Quantity" name="qty" required />
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; margin-top: 10px;">
                                   <input type="submit" name="btn_save" class="btn btn-success btn-sm">
                                </div>
                                </form>
                            </div>
                            <div class="col-sm-6">
                              
                              <?php

                                $requests = $app->getPurchaseRequest("WHERE material_id = '".$_GET['id']."'");
                                $state = $app->purchaseRequestStatus();
                                ?>


                            </div>
                        </div>


                </div>    
                <br><br>  
                  
                  <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th></th>
                                <th style="">Date Requested</th>
                                <th style="">QTY</th>
                                <th style="">Status</th>
                                <th style="">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $presription = $app->getPrescription("WHERE patient_id = '".$_GET['id']."'");
                            //echo json_encode($presription)."<============";
                            $c=0; 
                             $cc=0; foreach ($requests as $rk => $rv): $cc++;
                                ?>
                                <tr>
                                    <td><?php echo $cc; ?></td>
                                    <td><?php echo date("Y, F d", strtotime($rv['date'])); ?></td>
                                    <td><?php echo $rv['qty']; ?></td>
                                    <td><?php 

                                    echo $state [$rv['status']]; 

                                    if($rv['stocked']==1) {
                                      $str = "<label style='color:".MYBLUE.";'>Added on stock</label>";
                                    }else{
                                      $str = "<label style='color:".MYRED.";'>Ready to add on stock</label>";
                                    }

                                    if($rv['status']==2){ echo " (".$str.")"; }


                                    ?></td>
                                    <td>
                                    <?php if($_SESSION['acl']['purchaserequest-delete']==1 && $rv['status']==0): 

                                      $over = $rv['qty']." ".$supply['unit'];
                                      ?>
                                   

                                     <label  class="btn btn-danger btn-xs" onClick="deleteThisVital('<?php echo $rv['id']; ?>','<?php echo date("Y, F d", strtotime($rv['date']))." (".$over.")"; ?>')"><i class="fa fa-minus"></i> Delete</label>


                                    <?php endif; ?>   

                                    <?php if($_SESSION['acl']['materials-stock']==1 && $rv['status']==2 && $rv['stocked']==0): 

                                      ?>
                                   

                                     <a class="btn btn-success btn-xs" href="?page=<?php echo $_GET['page']; ?>&id=<?php echo $_GET['id']; ?>&tab=st&received=<?php echo $rv['id'];  ?>"><i class="fa fa-plus"></i> Add to Stock</a>


                                    <?php endif; ?>   


                                    

                                    </td>
                         
                                </tr>
                            <?php  endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th style="">Date Requested</th>
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
              
              <?php } ?>
              <!---------------------------------------------------->
              <!----------------Prescription End-------------------->
              <!---------------------------------------------------->






              <!---------------------------------------------------->
              <!-----------------Vital Signs Start------------------>
              <!---------------------------------------------------->
              <?php if($tab=="vs"){ ?>
              
              <div class="<?php if($tab=="vs"){ echo "active"; } ?> tab-pane" id="">
              <div class="row">
              <div class="col-md-12">
                  
                  <div style="padding:7px; text-align: right;" class="pull-right">
                            
                            <button data-toggle="collapse" class="btn btn-xs btn-success" data-target="#demo">
                                + New Vital Signs
                            </button>
                        

                  </div>



                  <?php 

                    $response=array('action'=>"", 'message'=>"");
                    if(isset($_POST['btn_save'])){
                        
                       
                        $data = array('model'=>"vitalsigns",'keys'=>"patient_id, queuing_number, type, datetime, value");
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
                            
                            $data2 = array(
                                'model'=>'vitalsigns',
                                'keys'=>'patient_id, queuing_number, type, datetime, value',
                                'values'=>"'".$_GET['id']."', 
                                           '".$_GET['qn']."', 
                                           '".$_POST['type']."',
                                           '".date("Y-m-d H:i:s")."',
                                           '".$_POST['value']."'"
                            );
                            $response = $app->create2($data2);
                            
                          
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
                      $deldata = array("model"=>"vitalsigns", 'condition'=>" WHERE id = '".$_GET['del']."'");
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
                                <form method="POST"  action="?page=<?php echo $_GET['page']; ?>&qn=<?php echo $_GET['qn']; ?>&tab=<?php echo $_GET['tab']; ?>&id=<?php echo $_GET['id']; ?>">
                                <div class="form-group" style="margin-bottom: 0px; ">

                                    <?php if(isset($_GET['vid'])): ?>
                                        <input type="hidden" class="form-control" name="vid" value="<?php echo $_GET['vid']; ?>" required />
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                  <?php $vitalTypes = $app->getVitalTypes();
                                  // echo json_encode($vitalTypes); ?>
                                <label>Type</label>
                                    <select class="form-control" data-placeholder="Select Vital Sign" name="type" style="width: 100%;"  required>
                                        <?php
                                         
                                         foreach ($vitalTypes as $key => $value) { $act="";
                                             if(isset($_GET['vid']) && $_GET['vid']==$key){  $act="selected"; }
                                             echo "<option value='".$key."' ".$act.">".$value."</option>";
                                         }
                                        ?>
                                    </select>   
                                </div> 

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Value</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Value" name="value" <?php if(isset($_GET['vid'])){ echo "value='".$rvalue['value']."'"; } ?> required />
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
                  
                  <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th></th>
                                <th style="">Type</th>
                                <th style="">Value</th>
                                <th style="">Date</th>
                                <th style="">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $vsigns = $app->getVitalSigns("WHERE patient_id = '".$_GET['id']."'");
                            //echo json_encode($vsigns);
                            $c=0; foreach ($vsigns as $key => $value): $c++;
                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo $vitalTypes[$value['type']]; ?></td>
                                    <td><?php echo $value['value']; ?></td>
                                    <td><?php echo date("M jS, Y", strtotime($value['datetime'])); ?></td>
                                    <td>
                                    <?php if($_SESSION['acl']['vital-delete']==1): 

                                      $over = str_replace("/"," over ",$value['value']);
                                      ?>
                                   

                                     <label  class="btn btn-danger btn-xs" onClick="deleteThisVital('<?php echo $value['id']; ?>','<?php echo $vitalTypes[$value['type']]." ( ".$over.")"; ?>')"><i class="fa fa-minus"></i> Delete</label>


                                    <?php endif; ?>    

                                    </td>
                         
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th style="">Type</th>
                                <th style="">Value</th>
                                <th style="">Date</th>
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
              <!-----------------Vital Signs End-------------------->
              <!---------------------------------------------------->





              <!---------------------------------------------------->
              <!-------------------Start Disease-------------------->
              <!---------------------------------------------------->
              <?php if($tab=="ds"){ ?>
              
              <div class="<?php if($tab=="ds"){ echo "active"; } ?> tab-pane" id="">
              <div class="row">
              <div class="col-md-12">
                  
                  <div style="padding:7px; text-align: right;" class="pull-right">
                            
                            <button data-toggle="collapse" class="btn btn-xs btn-success" data-target="#demo">
                                + New Disease
                            </button>
                        

                  </div>

                  <?php 

                    $response=array('action'=>"", 'message'=>"");
                    if(isset($_POST['btn_save'])){
                        
                       
                        $data = array('model'=>"patient_disease",'keys'=>"patient_id, queuing_number, disease_id, datetime");
                        //echo json_encode($_POST['manager']);
                     
                            $date = date("Y")."-".date("m")."-".date("d");
                            
                            $data2 = array(
                                'model'=>'patient_disease',
                                'keys'=>"patient_id, queuing_number, disease_id, datetime",
                                'values'=>"'".$_GET['id']."', 
                                           '".$_GET['qn']."', 
                                           '".$_POST['disease_id']."',
                                           '".date("Y-m-d H:i:s")."'"
                            );
                            $response = $app->create2($data2);
                            
                         

                    }
                  if($response['message']=="Successful"){

                    echo '<br><br><div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        Record Saved Successfully!
                      </div>';
                    }
                    if(isset($_GET['del'])){
                      $deldata = array("model"=>"patient_disease", 'condition'=>" WHERE id = '".$_GET['del']."'");
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
                                <form method="POST"  action="?page=<?php echo $_GET['page']; ?>&qn=<?php echo $_GET['qn']; ?>&tab=<?php echo $_GET['tab']; ?>&id=<?php echo $_GET['id']; ?>">
                                 <div class="form-group">
                                   <?php $diseases = $app->getDiseases(); ?>
                                    <label>Disease</label>
                                    <select class="form-control select2 select2-hidden-accessible" id="disease_id" name="disease_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                      <?php foreach($diseases as $k=> $v){
                                        echo '<option value="'.$k.'" >'.$v['name'].'</option>';
                                      } ?>
                                     
                                    </select>
                                </div>

                                <div class="form-group" style="">
                                    <label>Date</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                     <input type="text" class="form-control pull-right" name="datetime" id="datepicker" value='<?php echo date("m/d/Y"); ?>' >
                                </div>
                                <br>
                                <div class="form-group" style="margin-bottom: 0px; margin-top: 15px;">
                                   <input type="submit" name="btn_save" class="btn btn-success btn-sm">
                                </div>
                                </form>


                            </div>
                            <div class="col-sm-2"></div>
                        </div>


                </div>    
                <br><br> 

                  
                  <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th></th>
                                <th style="">Illness/Disease</th>
                                <th style="">Date</th>
                                <th style="">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $pdisease = $app->getPatientDisease("WHERE patient_id = '".$_GET['id']."'");
                            $c=0; foreach ($pdisease as $key => $value): $c++;
                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo $diseases[$value['disease_id']]['name']; ?></td>
                                    <td><?php echo date("M jS, Y", strtotime($value['datetime'])); ?></td>
                                    <td>
                                    <?php if($_SESSION['acl']['patients-disease-delete']==1): ?>
                                     <label  class="btn btn-danger btn-xs" onClick="deleteThisVital('<?php echo $value['id']; ?>','<?php echo $diseases[$value['disease_id']]['name']." ( ".date("M jS, Y", strtotime($value['datetime'])).")"; ?>')"><i class="fa fa-minus"></i> Delete</label>
                                    <?php endif; ?>    
                                    </td>
                         
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th style="">Illness/Disease</th>
                                <th style="">Date</th>
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
              <!---------------------End Disease-------------------->
              <!---------------------------------------------------->




              <!---------------------------------------------------->
              <!-------------------Start Operation------------------>
              <!---------------------------------------------------->
              <?php if($tab=="op"){ ?>
              
              <div class="<?php if($tab=="op"){ echo "active"; } ?> tab-pane" id="">
              <div class="row">
              <div class="col-md-12">
                  
                  <div style="padding:7px; text-align: right;" class="pull-right">
                            
                            <button data-toggle="collapse" class="btn btn-xs btn-success" data-target="#demo">
                                + New Operation
                            </button>
                        

                  </div>

                  <?php 

                    $response=array('action'=>"", 'message'=>"");
                    if(isset($_POST['btn_save'])){
                        
                       
                        $data = array('model'=>"patient_operations",'keys'=>"patient_id, queuing_number, operation_id, datetime");
                        //echo json_encode($_POST['manager']);
                     
                            $date = date("Y")."-".date("m")."-".date("d");
                            
                            $data2 = array(
                                'model'=>'patient_operations',
                                'keys'=>"patient_id, queuing_number, operation_id, datetime",
                                'values'=>"'".$_GET['id']."', 
                                           '".$_GET['qn']."', 
                                           '".$_POST['operation_id']."',
                                           '".date("Y-m-d H:i:s")."'"
                            );
                            $response = $app->create2($data2);
                            
                         

                    }
                  if($response['message']=="Successful"){

                    echo '<br><br><div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        Record Saved Successfully!
                      </div>';
                    }
                    if(isset($_GET['del'])){
                      $deldata = array("model"=>"patient_operations", 'condition'=>" WHERE id = '".$_GET['del']."'");
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
                                <form method="POST"  action="?page=<?php echo $_GET['page']; ?>&qn=<?php echo $_GET['qn']; ?>&tab=<?php echo $_GET['tab']; ?>&id=<?php echo $_GET['id']; ?>">
                                 <div class="form-group">
                                   <?php $operations = $app->getOperations(); ?>
                                    <label>Disease</label>
                                    <select class="form-control select2 select2-hidden-accessible" id="operation_id" name="operation_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                      <?php foreach($operations as $k=> $v){
                                        echo '<option value="'.$k.'" >'.$v['name'].'</option>';
                                      } ?>
                                     
                                    </select>
                                </div>

                                <div class="form-group" style="">
                                    <label>Date</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                     <input type="text" class="form-control pull-right" name="datetime" id="datepicker" value='<?php echo date("m/d/Y"); ?>' >
                                </div>
                                <br>
                                <div class="form-group" style="margin-bottom: 0px; margin-top: 15px;">
                                   <input type="submit" name="btn_save" class="btn btn-success btn-sm">
                                </div>
                                </form>


                            </div>
                            <div class="col-sm-2"></div>
                        </div>


                </div>    
                <br><br> 

                  
                  <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th></th>
                                <th style="">Operation/Surgery</th>
                                <th style="">Date</th>
                                <th style="">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $pdisease = $app->getPatientOperations("WHERE patient_id = '".$_GET['id']."'");
                            $c=0; foreach ($pdisease as $key => $value): $c++;
                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo $operations[$value['operation_id']]['name']; ?></td>
                                    <td><?php echo date("M jS, Y", strtotime($value['datetime'])); ?></td>
                                    <td>
                                    <?php if($_SESSION['acl']['patients-disease-delete']==1): ?>
                                     <label  class="btn btn-danger btn-xs" onClick="deleteThisVital('<?php echo $value['id']; ?>','<?php echo $operations[$value['operation_id']]['name']." ( ".date("M jS, Y", strtotime($value['datetime'])).")"; ?>')"><i class="fa fa-minus"></i> Delete</label>
                                    <?php endif; ?>    
                                    </td>
                         
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th style="">Illness/Disease</th>
                                <th style="">Date</th>
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
              <!-------------------End Operation-------------------->
              <!---------------------------------------------------->
              
              



              <!---------------------------------------------------->
              <!-------------------Start Operation------------------>
              <!---------------------------------------------------->
              <?php if($tab=="lr"){ ?>
              
              <div class="<?php if($tab=="lr"){ echo "active"; } ?> tab-pane" id="">
              <div class="row">
              <div class="col-md-12">
                  
                  <div style="padding:7px; text-align: right;" class="pull-right">
                           <!--  
                            <button data-toggle="collapse" class="btn btn-xs btn-success" data-target="#demo">
                                + New Operation
                            </button> -->
                        

                  </div>

                  <?php 

                    $response=array('action'=>"", 'message'=>"");
                    if(isset($_POST['btn_save'])){
                        
                       
                        $data = array('model'=>"patient_operations",'keys'=>"patient_id, queuing_number, operation_id, datetime");
                        //echo json_encode($_POST['manager']);
                     
                            $date = date("Y")."-".date("m")."-".date("d");
                            
                            $data2 = array(
                                'model'=>'patient_operations',
                                'keys'=>"patient_id, queuing_number, operation_id, datetime",
                                'values'=>"'".$_GET['id']."', 
                                           '".$_GET['qn']."', 
                                           '".$_POST['operation_id']."',
                                           '".date("Y-m-d H:i:s")."'"
                            );
                            $response = $app->create2($data2);
                            
                         

                    }
                  if($response['message']=="Successful"){

                    echo '<br><br><div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        Record Saved Successfully!
                      </div>';
                    }
                    if(isset($_GET['del'])){
                      $deldata = array("model"=>"patient_operations", 'condition'=>" WHERE id = '".$_GET['del']."'");
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
                                <form method="POST"  action="?page=<?php echo $_GET['page']; ?>&qn=<?php echo $_GET['qn']; ?>&tab=<?php echo $_GET['tab']; ?>&id=<?php echo $_GET['id']; ?>">
                                 <div class="form-group">
                                   <?php $operations = $app->getOperations(); ?>
                                    <label>Disease</label>
                                    <select class="form-control select2 select2-hidden-accessible" id="operation_id" name="operation_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                      <?php foreach($operations as $k=> $v){
                                        echo '<option value="'.$k.'" >'.$v['name'].'</option>';
                                      } ?>
                                     
                                    </select>
                                </div>

                                <div class="form-group" style="">
                                    <label>Date</label>
                                    <!-- <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                                     <input type="text" class="form-control pull-right" name="datetime" id="datepicker" value='<?php echo date("m/d/Y"); ?>' >
                                </div>
                                <br>
                                <div class="form-group" style="margin-bottom: 0px; margin-top: 15px;">
                                   <input type="submit" name="btn_save" class="btn btn-success btn-sm">
                                </div>
                                </form>


                            </div>
                            <div class="col-sm-2"></div>
                        </div>


                </div>    
                <br><br> 

                  
                  <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th></th>
                                <th style="">Operation/Surgery</th>
                                <th style="">Date</th>
                                <th style="">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $pdisease = $app->getPatientOperations("WHERE patient_id = '".$_GET['id']."'");
                            $c=0; foreach ($pdisease as $key => $value): $c++;
                                /*
                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo $operations[$value['operation_id']]['name']; ?></td>
                                    <td><?php echo date("M jS, Y", strtotime($value['datetime'])); ?></td>
                                    <td>
                                    <?php if($_SESSION['acl']['patients-disease-delete']==1): ?>
                                     <label  class="btn btn-danger btn-xs" onClick="deleteThisVital('<?php echo $value['id']; ?>','<?php echo $operations[$value['operation_id']]['name']." ( ".date("M jS, Y", strtotime($value['datetime'])).")"; ?>')"><i class="fa fa-minus"></i> Delete</label>
                                    <?php endif; ?>    
                                    </td>
                         
                                </tr>
                            <?php */ endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th style="">Illness/Disease</th>
                                <th style="">Date</th>
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
              <!-------------------End Operation-------------------->
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

<?php if(isset($_GET['received'])): ?>

  
  $("document").ready(function() {
    setTimeout(function() {
        $("#btnrec").click();
    },100);
});

<?php endif; ?>  

</script>