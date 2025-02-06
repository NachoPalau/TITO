<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function agregarAlCarrito(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Debes iniciar sesión para agregar productos al carrito.');
        }

        $usuario = Auth::user();
        $productoId = $request->input('producto_id');

        // Convertir carrito en array si está vacío
        $carrito = json_decode($usuario->carrito, true) ?? [];

        // Agregar el producto si no está en el carrito
        if (!in_array($productoId, $carrito)) {
            $carrito[] = $productoId;
        }

        // Guardar carrito actualizado
        $usuario->carrito = json_encode($carrito);
        $usuario->save();

        return back()->with('success', 'Producto agregado al carrito.');
    }
    public function sumar($id)
    {
        $user = Auth::user();
        
        // Aseguramos que el carrito siempre sea un string antes de decodificarlo
        $carrito = is_string($user->carrito) ? json_decode($user->carrito, true) : [];
    
        if (!is_array($carrito)) {
            $carrito = []; // En caso de error, aseguramos que sea un array vacío
        }
    
        // Incrementar la cantidad del producto
        $carrito[$id] = isset($carrito[$id]) ? $carrito[$id] + 1 : 1;
    
        // Guardamos nuevamente en la base de datos
        $user->carrito = json_encode($carrito);
        $user->save();
    
        return redirect()->back()->with('success', 'Cantidad aumentada');
    }
    
    public function restar($id)
    {
        $user = Auth::user();
        
        // Aseguramos que el carrito sea un string antes de decodificarlo
        $carrito = is_string($user->carrito) ? json_decode($user->carrito, true) : [];
    
        if (!is_array($carrito)) {
            $carrito = [];
        }
    
        // Reducir la cantidad del producto si existe en el carrito
        if (isset($carrito[$id])) {
            $carrito[$id]--;
    
            if ($carrito[$id] <= 0) {
                unset($carrito[$id]); // Eliminar si la cantidad es 0
            }
        }
    
        // Guardamos nuevamente en la base de datos
        $user->carrito = json_encode($carrito);
        $user->save();
    
        return redirect()->back()->with('success', 'Cantidad reducida');
    }
    
}
