@extends('main')
@section('pagehead')
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
@endsection
@section('content')
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
                            @csrf
                            <div class="control-group mb-3">
                                <label for="">Nombre de couverts</label>
                                <div class="input-group">
                                    <select class="custom-select form-control" name="nb_convives" id="convives" required>
                                        <option selected>----Choisissez le nombre de convives----</option>
                                        @for ($i = 1; $i <= 20; $i++)
                                            @if ($data->convives == $i)
                                                <option selected value="{{ $i }}">{{ $i }}</option>
                                            @else
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endif
                                        @endfor
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fa fa-chevron-down"></i></div>
                                    </div>
                                </div>
                                @if ($errors->has('nb_convives'))
                                    <p class="help-block text-danger">{{ $errors->first('nb_convives') }}</p>
                                @endif
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
                                @if ($errors->has('date'))
                                    <p class="help-block text-danger">{{ $errors->first('date') }}</p>
                                @endif
                            </div>
                            <div class="control-group mb-3">
                                <label for="heure">Choisissez l'heure</label>
                                <div id="reservation_heure"></div>
                                @if ($errors->has('heure'))
                                    <p class="help-block text-danger">{{ $errors->first('heure') }}</p>
                                @endif
                            </div>
                            <div class="control-group mb-3">
                                <label for="">Mentionner des allergies</label>
                                <div class="input-group">
                                    <select class="custom-select form-control" name="allergies[]" multiple>
                                        @if ($data->allergies== null || $data->allergies == 'null')
                                        <option selected value="null">----Allergique au----</option>
                                        @endif
                                        @php
                                            $allergies = ['Gluten', 'Crustacés', 'Oeufs', 'Poissons', 'Arachides', 'Soja', 'Lait', 'Céleri', 'Mollusques', 'Olives'];
                                            $dataAllergies = $data->allergies !== null || $data->allergies !== 'null' ? explode('%', $data->allergies) : 'null';
                                        @endphp
                                        @foreach ($allergies as $allergie)
                                        @if (is_array($dataAllergies) && in_array($allergie, $dataAllergies))
                                        <option selected value="{{ $allergie }}">{{ $allergie }}</option>
                                        @else   
                                        <option value="{{ $allergie }}">{{ $allergie }}</option>
                                        @endif
                                        @endforeach

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
@endsection
@section('js')
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
                var url = "{{ route('ajaxgettoday') }}";
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
                var url = "{{ route('ajaxverifierseuil') }}";
                $.ajax({
                    method: 'POST',
                    url: url,
                    data: {
                        var: convives,
                        _token: '{{ csrf_token() }}'
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
@endsection
