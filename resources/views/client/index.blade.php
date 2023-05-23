@extends('client.main')
@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <h4 class="text-center my-2">Quai Antique vous souhaite la bienvenue</h4>
      <div class="row g-4">
          <div class="col-sm-6 col-xl-3">
            <a href="{{ route('userdata') }}">
              <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                  <i class="fa fa-chart-line fa-3x text-primary"></i>
                  <div class="ms-3">
                      <p class="mb-2">Données</p>
                      <h6 class="mb-0">Par défaut</h6>
                  </div>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-xl-3">
            <a href="{{ route('reserver') }}">
              <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                  <i class="fa fa-chart-bar fa-3x text-primary"></i>
                  <div class="ms-3">
                      <p class="mb-2">Réservation</p>
                      <h6 class="mb-0">rapide</h6>
                  </div>
              </div>
            </a>
          </div>
      </div>
  </div>
  <!-- Sale & Revenue End -->
@endsection