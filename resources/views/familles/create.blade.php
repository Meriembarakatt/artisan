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

                    <h1>Ajouter une famille</h1>
                    <form method="POST" action="{{ route('familles.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="famille">Nom de la famille :</label>
                            <input type="text" id="famille" name="famille" class="form-control @error('famille') is-invalid @enderror" required>
                            @error('famille')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success float-right">Ajouter la famille</button>
                        <a href="{{ route('familles.index') }}" class="btn btn-success float-right">Annuler</a>
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
