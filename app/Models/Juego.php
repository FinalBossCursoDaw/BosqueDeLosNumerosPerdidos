<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Juego extends Model
{
    protected $table = 'Juegos';
    protected $primaryKey = 'id_juego';
    public $timestamps = false;
    
    protected $fillable = ['nombre', 'descripcion'];

    public function partidas()
    {
        return $this->hasMany(Partida::class, 'id_juego');
    }
}
