<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    
    protected $table = 'productos';

    protected $hidden = ['stock']; 
    protected $fillable = ['nombre', 'precio', 'descripcion','imagen_url','destacado']; 
}
