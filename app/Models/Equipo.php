<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Equipo extends Model
{
    protected $table = 'equipo';
    
    protected $fillable = [
        'tipo',
        'texto',
        'activo'
    ];
    
    protected $casts = [
        'activo' => 'boolean'
    ];
    
    public function imagenes(): BelongsToMany
    {
        return $this->belongsToMany(Imagen::class, 'equipo_imagen')
                   ->withTimestamps();
    }
}