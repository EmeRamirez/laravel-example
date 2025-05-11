<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InfoContacto extends Model
{
    use HasFactory;
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