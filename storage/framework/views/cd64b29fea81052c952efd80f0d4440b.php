
<?php $__env->startSection('pagehead'); ?>
    <!-- Page Header Start -->
    <div class="page-header mb-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Nos Menus</h2>
                </div>
                <div class="col-12">
                    <a href="">Menus</a>
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
                <h2>Menus <?php echo e(config('app.name')); ?></h2>
            </div>
            <div class="container">
                <?php if(!empty($menus)): ?>
                <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>      
                <?php
                    $formules = Helper::formulesDuMenu($menu->id);
                ?>
                <div class="row justify-content-center">
                    <?php if($menu->nombre_formules > 0): ?>
                    <div class="col-lg-6 col-md-12">
                        <h3 class="text-center"><?php echo e($menu->titre); ?></h3>
                        <hr>
                        <?php $__currentLoopData = $formules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $idsPlats = explode("%",$formule->plats);
                            $lastPlt = end($idsPlats);
                        ?>
                        <div class="menu-item">
                            
                            <div class="menu-text">
                                <h3><span><?php echo e($formule->titre); ?></span> <strong><?php echo e($formule->prix); ?>€</strong></h3>
                                <p class="text-muted">(<?php echo e(substr($formule->description, 0, 50)); ?>...)</p><br>
                                <?php
                                    $frmlPlts ="";
                                ?>
                                <?php $__currentLoopData = $idsPlats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $plat = Helper::returnPlat($id);
                                        if ($lastPlt !== $id) {
                                            $frmlPlts .=  $plat->titre . " + ";
                                        }
                                        $frmlPlts .=  $plat->titre;
                                    ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <p class="font-weight-bolder text-center"><?php echo e($frmlPlts); ?></p>
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

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppsWeb\QuaiAntique\resources\views/account/voiremenu.blade.php ENDPATH**/ ?>