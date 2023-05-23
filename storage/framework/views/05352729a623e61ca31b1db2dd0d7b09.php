<?php $__env->startSection('content'); ?>
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4 justify-content-center" >
                    <?php if(!empty($reservations)): ?>
                    <div class="bg-secondary rounded h-100 p-4 col-8">
                        <h6 class="mb-4">Réservations</h6>
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($k + 1); ?></th>
                                    <td><?php echo e($reservation->date); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('voirereservation', [$reservation->id])); ?>" class="me-2">Voire</a>
                                        <a href="<?php echo e(route('deletereservation', [$reservation->id])); ?>" class="deleteR"><i class="fa fa-trash me-2"></i></a>
                                    </td>
                                </tr>                                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php else: ?>
                <h4 class="text-center">Aucune menu trouvée !!!</h4>
                <?php endif; ?>
            </div>
<?php $__env->stopSection(); ?>
<?php if(!empty($reservations)): ?>
    <?php $__env->startSection('js'); ?>
        <script>
            $(function() {
                $(".deleteR").click(function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Supprimer',
                        text: 'Réservation sera supprimée definitivement',
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

<?php echo $__env->make("account.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppsWeb\QuaiAntique\resources\views/account/reservations.blade.php ENDPATH**/ ?>