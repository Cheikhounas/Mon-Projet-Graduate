@extends('account.main')
@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="d-flex justify-content-end">
            <a href="{{ route('convives') }}" class="btn btn-link">Annuler</a>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="bg-secondary rounded h-100 p-4 col-8">
                <form action="" method="POST">
                    @csrf
                    <h6 class="mb-4">Nombre seuil de convives </h6>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput" name="nombre_max"
                            placeholder="Nombre seuil" value="100" required>
                        <label for="floatingInput">Nombre seuil</label>
                        @if ($errors->has('nombre_max'))
                            <p class="help-block text-danger">{{ $errors->first('nombre_max') }}</p>
                        @endif
                    </div>
                    <div class="form-floating">
                        <button class="btn btn-dark" type="submit">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->
@endsection
