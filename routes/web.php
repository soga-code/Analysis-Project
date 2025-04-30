<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AnalyzeController;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::get('users',[UsersController::class,'index'])->name('users.index');
Route::delete('users/{id}',[UsersController::class,'destroy'])->name('users.destroy');


Route::get('/analyze', [AnalyzeController::class, 'index'])->name('analyze');
Route::post('/analyze/store', [AnalyzeController::class, 'analyze'])->name('analyze.process');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
