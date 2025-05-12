<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Imagen extends Model
{
    use HasFactory;
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