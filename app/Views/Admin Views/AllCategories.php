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
            <h1 class="m-0">All Categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Categories Management</a></li>
              <li class="breadcrumb-item active">All Categories</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content bg-light px-3">
        
      <div class="container-fluid mb-5">

        <!-- user content starts -->
        
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
              if($category_data!=false){
                $i=0;
                  foreach($category_data as $category){
                    $i++;
              
            ?>
                  <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $category['name'] ?></td>
                      <td><?php echo $category['slug'] ?></td>
                      
                      
                      <td>

                          <form method="get" action="<?= site_url('site-management/edit-category')?>" class="d-inline">
                            <input type="hidden" name="id" value="<?php echo $category['id']?>">
                            <input type="submit" class="btn btn-warning" onclick="return confirm('Are you sure to edit category?');" value="Edit">
                          </form>

                          <form method="post" action="<?= site_url('site-management/delete-category')?>" class="d-inline">
                            <input type="hidden" name="id" value="<?php echo $category['id']?>">
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


        <!-- user content ends -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->



<?=$this->endSection();?>

