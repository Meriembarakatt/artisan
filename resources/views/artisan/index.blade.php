@extends('layouts.app',['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'artisan'])
 
<a href="{{ route('artisan.create') }}">Ajouter un artisan</a>

<h1>Liste des artisans</h1>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Password</th>
            <th>Adresse</th>
            <th>Ville</th>
            <th>Téléphone</th>
            <th>Fonction</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($artisans as $artisan)
        <tr>
            <td>{{ $artisan->nom }}</td>
            <td>{{ $artisan->prenom }}</td>
            <td>{{ $artisan->email }}</td>
            <td>{{ $artisan->password }}</td>
            <td>{{ $artisan->adress }}</td>
            <td>{{ $artisan->ville }}</td>
            <td>{{ $artisan->tell }}</td>
            <td>{{ $artisan->fonction }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
