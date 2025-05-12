<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Historia extends Model
{
    use HasFactory;
    protected $table = 'historia';
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
        return $this->belongsToMany(Imagen::class, 'historia_imagen')
                   ->withTimestamps();
    }
}