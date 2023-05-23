@extends("account.main")
@section('content')
            <div class="container-fluid pt-4 px-4">
                <div class="d-flex justify-content-end">
                    <a href="{{route('addjour')}}" class="btn btn-link text-warning">Ajouter</a>
                  </div>
                <div class="row g-4 justify-content-center" >
                    @if (!empty($jours))
                    <div class="bg-secondary rounded h-100 p-4 col-8">
                        <h6 class="mb-4">Jours Ouvrables</h6>
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Titre</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($jours as $k => $jour)
                                <tr>
                                    <th scope="row">{{$k + 1}}</th>
                                    <td>{{$jour->titre}}</td>
                                    <td>
                                        <a href="{{route('editjour', [$jour->id])}}"><i class="fa fa-edit me-2"></i></a>
                                        <a href="{{route('deletejour', [$jour->id])}}" class="deleteJ"><i class="fa fa-trash me-2"></i>
                                        </a>
                                    </td>
                                </tr>                                    
                                @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                <h4 class="text-center">Aucun jour ouvrable trouvé !!!<br> cliquez <a href="{{ route('addjour') }}"
                    class="text-warning">ici</a> pour ajouter</h4>
                @endif
            </div>
@endsection
@if (!empty($jours))
    @section('js')
        <script>
            $(function() {
                $(".deleteJ").click(function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Supprimer',
                        text: 'Jour sera supprimé definitivement',
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
