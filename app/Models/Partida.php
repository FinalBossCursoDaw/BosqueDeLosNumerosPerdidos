<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    protected $table = 'Partidas';
    protected $primaryKey = 'id_partida';
    public $timestamps = false;
    
    protected $fillable = [
        'id_usuario',
        'id_juego',
        'fecha',
        'id_sesion',
        'puntuacion',
        'tiempo_seg'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }

    public function juego()
    {
        return $this->belongsTo(Juego::class, 'id_juego');
    }

    public function sesion()
    {
        return $this->belongsTo(Sesion::class, 'id_sesion');
    }
}
