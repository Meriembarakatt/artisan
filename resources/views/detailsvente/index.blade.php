{{-- resources/views/details/index.blade.php 

@extends('layouts.app')

@section('content')--}}
<div class="container">
    <h1>Liste des Détails de Vente</h1>
    <a href="{{ route('detailsvente.create') }}" class="btn btn-primary mb-3">Ajouter un Détail de Vente</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Article</th>
                <th>Vente</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detailsvente as $detail)
                <tr>
                    <td>{{ $detail->id }}</td>
                    <td>{{ $detail->article->designation }}</td>
                    <td>{{ $detail->vente->date }}</td>
                    <td>{{ $detail->qte }}</td>
                    <td>{{ $detail->prix }}</td>
                    <td>
                         <form action="{{ route('detailsvente.destroy', ['detailvente' => $detail->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
                  
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{--@endsection--}}
