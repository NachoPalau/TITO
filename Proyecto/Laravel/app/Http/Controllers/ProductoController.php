<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Receta;

class ProductoController extends Controller
{
    public function index()
    { $productos = Producto::all();
        $recetas = Receta::all();
    
        return view('prueba', [
            'productos' => $productos,
            'recetas' => $recetas
        ]);  
    }

}
