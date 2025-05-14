use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeminaireController;
use App\Http\Controllers\PresentateurController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DemandeController;

Auth::routes();
Route::get('/calendrier', [SeminaireController::class, 'calendrier'])->name('calendrier');
Route::get('/seminaires/{seminaire}/download', [SeminaireController::class, 'download'])
    ->name('seminaires.download');
Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Routes pour les secrétaires
    Route::middleware(['role:secretaire'])->prefix('secretaire')->group(function () {
        Route::resource('seminaires', SeminaireController::class);
        Route::resource('presentateurs', PresentateurController::class);
        Route::resource('themes', ThemeController::class);
        Route::resource('demandes', DemandeController::class)->only(['create', 'store', 'index']);
        
        // Routes de validation
        Route::post('/seminaires/{seminaire}/valider', [SeminaireController::class, 'valider'])->name('seminaires.valider');
        Route::post('/seminaires/{seminaire}/rejeter', [SeminaireController::class, 'rejeter'])->name('seminaires.rejeter');
    });
});
