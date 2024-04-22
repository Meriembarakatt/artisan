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
        $detailsVente = DetailVente::all();
        return view('vente.index', compact('ventes','detailsVente'));
    
       
    }

    public function create()
    {
        $articles = Article::all();
        $clients = Client::all();
        $ventes = Vente::all();
        return view('vente.create', compact('clients', 'articles', 'ventes'));
    }

     public function totalMontantParClient()
    {
        // Utilisez une requête pour calculer le total de montant (qte * prix) de chaque client
        $totals = Vente::select(DB::raw('SUM(detailsvente.qte * detailsvente.prix) as total'), 'clients.nom')
            ->join('clients', 'ventes.client_id', '=', 'clients.id')
            ->join('detailsvente', 'ventes.id', '=', 'detailsvente.vente_id')
            ->groupBy('clients.nom')
            ->get();

        return view('ventes.total_montant_par_client', ['totals' => $totals]);
    }

    public function store(Request $request)
    {
        // Récupérer les données des ventes depuis la requête
        $validatedData = $request->validate([
            'client_id' => 'required|integer', // Validation du client ID
            'date' => 'required|date', // Validation de la date
            'ventes' => 'required|array', // Validation des ventes (doit être un tableau)
            'ventes.*.article_id' => 'required|integer', // Validation de chaque article ID
            'ventes.*.qte' => 'required|integer', // Validation de chaque quantité
            'ventes.*.prix' => 'required|numeric', // Validation de chaque prix
        ]);
        
        $ventesData = $validatedData['ventes']; // Récupérer les données des ventes
        
        // Créer une nouvelle vente dans la table 'vente'
        $vente = new Vente();
        $vente->client_id = $validatedData['client_id'];
        $vente->date = $validatedData['date'];
        $vente->save();
        
        // Enregistrer les détails des ventes dans la table 'detailsvente'
        foreach ($ventesData as $venteData) {
            $detailsVente = new Detailvente();
            $detailsVente->article_id = $venteData['article_id'];
            $detailsVente->vente_id = $vente->id; // Assigner l'ID de la vente créée
            $detailsVente->qte = $venteData['qte'];
            $detailsVente->prix = $venteData['prix'];
            
            // Enregistrer les détails de vente dans la base de données
            $detailsVente->save();
        }
        
        // Répondre avec succès
        return response()->json(['message' => 'Ventes validées avec succès !'], 200);
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
