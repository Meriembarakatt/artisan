@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Créer une nouvelle sous-famille</h2>
        <form method="POST" action="{{ route('sousfamille.store') }}">
            @csrf
            <div class="form-group">
                <label for="famille_id">Famille :</label>
                <select class="form-control" id="famille_id" name="famille_id">
                    @foreach($familles as $famille)
                        <option value="{{ $famille->id }}">{{ $famille->famille }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="name">Nom de la sous-famille :</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Entrez le nom de la sous-famille">
            </div>
            <button type="submit" class="btn btn-primary">Créer la sous-famille</button>
        </form>
    </div>
@endsection
