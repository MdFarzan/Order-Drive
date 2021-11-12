<?=$this->extend('Master Layouts/Admin Layout/starter');
$this->section('main_content');



?>

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Revenue Report</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Report Management</a></li>
              <li class="breadcrumb-item active">Revenue Report</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        

        <!-- stat box starts -->
        <div class="row justify-content-center">

           <!-- ./col -->
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background:#f4da16;">
              <div class="inner">
                <h3><?php echo $today_revenue; ?></h3>

                <p>Today's Revenue</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->

         
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $l_seven_day; ?><sup style="font-size: 20px"></sup></h3>

                <p>Last Seven Day's Revenue</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $l_month; ?></h3>

                <p>Last Month Revenue</p    >
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $current_year_revenue; ?></h3>

                <p>Current Year Revenue</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              
            </div>
          </div>
        
          <div class="col-lg-3 col-6">
          
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3><?php echo $last_year_revenue; ?></h3>

              <p>Last Year Revenue</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->

         

        </div>
        <!-- stat box ends -->

        
      </div><!-- /.container-fluid -->
      
      
    </div>
    <!-- /.content -->


<?=$this->endSection();?>