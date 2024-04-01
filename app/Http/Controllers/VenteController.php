<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Vente;
use App\Models\Article;
use App\Models\DetailVente;
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
    {$articles = Article::all();
        $clients = Client::all();
        $ventes = Vente::all(); 
        return view('vente.create', compact('clients','articles','ventes'));
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



    public function bulkStore(Request $request) {
        foreach ($request->all() as $enregistrement) {
            $detailVente = new DetailVente(); // Remplacez DetailVente par le nom de votre modèle pour les détails de vente
            $detailVente->vente_id = $enregistrement['vente'];
            $detailVente->article_id = $enregistrement['article'];
            $detailVente->quantite = $enregistrement['quantite'];
            $detailVente->prix = $enregistrement['prix'];
            $detailVente->save();
        }
    
        return response()->json(['message' => 'Enregistrements de détails de vente enregistrés avec succès'], 200);
    }



    public function destroy(vente $vente)
    {
        $vente->delete();
        return redirect()->route('vente.index');

    }
    // Other methods like show(), edit(), update(), destroy() can be added as needed
}
