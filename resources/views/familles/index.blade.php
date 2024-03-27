@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@include('layouts.navbars.auth.sidenav', ['title' => 'familles'])
@include('layouts.navbars.auth.topnav', ['title' => 'familles'])

@section('content')
   
    <a href="{{ route('familles.create') }}">Ajouter la famille</a>
    
    <table>
        <thead>
            <tr>
                <th>famille</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($familles as $famille)
                <tr>
                    <td>{{ $famille->famille }}</td>
                    <td>  <form action="{{ route('familles.destroy', ['famille' => $famille->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
