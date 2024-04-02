<?php

namespace App\Http\Controllers;

use App\Models\Artisan;
use Illuminate\Http\Request;

class ArtisanController extends Controller
{
    public function index()
    {  $artisans = Artisan::orderBy('id', 'desc')->paginate(10); 
        return view('artisan.index', ['artisans' => $artisans]);
    }

    public function create()
    {
        // Retourne la vue 'artisan.create' pour créer un nouvel artisan
        return view('artisan.create');
    }

    public function store(Request $request)
    {
        // Valide les données du formulaire
        $validatedData = $request->validate([
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'email' => 'required|email|unique:artisans,email',
            'password' => 'required|min:6',
            'adress' => 'required',
            'ville' => 'required',
            'tell' => 'nullable',
            'fonction' => 'required',
        ]);

        // Crée un nouvel artisan avec les données validées
        Artisan::create($validatedData);

        // Redirige vers la liste des artisans avec un message de succès
        return redirect('/artisan')->with('success', 'Artisan ajouté avec succès');
    }

    public function show(Artisan $artisan)
    {
        // Affiche les détails d'un artisan spécifique (non implémenté dans cet exemple)
        return view('artisan.show', ['artisan' => $artisan]);
    }

    public function edit(Artisan $artisan)
    {
        // Affiche le formulaire d'édition pour un artisan donné (non implémenté dans cet exemple)
        return view('artisan.edit', ['artisan' => $artisan]);
    }

    public function update(Request $request, Artisan $artisan)
    {
        // Valide les données du formulaire d'édition
        $validatedData = $request->validate([
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'email' => 'required|email|unique:artisans,email,' . $artisan->id,
            'password' => 'required|min:6',
            'adress' => 'required',
            'ville' => 'required',
            'tell' => 'nullable',
            'fonction' => 'required',
        ]);

        // Met à jour les informations de l'artisan avec les données validées
        $artisan->update($validatedData);

        // Redirige vers la liste des artisans avec un message de succès
        return redirect('/artisan')->with('success', 'Artisan mis à jour avec succès');
    }

    public function destroy(Artisan $artisan)
    {
        // Supprime l'artisan de la base de données
        $artisan->delete();

        // Redirige vers la liste des artisans avec un message de succès
        return redirect('/artisan')->with('success', 'Artisan supprimé avec succès');
    }
}
