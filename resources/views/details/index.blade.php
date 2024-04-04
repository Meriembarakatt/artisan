@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Liste des Bons de detail de  Réception</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="mb-3">
                            <a href="{{ route('details.create') }}" class="btn btn-success">Ajouter un detail de Bon de Réception</a>
                        </div>

                        <table class="table">
                     
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Article</th>
                    <th>Bon de Réception</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detail__brs as $detail)
                    <tr>
                        <td>{{ $detail->id }}</td>
                        <td>{{ $detail->article->designation }}</td>
                        <td>{{ $detail->bonreception->date }}</td>
                        <td>{{ $detail->qte }}</td>
                        <td>{{ $detail->prix }}</td>
                        <td>
                            <a href="{{ route('details.show', $detail->id) }}" class="btn btn-primary">Voir</a>
                            <a href="{{ route('details.edit', $detail->id) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('details.destroy', ['detail' => $detail->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $detail__brs->links() }}
    </div>
@endsection
