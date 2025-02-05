<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Receta;

class RecetaController extends Controller
{
    public function actualizarGuardados($id, Request $request)
    {
        $receta = Receta::findOrFail($id);
        $cantidad = $request->input('cantidad');
    
        $receta->guardados += $cantidad;
        $receta->save();
    
        return response()->json(['success' => true, 'guardados' => $receta->guardados]);
    }
}
