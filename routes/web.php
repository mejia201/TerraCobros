<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetallePagoController;
use App\Http\Controllers\FinanciamientoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropiedadController;
use Illuminate\Support\Facades\Route;


//RUTAS PREDETERMINADAS

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


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



//RUTAS PARA PROPIEDAD

Route::controller(PropiedadController::class)->group(function () {
    Route::get('/propiedades', 'index')->middleware(['auth', 'verified'])->name('propiedad.index');
    Route::get('/propiedades/create', 'create')->middleware(['auth', 'verified'])->name('propiedad.create');
    Route::get('/propiedades/edit/{id}', 'edit')->middleware(['auth', 'verified'])->name('propiedad.edit');

    // POST METHOD
    Route::post('/propiedades/create', 'store')->middleware(['auth', 'verified'])->name('propiedad.store');


    // PUT METHOD
    Route::put('/propiedades/update/{id}', 'update')->middleware(['auth', 'verified'])->name('propiedad.update');


    // DELETE METHOD
    Route::delete('/propiedades/destroy/{id}', 'destroy')->middleware(['auth', 'verified'])->name('propiedad.destroy');
});



//RUTAS PARA FINANCIAMIENTO

Route::controller(FinanciamientoController::class)->group(function () {
    Route::get('/financiamientos', 'index')->middleware(['auth', 'verified'])->name('financiamiento.index');
    Route::get('/financiamientos/create', 'create')->middleware(['auth', 'verified'])->name('financiamiento.create');
    Route::get('/financiamientos/edit/{id}', 'edit')->middleware(['auth', 'verified'])->name('financiamiento.edit');
    Route::get('/financiamiento/opciones', 'obtenerOpcionesFinanciamiento')->middleware(['auth', 'verified'])->name('financiamiento.obtenerOpciones');
    // POST METHOD
    Route::post('/financiamientos/create', 'store')->middleware(['auth', 'verified'])->name('financiamiento.store');


    // PUT METHOD
    Route::put('/financiamientos/update/{id}', 'update')->middleware(['auth', 'verified'])->name('financiamiento.update');


    // DELETE METHOD
    Route::delete('/financiamientos/destroy/{id}', 'destroy')->middleware(['auth', 'verified'])->name('financiamiento.destroy');
});



//RUTAS PARA PAGOS

Route::controller(PagoController::class)->group(function () {
    Route::get('/pagos', 'index')->middleware(['auth', 'verified'])->name('pago.index');
    Route::get('/pagos/create', 'create')->middleware(['auth', 'verified'])->name('pago.create');
    Route::get('/pagos/edit/{id}', 'edit')->middleware(['auth', 'verified'])->name('pago.edit');
    Route::get('/financiamientos/{id_financiamiento}/cuotas', [PagoController::class, 'getCuotasByFinanciamiento']);    

    // POST METHOD
    Route::post('/pagos/create', 'store')->middleware(['auth', 'verified'])->name('pago.store');


    // PUT METHOD
    Route::put('/pagos/update/{id}', 'update')->middleware(['auth', 'verified'])->name('pago.update');


    // DELETE METHOD
    Route::delete('/pagos/destroy/{id}', 'destroy')->middleware(['auth', 'verified'])->name('pago.destroy');
});



require __DIR__.'/auth.php';
