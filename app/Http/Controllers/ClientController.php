<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;


class ClientController extends Controller
{
    public function index()
    {   $clients = Client::orderBy('id', 'desc')->paginate(10); 
       
       
        return view('client.index', ['clients' => $clients]);
    }
    public function search(Request $request)
    {
        $output = "";
    
        $clients = Client::where('nom', 'like', '%' . $request->search . '%')
            ->orWhere('prenom', 'like', '%' . $request->search . '%')
            ->get();
    
        foreach ($clients as $client) {
            $output .= '<tr>
                <td>' . $client->nom . '</td>
                <td>' . $client->prenom . '</td>
                <td>' . $client->tell . '</td>
                <td>' . $client->email . '</td>
                <td>' . $client->adress . '</td>
                <td>' . $client->ville . '</td>
                <td>
                <button type="button" class="btn-no-border" data-bs-toggle="modal" data-bs-target="#modalClientedit' . $client->id . '">
                <i class="fa-solid fa-pen-to-square green-icon"></i>
                </button>
                <form action="' . route("client.destroy", $client->id) . '" method="POST" style="display: inline;">
                    ' . csrf_field() . '
                    ' . method_field("DELETE") . '
                    <button type="submit" class="btn-no-border" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce client ?\')">
                    <i class="fa-solid fa-trash-can red-icon"></i>
                    </button>
                </form> 
                <button type="button" class="btn-no-border" data-bs-toggle="modal" data-bs-target="#modalClient' . $client->id . '">
                <i class="fa-solid fa-eye  black-icon"></i>
                </button>
                </td>
                <td>
                <!-- Bouton pour ouvrir le modal des règlements -->
                
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalReglements' . $client->id . '">
                   Règ
                </button>
                <a href="' . route("reglement_cl.create") . '" class="btn btn-success">add Règ</a>
                </td></tr>';
        }
    
        return response($output);
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
    
        $existingClient = Client::where('email', $validatedData['email'])->first();
    
        if ($existingClient) {
            return redirect()->back()->with('error', 'Cet email est déjà utilisé.');
        }
    
        Client::create($validatedData);
    
        return redirect('/client')->with('success', 'Client ajouté avec succès');
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
