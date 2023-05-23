@extends('account.main')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="d-flex justify-content-end">
            <a href="{{ route('addimage') }}" class="btn btn-link text-warning">Ajouter</a>
        </div>
        @if (!empty($images))
            <div class="row justify-content-center">
                @foreach ($images as $image)
                <div class="card col-3 mx-1 mb-2" style="background-color: #191C24;">
                    <img class="card-img-top" src="{{URL::to($image->image)}}" alt="Card image">
                    <div class="card-body">
                        <p class="card-title">{{$image->titre}}</p>
                        <div class="d-flex justify-content-around">
                            <a href="{{route('editimage', [$image->id])}}" class="btn btn-link text-warning">Modifier</a>
                            <a href="{{route('deleteimage', [$image->id])}}" class="btn btn-link deleteI">Supprimer</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <h4 class="text-center">Aucune image trouvée !!!<br> cliquez <a href="{{ route('addimage') }}"
                    class="text-warning">ici</a> pour ajouter</h4>
        @endif

    </div>
@endsection
@if (!empty($images))
    @section('js')
        <script>
            $(function() {
                $(".deleteI").click(function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Supprimer',
                        text: 'L\'Image sera supprimé définitivement',
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