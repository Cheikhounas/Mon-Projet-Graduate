@extends('account.main')
@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
      <div class="row g-4">
          <div class="col-sm-6 col-xl-3">
            <a href="{{route('carte')}}">
              <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                  <i class="fa fa-chart-line fa-3x text-primary"></i>
                  <div class="ms-3">
                      <p class="mb-2">Publier</p>
                      <h6 class="mb-0">La Carte</h6>
                  </div>
              </div>
            </a>  
          </div>
          <div class="col-sm-6 col-xl-3">
            <a href="{{route('galerie')}}">
              <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                  <i class="fa fa-image fa-3x text-primary"></i>
                  <div class="ms-3">
                      <p class="mb-2">Galerie</p>
                      <h6 class="mb-0">d'Images</h6>
                  </div>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-xl-3">
            <a href="{{route('reservations')}}">
              <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                  <i class="fa fa-table fa-3x text-primary"></i>
                  <div class="ms-3">
                      <p class="mb-2">Réservations</p>
                      <h6 class="mb-0">Avec détails</h6>
                  </div>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-xl-3">
            <a href="{{route('horaires')}}">
              <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                  <i class="fa fa-clock fa-3x text-primary"></i>
                  <div class="ms-3">
                      <p class="mb-2">Horaires</p>
                      <h6 class="mb-0">d'ouverture</h6>
                  </div>
              </div>
            </a>
          </div>
      </div>
  </div>
  <!-- Sale & Revenue End -->
@endsection