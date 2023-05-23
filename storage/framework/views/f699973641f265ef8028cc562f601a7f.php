
<?php $__env->startSection('pagehead'); ?>
    <!-- Page Header Start -->
    <div class="page-header mb-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Carte Restaurant</h2>
                </div>
                <div class="col-12">
                    <a href="">Carte</a>
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
    <!-- Carte Start -->
    <div class="menu">
        <div class="container">
            <div class="section-header text-center">
                <h2>Carte <?php echo e(config('app.name')); ?></h2>
            </div>
            <div class="container">
                <?php if(!empty($categories)): ?>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>      
                <?php
                    $plats = Helper::categoriePlats($categorie->id);
                ?>
                <div class="row justify-content-center">
                    <?php if($categorie->nombre_plats > 0): ?>
                    <div class="col-lg-6 col-md-12">
                        <h3 class="text-center"><?php echo e($categorie->titre); ?></h3>
                        <hr>
                        <?php $__currentLoopData = $plats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $image = Helper::platImage($plat->titre);
                        ?>
                        <div class="menu-item">
                            <div class="menu-img">
                                <img class="rounded" <?php if($image !== ""): ?> src="<?php echo e(URL::to($image)); ?>" <?php else: ?> src="<?php echo e(URL::to('img/default.jpg')); ?>" <?php endif; ?>  alt="Image" width="100" >
                            </div>
                            <div class="menu-text">
                                <h3><span><?php echo e($plat->titre); ?></span> <strong><?php echo e($plat->prix); ?>€</strong></h3>
                                <p><?php echo e(substr($plat->description, 0, 50)); ?>...</p>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Carte End -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppsWeb\QuaiAntique\resources\views/account/voirecarte.blade.php ENDPATH**/ ?>