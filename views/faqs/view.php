<!-- Main content -->
<?php
  error_reporting(E_ALL); ini_set('display_errors', 1);
$response=array('action'=>"", 'message'=>"");

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
                       
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <div class="form-group" style="margin-bottom: 0px; ">

                                    <?php if(isset($_GET['id'])): $id =$_GET['id']; ?>
                                       
                                        <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>" required />
                                    <?php endif; ?>
                                </div>
                                    
                                <?php
                                    
                                    $rec = $app->faqsview($id);
                                  
                                    foreach($rec as $key => $value){
                                      
                                    }
                                    
                                ?>
                               
                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Parent Question</label>
                                    
                                    <textarea id="parent" class="form-control" name="parent" style ="height:120px; background:white;" readonly ><?php if($value['parent']=='0'){ echo $value['question'];}else{$parentfind= $app->faqsview($value['parent']);foreach($parentfind as $xy => $xx){}echo $xx['question'];}?></textarea>
                                      
                                </div>


                                <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Question</label>
                                   
                                    <textarea id="question" class="form-control" name="question" style ="height:150px; background:white;" readonly ><?php echo $value['question'];?>
                                    </textarea>    
                                </div>
    
                                 <div class="form-group" style="margin-bottom: 0px; ">
                                    <label>Answer</label>
                                  
                                    <textarea id="answer" class="form-control" placeholder="Answer" name="answer" style ="height:150px; background:white;" readonly><?php echo $value['answer']; ?>
                                    </textarea>    
                                </div>
                               
                                
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
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

