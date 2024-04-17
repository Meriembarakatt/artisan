@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
   <!DOCTYPE html>
   <html lang="en">
   <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
   </head>
   <body>
    <style>/* Styles for form elements */
        form {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
        }
        
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        
        /* Responsive styles */
        @media screen and (max-width: 600px) {
            input[type="text"],
            input[type="email"],
            button[type="submit"] {
                width: 100%;
            }
        }
        </style>
   </body>
   </html>
    <div class="container mt-10">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <h1>formulaire pour ajouter client</h1>
                        </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                     
                        <table class="table">
                            <form method="POST" action="{{ route('client.store') }}">
                                @csrf
                                <label for="nom">Nom</label>
                                <input type="text" id="nom" name="nom" required>
                                <label for="prenom">Prénom</label>
                                <input type="text" id="prenom" name="prenom" required>
                                <label for="tell">Téléphone</label>
                                <input type="text" id="tell" name="tell" required>
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" required>
                                <label for="adress">Adresse</label>
                                <input type="text" id="adress" name="adress" required>
                                <label for="ville">Ville</label>
                                <input type="text" id="ville" name="ville" required>
                                <button type="submit">Ajouter</button>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
