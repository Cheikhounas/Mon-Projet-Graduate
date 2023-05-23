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
                            <option selected="">------Choisir le Jour------</option>
                            @foreach ($jours as $jour)
                                <option value="{{ $jour->id }}">{{ $jour->titre }}</option>
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
                            <label for="">De</label>
                            <input type="time" name="mo" class="form-control" id="inputEmail3" placeholder="Midi Ouverture" required>
                        </div>
                        <div class="col-2">
                            <label for="">À</label>
                            <input type="time" name="mf" class="form-control" id="inputEmail3" placeholder="Midi Fermeture" required>
                        </div>
                    </div>
                    <div class="row">
                        <label for="inputEmail3" class="col-2 col-form-label">Soir</label>
                        <div class="col-2">
                            <label for="">De</label>
                            <input type="time" name="so" class="form-control" id="inputEmail3" placeholder="Soir Ouverture" required>
                        </div>
                        <div class="col-2">
                            <label for="">À</label>
                            <input type="time" name="sf" class="form-control" id="inputEmail3" placeholder="Soir Fermeture" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
@endsection