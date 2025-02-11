<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\ProductoController;
use App\Models\Producto;
use App\Models\Receta;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\RecetaController;


Route::get('/', function () {
    $recetasMas = Receta::orderByDesc('guardados')->take(5)->get();
    return view('index',['recetas'=>$recetasMas]);
})->name('index');



Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store'])->name('register');

Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('miReceta', [RecetaController::class, 'index3'])->name('misrecetas');
Route::post('editProducto', [ProductoController::class, 'index2'])->name('editProducto');

Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
->name('password.request');

Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
->name('password.email');

Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
->name('password.reset');

Route::post('reset-password', [NewPasswordController::class, 'store'])
->name('password.store');

//Pago
Route::get('pago',[PagoController::class,'ensenyaMetPago'])->name('pago.pago');
Route::post('/pago',[PagoController::class,'procesarPago'])->name('pago.process');

Route::get('/track_pedido', function () {
    return view('pedido.trackeo');
})->name('track.pedido.view');

Route::get('/pedidos', [PedidoController::class, 'misPedidos'])->name('pedidos')->middleware('auth');
// Route::get('/track_pedido',[PedidoController::class,'track'])->name('track.pedido');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/prueba',[ProductoController::class, 'index'])->name('prueba');

Route::get('/api/productos', function () {
    return response()->json(Producto::all());
});


Route::get('/productos', [ProductoController::class, 'index'])->name('productos');
Route::get('/products/{id}/edit', [ProductoController::class, 'edit']);
Route::post('/products/{id}/update', [ProductoController::class, 'update']);

Route::get('/eventos', function () {
    return view('eventos');
})->name('eventos');

Route::get('/recetas', [RecetaController::class, 'index'])->name('recetas');
Route::get('newReceta', [RecetaController::class, 'index2'])->name('newReceta');
Route::get('recetas/create', [RecetaController::class, 'create'])->name('recetas.create');
Route::get('/recetas/{id}/edit', [RecetaController::class, 'edit'])->name('recetas.edit');
Route::post('recetas', [RecetaController::class, 'store'])->name('recetas.store');
Route::put('/recetas/{id}', [RecetaController::class, 'update'])->name('recetas.update'); 
Route::delete('/recetas/{id}', [RecetaController::class, 'destroy'])->name('recetas.destroy');

Route::post('/guardar-favoritos', [RecetaController::class, 'guardarFavoritos']);
Route::get('/eliminar-favorito/{recetaId}', [RecetaController::class, 'eliminarDeFavoritos'])->name('eliminar.favorito');



Route::middleware('auth')->group(function () {
    Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::post('/carrito/eliminar/{productoId}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
    Route::post('/carrito/modificar', [CarritoController::class, 'modificarCantidad'])->name('carrito.modificar');
    Route::get('/carrito', [CarritoController::class, 'verCarrito'])->name('carrito.ver');
});

