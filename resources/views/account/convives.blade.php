@extends("account.main")
@section('content')
            <div class="container-fluid pt-4 px-4">
                <div class="d-flex justify-content-end">
                    @if (!empty($convives) && isset($convives[0]))
                    <a href="{{route('editconvivesseuil',[$convives[0]->id])}}" class="btn btn-link text-warning">Modifier le nombre</a>
                    @else
                    <a href="{{route('setconvivesseuil')}}" class="btn btn-link text-warning">Fixer un nombre</a>
                    @endif
                  </div>
                <div class="row g-4 justify-content-center" >
                    @if (!empty($convives) && isset($convives[0]))
                    <div class="bg-secondary rounded h-100 p-4 col-8">
                        <h4 class="mb-4">Le nombre maximum de convives est: <span class="text-danger"> {{$convives[0]->nombre_max}}</span></h4>
                    </div>
                </div>
                @else
                <h4 class="text-center">Vous n'avez pas fixé de nombre seuil !!!<br> cliquez <a href="{{ route('setconvivesseuil') }}"
                    class="text-warning">ici</a> fixer un nombre</h4>
                @endif
            </div>
@endsection
