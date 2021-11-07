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
            <h1 class="m-0">All Orders</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo current_url(); ?>">Order Management</a></li>
              <li class="breadcrumb-item active">All Orders</li>
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
                    <th>Reference No.</th>
                    <th>Order Date</th>
                    <th>Total Products</th>
                    <th>Total Amount</th>
                    <th>Product List</th>
                    <th>Delivery Address</th>
                    <th>Update Status</th>
                    
                </thead>
            <!-- table header ends -->
            
            <tbody>
              
                <?php 
                
                $i=0;
                
                if($order_data != false){
                    
                    foreach($order_data as $row){
                    
                    $i++;
                    
                ?>
                  <tr>
                      <td><?=$i?></td>
                      <td><?=$row['ref_no']?></td>
                      <td><?= date('d-m-Y', strtotime($row['order_date']));?></td>
                      <td><?=  array_sum(explode(',', $row['product_qtys'])); ?></td>
                        
                      
                      <td>&#x20B9; <?= $payment_data[$i-1]['payble_amt']; ?> </td>
                      <td>
                        <a class="btn btn-info btn-sm" href="<?=base_url('/vendor/get-list?order-id='.$row['id'])?>">Get List</a>
                      </td>

                      <td><?= $row['delivery_address']; ?></td>
                      <td>
                        <?php
                                $status = $row['order_status'];

                                switch($status){
                                    
                                    case 0:
                                        echo '<span class="badge badge-danger">Canceled</span>';
                                        break;
                                    case 1:
                                        echo '<span class="badge badge-info">Just Placed</span>';
                                        break;
                                    case 2:
                                        echo '<span class="badge badge-light">Under Processing</span>';
                                        break;
                                    case 3:
                                        echo '<span class="badge badge-primary">Shipping</span>';
                                        break;
                                    case 4:
                                        echo '<span class="badge badge-success">Delivered</span>';
                                        break;
                                    default:

                                }
                            
                        ?>
                       </td>

                  </tr>
                  <?php
                    } 

                }

                else{
                  echo "No orders are availabe. Please place one at ". '<a href="'.base_url('/vendor/place-order/').'" >Shop</a>';
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

