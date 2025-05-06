<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Imagen extends Model
{
    protected $table = 'imagen';
    
    protected $fillable = [
        'nombre',
        'imagen',
        'activo'
    ];
    
    protected $casts = [
        'activo' => 'boolean'
    ];
    
    public function historias(): BelongsToMany
    {
        return $this->belongsToMany(Historia::class, 'historia_imagen')
                   ->withTimestamps();
    }
    
    public function equipos(): BelongsToMany
    {
        return $this->belongsToMany(Equipo::class, 'equipo_imagen')
                   ->withTimestamps();
    }
}