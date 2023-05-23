@extends('account.main')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="d-flex justify-content-end">
            <a href="{{ route('addformule') }}" class="btn btn-link text-warning">Ajouter une formule</a>
        </div>
        @if (!empty($formules))
        <div class="bg-secondary rounded h-100 p-4">
            <h6 class="mb-4">Liste des formules</h6>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($formules as $k => $formule)
                    <tr>
                        <th scope="row">{{$k + 1}}</th>
                        <td>{{$formule->titre}}</td>
                        <td>{{Helper::returnMenuFormule($formule->menu_id)}}</td>
                        <td>{{$formule->prix}}</td>
                        <td>
                            <a href="{{route('editformule', [$formule->id])}}"><i class="fa fa-edit me-2"></i></a>
                            <a href="{{route('deleteformule', [$formule->id])}}" class="deleteF"><i class="fa fa-trash me-2"></i>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div> 
        @else
        <h4 class="text-center">Aucune formule trouvée !!!<br> cliquez <a href="{{ route('addformule') }}"
            class="text-warning">ici</a> pour ajouter</h4>
        @endif
        <br><br><br><br>
    </div>
@endsection
@if (!empty($formules))
    @section('js')
        <script>
            $(function() {
                $(".deleteF").click(function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Supprimer',
                        text: 'Formule sera supprimée definitivement',
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