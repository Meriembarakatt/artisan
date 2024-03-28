<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Vente;
use Illuminate\Http\Request;

class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventes = Vente::all();
        return view('vente.index', compact('ventes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all(); 
        return view('vente.create', compact('clients'));
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
            'date' => 'required|date',
            'client_id' => 'required|exists:clients,id',
        ]);

        Vente::create($validatedData);

        return redirect('/ventes')->with('success', 'Vente ajoutée avec succès');
    }

    public function destroy(vente $vente)
    {
        $vente->delete();
        return redirect()->route('vente.index');

    }
    // Other methods like show(), edit(), update(), destroy() can be added as needed
}
