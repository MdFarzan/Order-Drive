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
      
      <!-- page header starts -->
        <div class="shop-header">
            <h2>Cart</h2>
        </div>
      <!-- page header ends -->

    <!-- cart starts -->
    
    <div id="cart">
        <form action="">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">S no.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price <sup>Per.</sup></th>
                        <th scope="col">Total (Price X Qty.)</th>
                        <th scope="col">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    
                    
                </tbody>
            </table>
            <hr />
            <div class="text-center mb-2"><input type="submit" id="place-order" class="btn btn-primary" value="Place Order" /></div>
        </form>
    </div>

    <!-- cart ends -->


    
    
      
        


      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->


<?=$this->endSection();?>

