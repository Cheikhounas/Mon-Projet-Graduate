@extends("account.main")
@section('content')
@php
    $username = $reservation->user_id !== 0 ? "Client" : "Visiteur";
    $allergies = $reservation->allergies !== null || $reservation->allergies !== 'null' ? str_replace("%", ",", $reservation->allergies): "RAS";
@endphp
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4 justify-content-center" >
                    <div class="bg-secondary rounded h-100 p-4 col-8">
                        <h4 class="my-3">Détails de la Réservation</h4>
                        <p><span class="text-warning">Qui: </span>{{$username}}</p>
                        <p><span class="text-warning">Convives: </span>{{$reservation->convives}}</p>
                        <p><span class="text-warning">Date: </span>{{$reservation->date}}</p>
                        <p><span class="text-warning">Allergies: </span>{{($allergies)}}</p>
                    </div>
                </div>
            </div>
@endsection
