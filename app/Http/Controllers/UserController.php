<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Assurez-vous d'importer le modèle User s'il existe dans votre application

class UserController extends Controller
{
    /**
     * Affiche la liste des utilisateurs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Affiche le formulaire de création d'un nouvel utilisateur.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Enregistre un nouvel utilisateur dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation des données entrées par l'utilisateur
        $validatedData = $request->validate([
            'username' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users|max:255',
            // Ajoutez d'autres règles de validation selon vos besoins
        ]);

        // Création d'un nouvel utilisateur avec les données validées
        User::create($validatedData);

        // Rediriger vers une page appropriée avec un message de succès
        return redirect('/users')->with('success', 'Utilisateur ajouté avec succès');
    }

    /**
     * Affiche les détails d'un utilisateur spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Affiche le formulaire de modification d'un utilisateur.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Met à jour les informations d'un utilisateur spécifique dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validation des données entrées par l'utilisateur
        $validatedData = $request->validate([
            'username' => 'required|unique:users,username,'.$id.'|max:255',
            'email' => 'required|email|unique:users,email,'.$id.'|max:255',
            // Ajoutez d'autres règles de validation selon vos besoins
        ]);

        // Recherche de l'utilisateur à mettre à jour
        $user = User::findOrFail($id);

        // Mise à jour des informations de l'utilisateur avec les données validées
        $user->update($validatedData);

        // Rediriger vers une page appropriée avec un message de succès
        return redirect('/users')->with('success', 'Informations de l\'utilisateur mises à jour avec succès');
    }

    /**
     * Supprime un utilisateur spécifique de la base de données.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Recherche de l'utilisateur à supprimer
        $user = User::findOrFail($id);

        // Suppression de l'utilisateur
        $user->delete();

        // Rediriger vers une page appropriée avec un message de succès
        return redirect('/users')->with('success', 'Utilisateur supprimé avec succès');
    }
}
