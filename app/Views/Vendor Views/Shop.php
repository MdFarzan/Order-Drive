<?=$this->extend('Master Layouts/Vendor Layout/starter');
$this->section('main_content');
?>

<?php 
    $uri = service('uri');
    $current_link = $uri->getSegment(2);
    
?>

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Place an Order</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Order Drive</a></li>
              <li class="breadcrumb-item active">Place an order</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

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
              <a class="nav-link" href="<?php echo current_url(); ?>">Home <span class="sr-only">(current)</span></a>
            </li>
            
            <?php 
              if($category_menu != false){
                foreach($category_menu as $cm){
            ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo current_url().'/category/'.$cm['slug']; ?>"><?php echo $cm['name']; ?> <span class="sr-only">(current)</span></a>
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
<div class="container-fluid py-2 pt-3"> 
    <div class="row">
      <?php 
        if($product_data != false){
          foreach($product_data as $product){
      ?>
      <!-- product start -->
      <div class="col-md-6 col-lg-4">
          <div class="product-wrapper">
              <a href="<?php echo current_url().'/product?id='.$product['id']; ?>" class="product-link">
                <div class="product-thumb">
                  <img src="<?php echo base_url($product['thumbnail_src']); ?>" alt="<?php echo $product['name']; ?>">
                </div>
                <div class="b-details">
                  <h5 class="product-title"><?php if(strlen($product['name'])>78){ echo substr($product['name'], 0, 78),'...'; } else{ echo $product['name']; }  ?></h5>
                  <span class="product-price">	<span class="rupee-symbol"> <i class="fas fa-rupee-sign"></i></span> <?php echo $product['price']; ?></span>
                </div>
              </a>
              <div class="text-center">
                <button class="btn btn-primary add-to-cart" data-product-id="<?php echo $product['id'] ?>">Add to Cart</button>
              </div>
            
          </div>
      </div>
      <!-- product ends -->

    <?php 
          }
        }
    ?>

 



    </div>

    <?php 
      if(isset($pager))
        echo $pager->links(); 
        
    ?>

</div>



    <!-- shop ends -->
      
        


      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->


<?=$this->endSection();?>