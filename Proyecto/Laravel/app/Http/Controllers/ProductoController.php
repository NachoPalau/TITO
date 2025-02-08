<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Receta;

class ProductoController extends Controller
{
    public function index()
    { $productos = Producto::all();
        $recetas = Receta::all();
        $productosDestacados = Producto::where('destacado', true)->get();
        // return view('prueba', [
        //     'productos' => $productos,
        //     'recetas' => $recetas
        // ]);  
        return view('prod',['productos'=>$productos,'productosDestacados' => $productosDestacados,]);
    }
    


}
