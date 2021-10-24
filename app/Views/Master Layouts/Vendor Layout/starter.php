<?php 
    
    
    $vendor_credentials = checkSession('vendor_credentials');
    $vendor_profile = checkSession('vendor_profile');
    
    
  

  

  $uri = service('uri');
  $current_link = $uri->getSegment(2);
  // echo $current_link;
  

?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Order Drive | <?php echo $vendor_profile['name']; ?></title>

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

    <!-- custom vendor assets -->
    <link rel="stylesheet" href="<?=base_url('vendor custom-assets/style.css')?>">
    
    <!-- datatable sorting plugin css -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" />

    <!-- shop css -->
    <link rel="stylesheet" href="<?=base_url('vendor custom-assets/shop.css')?>">

    

</head>
<body class="hold-transition sidebar-mini<?php if($current_link == 'place-order'){ echo ' sidebar-collapse'; } ?>">

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
    <a href="<?=base_url('vendor/dashboard');?>" class="brand-link">
      <img src="<?=base_url('site-identity/android-chrome-512x512.png')?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
      <span class="brand-text d-block font-weight-semibold" style="font-size:20px !important;"><span class="font-weight-bold">Order</span> Drive</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image line-height-25">
          
          
          <i class="nav-icon fas fa-user-tie" id="vendor-icon"></i>
        </div>
        <div class="info">
          <a href="#" class="d-block text-center" style="font-size:20px;"><?php echo $vendor_profile['name']; ?></a>
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
            <a href="<?=site_url('vendor/dashboard');?>" class="nav-link <?php if($current_link=='dashboard') echo 'active'; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <!-- menu item ends -->

          <!-- menu item starts -->
          <li class="nav-item">
            <a href="<?=site_url('vendor/place-order');?>" class="nav-link <?php if($current_link=='place-order') echo 'active'; ?>">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Place an Order
              </p>
            </a>
          </li>
          <!-- menu item ends -->

          <!-- menu item starts -->
          <li class="nav-item">
            <a href="<?=site_url('vendor/order-history');?>" class="nav-link <?php if($current_link=='order-history') echo 'active'; ?>">
              <i class="nav-icon fas fa-history"></i>
              <p>
                Order History
              </p>
            </a>
          </li>
          <!-- menu item ends -->

          <!-- menu item starts -->
          <li class="nav-item">
            <a href="<?=site_url('vendor/payment-history');?>" class="nav-link <?php if($current_link=='payment-history') echo 'active'; ?>">
            <i class="nav-icon fas fa-cash-register"></i>
              <p>
                Payment History
              </p>
            </a>
          </li>
          <!-- menu item ends -->

          
          
         
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
<!-- Bootstrap 4 -->
<script src="<?=base_url('admin assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('admin assets/dist/js/adminlte.min.js')?>"></script>
<!-- datatable sorting plugin script -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" defer></script>
<!-- custom script -->
<script src="<?=base_url('vendor custom-assets/script.js')?>"></script>
<!-- select2 plugin -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- js for shop -->
<script src="<?=base_url('vendor custom-assets/shop.js')?>"></script>
</body>
</html>
