@extends("account.main")
@section('content')
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4 justify-content-center" >
                    @if (!empty($reservations))
                    <div class="bg-secondary rounded h-100 p-4 col-8">
                        <h6 class="mb-4">Réservations</h6>
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($reservations as $k => $reservation)
                                <tr>
                                    <th scope="row">{{$k + 1}}</th>
                                    <td>{{$reservation->date}}</td>
                                    <td>
                                        <a href="{{route('voirereservation', [$reservation->id])}}" class="me-2">Voire</a>
                                        <a href="{{route('deletereservation', [$reservation->id])}}" class="deleteR"><i class="fa fa-trash me-2"></i></a>
                                    </td>
                                </tr>                                    
                                @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                <h4 class="text-center">Aucune menu trouvée !!!</h4>
                @endif
            </div>
@endsection
@if (!empty($reservations))
    @section('js')
        <script>
            $(function() {
                $(".deleteR").click(function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Supprimer',
                        text: 'Réservation sera supprimée definitivement',
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
