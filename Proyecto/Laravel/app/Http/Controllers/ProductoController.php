<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Producto;

class ProductoController extends Controller
{
    public function index()
    { $productos = Producto::all();
        $user = auth()->user();
        $carrito = $user ? $user->carrito : [];
        $productosDestacados = Producto::where('destacado', true)->get();
        return view('prod', [
            'productos' => $productos,
            'productosDestacados' => $productosDestacados,
            'carrito' => $carrito
        ]);
    }
    public function arraysEventos(){ 
        $productos = Producto::all();
            $array1 = Producto::whereIn('imagen_url', ['bombones_mym.jpg', 'corazon_kinder.jpg', 'ramo_rosas.jpg'])->get();
            $array2 = Producto::whereIn('imagen_url', ['taza_sanvalentin.jpg', 'pack_sanvalentin.jpg', 'corazon_lindor.jpg'])->get();
            
            return view('eventos',['array1'=>$array1,'array2' => $array2]);
    }
    public function index2()
    { $productos = Producto::all();
        $productosDestacados = Producto::where('destacado', true)->get();
        return view('editProducto',['productos'=>$productos,'productosDestacados' => $productosDestacados,]);
    }
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return response()->json($producto);
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
