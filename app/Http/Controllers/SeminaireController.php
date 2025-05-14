<?php

namespace App\Http\Controllers;

use App\Models\Seminaire;
use App\Models\Presentateur;
use App\Models\Theme;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Notifications\ProgrammePublieNotification; 
use App\Notifications\SeminaireValideNotification;
use App\Notifications\SeminaireRejeteNotification;

class SeminaireController extends Controller
{
    public function index()
    {
        $seminaires = Seminaire::with(['presentateur', 'theme'])
            ->where('statut', 'en_attente')
            ->get();

        return view('seminaires.index-secretaire', compact('seminaires'));
    }

    public function valider(Seminaire $seminaire)
    {
        $seminaire->update([
            'statut' => 'validé',
            'date_presentation' => now()->addDays(14)
        ]);

        // Notification au présentateur
        $seminaire->presentateur->user->notify(new SeminaireValideNotification($seminaire));

        // Notification à tous les étudiants
        User::where('role', 'etudiant')->each(function ($user) use ($seminaire) {
            $user->notify(new ProgrammePublieNotification($seminaire));
        });

        return redirect()->route('seminaires.index-secretaire')
            ->with('success', 'Séminaire validé et étudiants notifiés !');
    }

    public function rejeter(Request $request, Seminaire $seminaire)
    {
        $request->validate(['raison' => 'required|string']);

        $seminaire->update([
            'statut' => 'rejeté',
            'raison_rejet' => $request->raison
        ]);

        $seminaire->presentateur->user->notify(
            new SeminaireRejeteNotification($seminaire->titre, $request->raison)
        );

        return back()->with('success', 'Demande rejetée avec succès.');
    }

    public function calendrier()
    {
        $seminaires = Seminaire::where('statut', 'validé')
            ->where('date_presentation', '>', now())
            ->orderBy('date_presentation')
            ->get();

        return view('seminaires.calendrier', compact('seminaires'));
    }

    public function download(Seminaire $seminaire)
    {
        if (!Storage::exists('public/' . $seminaire->fichier)) {
            abort(404);
        }

        return Storage::download('public/' . $seminaire->fichier);
    }

   
}
