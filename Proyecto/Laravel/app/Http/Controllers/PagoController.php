<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class PagoController extends Controller
{

    public function procesarPago(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.50', //para aceptar de minimo 50 cents
            'token' => 'required' //token de stripe generado por Stripe.js
        ]);

        try {
            Stripe::setApiKey(config('services.stripe.secret_key'));

            //se crea el cargo
            $cargo = Charge::create([
                'amount' => $request->amount * 100,
                'currency' => 'usd', //codigo de la moneda
                'source' => $request->token,
                'description' => 'Pago seguro en laravel',
            ]);
            return back()->with('success', 'Pago realizado con exito');
        } catch (\Exception $e) {
            return back()->withErrors('Error al procesar el pago: ' . $e->getMessage());
        }
    }
}