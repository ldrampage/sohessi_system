
<?php
//error_reporting(E_ALL); ini_set('display_errors', 1);
 error_reporting(E_ALL); ini_set('display_errors', 1);
$dataS = array(
    'model'=>'reports',
    'condition'=>" WHERE id = '".$_GET['id']."'"
);
$reports = $app->getRecord2($dataS);
$reports=$reports['data'][0];


?>



<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i>
                Report
                <small class="pull-right">Today: <?php echo date("m/d/y");//$ticket['refno']; ?></small>
            </h2>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-12 invoice-col">
            Date Submitted: <?php echo $reports['date']; ?><br>
            
                <p>
                Report Content:
                <?php echo $reports['content']; ?>
                </p>
          
            
        </div>
       
       
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->



   
    
    
    <div class="row">
        
    </div>    


</section>


<?php

if(isset($_GET['active'])){
    echo "<script>document.getElementById('".$_GET['active']."').click();</script>";
}
?>


<script>

    function makeid() {
      var text = "";
      var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    
      for (var i = 0; i < 5; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    
      return text;
    }

  
   
   


</script>

<!-- /.content -->