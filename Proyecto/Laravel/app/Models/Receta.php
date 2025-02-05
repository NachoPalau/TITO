<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;
    
    protected $table = 'recetas';

    protected $fillable = ['titulo', 'id_usuario', 'descripcion','ingredientes','guardados'];
    public static function getUserNameById($id)
{
    $usuario = User::find($id);
    return $usuario ? $usuario->name : null;
}
public function usuario()
{
    return $this->belongsTo(User::class, 'id_usuario');
}
public function usuariosQueGuardaron()
{
    return $this->belongsToMany(User::class, 'receta_user')->withTimestamps();
}
}
