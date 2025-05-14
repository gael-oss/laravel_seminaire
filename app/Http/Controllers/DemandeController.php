<?php

namespace App\Http\Controllers;

use App\Models\Seminaire;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DemandeController extends Controller
{
    public function create()
    {
        $themes = Theme::all();
        return view('demandes.create', compact('themes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'theme_id' => 'required|exists:themes,id',
            'resume' => 'required|file|mimes:pdf|max:2048',
        ]);

        $filePath = $request->file('resume')->store('resumes', 'public');

        Seminaire::create([
            'titre' => $request->titre,
            'theme_id' => $request->theme_id,
            'presentateur_id' => auth()->user()->presentateur->id,
            'resume_path' => $filePath,
            'statut' => 'en_attente'
        ]);

        return redirect()->route('demandes.index')->with('success', 'Demande soumise avec succès !');
    }
}
