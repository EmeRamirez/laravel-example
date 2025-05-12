<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PreguntaFrecuente extends Model
{
    use HasFactory;
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