
<?php $__env->startSection('pagehead'); ?>
    <!-- Page Header Start -->
    <div class="page-header mb-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Page d'Accueil</h2>
                </div>
                <div class="col-12">
                    <a href="">Accueil</a>
                </div>
                <div class="mt-3 col-12">
                    <a href="<?php echo e(route('reserver')); ?>" class="btn custom-btn">Réserver</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- About Start -->
    <div class="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-img">
                        <img src="img/about.jpg" alt="Image">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content">
                        <div class="section-header">
                            <p>À Propos</p>
                            <h2><?php echo e(config('app.name')); ?> - Restaurant</h2>
                        </div>
                        <div class="about-text">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur
                                facilisis ornare velit non vulputate. Aliquam metus tortor, auctor id gravida condimentum,
                                viverra quis sem.
                            </p>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur
                                facilisis ornare velit non vulputate. Aliquam metus tortor, auctor id gravida condimentum,
                                viverra quis sem. Curabitur non nisl nec nisi scelerisque maximus. Aenean consectetur
                                convallis porttitor. Aliquam interdum at lacus non blandit.
                            </p>
                            <a class="btn custom-btn" href="<?php echo e(route('reserver')); ?>">Réserver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppsWeb\QuaiAntique\resources\views/index.blade.php ENDPATH**/ ?>