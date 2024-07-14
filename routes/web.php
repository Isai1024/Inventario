<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\FormasdepagoController;

Route::resource('productos', ProductoController::class);

Route::resource('categorias', CategoriaController::class);

Route::resource('clientes', ClienteController::class);

Route::resource('ventas', VentaController::class);

Route::resource('inventarios', InventarioController::class)->except(['show']);

Route::resource('cotizaciones', CotizacionController::class);

Route::resource('formasdepago', FormasdepagoController::class);

Route::post('/cotizaciones', [CotizacionController::class, 'store'])->name('cotizaciones.store');

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