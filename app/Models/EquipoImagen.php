<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipoImagen extends Model
{
    protected $table = 'equipo_imagen';
    
    protected $fillable = [
        'equipo_id',
        'imagen_id'
    ];
}