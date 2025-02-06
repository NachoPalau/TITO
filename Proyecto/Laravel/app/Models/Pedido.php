<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    // Atributos que se pueden rellenar masivamente
    protected $fillable = [
        'id_usuario',   // Relación con el usuario (cliente)
        'estado',       // Estado del pedido (ej: pendiente, enviado, entregado)
        'direccion',    // Dirección de envío
        'codigo_seguimiento', // Código de seguimiento generado para el pedido
    ];

    // Relación con el modelo Usuario (Cliente)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}

