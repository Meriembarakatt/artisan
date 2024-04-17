<?php

namespace App\Http\Controllers;

use App\Models\ReglementCl; // Nom de classe corrigé
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Mode;

class ReglementClController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reglements = ReglementCl::orderBy('id', 'desc')->paginate(10);
        $clients = Client::orderBy('id', 'desc')->paginate(10);
        $modes = Mode::orderBy('id', 'desc')->paginate(10);
        return view('reglement_cl.index', compact('reglements', 'clients', 'modes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        $modes = Mode::all();
        return view('reglement_cl.create', compact('clients', 'modes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'mode_id' => 'required|exists:modes,id',
            'date' => 'required|date',
            'montant' => 'required|numeric|min:0',
        ]);

        ReglementCl::create($validatedData);

        return redirect()->route('reglement_cl.index')->with('success', 'Règlement client ajouté avec succès.');
    }

    public function afficherReglement($id)
    {
        // Logique pour afficher le règlement du client avec l'ID $id
        $client = Client::findOrFail($id); // Supposons que vous avez un modèle Client
    
        // Chargez les règlements associés au client
        $reglements = $client->reglements;
    
        // Retournez la vue avec les données des règlements et du client
        return view('reglements.client', compact('client', 'reglements'));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReglementCl  $reglementCl
     * @return \Illuminate\Http\Response
     */
    public function show(ReglementCl $reglementCl) // Nom de classe corrigé
    {
        return view('reglement_cl.show', compact('reglementCl'));
    }

    public function edit(ReglementCl $reglementCl) // Nom de classe corrigé
    {
        $clients = Client::all();
        $modes = Mode::all();
        return view('reglement_cl.edit', compact('reglementCl', 'clients', 'modes'));
    }

    public function update(Request $request, ReglementCl $reglementCl) // Nom de classe corrigé
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'mode_id' => 'required|exists:modes,id',
            'date' => 'required|date',
            'montant' => 'required|numeric|min:0',
        ]);

        $reglementCl->update($validatedData);

        return redirect()->route('reglement_cl.index')->with('success', 'Règlement client mis à jour avec succès.');
    }

    public function destroy(ReglementCl $reglementCl) // Nom de classe corrigé
    {
        $reglementCl->delete();

        return redirect()->route('reglement_cl.index')->with('success', 'Règlement client supprimé avec succès.');
    }
}
