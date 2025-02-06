<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PedidoController;
use App\Models\Pedido;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

//Pago
Route::get('pago',[PagoController::class,'ensenyaMetPago'])->name('pago.pago');
Route::post('/pago',[PagoController::class,'procesarPago'])->name('pago.process');

Route::get('/track_pedido', function () {
    return view('pedido.trackeo');
})->name('track.pedido.view');

Route::post('/track_pedido', [PedidoController::class, 'track'])->name('track.pedido');
Route::get('/mis_pedidos', [PedidoController::class, 'misPedidos'])->name('mis.pedidos')->middleware('auth');
// Route::get('/track_pedido',[PedidoController::class,'track'])->name('track.pedido');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
