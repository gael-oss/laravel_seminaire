namespace App\Http\Controllers;

use App\Models\Seminaire;
use App\Models\Presentateur;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeminaireController extends Controller
{
    public function create()
    {
        $presentateurs = Presentateur::all();
        $themes = Theme::all();
        return view('seminaires.create', compact('presentateurs', 'themes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'date_presentation' => 'required|date',
            'presentateur_id' => 'required|exists:presentateurs,id',
            'theme_id' => 'required|exists:themes,id',
            'fichier' => 'nullable|file|mimes:pdf,ppt,pptx'
        ]);

        $seminaire = Seminaire::create($request->except('fichier'));

        if ($request->hasFile('fichier')) {
            $path = $request->file('fichier')->store('public/seminaires');
            $seminaire->update(['fichier' => str_replace('public/', '', $path)]);
        }

        return redirect()->route('seminaires.index')->with('success', 'Séminaire créé !');
    }
 $presentateur = $seminaire->presentateur;
    $presentateur->notify(new SeminaireValideNotification($seminaire));

    
}
