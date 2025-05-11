<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MantenimientoInfo extends Model
{
    use HasFactory;
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