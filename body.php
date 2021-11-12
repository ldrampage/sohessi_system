
</style>
<div class="content-wrapper" style="min-height: 650px;">  
    <!-- Content Header (Page header) -->
    <section class="content-header" style="">
      <h1>
        Laboratory & Patient Information Management System | SOHESSI
        <small>Version 1.0</small>
      </h1>
      <ol class="breadcrumb" >
        <li><a href="?page=home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">

        <?php
        
        $page_title = $app->aclLists();
        //echo json_encode($page_title)."=".$page;
        echo $page_title[$page];

        ?>

        </li>
      </ol>
    </section>
    <div>
      
       <?php
       switch ($page) {
          case 'home':
               //include 'views/home/index.php';
               include 'views/home/new.php';
            break;
          case 'new':
               include 'views/home/new.php';
            break;    
          case 'profile':
               include 'views/profile/create.php';     
            break;                
          default:
               include 'views/'.$page.'.php';
            break;
        }
       ?> 

    </div>
</div>   
