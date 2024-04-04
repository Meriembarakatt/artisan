<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Vente;
use App\Models\Article;
use App\Models\DetailVente;
use Illuminate\Http\Request;

class VenteController extends Controller
{
    public function index()
    {
        $ventes = Vente::orderBy('id', 'desc')->paginate(10);
        return view('vente.index', compact('ventes'));
    
       
    }

    public function create()
    {
        $articles = Article::all();
        $clients = Client::all();
        $ventes = Vente::all();
        return view('vente.create', compact('clients', 'articles', 'ventes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'client_id' => 'required|exists:clients,id',
        ]);

        Vente::create($validatedData);
        return redirect('/ventes')->with('success', 'Vente ajoutée avec succès');
    }

    // public function bulkStore(Request $request)
    // {
    //     dd($request->all);
    //     foreach ($request->all() as $enregistrement) {
    //         $detailVente = new DetailVente();
    //         $detailVente->vente_id = $enregistrement['vente'];
    //         $detailVente->article_id = $enregistrement['article'];
    //         $detailVente->quantite = $enregistrement['quantite'];
    //         $detailVente->prix = $enregistrement['prix'];
    //         $detailVente->save();
    //     }

    //     return response()->json(['message' => 'Enregistrements de détails de vente enregistrés avec succès'], 200);
    // }
   
    public function edit(Vente $vente)
    {
        $clients = Client::all();
        $articles = Article::all();
        return view('vente.edit', compact('vente', 'clients', 'articles'));
    }

    public function update(Request $request, Vente $vente)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'client_id' => 'required|exists:clients,id',
        ]);

        $vente->update($validatedData);
        return redirect()->route('vente.index')->with('success', 'Vente mise à jour avec succès');
    }

    public function show(Vente $vente)
{
    $vente->load('details.article'); // Chargement de la relation avec les détails de vente et les articles
    return view('vente.show', compact('vente'));
}


    public function destroy(Vente $vente)
    {
        $vente->delete();
        return redirect()->route('vente.index');
    }
}
