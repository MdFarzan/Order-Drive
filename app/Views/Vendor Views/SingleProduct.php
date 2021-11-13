<?=$this->extend('Master Layouts/Vendor Layout/starter');
$this->section('main_content');
?>

<?php 
    $uri = service('uri');
    $current_link = $uri->getSegment(2);
    
?>

    

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      
      <!-- product navbar starts -->

<nav class="navbar navbar-expand-lg navbar-light justify-content-end bg-white">
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a href="<?php echo base_url('/cart/'); ?>" class="btn btn-light mx-2 px-2 d-md-block d-lg-none text-primary"><i class="fas fa-shopping-cart"></i></a>        

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo base_url('vendor/place-order'); ?>">Home <span class="sr-only">(current)</span></a>
            </li>
            
            <?php 
              if($category_menu != false){
                foreach($category_menu as $cm){
            ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url().'/vendor/place-order/category/'.$cm['slug']; ?>"><?php echo $cm['name']; ?> <span class="sr-only">(current)</span></a>
            </li>

            <?php 

                }

              }
            
            ?>
            

          </ul>
          <form class="form-inline my-2 my-lg-0" method="GET" action="<?php echo base_url('vendor/place-order/search'); ?>">
            <input class="form-control mr-sm-2" name="find" type="search" placeholder="Search a product" aria-label="Search">
            <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
          </form>
          <a href="<?php echo base_url('/cart/'); ?>" class="btn btn-light mx-2 px-2 d-md-none d-lg-block text-primary"><i class="fas fa-shopping-cart"></i></a>
          
        </div>
      </nav>
    <!-- product navbar ends -->

    
    <!-- shop starts -->
    <div class="container-fluid bg-white single-product">
        <div class="row">
              
              <div class="col-md-4">
                <figure class="full-product-img text-center">
                    <img src="<?php echo base_url($product_data['thumbnail_src']) ?>" alt="" title="" />
                </figure>
              </div>

              <div class="col-md-8">
                <h1><?php echo $product_data['name']; ?></h1>
                <h3><span class="rupee-sym"><i class="fas fa-rupee-sign"></i></span> <?php echo $product_data['price']; ?></h3>
                
                <div class="product-qty" style="max-width:200px;">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="product-qty">Quantity</span>
                        </div>
                        
                        <input type="number" class="form-control p-qty-no" id="qty-<?php echo $product_data['id']; ?>" data-product-qty-ref="<?php echo $product_data['id']; ?>" min="1"  value="1" aria-label="product-quantity" aria-describedby="product-quantity">

                        
                    </div>

                    
                
                </div>

                <div class="add-cart-con">
                        <button class="py-2 btn btn-primary add-to-cart d-block single-product-page-btn" data-product-id="<?php echo $product_data['id']; ?>" style="width:200px;">Add to Cart</button>
                        
                </div>

                

                <div class="product-short-desc pt-4">
                    <p>
                        <?php echo $product_data['short_desc']; ?>
                    </p>
                </div>
                
              </div>
        
        </div>

        <div class="container">
            <div class="text-center long-desc-title"><h2>More details about product</h2></div>
            <div class="long-desc">
              <?php echo $product_data['long_desc']; ?>
            </div>

        </div>
    
    </div>
    <!-- shop ends -->
      
        


      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->


<?=$this->endSection();?>