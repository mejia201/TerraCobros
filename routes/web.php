<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


//RUTAS PREDETERMINADAS

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



//RUTAS PARA USUARIO
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//RUTAS PARA CLIENTES

Route::controller(ClienteController::class)->group(function () {
    Route::get('/clientes', 'index')->middleware(['auth', 'verified'])->name('cliente.index');
    Route::get('/clientes/create', 'create')->middleware(['auth', 'verified'])->name('cliente.create');
    Route::get('/clientes/edit/{id}', 'edit')->middleware(['auth', 'verified'])->name('cliente.edit');

    // POST METHOD
    Route::post('/clientes/create', 'store')->middleware(['auth', 'verified'])->name('cliente.store');


    // PUT METHOD
    Route::put('/clientes/update/{id}', 'update')->middleware(['auth', 'verified'])->name('cliente.update');


    // DELETE METHOD
    Route::delete('/clientes/destroy/{id}', 'destroy')->middleware(['auth', 'verified'])->name('cliente.destroy');
});




require __DIR__.'/auth.php';
