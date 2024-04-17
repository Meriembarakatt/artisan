@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])

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

                    <h1>Ajouter une client</h1>

    <form method="POST" action="{{route('client.store')}}">
        @csrf
        <div class="form-group">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" class="form-control @error('nom') is-invalid @enderror" required>
            @error('nom')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" class="form-control @error('prenom') is-invalid @enderror" required>
            @error('prenom')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="tell">Téléphone:</label>
            <input type="text" id="tell" name="tell" class="form-control @error('tell') is-invalid @enderror" required>
            @error('tell')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" required>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="adress">Adresse:</label>
            <input type="text" id="adress" name="adress" class="form-control @error('adress') is-invalid @enderror" required>
            @error('adress')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="ville">Ville:</label>
            <input type="text" id="ville" name="ville" class="form-control @error('ville') is-invalid @enderror" required>
            @error('ville')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
       
        <button type="submit"  class="btn btn-success float-right">Ajouter</button>
    </form>
    </div>
            </div>
        </div>
    </div>
</div>
@endsection