<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mode;

class ModeController extends Controller
{
    public function index()
    {
        $modes = Mode::all();
        return view('mode.index', compact('modes'));
    }

    public function create()
    {
        return view('mode.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'mode' => 'required|string|max:255',
        ]);

        Mode::create([
            'mode' => $request->mode,
        ]);

        return redirect()->route('modes.index')->with('success', 'Mode ajouté avec succès.');
    }

    public function show(Mode $mode)
    {
        return view('mode.show', compact('mode'));
    }

    public function edit(Mode $mode)
    {
        return view('mode.edit', compact('mode'));
    }

    public function update(Request $request, Mode $mode)
    {
        $request->validate([
            'mode' => 'required|string|max:255',
        ]);

        $mode->update([
            'mode' => $request->mode,
        ]);

        return redirect()->route('modes.index')->with('success', 'Mode mis à jour avec succès.');
    }

    public function destroy(Mode $mode)
    {
        $mode->delete();

        return redirect()->route('modes.index')->with('success', 'Mode supprimé avec succès.');
    }
}
