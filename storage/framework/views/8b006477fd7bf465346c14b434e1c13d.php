<?php $__env->startSection('content'); ?>
            <div class="container-fluid pt-4 px-4">
                <div class="d-flex justify-content-end">
                    <a href="<?php echo e(route('addutilisateur')); ?>" class="btn btn-link text-warning">Ajouter</a>
                  </div>
                <div class="row g-4 justify-content-center" >
                    <?php if(!empty($users)): ?>
                    <div class="bg-secondary rounded h-100 p-4 col-8">
                        <h6 class="mb-4">Les utilisateurs</h6>
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Pseudo</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($k + 1); ?></th>
                                    <td><?php echo e($user->email); ?></td>
                                    <td><?php echo e($user->name); ?></td>
                                    <td><?php echo e($user->type); ?></td>
                                    <td>
                                        <?php if($user->id == 1): ?>
                                            Super Admin
                                        <?php else: ?>
                                        <a href="<?php echo e(route('editutilisateur', [$user->id])); ?>"><i class="fa fa-edit me-2"></i></a>
                                        <a href="<?php echo e(route('deleteutilisateur', [$user->id])); ?>" class="deleteU"><i class="fa fa-trash me-2"></i>
                                        </a>                                           
                                        <?php endif; ?>
 
                                    </td>
                                </tr>                                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php else: ?>
                <h4 class="text-center">Pas d'utilisateur trouvé !!!<br> cliquez <a href="<?php echo e(route('addutilisateur')); ?>"
                    class="text-warning">ici</a> pour ajouter</h4>
                <?php endif; ?>
            </div>
<?php $__env->stopSection(); ?>
<?php if(!empty($users)): ?>
    <?php $__env->startSection('js'); ?>
        <script>
            $(function() {
                $(".deleteU").click(function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Supprimer',
                        text: 'Utilisateur sera supprimé definitivement',
                        icon: 'warning',
                        showCancelButton: true,
                        cancelButtonText: "Annuler",
                        cancelButtonColor: "green",
                        showConfirmButton: true,
                        confirmButtonColor: "red",
                        confirmButtonText: "Supprimer",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).unbind('click');
                            e.currentTarget.click();
                        }
                    })
                });
            })
        </script>
    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make("account.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppsWeb\QuaiAntique\resources\views/account/utilisateurs.blade.php ENDPATH**/ ?>