
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




$conditions = " WHERE tbl_projects.id = '".$_GET['id']."'";
$data = array('model'=>'projects', 'order'=>' order by name', 'condition'=>"",
    'joint'=>"SELECT tbl_projects.id as id,tbl_projects.name as name, tbl_projects.description as description,tbl_projects.notes as notes,tbl_projects.status as status,tbl_projects.date_start as date_start,tbl_projects.date_end as date_end, tbl_clients.company as company, tbl_clients.phone as phone, tbl_clients.email as email, tbl_clients.address as address,tbl_clients.contact_person as contact_person,tbl_clients.id as client_id FROM tbl_projects INNER JOIN tbl_clients ON tbl_projects.client_id = tbl_clients.id ".$conditions);
//echo json_encode($data);
$projects = $app->getRecordJoint($data);//$app->getRecord($data);
$clients = $projects[0];
//echo json_encode($projects);

//exit();
?>

<?php
$color = "#000";
if(strtoupper($clients['status'])=="LAUNCHED"){
    $color = MYGREEN;
}
if(strtoupper($clients['status'])=="FINISHED"){
    $color = MYBLUE;
}
if(strtoupper($clients['status'])=="WAITING"){
    $color = MYGOLD;
}
if(strtoupper($clients['status'])=="FAILED"){
    $color = MYRED;
}


?>

<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header" style="color: <?php echo $color; ?>">
                <i class="fa fa-globe"></i>
                <?php
                 echo strtoupper($clients['name'])." PROJECT";
                ?>
                <small class="pull-right">Date: <?php echo date("Y")."-".date("m")."-".date("d"); ?></small>
            </h2>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-3 invoice-col">
            <address>
                <strong><h4>Company Information:</h4></strong>
                <strong><?php echo $clients['company']; ?></strong><br>
                <?php echo $clients['contact_person']; ?><br>
                <?php echo $clients['address']; ?><br>
                Phone: <?php echo $clients['phone']; ?><br>
                Email: <?php echo $clients['email']; ?><br>
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-3 invoice-col">
            <address>
                <strong><h4>Service Information:</h4></strong>
                <strong><?php echo $clients['name']; ?></strong><br>
                <?php echo $clients['date_start']; ?><br>
                <?php echo $clients['date_end']; ?><br>

                Status: <span style="color: <?php echo $color; ?>; font-weight: bold;"><?php echo $clients['status']; ?></span><br>
            </address>
        </div>
        <div class="col-sm-3 invoice-col">
            <strong><h4>Service Description:</h4></strong>
            <p><?php echo $clients['description']; ?></p>
        </div>
        <!-- /.col -->
        <div class="col-sm-3 invoice-col">
            <strong><h4>Notes:</h4></strong>
            <p><?php echo $clients['notes']; ?></p>

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


if(isset($_GET['istatus'])){
    if(strtoupper($_GET['istatus'])=="ALL"){
        $cn = "";
    }else{
        $cn = " AND tbl_issues.status = '".$_GET['istatus']."' ";
    }
}

$conditions = "WHERE tbl_issues.project_no = '".$_GET['id']."' ".$cn." ORDER BY tbl_issues.date_submit";

$data = array('model'=>'projects', 'order'=>' order by name', 'condition'=>"",
    'joint'=>"SELECT tbl_issues.id as id,tbl_projects.name as name, tbl_projects.description as description,tbl_projects.notes as notes,tbl_projects.status as status,tbl_projects.date_start as date_start,tbl_projects.date_end as date_end, tbl_clients.company as company,tbl_clients.contact_person as contact_person,tbl_clients.id as client_id, tbl_projects.id as project_id, tbl_issues.description as issue_description, tbl_issues.status as issue_status, tbl_issues.bill_status as issu_bill_status, tbl_issues.date_submit as date_submit, tbl_issues.date_fixed as date_fixed FROM tbl_issues INNER JOIN tbl_clients ON tbl_issues.client_no = tbl_clients.id INNER JOIN tbl_projects ON tbl_projects.id = tbl_issues.project_no ".$conditions);
$issues = $app->getRecordJoint($data);


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
            <div id="print" class="myDivToPrint">
                <div class="box">
                    <div class="box-header">
                        <h4 class="" style="font-weight: bold;">
                            Tasks: <select class=" input-sm" name="istatus" onchange="reloadWithStatus(this.value)">
                            <?php
                            $st = array("all","on-process","pending","fixed");
                            $sl = "";
                            if(isset($_GET['istatus'])){
                                echo '<option value="'.$_GET['istatus'].'">'.ucfirst($_GET['istatus']).'</option>';
                                $sl = $_GET['istatus'];
                            }
                            else{
                                echo '<option value="all">All</option>';
                                $sl = "all";
                            }

                            foreach ($st as $key=>$v){
                                if($v!=$sl){
                                    echo '<option value="'.$v.'">'.ucfirst($v).'</option>';
                                }

                            }

                            ?> </select> </h4>
                        <div style="padding:7px; text-align: right;" class="pull-right">
                            <a href="?page=issues-create&project-id=<?php echo $clients['id']; ?>&client-id=<?php echo $clients['client_id']; ?>">
                                <button class="btn btn-success btn-xs"><i class="fa fa-file-text-o"></i> Create Task</button>
                            </a>

                        </div>
                    </div>
                    <?php /*
                        Status :
                        <select name="doption" class="span3" id="pst">

                            <?php
                            $var = array('All','Active','Pening','End');
                            $pst="";
                            if(isset($_GET['cstatus'])){
                                echo '<option value="'.ucfirst($_GET['cstatus']).'">'.ucfirst($_GET['cstatus']).'</option>';
                                $pst = ucfirst($_GET['cstatus']);
                            }
                            foreach ($var as $key => $value) {
                                if($value!=$pst){
                                    echo '<option value="'.$value.'">'.$value.'</option>';
                                }
                            }
                            ?>
                        </select> */ ?>




                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="width: 25%;">Description</th>
                                <th style="width: 25%;">Client</th>
                                <th>Service</th>
                                <th>Status</th>
                                <?php if($_SESSION['usertype']==1): ?>
                                <th>Bill Status</th>
                                <?php endif; ?>
                                <th>Date Submit</th>
                                <th>Date Finished</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $c=0; foreach ($issues as $key => $value): $c++;
                                if(strtoupper($value['issue_status'])=="FIXED"){
                                    $pcolor = MYGREEN;
                                }
                                if(strtoupper($value['issue_status'])=="ON-PROCESS"){
                                    $pcolor = MYBLUE;
                                }
                                if(strtoupper($value['issue_status'])=="FAILED"){
                                    $pcolor = MYRED;
                                }
                                if(strtoupper($value['issue_status'])=="PENDING"){
                                    $pcolor = MYGOLD;
                                }
                                ?>
                                <tr>
                                    <td style="padding: 0px;"><textarea class="form-control" style="width: 100%;"><?php echo $value['issue_description']; ?></textarea></td>
                                    <td ><?php echo $value['company']."(".$value['contact_person'].")"; ?></td>
                                    <td ><?php echo $value['name']; ?></td>
                                    <td style="color: <?php echo $pcolor; ?> ;"><?php
                                        echo $value['issue_status'];
                                        ?></td>
                                    <?php if($_SESSION['usertype']==1): ?>
                                    <td><?php echo $value['issu_bill_status']; ?></td>
                                    <?php endif; ?>
                                    <td><?php echo $value['date_submit']; ?></td>
                                    <td><?php echo $value['date_fixed']; ?></td>
                                    <td>

                                        <a href="?page=issues-view&id=<?php echo $value['id']; ?>">
                                            <button  class="btn btn-info btn-xs"><i class="fa fa-file-text-o"></i> View</button>
                                        </a>
                                        <a href="?page=issues-create&id=<?php echo $value['id']; ?>&client-id=<?php echo $value['client_id']; ?>&project-id=<?php echo $value['project_id']; ?>">
                                            <button  class="btn btn-warning btn-xs"><i class="fa fa-refresh"></i> Update</button>
                                        </a>

                                <?php if($_SESSION['usertype']==1): ?>

                                        <button class="btn btn-danger btn-xs" id="<?php echo $value['id']; ?>" onclick="deleteThis(this.id)"><i class="fa fa-trash-o"></i> Delete</button>

                                <?php endif; ?>

                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th style="width: 30%;">Description</th>
                                <th>Client</th>
                                <th>Project</th>
                                <th>Status</th>
                                <?php if($_SESSION['usertype']==1): ?>
                                <th>Bill Status</th>
                                <?php endif; ?>
                                <th>Date Submit</th>
                                <th>Date Fixed</th>
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