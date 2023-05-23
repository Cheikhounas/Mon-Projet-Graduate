@extends('account.main')
@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="d-flex justify-content-end">
            <a href="{{ route('jours') }}" class="btn btn-link">Annuler</a>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="bg-secondary rounded h-100 p-4 col-8">
                <form action="" method="POST">
                    @csrf
                    <h6 class="mb-4">Modifier le Jour</h6>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="titre"
                            placeholder="Jour Titre" value="{{$jour->titre}}" required>
                            <input type="hidden" name="idJour" value="{{$jour->id}}">
                        <label for="floatingInput">Jour Titre</label>
                        @if ($errors->has('titre'))
                            <p class="help-block text-danger">{{ $errors->first('titre') }}</p>
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
