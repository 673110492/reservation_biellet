<?php

use App\Http\Controllers\AgenceController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::prefix('agences')->name('agences.')->group(function () {
    Route::get('/', [AgenceController::class, 'index'])->name('index');
    Route::get('/create', [AgenceController::class, 'create'])->name('create');
    Route::post('/', [AgenceController::class, 'store'])->name('store');
    Route::get('/{id}', [AgenceController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [AgenceController::class, 'edit'])->name('edit');
    Route::put('/{id}', [AgenceController::class, 'update'])->name('update');
    Route::delete('/{id}', [AgenceController::class, 'destroy'])->name('destroy');
});
