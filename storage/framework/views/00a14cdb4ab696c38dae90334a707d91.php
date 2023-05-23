<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo e(config('app.name')); ?> - Restaurant </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Nunito:600,700" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <!-- Template Stylesheet -->
    <link rel="stylesheet" href="<?php echo e(URL::to('account/css/sweetalert.min.css')); ?>">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Nav Bar Start -->
    <div class="navbar navbar-expand-lg bg-light navbar-light">
        <div class="container-fluid">
            <a href="<?php echo e(route('accueil')); ?>" class="navbar-brand"><?php echo e(config('app.name')); ?></a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto">
                    <a href="<?php echo e(route('accueil')); ?>" class="nav-item nav-link  <?php echo e(Helper::activeLink(['accueil'])); ?>">Accueil</a>
                    <a href="<?php echo e(route('login')); ?>" class="nav-item nav-link <?php echo e(Helper::activeLink(['login'])); ?>">Connexion</a>
                    <a href="<?php echo e(route('reserver')); ?>" class="nav-item nav-link <?php echo e(Helper::activeLink(['reserver'])); ?>">Réserver</a>
                    <a href="<?php echo e(route('newclient')); ?>" class="nav-item nav-link <?php echo e(Helper::activeLink(['newclient'])); ?>">Crée un compte</a>
                    <?php if(Session::has('userlogged')): ?>
                        <a <?php if(Session::get('usertype') == 'admin'): ?> href="<?php echo e(route('userportal')); ?>" <?php else: ?> href="<?php echo e(route('clientportal')); ?>" <?php endif; ?>
                            class="nav-item nav-link">Votre Compte</a>
                    <?php endif; ?>
                    <a href="<?php echo e(route('voirecarte')); ?>" class="nav-item nav-link <?php echo e(Helper::activeLink(['voirecarte'])); ?>">Carte</a>
                    <a href="<?php echo e(route('voiremenu')); ?>" class="nav-item nav-link <?php echo e(Helper::activeLink(['voiremenu'])); ?>">Menu</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Nav Bar End -->
    <?php echo $__env->yieldContent('pagehead'); ?>
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
    <!-- Footer Start -->
    <div class="footer">
        <div class="container">
            <h2 class="text-center mb-3">Nos Horaires d'Ouverture</h2>
            <?php
                $semaine_jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
                $table_jours = Helper::returnJours();
                $tableJours = [];
                foreach ($table_jours as $table_jour) {
                    array_push($tableJours, $table_jour->titre);
                }
                
            ?>
            <div class="row justify-content-center pb-5">
                <?php $__currentLoopData = $semaine_jours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $semaine_jour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="mx-4">
                        <div class="footer-contact">
                            <h2><?php echo e($semaine_jour); ?></h2>
                            <?php if(in_array($semaine_jour, $tableJours)): ?>
                                <?php
                                    $jour = Helper::selectJour($semaine_jour);
                                    $horaires = Helper::horairesJour($jour->id);
                                ?>
                                <?php if(!empty($horaires) && isset($horaires[0])): ?>
                                    <p><?php echo e($horaires[0]->ouverture_midi); ?> - <?php echo e($horaires[0]->fermeture_midi); ?></p>
                                    <p><?php echo e($horaires[0]->ouverture_soir); ?> - <?php echo e($horaires[0]->fermeture_soir); ?></p>
                                <?php else: ?>
                                    <p>Fermé</p>
                                <?php endif; ?>
                            <?php else: ?>
                                <p>Fermé</p>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>
    <!-- Template Javascript -->
    <script src="<?php echo e(URL::asset('account/js/sweetalert2.min.js')); ?>"></script>
    <script src="js/main.js"></script>
    <?php echo $__env->yieldContent('js'); ?>
</body>

</html>
<?php /**PATH C:\AppsWeb\QuaiAntique\resources\views/main.blade.php ENDPATH**/ ?>