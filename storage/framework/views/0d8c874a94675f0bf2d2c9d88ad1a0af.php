
<?php $__env->startSection('content'); ?>
    <div class="container-fluid pt-4 px-4">
        <div class="d-flex justify-content-end">
            <a href="<?php echo e(route('utilisateurs')); ?>" class="btn btn-link text-warning">Annuler</a>
          </div>
        <div class="row justify-content-center">
            <div class="bg-secondary rounded h-100 p-4 col-8">
                <form method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-floating  mb-3">
                            <input type="text" class="form-control" name="name" placeholder="Pseudo" required="required">
                            <label for="floatingSelect">Pseudo</label>
                        <?php if($errors->has('name')): ?>
                            <p class="help-block text-danger"><?php echo e($errors->first('name')); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email" required="required">
                            <label for="floatingSelect">Email</label>
                        <?php if($errors->has('email')): ?>
                            <p class="help-block text-danger"><?php echo e($errors->first('email')); ?></p>
                        <?php endif; ?>
                    </div>
                    <label for="floatingSelect">Choisir le type d'utilisateur</label>
                    <select class="form-select" name="type" aria-label="Floating label select example" required>
                        <option selected value="client">Client</option>
                            <option value="admin">Admin</option>
                    </select>

                    <?php if($errors->has('type')): ?>
                        <p class="help-block text-danger"><?php echo e($errors->first('type')); ?></p>
                    <?php endif; ?>
                    <div class="form-floating  my-3">
                        <input type="password" class="form-control" name="password" placeholder="Mot de Passe"
                        required="required">
                        <label for="floatingSelect">Mot de Passe</label>
                        <?php if($errors->has('password')): ?>
                            <p class="help-block text-danger"><?php echo e($errors->first('password')); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-floating  my-3">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmation"
                                required="required">
                    <label for="floatingSelect">Confirmation</label>
                        <?php if($errors->has('password_confirmation')): ?>
                            <p class="help-block text-danger"><?php echo e($errors->first('password_confirmation')); ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <button class="btn btn-dark" type="submit">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('account.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppsWeb\QuaiAntique\resources\views/account/addutilisateur.blade.php ENDPATH**/ ?>