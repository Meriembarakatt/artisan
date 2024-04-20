<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\SousFamille;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Affiche une liste des articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { $articles = Article::orderBy('id', 'desc')->with('sousFamille')->paginate(10);

        return view('article.index', compact('articles'));
    }
    
    /**
     * Affiche le formulaire de création d'un nouvel article.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sousFamilles = SousFamille::all();
        return view('article.create', compact('sousFamilles'));
    }
    
    
    /**
     * Valide et stocke un nouvel article.
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
            'sousfamille_id' => 'required|exists:sous_familles,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
        ]);
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }
    
        Article::create($validatedData);
    
        return redirect()->route('article.index')->with('success', 'Article ajouté avec succès');
    }
    
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('article.show', compact('article'));
    }

    /**
     * Affiche le formulaire de modification d'un article.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
   
    public function edit($id)
{
    $article = Article::findOrFail($id);
    $sousFamilles = SousFamille::all();
    
    return view('article.edit', compact('article', 'sousFamilles'));
}


    /**
     * Met à jour un article spécifique dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'designation' => 'required|max:255',
            'prix_ht' => 'required|numeric',
            'qte' => 'required|numeric',
            'stock' => 'required|numeric',
            'sousfamille_id' => 'required|exists:sous_familles,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $article = Article::findOrFail($id);
        $article->fill($validatedData);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $article->image = $imagePath;
        }

        $article->save();

        return redirect()->route('article.index')->with('success', 'Article mis à jour avec succès');
    }

    /**
     * Supprime un article spécifique de la base de données.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('article.index')->with('success', 'Article supprimé avec succès');
    }
}