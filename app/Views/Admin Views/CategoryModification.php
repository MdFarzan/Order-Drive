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
            <h1 class="m-0">Edit Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url('site-management/all-categories'); ?>">Category Management</a></li>
              <li class="breadcrumb-item active">Edit Category</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content bg-light px-3">
        
      <div class="container-fluid mb-5">
        <?php 
            
            if($category != false){
                
            
        ?>
        <!-- form starts -->
        <form action="<?php echo htmlspecialchars(current_url()); ?>" method="POST" autocomplete="off">
           <!-- card starts -->
           <div class="card">
              <div class="card-header"><div class="card-title">Category Details</div></div>
              <!-- row starts -->
                  <div class="row py-3">
                      <!-- col starts -->
                      <div class="col-md-6 px-4 px-md-5">
                          <input type="hidden"  name="id" value="<?php echo $category['id'] ?>" />
                          <!-- form group starts -->
                          <div class="form-group">    
                              <label for="category-name">Category Name:</label>
                              <input type="text"  class="form-control" name="category-name" value="<?php echo $category['name'] ?>" id="category-name" />
                          </div>
                          <!-- form group ends -->
                      </div>
                      <!-- col ends -->
                      
                      <!-- col starts -->
                      <div class="col-md-6 px-md-5">
                          <!-- form group starts -->
                          <div class="form-group">    
                            <label for="category-slug">Category slug:</label>
                              <input type="text"  class="form-control" name="category-slug" value="<?php echo $category['slug'] ?>" id="category-slug" />
                              <p class="small">It will use as url.</p>
                          </div>
                          <!-- form group ends -->
                      </div>
                      <!-- col ends -->
            <?php 
                }
            ?>
                      <!-- col starts -->
                      <div class="col-md-6 px-md-5">
                          <!-- form group starts -->
                          <div class="form-group">    
                            <label for="parent-category">Parent Category: </label>
                              <select class="custom-select" name="parent-category" id="parent-category">
                              <option value="0" >None</option>
                             <?php 
                                if($parent_category != false){
                                  foreach($parent_category as $cat){

                             ?>
                                 <option value="<?php echo $cat['id'];?>" <?php if($category['p_id'] == $cat['id'] ){ echo 'selected';} ?>><?php echo $cat['name']; ?> </option>
                                
                              <?php 
                                  }
                                }
                                
                              ?>
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
            <input type="submit" class="btn btn-primary" value="Update Category" />

            <!-- form group ends -->

        </form>
        <!-- form ends -->
      </div><!-- /.container-fluid -->


        <!-- card starts -->
            <div class="card">
                <div class="card-header"><div class="card-title">Child Categories</div></div>

                    <!-- user content starts -->
                    <div class="container-fluid mb-5">
                    
                    <!-- table starts -->
                    <div class="table-responsive">
                    <table class="table text-center" id="sort-table">
                        <!-- table header starts -->
                            <thead>
                                <th>S no.</th>
                                <th>Category name</th>
                                <th>Category Slug</th>
                                <th>Actions</th>
                            </thead>
                        <!-- table header ends -->
                        
                        <tbody>

                        <?php 
                        if($child_categories != false){
                            $i=0;
                            foreach($child_categories as $child){
                                $i++;
                        
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $child['name'] ?></td>
                                <td><?php echo $child['slug'] ?></td>
                                
                                
                                <td>

                                    <form method="get" action="<?= site_url('site-management/edit-category')?>" class="d-inline">
                                        <input type="hidden" name="id" value="<?php echo $child['id']?>">
                                        <input type="submit" class="btn btn-warning" onclick="return confirm('Are you sure to edit category?');" value="Edit">
                                    </form>

                                    <form method="post" action="<?= site_url('site-management/delete-category')?>" class="d-inline">
                                        <input type="hidden" name="id" value="<?php echo $child['id']?>">
                                        <input type="submit" class="btn btn-danger" onclick="return confirm('It will delete child categories as well. Do you want to proceed?');" value="Delete">
                                    </form>
                                </td>
                            </tr>
                        <?php 
                                }
                            }
                        ?>
                            

                        </tbody>
                        <!-- table body ends -->

                    </table>
                    </div>
                    <!-- table ends -->

                    </div>
                    <!-- user content ends -->

            </div>
            <!-- card ends -->                                

    </div>
    <!-- /.content -->



<?=$this->endSection();?>

