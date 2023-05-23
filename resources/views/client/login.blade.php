@extends('main')
@section('pagehead')
    <!-- Page Header Start -->
    <div class="page-header mb-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Connexion</h2>
                </div>
                <div class="col-12">
                    <a href="">Connexion</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
@endsection
@section('content')
    <div class="mt-5 container">
        <div class="row justify-content-center">
            <div class="booking-form col-6">
                {{-- @if (Session::has('fail'))
                    <p class="help-block text-danger text-center">{{ Session::get('fail') }}</p>
                @endif
                @if (Session::has('success'))
                    <p class="help-block text-success text-center">{{ Session::get('success') }}</p>
                @endif --}}
                <form method="POST">
                    @csrf
                    <div class="control-group">
                        <div class="input-group">
                            <input type="email" class="form-control" name="email" placeholder="Email" required="required">
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="far fa-envelope"></i></div>
                            </div>
                        </div>
                        @if ($errors->has('email'))
                            <p class="help-block text-danger">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <div class="control-group  my-3">
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" placeholder="Mot de Passe"
                                required="required">
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fa fa-lock"></i></div>
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <p class="help-block text-danger">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <div>
                        <button class="btn custom-btn" type="submit">Se Connecter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
