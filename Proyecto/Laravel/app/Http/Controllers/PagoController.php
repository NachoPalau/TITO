<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\Auth;
use App\Models\Pedido;
use App\Models\Producto;

class PagoController extends Controller
{
    public function procesarPago(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:0.50', // Para aceptar un mínimo de 50 cents
        'token' => 'required', // Token de Stripe generado por Stripe.js
        'direccion' => 'required|string', // Solicitar la dirección en el formulario de pago
    ]);

    try {
        Stripe::setApiKey(config('services.stripe.secret_key'));

        // Crear el cargo
        $cargo = Charge::create([
            'amount' => $request->amount * 100,
            'currency' => 'usd', // Código de la moneda
            'source' => $request->token,
            'description' => 'Pago seguro en Laravel',
        ]);

        $usuario = Auth::user();

        $carrito = json_decode($usuario->carrito, true) ?: [];

        $total = array_sum(array_map(function ($producto) {
            return $producto['precio'] * $producto['cantidad'];
        }, $carrito));

        // Crear un nuevo pedido
        $pedido = new Pedido();
        $pedido->id_usuario = $usuario->id;
        $pedido->estado = 'En preparación';
        $pedido->direccion = $request->direccion;
        $pedido->total = $total;
        $pedido->save();

        // Borrar el carrito del usuario
        $usuario->carrito = json_encode([]);
        $usuario->save();

        return back()->with('success', 'Pago realizado con exito. Seras redireccionado en 5 segundos');
    } catch (\Exception $e) {
        return back()->withErrors('Error al procesar el pago: ' . $e->getMessage());
    }
}
}