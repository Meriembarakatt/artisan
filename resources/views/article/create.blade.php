{{-- @extends('layouts.app')

@section('content') --}}
    {{-- @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard']) --}}
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Styles CSS personnalisés */
        .form-group label {
            font-weight: bold;
            color: #333;
        }

        .form-control {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 8px;
        }

        .btn-primary {
            background-color: #007bff;
        }
    </style>
    
    <div class="container mt-10">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <h1>Ajouter un article</h1>
                        <form method="POST" action="{{ route('article.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="designation">Désignation:</label>
                                <input type="text" name="designation" class="form-control" id="designation" required>
                            </div>
                            <div class="form-group">
                                <label for="prix_ht">Prix HT :</label>
                                <input type="number" name="prix_ht" class="form-control" id="prix_ht" required>
                            </div>
                            <div class="form-group">
                                <label for="qte">Quantité :</label>
                                <input type="number" name="qte" class="form-control" id="qte" required>
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock :</label>
                                <input type="number" name="stock" class="form-control" id="stock" required>
                            </div>
                            <div class="form-group">
                                <label for="sousfamille_id">Sous-famille :</label>
                                <select name="sousfamille_id" class="form-control" id="sousfamille_id" required>
                                    @foreach ($sousFamilles as $sousFamille)
                                        <option value="{{ $sousFamille->id }}">{{ $sousFamille->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Image :</label>
                                <input type="file" name="image" class="form-control-file" id="image">
                            </div>
                            <button type="submit" class="btn btn-primary">ajouter Article</button>
                            <button><a href="{{ route('article.index') }}" class="btn btn-primary">Annuler</a></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- @endsection --}}
