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
            <h1 class="m-0">Add Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo htmlspecialchars(site_url('site-management/add-category')); ?>">Category Management</a></li>
              <li class="breadcrumb-item active">Add Category</li>
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
        <form action="<?php echo current_url(); ?>" method="POST" autocomplete="off">
           <!-- card starts -->
           <div class="card">
              <div class="card-header"><div class="card-title">Category Details</div></div>
              <!-- row starts -->
                  <div class="row py-3">
                      <!-- col starts -->
                      <div class="col-md-6 px-4 px-md-5">
                          <!-- form group starts -->
                          <div class="form-group">    
                              <label for="category-name">Category Name:</label>
                              <input type="text"  class="form-control" name="category-name" id="category-name" />
                          </div>
                          <!-- form group ends -->
                      </div>
                      <!-- col ends -->
                      
                      <!-- col starts -->
                      <div class="col-md-6 px-md-5">
                          <!-- form group starts -->
                          <div class="form-group">    
                            <label for="category-slug">Category slug:</label>
                              <input type="text"  class="form-control" name="category-slug" id="category-slug" />
                              <p class="small">It will use as url.</p>
                          </div>
                          <!-- form group ends -->
                      </div>
                      <!-- col ends -->

                      <!-- col starts -->
                      <div class="col-md-6 px-md-5">
                          <!-- form group starts -->
                          <div class="form-group">    
                            <label for="parent-category">Parent Category: </label>
                              <select class="custom-select" name="parent-category" id="parent-category">
                              <option value="0" >None</option>
                             
                              </select>

                          </div>
                          <!-- form group ends -->
                      </div>
                      <!-- col ends -->
                  </div>
              <!-- row ends -->
            </div>
            <!-- card ends -->

            

            <!-- form group starts -->
            <input type="submit" class="btn btn-primary" value="Add Category" />

            <!-- form group ends -->

        </form>
        <!-- form ends -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->



<?=$this->endSection();?>

