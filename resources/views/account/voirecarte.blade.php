@extends('main')
@section('pagehead')
    <!-- Page Header Start -->
    <div class="page-header mb-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Carte Restaurant</h2>
                </div>
                <div class="col-12">
                    <a href="">Carte</a>
                </div>
                <div class="mt-3 col-12">
                    <a href="{{route('reserver')}}" class="btn custom-btn">Réserver</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
@endsection
@section('content')
    <!-- Carte Start -->
    <div class="menu">
        <div class="container">
            <div class="section-header text-center">
                <h2>Carte {{ config('app.name') }}</h2>
            </div>
            <div class="container">
                @if (!empty($categories))
                @foreach ($categories as $categorie)      
                @php
                    $plats = Helper::categoriePlats($categorie->id);
                @endphp
                <div class="row justify-content-center">
                    @if ($categorie->nombre_plats > 0)
                    <div class="col-lg-6 col-md-12">
                        <h3 class="text-center">{{$categorie->titre}}</h3>
                        <hr>
                        @foreach ($plats as $plat)
                        @php
                            $image = Helper::platImage($plat->titre);
                        @endphp
                        <div class="menu-item">
                            <div class="menu-img">
                                <img class="rounded" @if ($image !== "") src="{{URL::to($image)}}" @else src="{{URL::to('img/default.jpg')}}" @endif  alt="Image" width="100" >
                            </div>
                            <div class="menu-text">
                                <h3><span>{{$plat->titre}}</span> <strong>{{$plat->prix}}€</strong></h3>
                                <p>{{ substr($plat->description, 0, 50) }}...</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    <!-- Carte End -->
@endsection
