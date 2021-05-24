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
            <h1 class="m-0">Add Admin</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin Management</a></li>
              <li class="breadcrumb-item active">Add Admin</li>
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
        <form action="" method="POST" autocomplete="off">
           <!-- card starts -->
           <div class="card">
              <div class="card-header"><div class="card-title">Basic Details</div></div>
              <!-- row starts -->
                  <div class="row py-3">
                      <!-- col starts -->
                      <div class="col-md-6 px-4 px-md-5">
                          <!-- form group starts -->
                          <div class="form-group">    
                              <label for="full-name">Full Name: </label>
                              <input type="text"  class="form-control" name="full-name" id="full-name" />
                          </div>
                          <!-- form group ends -->
                      </div>
                      <!-- col ends -->
                      
                      <!-- col starts -->
                      <div class="col-md-6 px-md-5">
                          <!-- form group starts -->
                          <div class="form-group">    
                              <label for="email">Email: </label>
                              <input type="email"  class="form-control" name="email" id="email" />
                          </div>
                          <!-- form group ends -->
                      </div>
                      <!-- col ends -->

                      <!-- col starts -->
                      <div class="col-md-6 px-md-5">
                          <!-- form group starts -->
                          <div class="form-group">    
                              <label for="passkey">Password: </label>
                              <input type="password"  class="form-control" name="passkey" id="passkey" />
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
                <!-- card header starts -->
                <div class="card-header">
                  <div class="card-title">Privileges</div>
                </div>
                <!-- card header ends -->

                <!-- card body starts -->
                <div class="card-body">
                  
                    <!-- row starts -->
                    <div class="row">
                    
                      <!-- col starts -->
                      <div class="col-md-3">
                        <!-- checkbox starts -->
                        <div class="custom-control custom-switch py-2 my-2">
                          <input type="checkbox" class="custom-control-input" id="admin-management" name="admin-priviliges[]" />
                          <label class="custom-control-label" for="admin-management">Admin Management</label>
                        </div>
                        <!-- checkbox ends -->            
                      </div>
                      <!-- col ends -->

                      <!-- col starts  -->
                      <div class="col-md-3">
                        <!-- checkbox starts -->
                        <div class="custom-control custom-switch py-2 my-2">
                          <input type="checkbox" class="custom-control-input" id="category-management" name="admin-priviliges[]" />
                          <label class="custom-control-label" for="category-management">Category Management</label>
                        </div>
                        <!-- checkbox ends -->
                      </div>
                      <!-- col ends -->
                      
                      <!-- col starts  -->
                      <div class="col-md-3">
                        <!-- checkbox starts -->
                        <div class="custom-control custom-switch py-2 my-2">
                          <input type="checkbox" class="custom-control-input" id="product-management" name="admin-priviliges[]" />
                          <label class="custom-control-label" for="product-management">Product Management</label>
                        </div>
                        <!-- checkbox ends -->
                      </div>
                      <!-- col ends -->
                      <!-- col starts  -->
                      <div class="col-md-3">
                        <!-- checkbox starts -->
                        <div class="custom-control custom-switch py-2 my-2">
                          <input type="checkbox" class="custom-control-input" id="vendor-management" name="admin-priviliges[]" />
                          <label class="custom-control-label" for="vendor-management">Vendor Management</label>
                        </div>
                        <!-- checkbox ends -->
                      </div>
                      <!-- col ends -->
                      <!-- col starts  -->
                      <div class="col-md-3">
                        <!-- checkbox starts -->
                        <div class="custom-control custom-switch py-2 my-2">
                          <input type="checkbox" class="custom-control-input" id="order-management" name="admin-priviliges[]" />
                          <label class="custom-control-label" for="order-management">Order Management</label>
                        </div>
                        <!-- checkbox ends -->
                      </div>
                      <!-- col ends -->

                       <!-- col starts -->
                       <div class="col-md-3">
                        <!-- checkbox starts -->
                        <div class="custom-control custom-switch py-2 my-2">
                          <input type="checkbox" class="custom-control-input" id="report-management" name="admin-priviliges[]" />
                          <label class="custom-control-label" for="report-management">Reports Management</label>
                        </div>
                        <!-- checkbox ends -->
                      </div>
                      <!-- col ends -->


                    </div>
                    <!-- row ends -->

                </div>
                <!-- card body ends -->

            </div>
            <!-- card ends -->

            <!-- form group starts -->
            <input type="submit" class="btn btn-primary" value="Create Admin" />

            <!-- form group ends -->

        </form>
        <!-- form ends -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->



<?=$this->endSection();?>

