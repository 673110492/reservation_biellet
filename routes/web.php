<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgenceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\front\AcceuilController;
use App\Http\Controllers\front\CartsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReserverController;
use App\Http\Controllers\TrajetController;
use App\Http\Controllers\VehiculeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::prefix('agences')->name('agences.')->group(function () {
    Route::get('/', [AgenceController::class, 'index'])->name('index');
    Route::get('/create', [AgenceController::class, 'create'])->name('create');
    Route::post('/', [AgenceController::class, 'store'])->name('store');
    Route::get('/{id}', [AgenceController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [AgenceController::class, 'edit'])->name('edit');
    Route::put('/{id}', [AgenceController::class, 'update'])->name('update');
    Route::delete('/{id}', [AgenceController::class, 'destroy'])->name('destroy');
});

Route::prefix('vehicules')->name('vehicules.')->group(function () {
    Route::get('/', [VehiculeController::class, 'index'])->name('index');
    Route::get('/create', [VehiculeController::class, 'create'])->name('create');
    Route::post('/', [VehiculeController::class, 'store'])->name('store');
    Route::get('/{id}', [VehiculeController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [VehiculeController::class, 'edit'])->name('edit');
    Route::put('/{id}', [VehiculeController::class, 'update'])->name('update');
    Route::delete('/{id}', [VehiculeController::class, 'destroy'])->name('destroy');
});
Route::patch('vehicules/{id}/toggle-status', [VehiculeController::class, 'toggleStatus'])->name('vehicules.toggleStatus');




Route::controller(TrajetController::class)->prefix('trajets')->name('trajets.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{trajet}', 'show')->name('show');
    Route::get('/{trajet}/edit', 'edit')->name('edit');
    Route::put('/{trajet}', 'update')->name('update');
    Route::delete('/{trajet}', 'destroy')->name('destroy');
});

Route::prefix('reservations')->name('reservations.')->group(function () {
    Route::get('/', [ReservationController::class, 'index'])->name('index');
    Route::get('/create', [ReservationController::class, 'create'])->name('create');
    Route::post('/', [ReservationController::class, 'store'])->name('store');
    Route::get('/{id}', [ReservationController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [ReservationController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ReservationController::class, 'update'])->name('update');
    Route::delete('/{id}', [ReservationController::class, 'destroy'])->name('destroy');
    Route::patch('/{id}/changer-statut', [ReservationController::class, 'changerStatut'])->name('changerStatut');
});
Route::patch('/reservations/{reservation}/status', [ReservationController::class, 'updateStatus'])->name('reservations.updateStatus');


Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/users', [UserController::class, 'store'])->name('user.store');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('user.show');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});


// route front
Route::get('/', [AcceuilController::class, 'index']);
Route::get('/vehicule/{id}', [AcceuilController::class, 'show'])->name('vehicule.show');


Route::prefix('reservation')->name('reservation.')->group(function () {
    Route::get('/', [\App\Http\Controllers\front\ReserverController::class, 'index'])->name('index');
    Route::post('/', [\App\Http\Controllers\front\ReserverController::class, 'store'])->name('store');
});
Route::get('/reservation/print/{id}', [\App\Http\Controllers\front\ReserverController::class, 'print'])->name('reservation.print');


Route::get('/cart', [CartsController::class, 'index'])->name('cart.index');


// Page d’accueil publique
Route::get('/', [AcceuilController::class, 'index'])->name('home');

// Routes accessibles uniquement aux utilisateurs authentifiés
Route::middleware('auth')->group(function () {

    // Routes accessibles uniquement aux admins
    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('agences')->name('agences.')->group(function () {
            Route::get('/', [AgenceController::class, 'index'])->name('index');
            // autres routes agence
        });

        // autres routes admin
    });

    // Routes utilisateurs authentifiés (non admin)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // etc.
});
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // toutes les autres routes admin ici...
});

