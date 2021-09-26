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
            <h1 class="m-0">Edit Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url('/site-management/all-products/'); ?>">Product Management</a></li>
              <li class="breadcrumb-item active">Edit Product</li>
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
            if($product_data == false)
            die();
        ?>
        <!-- form starts -->
        <form action="<?php echo htmlspecialchars(current_url()); ?>" method="POST" enctype="multipart/form-data"e>
        
           <!-- card starts -->
           <div class="card">
           
              <div class="card-header"><div class="card-title">Basic Details</div></div>
              <!-- row starts -->
                  <div class="row py-3">
                  
                      <!-- col starts -->
                      <div class="col-md-6 px-4 px-md-5">
                          <!-- form group starts -->
                          <div class="form-group">    
                              <input type="hidden" name="id" value="<?php echo $product_data['id'] ?>">
                              <label for="product-name">Product Name: <span class="text-danger">*</span></label>
                              <input type="text"  class="form-control" name="product-name" id="product-name" value="<?php echo $product_data['name'] ?>" required />
                          </div>
                          <!-- form group ends -->
                      </div>
                      <!-- col ends -->
                      
                      <!-- col starts -->
                      <div class="col-md-6 px-md-5">
                           <!-- form group starts -->
                           <div class="form-group">    
                           
                            <label for="product-category">Product Category: </label>
                              <select class="custom-select" name="product-category" id="product-category">
                              <option value="0" >None</option>
                             <?php 
                                if($category_data!=NULL){
                                  foreach($category_data as $category){

                             ?>
                                 <option value="<?php echo $category['id'];?>" <?php if($category['id'] == $product_data['category_id']) echo "selected" ?> ><?php echo $category['name']; ?> </option>
                              
                              <?php 
                                  }
                                }
                              ?>
                              </select>
                          </div>
                          <!-- form group ends -->
                      </div>
                      <!-- col ends -->

                      <!-- col starts -->
                      <div class="col-md-6 px-md-5">
                          <!-- form group starts -->
                          <div class="form-group">    
                            <label for="feature-img">Feature Image: <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="feature-img">Upload</span>
                              </div>
                              <div class="custom-file">
                                <input type="file" name="feature-image" class="custom-file-input" id="feature-img" aria-describedby="Feature Image" accept="image/*" >
                                <input type="hidden" name="feature-image-old" id="feature-img" value="<?php echo $product_data['thumbnail_src'] ?>" >
                                <label class="custom-file-label" for="feature-img">Choose file</label>
                              </div>
                            </div>
                          </div>
                          <!-- form group ends -->
                      </div>
                      <!-- col ends -->

                      <!-- col starts -->
                      <div class="col-md-6 px-md-5">
                          <!-- form group starts -->
                          <div class="form-group">    
                              <label for="product-price">Price (Per pcs.): <span class="text-danger">*</span></label>
                              <input type="number"  class="form-control" name="product-price" id="product-price" value="<?php echo $product_data['price'] ?>" min="0"  step="any" required />
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
              <div class="card-header"><div class="card-title">Product Description</div></div>
              <!-- row starts -->
                  <div class="row py-3">

                      <!-- col starts -->
                      <div class="col-md-6 px-md-5">
                          <!-- form group starts -->
                          <div class="form-group">
                            <label for="short-description">Short Description:<span class="text-danger">*</span></label>
                            <textarea class="form-control" id="short-description" name="short-description" rows="3" required><?php echo $product_data['short_desc'] ?>"</textarea>
                          </div>
                          <!-- form group ends -->
                      </div>
                      <!-- col ends -->
                      
                      <!-- col starts -->
                      <div class="col-md-6 px-md-5">
                          <!-- form group starts -->
                          <div class="form-group">
                            <label for="secondary-address">Long Description: </label>
                            <textarea class="form-control" id="long-description" name="long-description" rows="3"><?php echo $product_data['long_desc'] ?>"</textarea>
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
              <div class="card-header"><div class="card-title">Product Gallery:</div></div>
              <!-- row starts -->
                  <div class="row py-3">

                      <!-- col starts -->
                      <div class="col-md-12 px-md-5">
                          <!-- form group starts -->
                          <div class="form-group">
                          <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="gallery-images[]" id="product-gallery" aria-describedby="product-gallery" accept="image/*" multiple />
                                <label class="custom-file-label" for="product-gallery">Choose file</label>
                              </div>
                              <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="remove"></button>
                              </div>
                            </div>
                          </div>
                          <!-- form group ends -->
                      </div>
                      <!-- col ends -->
                      
                      
                      

                  </div>
              <!-- row ends -->
            </div>
            <!-- card ends -->

            <!-- form group starts -->
            <input type="submit" class="btn btn-primary" value="Update Product" />

            <!-- form group ends -->

        </form>
        <!-- form ends -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->


  


<?=$this->endSection();?>

