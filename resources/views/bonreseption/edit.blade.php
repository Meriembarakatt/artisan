@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Modifier Bon de Réception</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('bonreseption.update', $bonreception->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $bonreception->date) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="artisan_id">Artisan</label>
                                <select class="form-control" id="artisan_id" name="artisan_id" required>
                                    @foreach ($artisans as $artisan)
                                        <option value="{{ $artisan->id }}" {{ $bonreception->artisan_id == $artisan->id ? 'selected' : '' }}>{{ $artisan->nom }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                            <a href="{{ route('bonreseption.index') }}" class="btn btn-secondary">Retour</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
