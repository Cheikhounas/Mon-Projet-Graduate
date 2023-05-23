@extends("account.main")
@section('content')
            <div class="container-fluid pt-4 px-4">
                <div class="d-flex justify-content-end">
                    <a href="{{route('addutilisateur')}}" class="btn btn-link text-warning">Ajouter</a>
                  </div>
                <div class="row g-4 justify-content-center" >
                    @if (!empty($users))
                    <div class="bg-secondary rounded h-100 p-4 col-8">
                        <h6 class="mb-4">Les utilisateurs</h6>
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Pseudo</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($users as $k => $user)
                                <tr>
                                    <th scope="row">{{$k + 1}}</th>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->type}}</td>
                                    <td>
                                        @if ($user->id == 1)
                                            Super Admin
                                        @else
                                        <a href="{{route('editutilisateur', [$user->id])}}"><i class="fa fa-edit me-2"></i></a>
                                        <a href="{{route('deleteutilisateur', [$user->id])}}" class="deleteU"><i class="fa fa-trash me-2"></i>
                                        </a>                                           
                                        @endif
 
                                    </td>
                                </tr>                                    
                                @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                <h4 class="text-center">Pas d'utilisateur trouvé !!!<br> cliquez <a href="{{ route('addutilisateur') }}"
                    class="text-warning">ici</a> pour ajouter</h4>
                @endif
            </div>
@endsection
@if (!empty($users))
    @section('js')
        <script>
            $(function() {
                $(".deleteU").click(function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Supprimer',
                        text: 'Utilisateur sera supprimé definitivement',
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
