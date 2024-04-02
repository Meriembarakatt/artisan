@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Modifier la vente #{{ $vente->id }}
                    </div>
                    <div class="card-body">
                        <form action="{{ route('vente.update', $vente->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="date">Date de la vente:</label>
                                <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $vente->date) }}">
                            </div>
                            <div class="form-group">
                                <label for="client_id">Client:</label>
                                <select name="client_id" id="client_id" class="form-control">
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}" {{ $client->id == old('client_id', $vente->client_id) ? 'selected' : '' }}>{{ $client->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                            <a href="{{ route('vente.show', $vente->id) }}" class="btn btn-secondary">Annuler</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
