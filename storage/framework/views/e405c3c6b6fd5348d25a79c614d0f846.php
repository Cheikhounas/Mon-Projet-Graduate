
<?php $__env->startSection('pagehead'); ?>
    <!-- Page Header Start -->
    <div class="page-header mb-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Crée votre compte</h2>
                </div>
                <div class="col-12">
                    <a href="">Création de compte</a>
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
                <?php if(Session::has('fail')): ?>
                    <p class="help-block text-danger text-center"><?php echo e(Session::get('fail')); ?></p>
                <?php endif; ?>
                <?php if(Session::has('success')): ?>
                    <p class="help-block text-success text-center"><?php echo e(Session::get('success')); ?></p>
                <?php endif; ?>
                <form method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="control-group mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="name" placeholder="Pseudo" required="required">
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="far fa-keyboard"></i></div>
                            </div>
                        </div>
                        <?php if($errors->has('name')): ?>
                            <p class="help-block text-danger"><?php echo e($errors->first('name')); ?></p>
                        <?php endif; ?>
                    </div>
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
                    <div class="control-group  my-3">
                        <div class="input-group">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmation"
                                required="required">
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fa fa-lock"></i></div>
                            </div>
                        </div>
                        <?php if($errors->has('password_confirmation')): ?>
                            <p class="help-block text-danger"><?php echo e($errors->first('password_confirmation')); ?></p>
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

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppsWeb\QuaiAntique\resources\views/newclient.blade.php ENDPATH**/ ?>