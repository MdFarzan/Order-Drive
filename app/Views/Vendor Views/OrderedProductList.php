<?=
//extending layout
$this->extend('Master Layouts/Vendor Layout/starter');

//starting section
$this->section('main_content');
?>


<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Order History</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/vendor/order-history'); ?>">Product History</a></li>
              <li class="breadcrumb-item active">Ordered Products</li>
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
                    <th>Name</th>
                    <th>Feature Image</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Qty. SET</th>
                    <th>Price * Qty.</th>
                </thead>
            <!-- table header ends -->
            
            <tbody>
              
                <?php 
                
                $i=0;
                
                if($product_data != false){
                    
                    foreach($product_data as $row){
                    
                    $i++;
                    
                ?>
                  <tr>
                      <td><?=$i?></td>
                      <td><?=$row['name']?></td>
                      <td><img width="100px" height="auto" src="<?php echo base_url($row['thumbnail_src'])?>"></td>
                      <td>
                      <?php 
                        foreach($category_data as $cat){
                            if($row['category_id'] == $cat['id']){
                                echo $cat['name'];
                            }
                        }
                        ?></td>
                        
                      
                      <td>&#x20B9; <?=$ordered_price[$i-1]?></td>
                      <td><?=$ordered_qty[$i-1]?></td>
                      <td>&#x20B9; <?=$ordered_qty[$i-1] * $ordered_price[$i-1]; ?></td>
                  </tr>
                  <?php
                    } 

                }

                else{
                  echo "No vendors are defined!";
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

