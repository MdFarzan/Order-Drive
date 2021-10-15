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
        <a href="#" class="btn btn-light mx-2 px-2 d-md-block d-lg-none text-primary"><i class="fas fa-shopping-cart"></i></a>        

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if($current_link == 'place-order'){echo ' active'; }?>">
              <a class="nav-link" href="<?php echo current_url(); ?>">Home <span class="sr-only">(current)</span></a>
            </li>
            
            <?php 
              if($category_menu != false){
                foreach($category_menu as $cm){
            ?>
            <li class="nav-item <?php if($current_link == 'place-order'){echo ' active'; }?>">
              <a class="nav-link" href="<?php echo current_url().'/category?'.$cm['slug']; ?>"><?php echo $cm['name']; ?> <span class="sr-only">(current)</span></a>
            </li>

            <?php 

                }

              }
            
            ?>
            

          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search a product" aria-label="Search">
            <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
          </form>
          <a href="#" class="btn btn-light mx-2 px-2 d-md-none d-lg-block text-primary"><i class="fas fa-shopping-cart"></i></a>
          
        </div>
      </nav>
    <!-- product navbar ends -->





      
        


      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->


<?=$this->endSection();?>