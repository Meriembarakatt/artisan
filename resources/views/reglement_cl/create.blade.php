@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ajouter un règlement pour le client</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('reglement_cl.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="client_id">Client</label>
                            <select id="client_id" name="client_id" class="form-control">
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->nom }} {{ $client->prenom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="mode_id">Mode de règlement</label>
                            <select id="mode_id" name="mode_id" class="form-control">
                                @foreach($modes as $mode)
                                    <option value="{{ $mode->id }}">{{ $mode->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="date">Date</label>
                            <input id="date" type="date" class="form-control" name="date" required>
                        </div>

                        <div class="form-group">
                            <label for="montant">Montant</label>
                            <input id="montant" type="number" step="0.01" class="form-control" name="montant" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Ajouter le règlement</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
