<?php

namespace App\Http\Controllers;

use App\Models\Artisan;
use Illuminate\Http\Request;

class ArtisanController extends Controller
{
    public function index()
    {
        $artisans = Artisan::all();
        return view('artisan.index', ['artisans' => $artisans]);
    }

    public function create()
    {
        return view('artisan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'email' => 'required|email|unique:artisans,email',
            'password' => 'required|min:6',
            'adress' => 'required',
            'ville' => 'required',
            'fonction' => 'required',
        ]);
        
        Artisan::create($validatedData);
        return redirect('/artisan')->with('success', 'Artisan ajouté avec succès');
    }

    public function show(Artisan $artisan)
    {
        // Vous pouvez implémenter la logique pour afficher un artisan spécifique ici
    }

    public function edit(Artisan $artisan)
    {
        // Vous pouvez implémenter la logique pour afficher le formulaire d'édition ici
    }

    public function update(Request $request, Artisan $artisan)
    {
        // Vous pouvez implémenter la logique pour mettre à jour un artisan ici
    }

    public function destroy(Artisan $artisan)
    {
        // Vous pouvez implémenter la logique pour supprimer un artisan ici
    }
}
