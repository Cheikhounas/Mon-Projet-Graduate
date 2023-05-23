@extends("client.main")
@section('content')
            <div class="container-fluid pt-4 px-4">
                <div class="d-flex justify-content-end">
                    @if (!empty($data) && isset($data[0]))
                    <a href="{{route('editdefaultdata',[$data[0]->id])}}" class="btn btn-link text-warning">Modifier les Données</a>
                    @else
                    <a href="{{route('defaultdata')}}" class="btn btn-link text-warning">Données</a>
                    @endif
                  </div>
                <div class="row g-4 justify-content-center" >
                    @if (!empty($data) && isset($data[0]))
                    <div class="bg-secondary rounded h-100 p-4 col-8">
                        <h4 class="mb-4">Le nombre de convives par défaut est: <span class="text-danger"> {{$data[0]->convives}}</span><br>
                        Les allergies: <span class="text-danger">@if ($data[0]->allergies !== null || $data[0]->allergies !== "null")
                            {{str_replace("%", ",", $data[0]->allergies)}}@else RAS @endif</span>
                        </h4>
                    </div>
                </div>
                @else
                <h4 class="text-center">Vous n'avez pas fixé des données par défaut !!!<br> cliquez <a href="{{ route('defaultdata') }}"
                    class="text-warning">ici</a> pour ajouter.</h4>
                @endif
            </div>
@endsection
