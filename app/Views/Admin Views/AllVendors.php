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
            <h1 class="m-0">All Vendors</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Vendor Management</a></li>
              <li class="breadcrumb-item active">All Admins</li>
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
                    <th>Contact No.</th>
                    <th>Status</th>
                    <th>Primary Address</th>
                    <th>Joining Date</th>
                    <th>Actions</th>
                </thead>
            <!-- table header ends -->
            
            <tbody>
              
                <?php 
                
                $i=0;
                
                if($profile_data !== false){
                    
                    foreach($profile_data as $row){
                    
                    $i++;
                    
                ?>
                  <tr>
                      <td><?=$i?></td>
                      <td><?=$row['name']?></td>
                      <td><?=$row['contact_no']?></td>
                      <td>
                      <?php 
                        $row2 = $cred_data[$i-1];
                        if($row2['active_status']!=0){
                          echo '<span class="badge badge-success">Active</span>';
                           
                        } 
                        else{
                          echo '<span class="badge badge-danger">Suspended</span>';
                          }; 
                        ?></td>
                        <td><?=$row['primary_address']?></td>
                      
                      <td><?=date('d-m-Y', strtotime($row2['created_at']))?></td>
                      <td>

                          <form method="get" action="<?= site_url('site-management/edit-vendor')?>" class="d-inline">
                            <input type="hidden" name="id" value="<?= $row2['id'] ?>">
                            <input type="submit" class="btn btn-warning" onclick="return confirm('Are you sure to edit vendor?');" value="Edit">
                          </form>

                          <form method="post" action="<?= site_url('site-management/delete-vendor')?>" class="d-inline">
                            <input type="hidden" name="id" value="<?= $row2['id'] ?>">
                            <input type="submit" class="btn btn-danger" onclick="return confirm('Delete selected Vendor?');" value="Delete">
                          </form>
                      </td>
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

