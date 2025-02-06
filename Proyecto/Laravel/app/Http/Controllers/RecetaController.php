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

    // Obtener las recetas favoritas actuales
    $favoritas = json_decode($usuario->favoritas, true);

    // Verificar si la receta ya está en favoritos
    if (!in_array($recetaId, $favoritas)) {
        $favoritas[] = $recetaId;
    }

    // Guardar las recetas favoritas actualizadas
    $usuario->favoritas = json_encode($favoritas);
    $usuario->save();

    return redirect()->back();
}
// RecetaController.php

public function eliminarDeFavoritos($recetaId)
{
    $usuario = auth()->user();

    // Obtener las recetas favoritas actuales
    $favoritas = json_decode($usuario->favoritas, true);

    // Eliminar la receta de la lista de favoritos
    $favoritas = array_filter($favoritas, function ($id) use ($recetaId) {
        return $id != $recetaId;
    });

    // Reindexar el array
    $favoritas = array_values($favoritas);

    // Guardar las recetas favoritas actualizadas
    $usuario->favoritas = json_encode($favoritas);
    $usuario->save();

    return redirect()->back();
}


}
