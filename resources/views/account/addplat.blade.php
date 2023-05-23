@extends('account.main')
@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="d-flex justify-content-end">
            <a href="{{ route('carte') }}" class="btn btn-link">Annuler</a>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="bg-secondary rounded h-100 p-4 col-8">
                <form action="" method="POST">
                    @csrf
                    <h6 class="mb-4">Ajouter un Plat</h6>
                    @if (!empty($categories))
                        <select class="form-select" name="categorie_id" aria-label="Floating label select example" required>
                            <option selected="">------Choisir la catégorie du plat------</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->titre }}</option>
                            @endforeach
                        </select>
                        <label for="floatingSelect">Choisir la catégorie du plat</label>
                        @if ($errors->has('categorie_id'))
                            <p class="help-block text-danger">{{ $errors->first('categorie_id') }}</p>
                        @endif
                    @else
                        <h4 class="text-center">Vous devez d'abord ajouter une catégorie !!!<br> cliquez <a
                                href="{{ route('addcategorie') }}" class="text-warning">ici</a> pour ajouter</h4>
                    @endif
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="titre" placeholder="Titre"
                            required>
                        <label for="floatingInput">Titre</label>
                        @if ($errors->has('titre'))
                            <p class="help-block text-danger">{{ $errors->first('titre') }}</p>
                        @endif
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Book description" name="description" style="height: 150px;" required></textarea>
                        <label for="floatingTextarea">Description</label>
                        @if ($errors->has('description'))
                            <p class="help-block text-danger">{{ $errors->first('description') }}</p>
                        @endif
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput" name="prix" placeholder="Titre"
                            required>
                        <label for="floatingInput">Prix</label>
                        @if ($errors->has('prix'))
                            <p class="help-block text-danger">{{ $errors->first('prix') }}</p>
                        @endif
                    </div>
                    <div class="form-floating">
                        <button class="btn btn-dark" type="submit">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->
@endsection
