<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $useri['photo']; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['login_user']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" >
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            
          </a>
         
        </li>
        <?php if($_SESSION['acl']['transaction']==1): ?>
        <li class="active treeview">
          <a href="?page=transaction">
            <i class="fa fa-list-alt"></i> <span>Transaction</span>
            
          </a>
         
        </li>
      <?php  endif; ?>
      <?php if($_SESSION['acl']['consultation']==1): ?>
        <li class="active treeview">
          <a href="?page=consultation">
            <i class="fa fa-list-alt"></i> <span>Consultation</span>
          </a>
         
        </li>
      <?php  endif; ?>
      <?php if($_SESSION['acl']['process-test']==1): ?>
        <li class="active treeview">
          <a href="?page=process-test">
            <i class="fa fa-list-alt"></i> <span>Lab Test Processing</span>
          </a>
         
        </li>
      <?php  endif; ?>
      <?php if($_SESSION['acl']['patients']==1): ?>
        <li class="treeview">
          <a href="#">
            <i class="fa  fa-list-alt"></i> <span>Patient</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
               <?php if($_SESSION['acl']['employee-create']==1): ?>
                <li class="disable"><a href="?page=patients-create"><i class="fa fa-circle-o"></i>Create Patient</a></li>
                <?php endif; ?>
                <li><a href="?page=patients&status=1"><i class="fa fa-circle-o"></i>Patient List</a></li>
          </ul>
        </li>
      <?php endif; ?>  
      <?php if($_SESSION['acl']['employee']==1): ?>
        <li class="treeview">
          <a href="#">
            <i class="fa  fa-list-alt"></i> <span>Employee</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
               <?php if($_SESSION['acl']['employee-create']==1): ?>
                <li class="disable"><a href="?page=employee-create"><i class="fa fa-circle-o"></i>Create Employee</a></li>
                <?php endif; ?>
                <li><a href="?page=employee&status=1"><i class="fa fa-circle-o"></i>Employee List</a></li>
          </ul>
        </li>
      <?php endif; ?>
	  
	  
	  <?php if($_SESSION['acl']['po']==1): ?>
        <li class="treeview">
          <a href="#">
            <i class="fa  fa-list-alt"></i> <span>Purchase Order</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
               <?php if($_SESSION['acl']['po-create']==1): ?>
                <li class="disable"><a href="?page=po-create"><i class="fa fa-circle-o"></i>Create Purchase Order</a></li>
                <?php endif; ?>
                <li><a href="?page=po&status=1"><i class="fa fa-circle-o"></i>Purchase Order List</a></li>
          </ul>
        </li>
      <?php endif; ?>


      <?php if($_SESSION['acl']['expenses']==1): ?>
        <li class="treeview">
          <a href="#">
            <i class="fa  fa-list-alt"></i> <span>Expenses</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
               <?php if($_SESSION['acl']['expenses-create']==1): ?>
                <li class="disable"><a href="?page=expenses-create"><i class="fa fa-circle-o"></i>Create Expenses</a></li>
                <?php endif; ?>
                <li><a href="?page=expenses&status=1"><i class="fa fa-circle-o"></i>Expenses List</a></li>
          </ul>
        </li>
      <?php endif; ?>


      <?php if($_SESSION['acl']['billings']==1): ?>
        <li class="treeview">
          <a href="#">
            <i class="fa  fa-list-alt"></i> <span>Billings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
               <?php if($_SESSION['acl']['billings-create']==1): ?>
                <li class="disable"><a href="?page=billings-create"><i class="fa fa-circle-o"></i>Create Billing</a></li>
                <?php endif; ?>
                <li><a href="?page=billings&status=1"><i class="fa fa-circle-o"></i>Billing List</a></li>
          </ul>
        </li>
      <?php endif; ?>

       <?php if($_SESSION['acl']['returns']==1): ?>
        <li class="treeview">
          <a href="#">
            <i class="fa  fa-list-alt"></i> <span>Returns</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
               <?php if($_SESSION['acl']['returns-create']==1): ?>
                <li class="disable"><a href="?page=returns-create"><i class="fa fa-circle-o"></i>Create Returns</a></li>
                <?php endif; ?>
                <li><a href="?page=returns&status=1"><i class="fa fa-circle-o"></i>Returns List</a></li>
          </ul>
        </li>
      <?php endif; ?>

      <?php if($_SESSION['acl']['payments']==1): ?>
        <li class="treeview">
          <a href="#">
            <i class="fa  fa-list-alt"></i> <span>Payment</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
               <?php if($_SESSION['acl']['payments-create']==1): ?>
                <li class="disable"><a href="?page=payments-create"><i class="fa fa-circle-o"></i>Create payments</a></li>
                <?php endif; ?>
                <li><a href="?page=payments&status=1"><i class="fa fa-circle-o"></i>payments List</a></li>
          </ul>
        </li>
      <?php endif; ?>

      
      <?php if($_SESSION['acl']['settings']==1): ?>
        <li class="treeview">
          <a href="#">
            <i class="fa  fa-list-alt"></i> <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
                <?php if($_SESSION['acl']['department']==1): ?>
                <li class="disable"><a href="?page=department"><i class="fa fa-circle-o"></i>Department</a></li>
                <?php endif; ?>

                <?php if($_SESSION['acl']['company']==1): ?>
                <li class="disable"><a href="?page=company"><i class="fa fa-circle-o"></i>Company</a></li>
                <?php endif; ?>

                 <?php if($_SESSION['acl']['testcategory']==1): ?>
                <li class="disable"><a href="?page=testcategory"><i class="fa fa-circle-o"></i>Lab Test Category</a></li>
                <?php endif; ?>

                <?php if($_SESSION['acl']['tests']==1): ?>
                <li class="disable"><a href="?page=tests"><i class="fa fa-circle-o"></i>Lab Tests</a></li>
                <?php endif; ?>
                <?php if($_SESSION['acl']['tests']==100): ?>
                <li class="disable"><a href="?page=crete-lab-result"><i class="fa fa-circle-o"></i>Create Lab Result</a></li>
                <?php endif; ?>

                <?php if($_SESSION['acl']['suppliers']==1): ?>
                <li class="disable"><a href="?page=suppliers"><i class="fa fa-circle-o"></i>Supplier</a></li>
                <?php endif; ?>

                <?php if($_SESSION['acl']['materials']==1): ?>
                <li class="disable"><a href="?page=materials"><i class="fa fa-circle-o"></i>Materials</a></li>
                <?php endif; ?>

                <?php if($_SESSION['acl']['brands']==1): ?>
                <li class="disable"><a href="?page=brands"><i class="fa fa-circle-o"></i>Medicine Brands</a></li>
                <?php endif; ?>

                <?php if($_SESSION['acl']['medicines']==1): ?>
                <li class="disable"><a href="?page=medicines"><i class="fa fa-circle-o"></i>Medicines</a></li>
                <?php endif; ?>

                <?php if($_SESSION['acl']['symptoms']==1): ?>
                <li class="disable"><a href="?page=symptoms"><i class="fa fa-circle-o"></i>Symptoms</a></li>
                <?php endif; ?>

                <?php if($_SESSION['acl']['diseases']==1): ?>
                <li class="disable"><a href="?page=diseases"><i class="fa fa-circle-o"></i>Diseases</a></li>
                <?php endif; ?>

                <?php if($_SESSION['acl']['operations']==1): ?>
                <li class="disable"><a href="?page=operations"><i class="fa fa-circle-o"></i>Operations</a></li>
                <?php endif; ?>

                <?php if($_SESSION['acl']['access-controls']==100): ?>
                <li class="disable"><a href="?page=access-controls"><i class="fa fa-circle-o"></i>Access COntrols</a></li>
                <?php endif; ?>
               
          </ul>
        </li>
      <?php endif; ?>

      
      
      <?php if(isset($_SESSION['acl']['reports'])): if($_SESSION['acl']['reports']==1): ?>
        <li class="treeview">
          <a href="#">
            <i class="fa  fa-list-alt"></i> <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
                <li><a href="?page=reports&t=employee"><i class="fa fa-circle-o"></i>Employees</a></li>
                <li><a href="?page=reports&t=patients"><i class="fa fa-circle-o"></i>Patients</a></li>
                <li><a href="?page=reports&t=transactions"><i class="fa fa-circle-o"></i>Transactions</a></li>
                <li><a href="?page=reports&t=pricing"><i class="fa fa-circle-o"></i>Pricing</a></li>
                <li><a href="?page=reports&t=prean"><i class="fa fa-circle-o"></i>Pre & annual</a></li>
                <li><a href="?page=reports&t=results"><i class="fa fa-circle-o"></i>Lab Result</a></li>
          </ul>
        </li>
      <?php endif;endif; ?>

      
      
      <?php if($_SESSION['acl']['access-log']==1): ?>
        <li class="treeview">
          <a href="?page=access-log">
            <i class="fa  fa-list-alt"></i> <span>Access Logs</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
      <?php endif; ?>
 

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>