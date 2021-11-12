
<script>


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
$response['message']="";

if(isset($_GET['del'])){

    $data = array('model'=>'methodrates', 'condition'=>" WHERE id = '".$_GET['del']."'");
    $response = $app->delete2($data);
}


$data = array("model"=>"paymentmethods", "condition"=>" WHERE id = '".$_GET['id']."'");
$projects=$app->getRecord2($data);
$department = $projects['data'][0];
$eawards = json_decode($department['employee_id']);
$rates = $app->getrates("WHERE method_id =  '".$_GET['id']."'");


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
                 echo strtoupper($department['name'])." (Payment Method)";
                ?>
                <small class="pull-right">Date: <?php echo date("Y")."-".date("m")."-".date("d"); ?></small>
            </h2>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
   
    <!-- /.row -->

    <!-- Table row -->



    <br>

    <div class="row">

        <div class="col-md-12">


            <br>
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
                    <div class="box-header">
                        <h4 class="" style="font-weight: bold;">
                           

                            </select> </h4>

                        <div style="padding:7px; text-align: right;" class="pull-right">
                        <?php if($_SESSION['acl']['rate-create']==1): ?>
                            <a href="?page=rate-create&mid=<?php echo $_GET['id']; ?>">
                                <button class="btn btn-success btn-xs"><i class="fa fa-file-text-o"></i> Add Rate</button>
                            </a>
                        <?php endif; ?>    

                        </div>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th style="width:auto;"></th>
                                <th >Range From</th>
                                <th >Range To</th>
                                <th >Fee</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $n=0;
                            foreach($rates as $ke => $value): $n++;
                            ?>
                                <tr>
                                    <td ><?php echo $n; ?></td>
                                    <td ><?php echo number_format($value['amount_from'],2); ?></td>
                                    <td ><?php echo number_format($value['amount_to'],2); ?></td>
                                    <td ><?php echo number_format($value['amount_rate'],2); ?></td>
                                    
                                    <td>

                                   
                                        <?php if($_SESSION['acl']['rate-update']==1): ?>
                                        <a href="?page=rate-create&id=<?php echo $value['id']; ?>&mid=<?php echo $_GET['id']; ?>">
                                            <button  class="btn btn-warning btn-xs"><i class="fa fa-refresh"></i> Update</button>
                                        </a>
                                        <?php endif; ?>
                                        <?php if($_SESSION['acl']['rate-delete']==1): ?>
                                         <button class="btn btn-danger btn-xs" id="<?php echo $value['id']; ?>" onclick="deleteThis(this.id)"><i class="fa fa-trash-o"></i> Delete</button>
                                        
                                        <?php endif; ?>

                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                               <th style="width:auto;"></th>
                                <th >Range From</th>
                                <th >Range To</th>
                                <th >Fee</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->