@extends('account.main')
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="d-flex justify-content-end">
        <a href="{{ route('addhoraire') }}" class="btn btn-link text-warning">Ajouter un Horaire</a>
    </div>
    @if (!empty($horaires))
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Les Horaires d'Ouverture</h6>
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Jour</th>
                    <th scope="col">Midi</th>
                    <th scope="col">Soir</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($horaires as $k => $horaire)
                @php
                    $jourTitre = Helper::returnNameBlongsToId($horaire->jour_id, 'jours');
                @endphp
                <tr>
                    <th scope="row">{{$k + 1}}</th>
                    <td>{{$jourTitre}}</td>
                    <td>{{$horaire->ouverture_midi}} - {{$horaire->fermeture_midi}}</td>
                    <td>{{$horaire->ouverture_soir}} - {{$horaire->fermeture_soir}}</td>
                    <td>
                        <a href="{{route('edithoraire', [$horaire->id])}}"><i class="fa fa-edit me-2"></i></a>
                        <a href="{{route('deletehoraire', [$horaire->id])}}" class="deleteH"><i class="fa fa-trash me-2"></i>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div> 
    @else
    <h4 class="text-center">Aucun horaire trouvé !!!<br> cliquez <a href="{{ route('addhoraire') }}"
        class="text-warning">ici</a> pour ajouter</h4>
    @endif
</div>
@endsection
@if (!empty($horaires))
    @section('js')
        <script>
            $(function() {
                $(".deleteH").click(function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Supprimer',
                        text: 'L\'Horaire sera supprimé définitivement',
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