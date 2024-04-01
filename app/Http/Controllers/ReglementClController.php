<?php

namespace App\Http\Controllers;

use App\Models\reglementCl;
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
    $reglements = ReglementCl::all();
    return view('reglement_cl.index', ['reglements' => $reglements]);
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\reglementCl  $reglementCl
     * @return \Illuminate\Http\Response
     */
    public function show(reglementCl $reglementCl)
{
    $reglementCl = ReglementCl::findOrFail($reglementCl->id);
    return view('reglement_cl.show', compact('reglementCl'));
}

public function edit(reglementCl $reglementCl)
{
    $clients = Client::all();
    $modes = Mode::all();
     // Récupérer tous les clients depuis la base de données
    return view('reglement_cl.edit', compact('reglementCl', 'clients','modes'));
}
public function update(Request $request, reglementCl $reglementCl)
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

public function destroy(reglementCl $reglementCl)
{
    $reglementCl->delete();

    return redirect()->route('reglement_cl.index')->with('success', 'Règlement client supprimé avec succès.');
}
}