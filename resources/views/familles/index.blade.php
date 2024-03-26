@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@include('layouts.navbars.auth.sidenav', ['title' => 'familles'])
@include('layouts.navbars.auth.topnav', ['title' => 'familles'])

@section('content')
   
    <a href="{{ route('familles.create') }}">Ajouter la famille</a>
    
    <table>
        <thead>
            <tr>
                <th>famille</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($familles as $famille)
                <tr>
                    <td>{{ $famille->famille }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
