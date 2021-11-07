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
            <h1 class="m-0">Pending Orders</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('site-management/all-orders/'); ?>">Order Management</a></li>
              <li class="breadcrumb-item active">Pending Orders</li>
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
                        
                      
                      <td>&#x20B9; <?php
                      
                      //$payment_data[$i-1]['payble_amt']; 
                        foreach($payment_data as $pay){
                            if($pay['id'] == $row['id']){
                              echo $pay['payble_amt'];
                              break;
                            }
                        }
                      ?> </td>

                      <td>
                        <a class="btn btn-info btn-sm" href="<?=base_url('/site-management/get-orderedItems?order-id='.$row['id'])?>">Get List</a>
                      </td>

                      <td><?= $row['delivery_address']; ?></td>
                      <td>
                        <?php
                                $status = $row['order_status'];

                                

                        ?>
                        <form action="/site-management/changeOrderStatus" method="post">
                          <div class="d-flex flex-row">
                            <input type="hidden" name="order-id" value="<?php echo $row['id']; ?>" />
                            <!-- <input type="submit" onclick="return confirm('Change status to Under Processing?');" class="btn btn-success btn-sm" value="Set to Processing"> -->
                            <select name="order-status" id="change-order-status">
                                <option dislabled value="-1">-- Status --</option>
                                <option value="0">Cancel</option>
                                <option value="3" <?php if($row['order_status'] == 3){echo 'selected';} ?>>Shipping</option>
                                <option value="4" <?php if($row['order_status'] == 4){echo 'selected';} ?>>Delivered</option>
                                
                            </select>
                            <input type="submit" onclick="return confirm('Are you sure to change status?');" class="btn btn-primary btn-sm" value="Apply">
                            </div>
                        </form> 
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

