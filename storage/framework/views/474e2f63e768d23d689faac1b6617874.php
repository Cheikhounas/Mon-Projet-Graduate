
<?php $__env->startSection('pagehead'); ?>
    <!-- Page Header Start -->
    <div class="page-header mb-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Connexion</h2>
                </div>
                <div class="col-12">
                    <a href="">Connexion</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="mt-5 container">
        <div class="row justify-content-center">
            <div class="booking-form col-6">
                
                <form method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="control-group">
                        <div class="input-group">
                            <input type="email" class="form-control" name="email" placeholder="Email" required="required">
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="far fa-envelope"></i></div>
                            </div>
                        </div>
                        <?php if($errors->has('email')): ?>
                            <p class="help-block text-danger"><?php echo e($errors->first('email')); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="control-group  my-3">
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" placeholder="Mot de Passe"
                                required="required">
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fa fa-lock"></i></div>
                            </div>
                        </div>
                        <?php if($errors->has('password')): ?>
                            <p class="help-block text-danger"><?php echo e($errors->first('password')); ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <button class="btn custom-btn" type="submit">Se Connecter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppsWeb\QuaiAntique\resources\views/account/login.blade.php ENDPATH**/ ?>