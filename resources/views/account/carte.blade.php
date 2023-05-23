@extends('account.main')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="d-flex justify-content-end">
            <a href="{{ route('addplat') }}" class="btn btn-link text-warning">Ajouter un plat</a>
        </div>
        @if (!empty($plats))
        <div class="bg-secondary rounded h-100 p-4">
            <h6 class="mb-4">Liste des plats</h6>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Catégorie</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plats as $k => $plat)
                    <tr>
                        <th scope="row">{{$k + 1}}</th>
                        <td>{{$plat->titre}}</td>
                        <td>{{Helper::returnPlatCategorie($plat->categorie_id)}}</td>
                        <td>{{$plat->prix}}</td>
                        <td>
                            <a href="{{route('editplat', [$plat->id])}}"><i class="fa fa-edit me-2"></i></a>
                            <a href="{{route('deleteplat', [$plat->id])}}" class="deleteP"><i class="fa fa-trash me-2"></i>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div> 
        <div class="col-12 d-flex flex-row-reverse">
            <a href="{{ route('voirecarte') }}">
                <button type="button" class="btn btn-dark rounded-pill m-2">Carte du restaurant</button>
            </a>
        </div>      
        @else
        <h4 class="text-center">Aucun plat trouvé !!!<br> cliquez <a href="{{ route('addplat') }}"
            class="text-warning">ici</a> pour ajouter</h4>
        @endif
        <br><br><br><br>
    </div>
@endsection
@if (!empty($plats))
    @section('js')
        <script>
            $(function() {
                $(".deleteP").click(function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Supprimer',
                        text: 'Plat sera supprimé definitivement',
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
    @endsection
@endif