<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MantenimientoInfo extends Model
{
    protected $table = 'mantenimiento_info';
    
    protected $fillable = [
        'nombre',
        'texto',
        'activo'
    ];
    
    protected $casts = [
        'activo' => 'boolean'
    ];
}