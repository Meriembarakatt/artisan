<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detailvente;
use App\Models\Vente;
use App\Models\article;

class DetailventeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles=article::orderBy('id', 'desc')->paginate(10);
        $ventes=Vente::orderBy('id', 'desc')->paginate(10);
        $detailsvente=Detailvente::orderBy('id', 'desc')->paginate(10);
        return view('detailsvente.index',compact('detailsvente','ventes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articles = article::all();
        $ventes = Vente::all();
        return view('detailsvente.create', compact('articles', 'ventes'));
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'article_id' => 'required|exists:articles,id', // Utilisez article_id.* pour valider un tableau
    //         'vente_id' => 'required|exists:ventes,id',
    //         'qte' => 'required', // Utilisez qte.* pour valider un tableau
    //         'prix' => 'required', // Utilisez prix.* pour valider un tableau
    //     ]);
    
    //     $detail = Detailvente::create($validatedData);
    
    //     return response()->json($detail, 201);
    
    //     // return redirect('/detailsvente')->with('success', 'Détails de vente ajoutés avec succès');
    // }
    public function store(Request $request)
    {
        // Récupérer les données des ventes depuis la requête
        $ventesData = $request->input();
      
        // Créer une nouvelle vente dans la table 'vente'
        $vente = new Vente();
        $vente->date = now(); // Vous pouvez modifier la date selon vos besoins
        $vente->client_id = 1; // Remplacez par l'ID du client si vous le gérez
        
        // Enregistrer la vente dans la base de données
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

    
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Detailvente  $detailvente
     * @return \Illuminate\Http\Response
     */
    public function show(Detailvente $detailvente)
    {
        return view('details.show', compact('detailvente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Detailvente  $detailvente
     * @return \Illuminate\Http\Response
     */
    public function edit(Detailvente $detailvente)
    {
        return view('details.edit', compact('detailvente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Detailvente  $detailvente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detailvente $detailvente)
    {
        $validatedData = $request->validate([
            'article_id' => 'required|exists:articles,id',
            'vente_id' => 'required|exists:ventes,id',
            'qte' => 'required',
            'prix' => 'required',
        ]);

        $detailvente->update($validatedData);

        return redirect('/details')->with('success', 'Détail de vente mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Detailvente  $detailvente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detailvente $detailvente)
    {
        $detailvente->delete();
        return redirect()->route('detailsvente.index')->with('success', 'Détail de vente supprimé avec succès');
    }
}
