<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaServicio extends Model
{
    protected $table = 'categoria_servicio';
    
    protected $fillable = [
        'nombre',
        'imagen',
        'texto',
        'activo'
    ];
    
    protected $casts = [
        'activo' => 'boolean'
    ];
}