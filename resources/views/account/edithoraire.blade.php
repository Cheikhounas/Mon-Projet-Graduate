@extends('account.main')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Horaires d'Ouverture</h6>
                <form action="" method="POST">
                    @csrf
                    @if (!empty($jours))
                    <div class="form-floating mb-3">
                        <select class="form-select" name="jour_id" aria-label="Floating label select example" required>
                            @foreach ($jours as $jour)
                            @if ($jour->id == $horaire->jour_id)
                            <option selected value="{{ $jour->id }}">{{ $jour->titre }}</option>                                
                            @else
                            <option value="{{ $jour->id }}">{{ $jour->titre }}</option>
                            @endif
                            @endforeach
                        </select>
                        <label for="floatingSelect">Choisir le Jour</label>
                        @if ($errors->has('jour_id'))
                            <p class="help-block text-danger">{{ $errors->first('jour_id') }}</p>
                        @endif
                    </div>
                    @else
                        <h4 class="text-center">Vous devez d'abord ajouter un Jour !!!<br> cliquez <a
                                href="{{ route('addjour') }}" class="text-warning">ici</a> pour ajouter</h4>
                    @endif
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-2 col-form-label">Midi</label>
                        <div class="col-2">
                            <input type="hidden" name="horaire_id" value="{{$horaire->id}}">
                            <label for="">De</label>
                            <input type="time" name="mo" value="{{$horaire->ouverture_midi}}" class="form-control" id="inputEmail3" placeholder="Midi Ouverture" required>
                        </div>
                        <div class="col-2">
                            <label for="">À</label>
                            <input type="time" name="mf" value="{{$horaire->fermeture_midi}}"class="form-control" id="inputEmail3" placeholder="Midi Fermeture" required>
                        </div>
                    </div>
                    <div class="row">
                        <label for="inputEmail3" class="col-2 col-form-label">Soir</label>
                        <div class="col-2">
                            <label for="">De</label>
                            <input type="time" name="so" value="{{$horaire->ouverture_soir}}" class="form-control" id="inputEmail3" placeholder="Soir Ouverture" required>
                        </div>
                        <div class="col-2">
                            <label for="">À</label>
                            <input type="time" name="sf" value="{{$horaire->fermeture_soir}}" class="form-control" id="inputEmail3" placeholder="Soir Fermeture" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark">Modifier</button>
                </form>
            </div>
        </div>
    </div>
@endsection