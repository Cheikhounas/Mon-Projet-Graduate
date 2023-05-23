@extends('account.main')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="d-flex justify-content-end">
            <a href="{{ route('galerie') }}" class="btn btn-link">Annuler</a>
        </div>
        <div class="row justify-content-center">
            <div class="col-8  bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Ajouter Une Image</h6>
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" name="titre" class="form-control" id="floatingInput" placeholder="Titre de l'image"
                            required>
                        <label for="floatingName">Titre</label>
                        @if ($errors->has('titre'))
                            <p class="help-block text-danger">{{ $errors->first('titre') }}</p>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label">Image</label>
                        <input class="form-control bg-dark" type="file" name="photo" accept="image/png, image/jpeg">
                        @if ($errors->has('photo'))
                            <p class="help-block text-danger">{{ $errors->first('photo') }}</p>
                        @endif
                    </div>
                    <div class="form-floating my-3">
                        <button type="submit" class="btn btn-dark">Ajouter</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
@endsection
