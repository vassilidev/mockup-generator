@extends('layouts.master')

@section('content')
    <div class="container">
        <form action="{{ route('player.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-4 my-4">
                    <div class="form-floating">
                        <input type="text"
                               name="pseudo"
                               id="pseudo"
                               @class(['form-control', 'is-invalid' => $errors->has('pseudo')])
                               placeholder="Pseudo"
                               value="{{ old('pseudo') }}">
                        <label for="pseudo">Pseudo</label>
                        <small class="text-danger">{{ $errors->first('pseudo') }}</small>
                    </div>
                </div>
                <div class="form-floating col-lg-4 my-4">
                    <input type="text"
                           name="name"
                           id="name"
                           @class(['form-control', 'is-invalid' => $errors->has('name')])
                           placeholder="Prénom"
                           value="{{ old('name') }}"
                           required>
                    <label for="name">Prénom *</label>
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                </div>
                <div class="form-floating col-lg-4 my-4">
                    <input type="text"
                           name="surname"
                           id="surname"
                           @class(['form-control', 'is-invalid' => $errors->has('surname')])
                           placeholder="Nom"
                           value="{{ old('surname') }}"
                           required>
                    <label for="surname">Nom de famille *</label>
                    <small class="text-danger">{{ $errors->first('surname') }}</small>
                </div>
            </div>
            <div class="my-4">
                <label for="photo">Photo *</label>
                <input type="file"
                       name="photo"
                       id="photo"
                       @class(['form-control', 'is-invalid' => $errors->has('photo')])
                       required>
                <small class="text-danger">{{ $errors->first('photo') }}</small>
            </div>
            <div class="my-4">
                <button type="submit" class="btn btn-success">
                    Créer le joueur
                </button>
            </div>
        </form>
    </div>
@endsection