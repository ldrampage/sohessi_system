
<script>


    function deleteThis(id, name){
        if (confirm('Are you sure you want to delete '+name+'?')) {
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

    $data = array('model'=>'subdepartment', 'condition'=>" WHERE id = '".$_GET['del']."'");
    $response = $app->delete2($data);
}



$conditions = " WHERE tbl_projects.id = '".$_GET['id']."'";
/*$data = array('model'=>'projects', 'order'=>' order by name', 'condition'=>"",
    'joint'=>"SELECT tbl_projects.id as id,tbl_projects.name as name, tbl_projects.description as description,tbl_projects.notes as notes,tbl_projects.status as status,tbl_projects.date_start as date_start,tbl_projects.date_end as date_end, tbl_clients.company as company, tbl_clients.phone as phone, tbl_clients.email as email, tbl_clients.address as address,tbl_clients.contact_person as contact_person,tbl_clients.id as client_id FROM tbl_projects INNER JOIN tbl_clients ON tbl_projects.client_id = tbl_clients.id ".$conditions);*/
//echo json_encode($data);
//$projects = $app->getRecordJoint($data);//
$data = array("model"=>"department", "condition"=>" WHERE id = '".$_GET['id']."'");
$projects=$app->getRecord2($data);
$department = $projects['data'][0];

$edata = array("model"=>"employee", "condition"=>" WHERE department_id = '".$_GET['id']."'");
$emps = $app->getRecord2($edata);
$emps = $emps['data'];
//echo json_encode($projects);
$departments = $app->getDepartments();

$data = array('model'=>'subdepartment', 'condition'=>" WHERE department_id = '".$_GET['id']."'",'order'=>' order by name');
$subdepartment = $app->getRecord2($data);
$subdepartment = $subdepartment['data'];

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
                 echo strtoupper($department['name'])."";
                ?>
                <small class="pull-right">Date: <?php echo date("Y")."-".date("m")."-".date("d"); ?></small>
            </h2>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
            <address>
                <strong><h4><?php echo $department['name']; ?></h4></strong>
                <?php echo $department['description']; ?><br>
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
                        <h3 class="box-title" style="font-weight: bold;">Sub Departments</h3>
                        <div style="padding:7px; text-align: right;" class="pull-right">
                            <button  class="btn btn-primary btn-sm btn-click-view" onclick="PrintElem('print', 'Tenant Recod')"><i class="icon-print"></i> Print</button>

                            <?php if($_SESSION['acl']['subdepartment-create']==1): ?>
                            <a href="?page=subdepartment-create&did=<?php echo $_GET['id']; ?>" type="submit" class="btn btn-success btn-sm">Create</a>
                            <?php endif; ?>

                        </div>
                    </div>
                   



                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background:#4DC7BC; color:#fff;">
                            <tr>
                                <th></th>
                                <th style="width: 20%;">Department</th>
                                <th style="width: 20%;">Sub-Department</th>
                                <th style="width: 60%;">Description</th>
                                <th style="width: 10%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $c=0; foreach ($subdepartment as $key => $value): $c++;
                               
                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo $departments[$value['department_id']]['name']; ?></td>
                                    <td><?php echo $value['name']; ?></td>
                                   
                                    <td><?php echo $value['description']; ?></td>
                                  
                                    <td>
                                        <?php if($_SESSION['acl']['subdepartment-view']==1): ?>    
                                        <a href="?page=subdepartment-view&sid=<?php echo $value['id']; ?>&id=<?php echo $_GET['id']; ?>">
                                            <button  class="btn btn-info btn-xs"><i class="fa fa-file-text-o"></i> View</button>
                                        </a>
                                    <?php endif; ?>
                                        <?php if($_SESSION['acl']['subdepartment-update']==1): ?>
                                        <a href="?page=subdepartment-create&sid=<?php echo $value['id']; ?>&id=<?php echo $_GET['id']; ?>">
                                            <button  class="btn btn-warning btn-xs"><i class="fa fa-refresh"></i> Update</button>
                                        </a>
                                       <!--  <button class="btn btn-danger btn-xs" id="<?php echo $value['id']; ?>" onclick="deleteThis(this.id)"><i class="fa fa-trash-o"></i> Delete</button>
                                        -->
                                        <?php endif; ?>
                                         <?php if($_SESSION['acl']['subdepartment-delete']==1): ?>
                                        
                                           <button  class="btn btn-danger btn-xs" onClick="deleteThis('<?php echo $value['id']; ?>','<?php echo $value['name']; ?>')"><i class="fa fa-refresh"></i> Delete</button>
                                        
                                       <!--  <button class="btn btn-danger btn-xs" id="<?php echo $value['id']; ?>" onclick="deleteThis(this.id)"><i class="fa fa-trash-o"></i> Delete</button>
                                        -->
                                        <?php endif; ?>

                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th style="width: 20%;">Department</th>
                                <th style="width: 20%;">Sub-Department</th>
                                <th style="width: 60%;">Description</th>
                                <th style="width: 10%;">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <?php /*
            <div id="print" class="myDivToPrint">
                <div class="box">
                    <div class="box-header">
                        <h4 class="" style="font-weight: bold;">
                           

                            </select> </h4>

                        <div style="padding:7px; text-align: right;" class="pull-right">
                        <?php if($_SESSION['acl']['employee-create']==1): ?>
                            <a href="?page=employee-create&department-id=<?php echo $_GET['id']; ?>">
                                <button class="btn btn-success btn-xs"><i class="fa fa-file-text-o"></i> Create Employee</button>
                            </a>
                        <?php endif; ?>    

                        </div>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="width:auto;"></th>
                                <th >Name</th>
                                <th >Position</th>
                                <th >Email</th>
                                <th >Date Hired</th>
                                <th >Shift</th>
                                <th >Hrs/month</th>
                                <th >Rate/Hr</th>
                                <th >Monthly</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $n=0;
                            foreach($emps as $ke => $value): $n++;
                            ?>
                                <tr>
                                    <td ><?php echo $n; ?></td>
                                    <td ><?php echo $value['lname'].", ".$value['fname']." ".$value['mname']; ?></td>
                                    <td ><?php echo $value['position']; ?></td>
                                    <td ><?php echo $value['email']; ?></td>
                                    <td ><?php echo $value['date_hired']; ?></td>
                                    <td ><?php echo $value['shift_start']."-".$value['shift_end']; ?></td>
                                    <td ><?php echo $value['hrs']; ?></td>
                                    <td ><?php echo number_format($value['rate'],2); ?>/hr</td>
                                    <td ><?php echo number_format($value['monthly'],2); ?>/month</td>
                                    <td>

                                         <?php if($_SESSION['acl']['employee-view']==1): ?>    
                                        <a href="?page=employee-view&id=<?php echo $value['id']; ?>">
                                            <button  class="btn btn-info btn-xs"><i class="fa fa-file-text-o"></i> View</button>
                                        </a>
                                    <?php endif; ?>
                                        <?php if($_SESSION['acl']['employee-update']==1): ?>
                                        <a href="?page=employee-create&id=<?php echo $value['id']; ?>">
                                            <button  class="btn btn-warning btn-xs"><i class="fa fa-refresh"></i> Update</button>
                                        </a>
                                       <!--  <button class="btn btn-danger btn-xs" id="<?php echo $value['id']; ?>" onclick="deleteThis(this.id)"><i class="fa fa-trash-o"></i> Delete</button>
                                        -->
                                        <?php endif; ?>

                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th style="width:auto;"></th>
                                <th >Name</th>
                                <th >Position</th>
                                <th >Email</th>
                                <th >Date Hired</th>
                                <th >Shift</th>
                                <th >Hrs/month</th>
                                <th >Rate/Hr</th>
                                <th >Monthly</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            */ ?>
        </div>
    </div>
</section>
<!-- /.content -->