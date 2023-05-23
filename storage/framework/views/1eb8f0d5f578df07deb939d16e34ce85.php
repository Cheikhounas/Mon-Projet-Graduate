
<?php $__env->startSection('pagehead'); ?>
    <!-- Page Header Start -->
    <div class="page-header mb-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Réserver Une Table</h2>
                </div>
                <div class="col-12">
                    <a href="">Réserver</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Booking Start -->
    <div class="booking">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="section-header mt-2">
                        <h2 class="text-center">Réserver votre Table</h2>
                        <p class="text-center">Quai Antique vous souhaite un bon appétit</p>
                    </div>
                    <div class="">
                        <form action="" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="control-group mb-3">
                                <label for="">Nombre de couverts</label>
                                <div class="input-group">
                                    <select class="custom-select form-control" name="nb_convives" id="convives" required>
                                        <option selected>----Choisissez le nombre de convives----</option>
                                        <?php for($i = 1; $i <= 20; $i++): ?>
                                            <?php if($data->convives == $i): ?>
                                                <option selected value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fa fa-chevron-down"></i></div>
                                    </div>
                                </div>
                                <?php if($errors->has('nb_convives')): ?>
                                    <p class="help-block text-danger"><?php echo e($errors->first('nb_convives')); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="control-group mb-3">
                                <label for="date">Choississez la date</label>
                                <div class="input-group date" id="date" data-target-input="nearest">
                                    <input type="date" class="form-control" placeholder="mm/jj/aaaa" name="date"
                                        id="selectedDate" required>
                                    <div class="input-group-append" data-target="#date" data-toggle="datetimepicker">
                                        <div class="input-group-text" id="date_calendar"><i class="far fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                </div>
                                <?php if($errors->has('date')): ?>
                                    <p class="help-block text-danger"><?php echo e($errors->first('date')); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="control-group mb-3">
                                <label for="heure">Choisissez l'heure</label>
                                <div id="reservation_heure"></div>
                                <?php if($errors->has('heure')): ?>
                                    <p class="help-block text-danger"><?php echo e($errors->first('heure')); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="control-group mb-3">
                                <label for="">Mentionner des allergies</label>
                                <div class="input-group">
                                    <select class="custom-select form-control" name="allergies[]" multiple>
                                        <?php if($data->allergies== null || $data->allergies == 'null'): ?>
                                        <option selected value="null">----Allergique au----</option>
                                        <?php endif; ?>
                                        <?php
                                            $allergies = ['Gluten', 'Crustacés', 'Oeufs', 'Poissons', 'Arachides', 'Soja', 'Lait', 'Céleri', 'Mollusques', 'Olives'];
                                            $dataAllergies = $data->allergies !== null || $data->allergies !== 'null' ? explode('%', $data->allergies) : 'null';
                                        ?>
                                        <?php $__currentLoopData = $allergies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allergie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(is_array($dataAllergies) && in_array($allergie, $dataAllergies)): ?>
                                        <option selected value="<?php echo e($allergie); ?>"><?php echo e($allergie); ?></option>
                                        <?php else: ?>   
                                        <option value="<?php echo e($allergie); ?>"><?php echo e($allergie); ?></option>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </select>
                                    <div class="input-group-text"><i class="fa fa-chevron-down"></i></div>
                                </div>
                            </div>
                    </div>
                    <div class=" mb-3">
                        <button class="btn custom-btn" type="submit" id="btn_reserver">Réserver</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Booking End -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        $(function() {
            $("#selectedDate").on('change', function() {
                var d = new Date($(this).val());
                var jour = d.getDate();
                var mois = d.getMonth();
                mois++;
                var an = d.getFullYear();
                var selectedDate = mois + "/" + jour + "/" + an;
                var jours = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
                var date = new Date(selectedDate);
                var url = "<?php echo e(route('ajaxgettoday')); ?>";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: 'POST',
                    url: url,
                    data: {
                        var: selectedDate,
                    },
                    dataType: 'HTML',
                    success: function(response) {
                        if (response == "") {
                            // alert("Non ouvrable" + jours[date.getDay()]);
                            Swal.fire({
                                title: 'Ouverture',
                                text: 'Désolé on est fermé ' + jours[date.getDay()],
                                icon: 'warning',
                            });
                            $("#btn_reserver").prop("disabled", true);
                            $("#reservation_heure").html("");
                        } else {
                            $("#reservation_heure").html("");
                            $("#reservation_heure").html(response);
                            $("#btn_reserver").prop("disabled", false);
                        }

                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            $("#convives").on('change', function() {
                var convives = $(this).find("option:selected").val();
                var url = "<?php echo e(route('ajaxverifierseuil')); ?>";
                $.ajax({
                    method: 'POST',
                    url: url,
                    data: {
                        var: convives,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    dataType: 'HTML',
                    success: function(response) {
                        if (response == 0) {
                            Swal.fire({
                                title: 'Nombre de place trop élevé',
                                text: "Il n'y pas de place pour ce nombre de convives",
                                icon: 'warning',
                            });
                            $("#btn_reserver").prop("disabled", true);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            })
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppsWeb\QuaiAntique\resources\views/reserverdata.blade.php ENDPATH**/ ?>