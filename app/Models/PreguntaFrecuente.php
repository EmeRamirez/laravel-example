<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreguntaFrecuente extends Model
{
    protected $table = 'pregunta_frecuente';
    
    protected $fillable = [
        'pregunta',
        'respuesta',
        'activo'
    ];
    
    protected $casts = [
        'activo' => 'boolean'
    ];
}