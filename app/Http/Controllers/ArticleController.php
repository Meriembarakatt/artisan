<?php

namespace App\Http\Controllers;

use App\Models\article;
use App\Models\SousFamille;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = article::with('sousFamille')->get();
        return view('article.index', compact('articles'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $sousFamilles = SousFamille::all();
        return view('article.create', compact('sousFamilles'));
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
            'designation' => 'required|max:255',
            'prix_ht' => 'required|numeric',
            'qte' => 'required|numeric',
            'stock' => 'required|numeric',
            'sousfamille_id' => 'required|exists:sous_familles,id', // Assurez-vous que la sous-famille existe en base de données
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation pour le champ image (facultatif et ajustable selon vos besoins)
        ]);

        // Vérifiez si une image a été téléchargée
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName); // Stockez l'image dans le répertoire de stockage
        } else {
            $imageName = 'default.jpg'; // Utilisez une image par défaut si aucune image n'est téléchargée
        }

        // Créez l'article avec les données validées et l'image
        Article::create([
            'designation' => $validatedData['designation'],
            'prix_ht' => $validatedData['prix_ht'],
            'qte' => $validatedData['qte'],
            'stock' => $validatedData['stock'],
            'image' => $imageName,
            'sousfamille_id' => $validatedData['sousfamille_id'],
        ]);

        return redirect('/article')->with('success', 'Article ajouté avec succès');
    }

}
