<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Producto;

class ProductoController extends Controller
{
    public function index()
    { $productos = Producto::all();
        $user = auth()->user();
        $carrito=$user->carrito;
        $productosDestacados = Producto::where('destacado', true)->get();
        return view('prod', [
            'productos' => $productos,
            'productosDestacados' => $productosDestacados,
            'carrito' => $carrito
        ]);
    }
    public function index2()
    { $productos = Producto::all();
        $productosDestacados = Producto::where('destacado', true)->get();
        return view('editProducto',['productos'=>$productos,'productosDestacados' => $productosDestacados,]);
    }
    public function edit($id)
    {
        $product = Producto::findOrFail($id);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $product = Producto::findOrFail($id);
        $product->update($request->all());

        return response()->json(['success' => 'Producto actualizado correctamente']);
    }


}
