@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
<div class="container mt-10">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-header">Liste des   detail de  vente</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <a href="{{ route('detailsvente.create') }}" class="btn btn-success">Ajouter un detail de  vente</a>
                    </div>
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
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
