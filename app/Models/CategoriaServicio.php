<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoriaServicio extends Model
{
    use HasFactory;
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
