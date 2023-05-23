@extends("account.main")
@section('content')
            <div class="container-fluid pt-4 px-4">
                <div class="d-flex justify-content-end">
                    <a href="{{route('addmenu')}}" class="btn btn-link text-warning">Ajouter</a>
                  </div>
                <div class="row g-4 justify-content-center" >
                    @if (!empty($menus))
                    <div class="bg-secondary rounded h-100 p-4 col-8">
                        <h6 class="mb-4">Menus</h6>
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Titre</th>
                                    <th scope="col">Nombre Formules</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($menus as $k => $menu)
                                <tr>
                                    <th scope="row">{{$k + 1}}</th>
                                    <td>{{$menu->titre}}</td>
                                    <td>{{$menu->nombre_formules}}</td>
                                    <td>
                                        <a href="{{route('editmenu', [$menu->id])}}"><i class="fa fa-edit me-2"></i></a>
                                        <a href="{{route('deletemenu', [$menu->id])}}" class="deleteM"><i class="fa fa-trash me-2"></i>
                                        </a>
                                    </td>
                                </tr>                                    
                                @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                <h4 class="text-center">Aucun menu trouvé !!!<br> cliquez <a href="{{ route('addmenu') }}"
                    class="text-warning">ici</a> pour ajouter</h4>
                @endif
            </div>
@endsection
@if (!empty($menus))
    @section('js')
        <script>
            $(function() {
                $(".deleteM").click(function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Supprimer',
                        text: 'Menu sera supprimé definitivement',
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
