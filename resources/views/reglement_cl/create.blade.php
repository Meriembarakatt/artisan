@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Ajouter un règlement</div>

                    <div class="card-body">
                        <form action="{{ route('reglement_cl.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="client_id">Client :</label>
                                <select name="client_id" id="client_id" class="form-control">
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->prenom }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="mode_id">Mode de règlement :</label>
                                <select name="mode_id" id="mode_id" class="form-control">
                                    @foreach ($modes as $mode)
                                        <option value="{{ $mode->id }}">{{ $mode->mode }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="montant">Montant :</label>
                                <input type="text" name="montant" id="montant" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="date">Date :</label>
                                <input type="date" name="date" id="date" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                                <a href="{{ route('reglement_cl.index') }}" class="btn btn-secondary">Annuler</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
