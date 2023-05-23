<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo e(config('app.name')); ?> - Compte</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo e(URL::to('account/lib/owlcarousel/assets/owl.carousel.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::to('account/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')); ?>" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo e(URL::to('account/css/bootstrap.min.css')); ?>" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?php echo e(URL::to('account/css/style.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(URL::to('account/css/sweetalert.min.css')); ?>">

</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="<?php echo e(route('clientportal')); ?>" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-warning"><i class="fa fa-user-edit me-2"></i><?php echo e(config('app.name')); ?></h3>
                </a>
                <div class="navbar-nav w-100">
                    <a href="<?php echo e(route('clientportal')); ?>"
                        class="nav-item nav-link <?php echo e(Helper::activeLink(['clientportal'])); ?>"><i
                            class="fa fa-home me-2"></i>Accueil</a>
                    <a href="<?php echo e(route('userdata')); ?>"
                        class="nav-item nav-link <?php echo e(Helper::activeLink(['defaultdata', 'userdata', 'editdefaultdata'])); ?>">
                        <i class="fa fa-database me-2"></i>Données</a>
                    <a href="<?php echo e(route('reserver')); ?>"
                        class="nav-item nav-link"><i
                            class="far fa-file-alt me-2"></i>Réservation</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0 text-warning">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="<?php echo e(URL::to('img/chef_gusto.png')); ?>" alt=""
                                style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php echo e(Session::get('userlogged')); ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="<?php echo e(route('logoutadmin')); ?>" class="dropdown-item">Se Deconnecté</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
            <div class="mt-2">
                <?php if(Session::has('fail')): ?>
                    <p class="help-block text-danger text-center"><?php echo e(Session::get('fail')); ?></p>
                <?php endif; ?>
                <?php if(Session::has('success')): ?>
                    <p class="help-block text-success text-center"><?php echo e(Session::get('success')); ?></p>
                <?php endif; ?>
                <?php if(Session::has('warning')): ?>
                    <div class="alert alert-warning text-center my-2 mx-2"><?php echo e(Session::get('warning')); ?></div>
                <?php endif; ?>
            </div>
            <?php echo $__env->yieldContent('content'); ?>
        </div>
        <!-- Content End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo e(URL::to('account/lib/chart/chart.min.js')); ?>"></script>
    <script src="<?php echo e(URL::to('account/lib/easing/easing.min.js')); ?>"></script>
    <script src="<?php echo e(URL::to('account/lib/waypoints/waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(URL::to('account/lib/owlcarousel/owl.carousel.min.js')); ?>"></script>
    <script src="<?php echo e(URL::to('account/lib/tempusdominus/js/moment.min.js')); ?>"></script>
    <script src="<?php echo e(URL::to('account/lib/tempusdominus/js/moment-timezone.min.js')); ?>"></script>
    <script src="<?php echo e(URL::to('account/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')); ?>"></script>

    <!-- Template Javascript -->
    <script src="<?php echo e(URL::to('account/js/main.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('account/js/sweetalert2.min.js')); ?>"></script>
    <?php echo $__env->yieldContent('js'); ?>
</body>

</html>
<?php /**PATH C:\AppsWeb\QuaiAntique\resources\views/client/main.blade.php ENDPATH**/ ?>