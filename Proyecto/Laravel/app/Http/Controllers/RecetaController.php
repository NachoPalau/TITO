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

public function index()
{ 
    $recetas = Receta::all();
    $recetasMas = Receta::orderByDesc('guardados')->take(5)->get();
    return view('recetas', [
        'recetas' => $recetas,
        'recetasMas' => $recetasMas

    ]);  
   
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
        
        // Eliminar relaciones si es necesario
        $receta->ingredientes()->delete();
        
        // Luego eliminar la receta
        $receta->delete();
    
        return redirect()->route('misrecetas')->response()->json(['success' => 'Receta eliminada correctamente']);
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
