<?php

namespace App\Http\Controllers;

use App\Models\SousFamille;
use Illuminate\Http\Request;
use App\Models\Famille;

class SousFamilleController extends Controller
{
    public function index()
    {$sousFamilles = SousFamille::orderBy('id', 'desc')->paginate(10);
        $familles=Famille::orderBy('id', 'desc')->paginate(10);
        return view('sousfamille.index', compact('sousFamilles','familles'));

        }
      
        
        public function search(Request $request)
        {
            $output = "";
            
            $sousFamilles = SousFamille::where('name', 'like', '%' . $request->search . '%')
            ->orWhereHas('famille', function($query) use ($request) {
                $query->where('famille', 'like', '%' . $request->search . '%');
            })
            ->get();
            
            foreach ($sousFamilles as $sousFamille) {
                $output .= '<tr><td>' . $sousFamille->name . '</td>
                    <td>' .$sousFamille->famille->famille. '</td>
                    <td>
                        <form action="' . route('sousfamille.edit', $sousFamille->id) . '" method="GET" style="display: inline;">
                            ' . csrf_field() . '
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalSousFamilleedit' . $sousFamille->id . '">
                                modifier
                            </button>
                        </form>
                        <form action="' . route('sousfamille.destroy', $sousFamille->id) . '" method="POST" style="display: inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cette sous-famille ?\')">Supprimer</button>
                        </form>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalSousFamille' . $sousFamille->id . '">
                            Détails
                        </button>
                    </td></tr>';
            }
            
            return response($output);
        }
        
    public function create()
    {
        $familles = Famille::all();
        return view('sousfamille.create', compact('familles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'famille_id' => 'required|exists:familles,id',
            'name' => 'required|max:255',
        ]);

        SousFamille::create($validatedData);

        return redirect('/sousfamilles')->with('success', 'Sous-famille ajoutée avec succès');
    }

    public function show(SousFamille $sousFamille)
    {
        $famille = $sousFamille->famille;
        return view('sousfamille.show', compact('sousFamille', 'famille'));
    }

    public function edit(SousFamille $sousFamille)
    {
        $familles = Famille::all();
        return view('sousfamille.edit', compact('sousFamille', 'familles'));
    }

    public function update(Request $request, SousFamille $sousFamille)
    {
        $validatedData = $request->validate([
            'famille_id' => 'required|exists:familles,id',
            'name' => 'required|max:255',
        ]);

        $sousFamille->update($validatedData);

        return redirect('/sousfamilles')->with('success', 'Sous-famille mise à jour avec succès');
    }

    public function destroy(SousFamille $sousFamille)
    {
        $sousFamille->delete();
        return redirect()->route('sousfamille.index')->with('success', 'Sous-famille supprimée avec succès');
    }
}
