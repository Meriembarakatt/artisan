<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Mode;

class ModeController extends Controller
{
    public function index()
    {   
        $modes=Mode::all();
        return view('mode.index', ['modes' => $modes]);
    }
}
