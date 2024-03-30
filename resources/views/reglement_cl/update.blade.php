@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Modifier un règlement</div>

                    <div class="card-body">
                        <form action="{{ route('reglement_cl.update', $reglementCl->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="client_id">Client :</label>
                                <select name="client_id" id="client_id" class="form-control">
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}" {{ $client->id == $reglementCl->client_id ? 'selected' : '' }}>{{ $client->prenom }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="mode_id">Mode de règlement :</label>
                                <select name="mode_id" id="mode_id" class="form-control">
                                    @foreach ($modes as $mode)
                                        <option value="{{ $mode->id }}" {{ $mode->id == $reglementCl->mode_id ? 'selected' : '' }}>{{ $mode->mode }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="montant">Montant :</label>
                                <input type="text" name="montant" id="montant" class="form-control" value="{{ $reglementCl->montant }}" required>
                            </div>

                            <div class="form-group">
                                <label for="date">Date :</label>
                                <input type="date" name="date" id="date" class="form-control" value="{{ $reglementCl->date }}" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Modifier</button>
                                <a href="{{ route('reglement_cl.index') }}" class="btn btn-secondary">Annuler</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
