@extends('client.main')
@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="d-flex justify-content-end">
            <a href="{{ route('userdata') }}" class="btn btn-link">Annuler</a>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="bg-secondary rounded h-100 p-4 col-8">
                <form action="" method="POST">
                    @csrf
                    <h6 class="mb-4">Données Par défaut lors de la réservation</h6>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="nb_convives" aria-label="Floating label select example" required>
                            <option selected>----Choisissez le nombre de convives----</option>
                            @for ($i = 1; $i <= 20; $i++)
                            @if ($data->convives == $i )
                            <option selected value="{{ $i }}">{{ $i }}</option>
                            @else
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endif
                            @endfor
                        </select>
                        <label for="floatingSelect">Convives</label>
                        @if ($errors->has('nb_convives'))
                            <p class="help-block text-danger">{{ $errors->first('nb_convives') }}</p>
                        @endif
                    </div>
                    {{-- <div class="form-floating mb-3"> --}}
                        <select class="form-select" multiple name="allergies[]" aria-label="Floating label select example" required>
                           @if ($data->allergies == null || $data->allergies == 'null')
                           <option selected value="null">------Allergie aur------</option>
                           @endif
                            @php
                                $allergies = ['Gluten', 'Crustacés', 'Oeufs', 'Poissons', 'Arachides', 'Soja', 'Lait', 'Céleri', 'Mollusques', 'Olives'];
                                $dataAllergies = $data->allergies !== null || $data->allergies !== 'null' ? explode("%",$data->allergies) : "null";
                            @endphp
                            @foreach ($allergies as $allergie)
                            @if (is_array($dataAllergies) && in_array($allergie, $dataAllergies))
                            <option selected value="{{ $allergie }}">{{ $allergie }}</option>
                            @else   
                            <option value="{{ $allergie }}">{{ $allergie }}</option>
                            @endif
                            @endforeach
                        </select>
                        <label for="floatingSelect">Mentionner des allergies</label>
                        @if ($errors->has('allergies'))
                            <p class="help-block text-danger">{{ $errors->first('allergies') }}</p>
                        @endif
                    {{-- </div> --}}
                    <div class="form-floating mt-3">
                        <input type="hidden" name="data_id" value="{{$data->id}}">
                        <button class="btn btn-dark" type="submit">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->
@endsection
