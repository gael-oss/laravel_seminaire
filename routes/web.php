use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeminaireController;
use App\Http\Controllers\PresentateurController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\HomeController;

Auth::routes();

Route::middleware(['auth'])->group(function () {
    
    Route::get('/', [HomeController::class, 'index'])->name('home');

  
    Route::middleware(['role:secretaire'])->group(function () {
        Route::resource('seminaires', SeminaireController::class);
        Route::resource('presentateurs', PresentateurController::class);
        Route::resource('themes', ThemeController::class);
    });
});
