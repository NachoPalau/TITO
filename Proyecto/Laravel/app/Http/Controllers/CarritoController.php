<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class CarritoController extends Controller
{
    // Agregar producto al carrito
    public function agregar(Request $request)
    {
        $usuario = Auth::user();
        $productoId = $request->input('producto_id');
        $cantidad = $request->input('cantidad');
        $precio = $request->input('precio');
    
        // Obtener el carrito actual del usuario
        $carrito = json_decode($usuario->carrito, true) ?: [];
    
        // Verificar si el producto ya está en el carrito
        $productoExistente = false;
        foreach ($carrito as &$producto) {
            if ($producto['idProducto'] == $productoId) {
                // Si el producto ya está en el carrito, aumentamos su cantidad
                $producto['cantidad'] += $cantidad;
                // Asegurarnos de que la cantidad no sea menor a 1
                if ($producto['cantidad'] < 1) {
                    $producto['cantidad'] = 1;
                }
                $productoExistente = true;
                break;
            }
        }
    
        // Si el producto no existe, lo agregamos al carrito
        if (!$productoExistente) {
            // Aquí puedes agregar más detalles del producto si lo deseas
            $carrito[] = [
                'idProducto' => $productoId,
                'precio' => $precio,
                'cantidad' => $cantidad,
            ];
        }
    
        // Guardar el carrito actualizado
        $usuario->carrito = json_encode($carrito);
        $usuario->save();
    
        // Redirigir al usuario al carrito o a la página anterior
        return back()->with('success', 'Producto agregado al carrito');
    }
    public function tramitarPedido(Request $request)
    {
        $user = Auth::user();
        $carrito = $request->input('carrito');

        // Validar que el carrito es un array
        if (!is_array($carrito)) {
            return response()->json(['error' => 'El carrito no es válido.'], 400);
        }

        // Actualizar la columna carrito del usuario
        $user->carrito = json_encode($carrito);
        $user->save();

        return response()->json(['success' => 'Carrito actualizado correctamente.']);
    }
    // Ver el carrito de compras
    public function verCarrito()
    {
        $usuario = Auth::user();
        $carrito = json_decode($usuario->carrito, true) ?: [];

        // Sumar el total del carrito
        $total = array_sum(array_map(function ($producto) {
            return $producto['precio'] * $producto['cantidad'];
        }, $carrito));

        return view('carrito', compact('carrito', 'total'));
    }

    public function mostrarPago()
    {
    $usuario = Auth::user();
    $carrito = json_decode($usuario->carrito, true) ?: [];

    // Sumar el total del carrito
    $total = array_sum(array_map(function ($producto) {
        return $producto['precio'] * $producto['cantidad'];
    }, $carrito));

    return view('pago', compact('total'));
    }

    // Eliminar producto del carrito
    public function eliminar($productoId)
    {
        $usuario = Auth::user();
        $carrito = json_decode($usuario->carrito, true) ?: [];

        // Filtrar el producto por el id y eliminarlo
        $carrito = array_filter($carrito, function ($producto) use ($productoId) {
            return $producto['idProducto'] != $productoId;
        });

        // Reindexar el arreglo (eliminando las claves numéricas no consecutivas)
        $carrito = array_values($carrito);

        // Guardamos el carrito actualizado en la base de datos
        $usuario->carrito = json_encode($carrito);
        $usuario->save();

        return back()->with('success', 'Producto eliminado del carrito');
    }
    public function modificarCantidad(Request $request)
    {
        $usuario = Auth::user();
        $productoId = $request->input('producto_id');
        $cantidad = $request->input('cantidad');
    
        // Obtener el carrito actual del usuario
        $carrito = json_decode($usuario->carrito, true) ?: [];
    
        // Buscar el producto en el carrito y actualizar la cantidad
        foreach ($carrito as $key => &$producto) {
            if ($producto['idProducto'] == $productoId) {
                // Actualizar la cantidad
                $producto['cantidad'] += $cantidad;
    
                // Si la cantidad es menor a 1 después de restar, eliminar el producto
                if ($producto['cantidad'] < 1) {
                    // Eliminar el producto del carrito
                    unset($carrito[$key]);
                } else {
                    // Asegurarse de que la cantidad no sea negativa
                    $producto['cantidad'] = max($producto['cantidad'], 1);
                }
                break;
            }
        }
    
        // Reindexar el array del carrito para que no haya índices perdidos
        $carrito = array_values($carrito);
    
        // Guardar el carrito actualizado
        $usuario->carrito = json_encode($carrito);
        $usuario->save();
    
        // Redirigir a la página anterior con un mensaje de éxito
        return back()->with('success', 'Cantidad actualizada correctamente');
    }
    
}
