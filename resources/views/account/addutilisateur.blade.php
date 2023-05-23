@extends('account.main')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="d-flex justify-content-end">
            <a href="{{route('utilisateurs')}}" class="btn btn-link text-warning">Annuler</a>
          </div>
        <div class="row justify-content-center">
            <div class="bg-secondary rounded h-100 p-4 col-8">
                <form method="POST">
                    @csrf
                    <div class="form-floating  mb-3">
                            <input type="text" class="form-control" name="name" placeholder="Pseudo" required="required">
                            <label for="floatingSelect">Pseudo</label>
                        @if ($errors->has('name'))
                            <p class="help-block text-danger">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email" required="required">
                            <label for="floatingSelect">Email</label>
                        @if ($errors->has('email'))
                            <p class="help-block text-danger">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <label for="floatingSelect">Choisir le type d'utilisateur</label>
                    <select class="form-select" name="type" aria-label="Floating label select example" required>
                        <option selected value="client">Client</option>
                            <option value="admin">Admin</option>
                    </select>

                    @if ($errors->has('type'))
                        <p class="help-block text-danger">{{ $errors->first('type') }}</p>
                    @endif
                    <div class="form-floating  my-3">
                        <input type="password" class="form-control" name="password" placeholder="Mot de Passe"
                        required="required">
                        <label for="floatingSelect">Mot de Passe</label>
                        @if ($errors->has('password'))
                            <p class="help-block text-danger">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <div class="form-floating  my-3">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmation"
                                required="required">
                    <label for="floatingSelect">Confirmation</label>
                        @if ($errors->has('password_confirmation'))
                            <p class="help-block text-danger">{{ $errors->first('password_confirmation') }}</p>
                        @endif
                    </div>
                    <div>
                        <button class="btn btn-dark" type="submit">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
