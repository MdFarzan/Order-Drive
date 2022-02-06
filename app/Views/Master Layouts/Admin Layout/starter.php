

<!DOCTYPE html>
<?php 

  
    
  

 
  if(checkSession('privileges')){
    $privileges = checkSession('privileges');
    
  }

  $uri = service('uri');
  $current_link = $uri->getSegment(2);
  


?>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Order Drive | Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?=base_url('admin assets/plugins/fontawesome-free/css/all.min.css');?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('admin assets/dist/css/adminlte.min.css')?>">

  <!-- fav icons starts-->
  <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url('site-identity/apple-touch-icon.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url('site-identity//favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('site-identity//favicon-16x16.png') ?>">
    <link rel="manifest" href="<?=base_url('site-identity/site.webmanifest') ?>">
    <!-- favicon ends -->

    <!-- custom admin assets -->
    <link rel="stylesheet" href="<?=base_url('admin custom-assets/style.css')?>">
    
    <!-- datatable sorting plugin css -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" />

    

</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" title="Sign out" href="<?=site_url('site-management/signout/');?>" role="button">
          <i class="fas fa-sign-out-alt"></i>
          
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=base_url('site-management/dashboard');?>" class="brand-link">
      <img src="<?=base_url('site-identity/android-chrome-512x512.png')?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
      <span class="brand-text d-block font-weight-semibold" style="font-size:20px !important;"><span class="font-weight-bold">Order</span> Drive</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image line-height-25">
          
          <i class="nav-icon fas fa-user-shield" id="admin-icon"></i>
        </div>
        <div class="info">
          <a href="#" class="d-block text-center" style="font-size:20px;"><?=checkSession('credentials')['name']?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           <!-- menu item starts -->
           <li class="nav-item">
            <a href="<?=site_url('site-management/dashboard');?>" class="nav-link <?php if($current_link=='dashboard') echo 'active'; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <!-- menu item ends -->

          <!-- menu starts -->
          <?php if($privileges['admins_management']==1){ ?>
          <li class="nav-item <?php if($current_link=='all-admin' || $current_link=='edit-admin' || $current_link=='add-admin') echo 'menu-open'; ?>">
            <a href="#" class="nav-link <?php if($current_link=='all-admin' || $current_link=='edit-admin' || $current_link=='add-admin') echo 'active'; ?>">
              
              <i class="fas fa-user-cog nav-icon"></i>
              <p>
                Admin Managment
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?=site_url('site-management/all-admin/');?>" class="nav-link <?php if($current_link=='all-admin' || $current_link=='edit-admin') echo 'active'; ?>">
                  
                  <i class="fas fa-users-cog nav-icon"></i>
                  <p>All Admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('site-management/add-admin/');?>" class="nav-link <?php if($current_link=='add-admin') echo 'active'; ?>">
                  
                  <i class="fas fa-user-shield nav-icon"></i>
                  <p>Add Admin</p>
                </a>
              </li>
            </ul>
          </li>
          <?php }?>
          <!-- menu ends -->

          <!-- menu starts -->
          <?php if($privileges['vendor_management']==1){ ?>
          <li class="nav-item <?php if($current_link=='all-vendor' || $current_link=='add-vendor' || $current_link=='edit-vendor') echo 'menu-open'; ?>">
            <a href="#" class="nav-link <?php if($current_link=='all-vendor' || $current_link=='edit-vendor' || $current_link=='add-vendor') echo 'active'; ?>">
              
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Vendor Managment
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=site_url('site-management/all-vendor/');?>" class="nav-link <?php if($current_link=='all-vendor' || $current_link=='edit-vendor') echo 'active'; ?>">
                  <i class="fas fa-users nav-icon"></i>
                  
                  <p>All Vendors</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('site-management/add-vendor/');?>" class="nav-link <?php if($current_link=='add-vendor') echo 'active'; ?>">
                  
                  <i class="fas fa-user-plus nav-icon"></i>
                  <p>Add Vendor</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <!-- menu ends -->

          <!-- menu starts -->
          <?php if($privileges['category_management']==1){ ?>
          <li class="nav-item <?php if($current_link=='all-categories' || $current_link=='edit-category' || $current_link=='add-category') echo 'menu-open'; ?>">
            <a href="#" class="nav-link <?php if($current_link=='all-categories' || $current_link=='edit-category' || $current_link=='add-category') echo 'active'; ?>">
              
              <i class="nav-icon fas fa-border-all"></i>
              <p>
                Category Managment
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=site_url('site-management/all-categories/');?>" class="nav-link <?php if($current_link=='all-categories' || $current_link=='edit-category') echo 'active'; ?>">
                  
                  <i class="fas fa-th-list nav-icon"></i>
                  <p>All Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('site-management/add-category/');?>" class="nav-link <?php if($current_link=='add-category') echo 'active'; ?>">
                  <i class="fas fa-bookmark nav-icon"></i>
                  
                  <p>Add Category</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <!-- menu ends -->

          <!-- menu starts -->
          <?php if($privileges['product_management']==1){ ?>
          <li class="nav-item <?php if($current_link=='all-products' || $current_link=='add-product' || $current_link=='edit-product') echo 'menu-open'; ?>">
            <a href="#" class="nav-link <?php if($current_link=='all-products' || $current_link=='add-product' || $current_link=='edit-product') echo 'active'; ?>">
              
              <i class="nav-icon fas fa-box-open"></i>
              <p>
                Product Managment
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=site_url('site-management/all-products/');?>" class="nav-link <?php if($current_link=='all-products' || $current_link=='edit-product') echo 'active'; ?>">
                  
                  <i class="fas fa-boxes nav-icon"></i>
                  <p>All Products</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('site-management/add-product/');?>" class="nav-link <?php if($current_link=='add-product') echo 'active'; ?>">
                  
                  <i class="nav-icon fas fa-cart-plus"></i>
                  <p>Add Product</p>
                </a>
              </li>
             
            </ul>
          </li>
          <?php } ?>
          <!-- menu ends -->

          <!-- menu starts -->
          <?php if($privileges['order_management']==1){ ?>
          <li class="nav-item <?php if($current_link=='all-orders' || $current_link == 'get-orderedItems' || $current_link=='new-orders' || $current_link=='pending-orders') echo 'menu-open'; ?>">
            <a href="#" class="nav-link <?php if($current_link=='all-orders' || $current_link == 'get-orderedItems' || $current_link=='new-orders' || $current_link=='pending-orders') echo 'active'; ?>">
              
              <i class="nav-icon fas fa-archive"></i>
              <p>
                Order Managment
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=site_url('site-management/all-orders/');?>" class="nav-link <?php if($current_link=='all-orders' || $current_link == 'get-orderedItems') echo 'active'; ?>">
                  
                  <i class="nav-icon fas fa-box"></i>
                  <p>All Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('site-management/new-orders/');?>" class="nav-link <?php if($current_link=='new-orders') echo 'active'; ?>">
                  
                  <i class="nav-icon fas fa-briefcase-medical"></i>
                  <p>New Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('site-management/pending-orders/');?>" class="nav-link <?php if($current_link=='pending-orders') echo 'active'; ?>">
                  
                  <i class="nav-icon fas fa-calendar-minus"></i>
                  <p>Pending Orders</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <!-- menu ends -->

          <!-- menu starts -->
          <?php if($privileges['report_management']==1){ ?>
          <li class="nav-item <?php if($current_link=='sales-report' || $current_link == 'revenue-report')  echo 'menu-open'; ?>">
            <a href="#" class="nav-link <?php if($current_link=='sales-report' || $current_link == 'revenue-report') echo 'active'; ?>">
              
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Reports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=site_url('site-management/sales-report/');?>" class="nav-link <?php if($current_link=='sales-report') echo 'active'; ?>">
                  
                  <i class="fas fa-chart-area nav-icon"></i>
                  <p>Sales Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('site-management/revenue-report/');?>" class="nav-link <?php if($current_link=='revenue-report') echo 'active'; ?>">
                  <i class="nav-icon fas fa-chart-line"></i>
                  
                  <p>Revenue Report</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <!-- menu ends -->
          
         
          <li class="nav-item">
            <a href="<?=site_url('site-management/signout/');?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Sign out
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- section rendering -->
    <?php 
    //getting alert if exist
    getAlert();
    
    ?>
    <?= $this->renderSection("main_content"); ?>
    
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Made with ❤️ by Md. Farzan
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2021 <a href="https://github.com/MdFarzan/" target="_blank">Order Drive</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- adding CKEditor -->
<script src="<?=base_url('admin assets/plugins/ckeditor/ckeditor.js')?>"></script>
<!-- jQuery -->

<script src="<?=base_url('admin assets/plugins/jquery/jquery.min.js')?>"></script>
<script src="<?=base_url('admin custom-assets/jQueryTableSorter.js')?>"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url('admin assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('admin assets/dist/js/adminlte.min.js')?>"></script>
<!-- datatable sorting plugin script -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" defer></script>
<!-- custom script -->
<script src="<?=base_url('admin custom-assets/script.js')?>"></script>
<!-- select2 plugin -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>
</html>
