@extends('main')
@section('pagehead')
    <!-- Page Header Start -->
    <div class="page-header mb-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Nos Menus</h2>
                </div>
                <div class="col-12">
                    <a href="">Menus</a>
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
                <h2>Menus {{ config('app.name') }}</h2>
            </div>
            <div class="container">
                @if (!empty($menus))
                @foreach ($menus as $menu)      
                @php
                    $formules = Helper::formulesDuMenu($menu->id);
                @endphp
                <div class="row justify-content-center">
                    @if ($menu->nombre_formules > 0)
                    <div class="col-lg-6 col-md-12">
                        <h3 class="text-center">{{$menu->titre}}</h3>
                        <hr>
                        @foreach ($formules as $formule)
                        @php
                            $idsPlats = explode("%",$formule->plats);
                            $lastPlt = end($idsPlats);
                        @endphp
                        <div class="menu-item">
                            {{-- <div class="menu-img">
                                <img class="rounded" @if ($image !== "") src="{{URL::to($image)}}" @else src="{{URL::to('img/default.jpg')}}" @endif  alt="Image" width="100" >
                            </div> --}}
                            <div class="menu-text">
                                <h3><span>{{$formule->titre}}</span> <strong>{{$formule->prix}}€</strong></h3>
                                <p class="text-muted">({{ substr($formule->description, 0, 50) }}...)</p><br>
                                @php
                                    $frmlPlts ="";
                                @endphp
                                @foreach ($idsPlats as $id)
                                    @php
                                        $plat = Helper::returnPlat($id);
                                        if ($lastPlt !== $id) {
                                            $frmlPlts .=  $plat->titre . " + ";
                                        }
                                        $frmlPlts .=  $plat->titre;
                                    @endphp
                                @endforeach
                                <p class="font-weight-bolder text-center">{{$frmlPlts}}</p>
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
