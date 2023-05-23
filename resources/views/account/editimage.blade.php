@extends('account.main')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="d-flex justify-content-end">
            <a href="{{ route('galerie') }}" class="btn btn-link">Annuler</a>
        </div>
        <div class="row justify-content-center">
            <div class="col-8  bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Modifier Une Image</h6>
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="hidden" name="image_id" value="{{$image->id}}">
                        <input type="text" name="titre" class="form-control" id="floatingInput" placeholder="Titre de l'image"
                            required value="{{$image->titre}}">
                        <label for="floatingName">Titre</label>
                        @if ($errors->has('titre'))
                            <p class="help-block text-danger">{{ $errors->first('titre') }}</p>
                        @endif
                    </div>
                    <div class="mb-3">
                        <img src="{{URL::to($image->image)}}" alt="Photo" width="100%">
                        <label for="formFileMultiple" class="form-label">Image</label>
                        <input class="form-control bg-dark" type="file" name="newphoto" accept="image/png, image/jpeg">
                        <input type="hidden" name="oldphoto" value="{{$image->image}}">
                        @if ($errors->has('newphoto'))
                            <p class="help-block text-danger">{{ $errors->first('newphoto') }}</p>
                        @endif
                    </div>
                    <div class="form-floating my-3">
                        <button type="submit" class="btn btn-dark">Modifier</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
@endsection
