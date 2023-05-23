@extends("account.main")
@section('content')
            <div class="container-fluid pt-4 px-4">
                <div class="d-flex justify-content-end">
                    <a href="{{route('addcategorie')}}" class="btn btn-link text-warning">Ajouter</a>
                  </div>
                <div class="row g-4 justify-content-center" >
                    @if (!empty($categories))
                    <div class="bg-secondary rounded h-100 p-4 col-8">
                        <h6 class="mb-4">Categories</h6>
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Titre</th>
                                    <th scope="col">Nombre Plats</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($categories as $k => $category)
                                <tr>
                                    <th scope="row">{{$k + 1}}</th>
                                    <td>{{$category->titre}}</td>
                                    <td>{{$category->nombre_plats}}</td>
                                    <td>
                                        <a href="{{route('editcategorie', [$category->id])}}"><i class="fa fa-edit me-2"></i></a>
                                        <a href="{{route('deletecategorie', [$category->id])}}" class="deleteC"><i class="fa fa-trash me-2"></i>
                                        </a>
                                    </td>
                                </tr>                                    
                                @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                <h4 class="text-center">Aucune catégorie trouvée !!!<br> cliquez <a href="{{ route('addcategorie') }}"
                    class="text-warning">ici</a> pour ajouter</h4>
                @endif
            </div>
@endsection
@if (!empty($categories))
    @section('js')
        <script>
            $(function() {
                $(".deleteC").click(function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Supprimer',
                        text: 'Categorie sera supprimé definitivement',
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
