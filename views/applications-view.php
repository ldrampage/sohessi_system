
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




$data = array("model"=>"application", "condition"=>" WHERE id = '".$_GET['id']."'");
$applicant=$app->getRecord2($data);
$applicant = $applicant['data'][0];
$vacancy = $app->getVacancy();
$atdata = array("model"=>"attachments", "condition"=>" WHERE amodel = 'application' AND amodel_id='".$applicant['id']."'");
$att = $app->getRecord2($atdata);
if(sizeOf($att['data'])>0){
    $att = $att['data'][0];
}else{
$att = $att['data'][0] = array("attachment"=>"");
}
//$eawards = json_decode($department['employee_id']);
//$emps = $app->getEmployees();
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
                 echo strtoupper($vacancy[$applicant['vacancy_id']]['title'])." (Application View)";
                ?>
                <small class="pull-right">Date: <?php echo date("Y")."-".date("m")."-".date("d"); ?></small>
            </h2>
            <div class="pull-right" style="margin-top: -75px;">
                            <a href="?page=applications"><label class="btn btn-xs btn-info">back</label></a> 
                        </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
            <address>
                <strong>
                <h4><?php echo $applicant['lname'].", ".$applicant['fname']." ".$applicant['mname']; ?></h4>
                </strong>
                Email: <?php echo $applicant['email']; ?><br>
                Open Letter: <?php echo $applicant['openletter']; ?><br>
                Attachment: <a target="_BLANK" href='<?php echo $att['attachment']; ?>'>Download</a><br>
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

    $data = array('model'=>'issues', 'condition'=>" WHERE id = '".$_GET['del']."'");
    $response = $app->delete2($data);
}





?>




    <br>

    <div class="row">

        <div class="col-md-12">


            <br>
            <div class="widget-content ">
                <div">

                <?php if( $response['message']=="Successful"){
                    echo '<br><div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">x</a>
                    <strong>Success!</strong> Record '.$daction.' successfully.
                </div>';
                }
                ?>



            </div>
            
        </div>
    </div>
</section>
<!-- /.content -->