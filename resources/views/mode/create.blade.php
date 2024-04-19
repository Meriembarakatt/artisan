@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])

    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Ajouter un Mode
                    </div>
                    <div class="card-body">
                        <form action="{{ route('modes.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="mode">Mode</label>
                                <input type="text" name="mode" id="mode" class="form-control" placeholder="Mode">
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                            <a href="{{ route('modes.index') }}" class="btn btn-secondary">Retour</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

