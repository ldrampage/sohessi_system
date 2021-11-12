<!-- Main content -->
<?php
  error_reporting(E_ALL); ini_set('display_errors', 1);
$response=array('action'=>"", 'message'=>"");

if(isset($_POST['btn_save'])){
     date_default_timezone_set('America/New_York');
        $date = date('Y-m-d h:i:s', time());

    $data = array('model'=>"kirby",'keys'=>'id, parent, question, answer');

    if(isset($_POST['id'])){
       
        
        $response = $app->faqsupdate($_POST['id'],$_POST['parent'],trim($_POST['question']),trim($_POST['answer']));
       
    }else{
        
        $dts = array(
        'model'=>'faqs'
        );
       
        if ($_POST['parent']=='Parent')$parent = 0;
        else $parent=$_POST['parent'];
       
        $data2 = array(
            'model'=>'faqs',
            'keys'=>'id, parent, question, answer',
            'values'=>"'', '$parent', '".$_POST['question']."', '".$_POST['answer']."'"
        );
        
        $response = $app->faqscreate($data2);
        $response['message'] = "Successful";
      
    }

}

if(isset($_GET['id'])){
    $action = "Update";
    $select = $app->faqsview($_GET['id']);
    $ds = array(
        'model'=>'faqs',
        'condition'=>" WHERE id = '".$_GET['id']."'"
    ); 
    $cur = $app->getRecord2($ds); 
    //$cur=$cur['data'][0];
    foreach($select as $colx => $valx){
        
    }
}else{ $action = "Create"; }

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
            <form name="user" method="post"  enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                       
                        <h4 class="modal-title" id="myModalLabel"><?php echo $action; ?> FAQs</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <div class="form-group" style="margin-bottom: 0px; ">

                                    <?php if(isset($_GET['id'])):?>
                                        <input type="hidden" class="form-control" name="id" value="<?php echo $_GET['id']; ?>" required />
                                        
                                    <?php endif; ?>
                                </div>
                    
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Parent</label>
                                    
                                    
                                    <select name="parent"  class="form-control">
                                        <!--<option>default</option>-->
                                        <option value = '0'>Parent</option>
                                        
                                       <?php 
                                        $param = array('model'=>"faqs");
                                         $opt = $app->getrecord2($param);
                                         $options =$opt['data'];
                                       foreach($options as $key => $val){
                                        $question =$val['question']; 
                                        $idx =$val['id'];    
                                        echo"<option value='".$idx."'>$question</option>";
                                       }
                                       ?>
                                            
                                    </select>
                                    
                                </div>

                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Question</label>
                                    
                                    <textarea id="question" class="form-control" placeholder="Question" name="question" style ="height:120px;" required><?php if(isset($_GET['id'])){echo trim($valx['question']);}?></textarea>
                                      
                                </div>
                    
                                 <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Answer</label>
                                   
                                    <textarea id="answer" class="form-control" placeholder="Answer" name="answer"style ="height:120px;" required><?php if(isset($_GET['id'])){echo trim($valx['answer']);}?></textarea>
                                        
                                </div>
                                
                            </div>
                            <div class="col-sm-2"></div>
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
<!--<script>-->
<!--    $("#domain").on("change", function(){-->
<!--        $("#webfolder").val($(this).val());-->
<!--    });-->
<!--</script>-->

