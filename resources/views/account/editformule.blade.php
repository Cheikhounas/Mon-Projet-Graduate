@extends('account.main')
@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="d-flex justify-content-end">
            <a href="{{ route('formules') }}" class="btn btn-link">Annuler</a>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="bg-secondary rounded h-100 p-4 col-8">
                <form action="" method="POST">
                    @csrf
                    <h6 class="mb-4">Modifier une Formule</h6>
                    @if (!empty($menus))
                        <select class="form-select" name="menu_id" aria-label="Floating label select example" required>
                            @foreach ($menus as $menu)
                            @if ($formule->menu_id == $menu->id)
                            <option selected value="{{ $menu->id }}">{{ $menu->titre }}</option>
                            @else
                            <option value="{{ $menu->id }}">{{ $menu->titre }}</option>
                            @endif
                            @endforeach
                        </select>
                        <label for="floatingSelect">Choisir le Menu de la Formule</label>
                        @if ($errors->has('menu_id'))
                            <p class="help-block text-danger">{{ $errors->first('menu_id') }}</p>
                        @endif
                    @else
                        <h4 class="text-center">Vous devez d'abord ajouter un menu !!!<br> cliquez <a
                                href="{{ route('addmenu') }}" class="text-warning">ici</a> pour ajouter</h4>
                    @endif
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="titre" placeholder="Titre"
                            required value="{{$formule->titre}}">
                        <label for="floatingInput">Titre</label>
                        @if ($errors->has('titre'))
                            <p class="help-block text-danger">{{ $errors->first('titre') }}</p>
                        @endif
                    </div>
                    @if (!empty($plats))
                    @php
                        $idsPlats = explode("%", $formule->plats);
                    @endphp
                    <select class="form-select" multiple name="plats[]" aria-label="Floating label select example" required>
                        @foreach ($plats as $plat)
                        @if (in_array($plat->id, $idsPlats))
                        <option selected value="{{ $plat->id }}">{{ $plat->titre }}</option>
                        @else
                        <option value="{{ $plat->id }}">{{ $plat->titre }}</option>
                        @endif
                        @endforeach
                    </select>
                    <label for="floatingSelect">Choisir le(s) Plat(s) de la Formule</label>
                    @if ($errors->has('plats'))
                        <p class="help-block text-danger">{{ $errors->first('plats') }}</p>
                    @endif
                @else
                    <h4 class="text-center">Vous devez d'abord ajouter un menu !!!<br> cliquez <a
                            href="{{ route('addmenu') }}" class="text-warning">ici</a> pour ajouter</h4>
                @endif
                    <div class="form-floating mb-3 mt-3">
                        <textarea class="form-control" placeholder="Book description" name="description" style="height: 150px;" required>{{$formule->description}}</textarea>
                        <label for="floatingTextarea">Description</label>
                        @if ($errors->has('description'))
                            <p class="help-block text-danger">{{ $errors->first('description') }}</p>
                        @endif
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput" name="prix" placeholder="Titre"
                            required value="{{$formule->prix}}">
                        <label for="floatingInput">Prix</label>
                        
                        <input type="hidden" name="oldmenu_id" value="{{$formule->menu_id}}">
                        <input type="hidden" name="formule_id" value="{{$formule->id}}">
                        @if ($errors->has('prix'))
                            <p class="help-block text-danger">{{ $errors->first('prix') }}</p>
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
