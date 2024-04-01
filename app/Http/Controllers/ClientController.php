<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {   
        $clients = Client::all();
        return view('client.index', ['clients' => $clients]);
    }

    public function create()
    {
        return view('client.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'tell' => 'required|max:20',
            'email' => 'required|email|max:255',
            'adress' => 'required|max:255',
            'ville' => 'required|max:255',
        ]);

        Client::create($validatedData);

        return redirect('/clients')->with('success', 'Client ajouté avec succès');
    }

    public function show(Client $client)
{
    return view('client.show', compact('client'));
}


    public function edit(Client $client)
    {
        return view('client.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validatedData = $request->validate([
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'tell' => 'required|max:20',
            'email' => 'required|email|max:255',
            'adress' => 'required|max:255',
            'ville' => 'required|max:255',
        ]);

        $client->update($validatedData);

        return redirect()->route('client.index')->with('success', 'Client mis à jour avec succès');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('client.index')->with('success', 'Client supprimé avec succès');
    }
}
