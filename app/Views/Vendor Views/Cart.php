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
        <form method="post" action="create-order/">
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

            <div class="payment-sec p-2" id="cart-place-order">

                <div class="text-center m-3">
                <select class="custom-select" id="payment-options">
                    
                    <option value="cash" selected>Cash On Delivery</option>
                    <option value="card">Credit/Debit Card</option>
                    <option value="upi">UPI</option>
                </select>
                </div>   

                <div id="card" class="px-2 container payment-option" style="display:none;">     
                    <div class="row">

                        <div class="col-md-6 p-md-3">
                            <div class="form-group">
                                <label for="name">Name on Card: </label>
                                <input type="text" name="holder-name" class="form-control" id="name" placeholder="Ex. Ammy Virk">
                            </div>
                        </div>
                        
                        <div class="col-md-6 p-md-3">
                            <div class="form-group">
                                <label for="cart-no">Debit/Credit Card No.</label>
                                <input type="text" name="card-no" class="form-control" id="cart-no" pattern="[0-9]{16,16}" placeholder="16 Digit Cart no">
                            </div>
                        </div>

                        <div class="col-md-6 p-md-3">
                            <div class="form-group">
                                <label for="exp-date">Expiry Date: </label>
                                <input type="text" name="expiry-date" class="form-control" id="exp-date" Placeholder="YYYY-MM" />
                            </div>
                        </div>

                        <div class="col-md-6 p-md-3">
                            <div class="form-group">
                                <label for="cvv">CVV</label>
                                <input type="text" name="cvv" class="form-control" id="cart-no" pattern="[0-9]{3}" placeholder="XXX">
                            </div>
                        </div>

                    </div>
                </div>

                <div id="upi" class="payment-option" style="display:none;">
                    <div class="text-center">
                    <div class="col-md-6 p-md-3 mx-auto">
                            <div class="form-group">
                                <label for="upi-id">Enter UPI: </label>
                                <input type="text" name="upi-id" class="form-control" id="upi-id" placeholder="UPI ID">
                                <p class="small">And accept the request on your upi merchant</p>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="text-center mb-2"><input type="submit" class="btn btn-primary" value="Place Order" /></div>

            </div>
        </form>
    </div>

    <!-- cart ends -->


    
    
      
        


      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->


<?=$this->endSection();?>

