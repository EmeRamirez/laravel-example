<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoContacto extends Model
{
    protected $table = 'info_contacto';
    
    protected $fillable = [
        'nombre',
        'texto',
        'texto_adicional',
        'activo'
    ];
    
    protected $casts = [
        'activo' => 'boolean'
    ];
}