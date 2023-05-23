<?php $__env->startSection('content'); ?>
            <div class="container-fluid pt-4 px-4">
                <div class="d-flex justify-content-end">
                    <?php if(!empty($data) && isset($data[0])): ?>
                    <a href="<?php echo e(route('editdefaultdata',[$data[0]->id])); ?>" class="btn btn-link text-warning">Modifier les Données</a>
                    <?php else: ?>
                    <a href="<?php echo e(route('defaultdata')); ?>" class="btn btn-link text-warning">Données</a>
                    <?php endif; ?>
                  </div>
                <div class="row g-4 justify-content-center" >
                    <?php if(!empty($data) && isset($data[0])): ?>
                    <div class="bg-secondary rounded h-100 p-4 col-8">
                        <h4 class="mb-4">Le nombre de convives par défaut est: <span class="text-danger"> <?php echo e($data[0]->convives); ?></span><br>
                        Les allergies: <span class="text-danger"><?php if($data[0]->allergies !== null || $data[0]->allergies !== "null"): ?>
                            <?php echo e(str_replace("%", ",", $data[0]->allergies)); ?><?php else: ?> RAS <?php endif; ?></span>
                        </h4>
                    </div>
                </div>
                <?php else: ?>
                <h4 class="text-center">Vous n'avez pas fixé des données par défaut !!!<br> cliquez <a href="<?php echo e(route('defaultdata')); ?>"
                    class="text-warning">ici</a> pour ajouter.</h4>
                <?php endif; ?>
            </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("client.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppsWeb\QuaiAntique\resources\views/client/userdata.blade.php ENDPATH**/ ?>