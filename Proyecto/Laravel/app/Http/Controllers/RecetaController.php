<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Receta;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

class RecetaController extends Controller
{
public function agregarAFavoritos($recetaId)
{
    $usuario = auth()->user();

    $favoritas = json_decode($usuario->favoritas, true);

    if (!in_array($recetaId, $favoritas)) {
        $favoritas[] = $recetaId;
    }

  
    $usuario->favoritas = json_encode($favoritas);
    $usuario->save();

    return redirect()->back();
}

public function eliminarDeFavoritos($recetaId)
{
    $usuario = auth()->user();

    $favoritas = json_decode($usuario->favoritas, true);

   
    $favoritas = array_filter($favoritas, function ($id) use ($recetaId) {
        return $id != $recetaId;
    });


    $favoritas = array_values($favoritas);


    $usuario->favoritas = json_encode($favoritas);
    $usuario->save();

    return redirect()->back();
}


}
