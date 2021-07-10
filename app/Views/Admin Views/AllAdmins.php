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
            <h1 class="m-0">All Admins</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin Management</a></li>
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
                    <th>Email</th>
                    <th>Status</th>
                    <th>Creation Date</th>
                    <th>Updation Date</th>
                    <th>Actions</th>
                </thead>
            <!-- table header ends -->
            <tbody>
              
                <?php 
                
                $i=0;
                if($data !== false){
                
                    foreach($data as $row){
                    $i++;
                ?>
                  <tr>
                      <td><?=$i?></td>
                      <td><?=$row['name']?></td>
                      <td><?=$row['email']?></td>
                      <td>
                      <?php 
                        if($row['active_status']!=0){
                          echo '<span class="badge badge-success">Active</span>';
                           /*'<span class="badge badge-success">Active</span>';*/ 
                        } 
                        else{
                          echo '<span class="badge badge-danger">Suspended</span>';
                          }; 
                        ?></td>
                      <td><?=date('d-m-Y', strtotime($row['created_at']))?></td>
                      <td><?=date('d-m-Y', strtotime($row['updated_at']))?></td>
                      <td>
                          <form method="post" action="/edit-admin" class="d-inline">
                            <input type="hidden" name="admin_id" value="<?= $row['id'] ?>">
                            <input type="submit" class="btn btn-info" onclick="return confirm('Are you sure to edit admin?');" value="Edit">
                          </form>

                          <form method="post" action="/delete-admin" class="d-inline">
                            <input type="hidden" name="admin_id" value="<?= $row['id'] ?>">
                            <input type="submit" class="btn btn-warning" onclick="return confirm('Delete selected Admin?');" value="Delete">
                          </form>
                      </td>
                  </tr>
                  <?php
                    } 

                }

                else{
                  echo "No admins are defined!";
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

