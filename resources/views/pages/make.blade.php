@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <form action="{{ route('generate') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="my-4">
                <h1>Information</h1>
                <div class="row">
                    <div class="col-lg-6 my-4">
                        <div class="form-floating">
                            <select name="atHome"
                                    id="atHome"
                                    @class(['form-control', 'is-invalid' => $errors->has('atHome')])
                                    required>
                                <option value="true">Oui</option>
                                <option value="false">Non</option>
                            </select>
                            <label for="atHome">Match à domicile ?</label>
                            <small class="text-danger">{{ $errors->first('atHome') }}</small>
                        </div>
                    </div>
                    <div class="col-lg-6 my-4">
                        <div class="form-floating">
                            <input type="text"
                                   id="where"
                                   name="where"
                                   placeholder="where"
                                   @class(['form-control', 'is-invalid' => $errors->has('where')])
                                   required>
                            <label for="where">Où ça ?</label>
                            <small class="text-danger">{{ $errors->first('where') }}</small>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="my-4">
                <h1>Adversaire</h1>
                <div class="row">
                    <div class="col-lg-6 my-4">
                        <div class="form-floating">
                            <input type="text"
                                   id="enemyName"
                                   name="enemyName"
                                   placeholder="Nom"
                                   @class(['form-control', 'is-invalid' => $errors->has('enemyName')])
                                   required>
                            <label for="enemyName">Nom de l'ardversaire</label>
                            <small class="text-danger">{{ $errors->first('enemyName') }}</small>
                        </div>
                    </div>
                    <div class="col-lg-6 my-4">
                        <div class="form-floating">
                            <input type="text"
                                   id="enemyInsta"
                                   name="enemyInsta"
                                   placeholder="Instagram"
                                @class(['form-control', 'is-invalid' => $errors->has('enemyInsta')])>
                            <label for="enemyInsta">@instagram</label>
                            <small class="text-danger">{{ $errors->first('enemyInsta') }}</small>
                        </div>
                    </div>
                    <div class="col-lg-6 my-4">
                        <label for="enemyLogo">Logo</label>
                        <input type="file"
                               id="enemyLogo"
                               name="enemyLogo"
                               accept="image/png, image/jpeg"
                               @class(['form-control', 'is-invalid' => $errors->has('enemyLogo')])
                               required>
                        <small class="text-danger">{{ $errors->first('enemyLogo') }}</small>
                    </div>
                </div>
            </div>
            <hr>
            <div class="my-4">
                <h1>Composition</h1>
                <div class="row">
                    @foreach($grid as $line)
                        @foreach($line as $number)
                            <div class="col-lg-{{ 12 / count($line) }} my-4">
                                <label for="players[{{ $number }}]">Joueur {{ $number }}</label>
                                <select name="players[{{ $number }}]"
                                        id="players[{{ $number }}]"
                                        class="playerSelect"
                                        required>
                                    @foreach($players as $player)
                                        <option
                                            value="{{ $player->id }}">{{ $player->pseudo ?? $player->full_name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">{{ $errors->first("players[{$number}]") }}</small>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>

            <div class="my-2">
                <button type="submit" class="btn btn-success">Créer le kit</button>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('.playerSelect').select2({
                width: '100%'
            });
        });
    </script>
@endpush
