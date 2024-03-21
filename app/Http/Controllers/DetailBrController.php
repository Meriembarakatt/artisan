<?php

namespace App\Http\Controllers;

use App\Models\DetailBr;
use App\Models\article;
use App\Models\Bonreseption;
use Illuminate\Http\Request;

class DetailBrController extends Controller
{
    public function index()
    {
        $detail__brs=DetailBr::all();
        return view('details.index',compact('detail__brs'));
    }

    public function create()
    {
        $articles = article::all();
        $bonreceptions = Bonreseption::all();
        return view('details.create', compact('articles', 'bonreceptions'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'article_id' => 'required|exists:articles,id',
            'br_id' => 'required|exists:bonreseptions,id',
            'qte' => 'required',
            'prix' => 'required',
        ]);

        DetailBr::create($validatedData);

        return redirect('/details')->with('success', 'Détail de bon de réception ajouté avec succès');
    }

    public function show(DetailBr $detail_Br)
    {
        return view('details.show', compact('detail_Br'));
    }

    public function edit(DetailBr $detail_Br)
    {
        return view('details.edit', compact('detail_Br'));
    }

    public function update(Request $request, DetailBr $detail_Br)
    {
        $validatedData = $request->validate([
            'article_id' => 'required|exists:articles,id',
            'br_id' => 'required|exists:bonreseptions,id',
            'qte' => 'required',
            'prix' => 'required',
        ]);

        $detail_Br->update($validatedData);

        return redirect('/details')->with('success', 'Détail de bon de réception mis à jour avec succès');
    }

    public function destroy(Detail_Br $detail_Br)
    {
        $detail_Br->delete();

        return redirect('/details')->with('success', 'Détail de bon de réception supprimé avec succès');
    }
}
