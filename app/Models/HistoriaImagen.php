<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriaImagen extends Model
{
    protected $table = 'historia_imagen';
    
    protected $fillable = [
        'historia_id',
        'imagen_id'
    ];
}