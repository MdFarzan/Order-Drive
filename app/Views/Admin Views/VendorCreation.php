<?=
//extending layout
$this->extend('Master Layouts/Admin Layout/starter');

//starting section
$this->section('main_content');
?>


<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Vendor</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url('/site-management/all-vendor/'); ?>">Vendor Management</a></li>
              <li class="breadcrumb-item active">Add Vendor</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content bg-light px-3">
        
      <div class="container-fluid mb-5">

        <!-- form starts -->
        <form action="<?php echo htmlspecialchars(site_url('site-management/add-vendor/')); ?>" method="POST" autocomplete="off">
           <!-- card starts -->
           <div class="card">
              <div class="card-header"><div class="card-title">Credentials</div></div>
              <!-- row starts -->
                  <div class="row py-3">
                      <!-- col starts -->
                      <div class="col-md-6 px-4 px-md-5">
                          <!-- form group starts -->
                          <div class="form-group">    
                              <label for="email">Email: <span class="text-danger">*</span></label>
                              <input type="email"  class="form-control" name="email" id="email" required />
                          </div>
                          <!-- form group ends -->
                      </div>
                      <!-- col ends -->

                      <!-- col starts -->
                      <div class="col-md-6 px-md-5">
                          <!-- form group starts -->
                          <div class="form-group">    
                              <label for="passkey">Password: <span class="text-danger">*</span></label>
                              <input type="password"  class="form-control" name="passkey" id="passkey"  required />
                          </div>
                          <!-- form group ends -->
                      </div>
                      <!-- col ends -->

                      
                      

                  </div>
              <!-- row ends -->
            </div>
            <!-- card ends -->

            <!-- card starts -->
           <div class="card">
              <div class="card-header"><div class="card-title">Personal Details</div></div>
              <!-- row starts -->
                  <div class="row py-3">
                      <!-- col starts -->
                      <div class="col-md-6 px-4 px-md-5">
                          <!-- form group starts -->
                          <div class="form-group">    
                              <label for="full-name">Full Name: <span class="text-danger">*</span></label>
                              <input type="text"  class="form-control" name="full-name" id="full-name" required />
                          </div>
                          <!-- form group ends -->
                      </div>
                      <!-- col ends -->

                      <!-- col starts -->
                      <div class="col-md-6 px-md-5">
                          <!-- form group starts -->
                          <div class="form-group">    
                              <label for="mobile-no">Contact no: <span class="text-danger">*</span></label>
                              <input type="tel"  class="form-control" name="mobile-no" id="mobile-no" required />
                          </div>
                          <!-- form group ends -->
                      </div>
                      <!-- col ends -->

                      <!-- col starts -->
                      <div class="col-md-6 px-md-5">
                          <!-- form group starts -->
                          <div class="form-group">
                            <label for="primary-address">Primary Address: <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="primary-address" name="primary-address" rows="3" required></textarea>
                          </div>
                          <!-- form group ends -->
                      </div>
                      <!-- col ends -->
                      
                      <!-- col starts -->
                      <div class="col-md-6 px-md-5">
                          <!-- form group starts -->
                          <div class="form-group">
                            <label for="secondary-address">Secondary Address: </label>
                            <textarea class="form-control" id="secondary-address" name="secondary-address" rows="3"></textarea>
                          </div>
                          <!-- form group ends -->
                      </div>
                      <!-- col ends -->
                      

                  </div>
              <!-- row ends -->
            </div>
            <!-- card ends -->

            <!-- form group starts -->
            <input type="submit" class="btn btn-primary" value="Create Vendor" />

            <!-- form group ends -->

        </form>
        <!-- form ends -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->



<?=$this->endSection();?>

