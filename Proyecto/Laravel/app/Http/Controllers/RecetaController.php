<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Receta;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

class RecetaController extends Controller
{

    
    public function guardarFavoritos(Request $request)
    {
        // 1. Obtener el usuario autenticado
        $user = Auth::user();
    
        // 2. Validar que el usuario esté autenticado
        if (!$user) {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }
    
        // 3. Obtener el array o JSON de favoritos
        $favoritos = $request->input('favoritos');
    
        // 4. Validar que se haya enviado el array o JSON
        if (!$favoritos) {
            return response()->json(['error' => 'No se enviaron favoritos'], 400);
        }
    
        // 5. Convertir a array si es JSON
        if (is_string($favoritos)) {
            $favoritos = json_decode($favoritos, true);
        }
    
        // 6. Validar que sea un array
        if (!is_array($favoritos)) {
            return response()->json(['error' => 'Formato de favoritos incorrecto'], 400);
        }
    
        // 7. Guardar los favoritos en la base de datos
        $user->favoritas = json_encode($favoritos);
        $user->save(); 
        // 1. Obtener todas las recetas
    $recetas = Receta::all();

    // 2. Recorrer las recetas
    foreach ($recetas as $receta) {
        // 3. Contar cuántas veces aparece el ID de esta receta en la columna "favoritas" de todos los usuarios
        $conteo = User::whereRaw('JSON_CONTAINS(favoritas, \''.$receta->id.'\')')->count();

        // 4. Actualizar la columna "guardados" de la receta
        $receta->guardados = $conteo;
        $receta->save();
    }
    
        // 8. Devolver una respuesta exitosa
        return response()->json(['message' => 'Favoritos guardados correctamente'], 200);
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

public function index()
{
    $recetas = Receta::all();
    $recetasMas = Receta::orderByDesc('guardados')->take(5)->get();
    $user = auth()->user();
    $favoritas = auth()->check() ? $user->favoritas : [];

    foreach ($recetas as $receta) {
        $precioReceta = 0;
        $ingredientesArray = json_decode($receta->id_ingredientes, true);
        $receta->nombres_productos = $this->obtenerNombresProductos($ingredientesArray);
        $receta->precio_total = $this->calcularPrecioTotal($ingredientesArray);
    }
    foreach ($recetasMas as $receta) {
        $precioReceta = 0;
        $ingredientesArray = json_decode($receta->id_ingredientes, true);
        $receta->nombres_productos = $this->obtenerNombresProductos($ingredientesArray);
        $receta->precio_total = $this->calcularPrecioTotal($ingredientesArray);
    }

    return view('recetas', compact('recetas', 'recetasMas', 'favoritas'));
}
public function index5()
{
    $recetas = Receta::all();
    $recetasMas = Receta::orderByDesc('guardados')->take(5)->get();
    $user = auth()->user();
    $favoritas = $user ? $user->favoritas : [];

    foreach ($recetas as $receta) {
        $precioReceta = 0;
        $ingredientesArray = json_decode($receta->id_ingredientes, true);
        $receta->nombres_productos = $this->obtenerNombresProductos($ingredientesArray);
        $receta->precio_total = $this->calcularPrecioTotal($ingredientesArray);
    }
    foreach ($recetasMas as $receta) {
        $precioReceta = 0;
        $ingredientesArray = json_decode($receta->id_ingredientes, true);
        $receta->nombres_productos = $this->obtenerNombresProductos($ingredientesArray);
        $receta->precio_total = $this->calcularPrecioTotal($ingredientesArray);
    }

    return view('index', compact('recetas', 'recetasMas', 'favoritas'));
}

private function calcularPrecioTotal($ingredientesArray) {
    $precioTotal = 0;

    if (is_array($ingredientesArray)) {
        foreach ($ingredientesArray as $id_producto) {
            if (is_numeric($id_producto)) {
                $id_producto = intval($id_producto);
                $producto = Producto::find($id_producto);

                if ($producto) {
                    $precioTotal += $producto->precio;
                }
            }
        }
    }

    return $precioTotal;
}

private function obtenerNombresProductos($ingredientesArray, &$precioTotal = 0) {
    $nombresProductos = [];

    if (is_array($ingredientesArray)) {
        foreach ($ingredientesArray as $id_producto) {
            if (is_numeric($id_producto)) {
                $id_producto = intval($id_producto);
                $producto = Producto::find($id_producto);

                if ($producto) {
                    $nombresProductos[] = $producto->nombre;
                } else {
                    $nombresProductos[] = "Producto no encontrado (ID: " . $id_producto . ")";
                }
            } else {
                $nombresProductos[] = $id_producto;
            }
        }
    }

    return $nombresProductos;
}
public function index2()
{ 
    $productos = Producto::all();
    return view('newReceta', [
        'productos' => $productos,

    ]);  
   
}
public function index3()
{ 
    $user = Auth::user();
    $recetas = Receta::where('id_usuario', $user->id)->get();

    return view('miReceta', compact('recetas')); 
   
}
public function create()
    {
        return view('newReceta'); 
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'ingredientes' => 'required|string',
            'guardados' => 'boolean',
        ]);
    
        $usuario = Auth::user();
    
     
        $receta = Receta::create([
            'titulo' => $validated['titulo'],
            'descripcion' => $validated['descripcion'],
            'ingredientes' => $validated['ingredientes'],
            'guardados' => $request->has('guardados') ? 1 : 0, 
            'id_usuario' => $usuario->id,
        ]);
    
        
        $favoritas = json_decode($usuario->favoritas, true) ?? []; 
        if (!in_array($receta->id, $favoritas)) {
            $favoritas[] = $receta->id; 
            $usuario->favoritas = json_encode($favoritas); 
            $usuario->save(); 
        }
    
        return redirect()->route('misrecetas')->with('success', 'Receta creada y añadida a favoritas con éxito');
    }
    public function destroy($id)
    {
        $receta = Receta::findOrFail($id);
    
        // Eliminar relaciones si es necesario (si hay alguna relación a eliminar, por ejemplo, ingredientes)
        // Si no tienes una relación directa con ingredientes, puedes omitir esto.
        // $receta->ingredientes()->delete();
    
        // Eliminar la receta
        $receta->delete();
    
        // Responder con un JSON indicando que la receta fue eliminada correctamente
        return response()->json(['success' => 'Receta eliminada correctamente']);
    }
    
public function edit($id)
{
    $receta = Receta::findOrFail($id);
    $productos=Producto::all();
    return view('recetaEdit', compact('receta', 'productos'));
}
public function update(Request $request, $id)
{
    $validated = $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string|max:255',
        'ingredientes' => 'required|string',
        'guardados' => 'boolean',
    ]);

    $usuario = Auth::user();
    $receta = Receta::findOrFail($id);

    // Actualizar receta
    $receta->update([
        'titulo' => $validated['titulo'],
        'descripcion' => $validated['descripcion'],
        'ingredientes' => $validated['ingredientes'],
        'guardados' => $request->has('guardados') ? 1 : 0,
    ]);

    // Manejo de favoritos
    $favoritas = json_decode($usuario->favoritas, true) ?? [];

    if ($request->has('guardados')) {
        if (!in_array($receta->id, $favoritas)) {
            $favoritas[] = $receta->id;
        }
    } else {
        $favoritas = array_filter($favoritas, fn($fav) => $fav != $receta->id);
    }

    $usuario->favoritas = json_encode(array_values($favoritas));
    $usuario->save();

    return redirect()->route('misrecetas')->with('success', 'Receta actualizada correctamente');
}

}
