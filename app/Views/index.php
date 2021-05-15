<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?="Order Drive | Sign in"?></title>
    <!-- fav icons starts-->
    <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url('site-identity/apple-touch-icon.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url('site-identity//favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('site-identity//favicon-16x16.png') ?>">
    <link rel="manifest" href="<?=base_url('site-identity/site.webmanifest') ?>">
    <!-- favicon ends -->
    <meta name="author" content="Md Farzan" />
    <!-- head cdns -->
    <?=$this->include('includes/headCdn.php')?>
</head>
<body>

    <!-- container starts -->
    <div class="container">
        <!-- header starts -->
        <header class="text-center pb-3">
            <span id="logo"><img src="site-identity/logo-304-X-87.jpg"></span>
        </header>
        <!-- header ends -->
        
        <!-- main starts -->
        <main class="mt-3">
            <!-- row starts -->
            <div class="row justify-content-center">
                <!-- col starts -->
                <div class="col-md-8 col-lg-6">
                    <!-- nav tab starts -->
                    <nav>
                        
                        <div class="nav nav-tabs text-center justify-content-center" id="nav-tab" role="tablist">
                            <a class="nav-link<?=!(bool)getFlashError('admin')?' active':''; ?>" id="nav-vendor-tab" data-toggle="tab" href="#nav-vendor" role="tab" aria-controls="nav-home" aria-selected="true">Sign in As <strong>Vendor</strong></a>
                            
                            <a class="nav-link<?=(bool)getFlashError('admin')?' active':''; ?>" id="nav-admin-tab" data-toggle="tab" href="#nav-admin" role="tab" aria-controls="nav-contact" aria-selected="false">Sign in As <strong>Admin</strong></a>
                        </div>
                    </nav>
                
                    <div class="tab-content border border-left-2 px-2 px-md-5 py-4" id="nav-tabContent">
                        <div class="tab-pane<?=!(bool)getFlashError('admin')?' active show':''; ?>" id="nav-vendor" role="tabpanel" aria-labelledby="nav-admin-tab">
                            <!-- form starts -->
                                <form action="vendor-sign-in/" class="py-md-4" method="post">
                                    <h3>Sign in as Vendor</h3>
                                    <hr />
                                    <!-- form group starts -->
                                        <div class="form-group">
                                            <label for="email">Email: </label>
                                            <input type="email" id="email" name="user-mail" class="form-control" />
                                        </div>
                                    <!-- form group ends -->

                                    <!-- form group starts -->
                                    <div class="form-group">
                                            <label for="passkey">Password: </label>
                                            <input type="password" name="user-passkey" class="form-control" />
                                    </div>
                                    <!-- form group ends -->
                                    <div class="form-check form-check-inline">
                                            <input type="checkbox" id="remember" name="remember-me" class="form-check-input" />
                                            <label class="form-check-label" for="remember"> Remember me</label>
                                    </div>
                                    <!-- form group ends -->
                                    
                                    <!-- form group starts -->
                                    <div class="form-group text-center">
                                            <input type="submit" class="btn btn-primary" value="Sign in" />
                                    </div>
                                    <!-- form group ends -->
                                </form>
                            <!-- form ends -->

                                <!-- display sign in support start -->
                                <?php 
                                    if(defined('VENDOR_SIGNIN_SUPPORT')){
                                ?>
                                    <p>Trouble in Sign? Contact our <a href="mailto:<?=VENDOR_SIGNIN_SUPPORT;?>">Vendor Support</a></p>

                                <?php }?>
                                <!-- display sign in support end -->
                        </div>
                        
                        <div class="tab-pane fade<?=(bool)getFlashError('admin')?' active show':''; ?>" id="nav-admin" role="tabpanel" aria-labelledby="nav-admin-tab">
                            <!-- alert starts -->
                            <?php if(getFlashError('admin')){ 
                                $err = getFlashError('admin'); ?>
                                <div class="alert alert-danger fade show dismissible">
                                    <strong><?=$err['title'];?></strong><?=$err['msg'];?>
                                    <button type="button" class="close" data-dismiss="alert"> <span class="">&times;</span></button>
                                </div>        
                            <?php } ?>
                            
                            <!-- alert ends -->

                             <!-- form starts -->
                             <form action="admin-sign-in/" class="py-md-4" method="post">
                                    <h3>Sign in as Admin</h3>
                                    <hr />
                                    <!-- form group starts -->
                                        <div class="form-group">
                                            <label for="email">Email: </label>
                                            <input type="email" id="email" name="user-mail" class="form-control" />
                                        </div>
                                    <!-- form group ends -->

                                    <!-- form group starts -->
                                    <div class="form-group">
                                            <label for="passkey">Password: </label>
                                            <input type="password" name="user-passkey" class="form-control" />
                                    </div>
                                    <!-- form group ends -->
                                     <!-- form group ends -->
                                    <div class="form-check form-check-inline">
                                            <input type="checkbox" id="rememberAdmin" name="remember-me" class="form-check-input" />
                                            <label class="form-check-label" for="rememberAdmin"> Remember me</label>
                                    </div>
                                    <!-- form group ends -->

                                    <!-- form group starts -->
                                    <div class="form-group text-center">
                                            <input type="submit" class="btn btn-primary" value="Sign in" />
                                    </div>
                                    <!-- form group ends -->
                                </form>
                            <!-- form ends -->

                        </div>
                    </div>

                    <!-- nav tab ends -->
                </div>
                <!-- col ends -->
            </div>
            <!-- row ends -->
        </main>
        <!-- main ends -->

    </div>
    <!-- container ends -->
    
    <!-- footer starts -->
        <footer class="container">
            
        </footer>
    <!-- footer ends -->

    <!-- body cdns -->
    <?=$this->include('includes/bodyCdn.php')?>
</body>
</html>