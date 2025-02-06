<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class PedidoController extends Controller
{
    // Función para generar código de seguimiento al hacerse un pedido
    public function generaCodigoSeguimiento($id_pedido)
    {
        $pedido = Pedido::find($id_pedido);

        if (!$pedido) {
            return response()->json(['error' => 'Pedido no encontrado'], 404);
        }

        if (!$pedido->codigo_seguimiento) {
            $pedido->codigo_seguimiento = 'TRK' . strtoupper(uniqid());
        }
        $estados = ['En preparación', 'En camino', 'Repartido'];

        if (empty($pedido->estado)) {
            Log::info('Estado vacío o NULL detectado para pedido con ID: ' . $id_pedido);
            $pedido->estado = $estados[array_rand($estados)];
        }else{
            Log::info('Estado NO vacío: ' . $pedido->estado . ' para pedido con ID: ' . $id_pedido);
        }
        $pedido->save();


        return response()->json([
            'codigo_seguimiento' => $pedido->codigo_seguimiento,
            'estado' => $pedido->estado,
            'direccion' => $pedido->direccion,
            'actualizado_en' => $pedido->updated_at ? $pedido->updated_at->format('d-m-Y H:i:s') : 'No hay actualizaciones',
        ]);
    }

    // Método para hacer el seguimiento usando su código
    public function track(Request $request)
    {
        $request->validate([
            'codigo_seguimiento' => 'required|string',
        ]);

        $pedido = Pedido::where('codigo_seguimiento', $request->codigo_seguimiento)->first();

        if (!$pedido) {
            return response()->json(['error' => 'Pedido no encontrado'], 404);
        }

        return response()->json([
            'codigo_seguimiento' => $pedido->codigo_seguimiento,
            'estado' => $pedido->estado,
            'direccion' => $pedido->direccion,
            'actualizado_en' => $pedido->updated_at ? $pedido->updated_at->format('d-m-Y H:i:s') : 'No se han encontrado actualizaciones',
        ]);
    }
    public function misPedidos(){
        if(!Auth::check()){
            return redirect()->route('login')->with('error', 'Debes iniciar sesion para ver tus pedidos');
        }
        $pedidos = Pedido::where('id_usuario', Auth::id())->get();

        return view('pedido.misPedidos',compact('pedidos'));
    }
}
