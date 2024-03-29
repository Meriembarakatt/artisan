<?php

namespace App\Http\Controllers;

use App\Models\Article;
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
        $articles = Article::with('sousFamille')->get();
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
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'designation' => 'required|max:255',
            'prix_ht' => 'required|numeric',
            'qte' => 'required|numeric',
            'stock' => 'required|numeric',
            'sousfamille_id' => 'required|exists:sous_familles,id', // Assurez-vous que la sous-famille existe en base de données
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480', // Validation pour le champ image (facultatif et ajustable selon vos besoins)
        ]);
    
        // Vérifiez si une image a été téléchargée
        if ($request->hasFile('image')) {
            // Stockez l'image dans le répertoire public/images
            $imagePath = $request->file('image')->store('images', 'public');
    
            // Ajoutez le chemin de l'image aux données validées
            $validatedData['image_path'] = $imagePath;
        }
    
        // Créez l'article avec les données validées
        Article::create($validatedData);
    
        // Redirigez l'utilisateur vers la liste des articles avec un message de succès
        return redirect()->route('article.index')->with('success', 'Article ajouté avec succès');
    }
    

}
