<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    protected $table = 'Sesiones';
    protected $primaryKey = 'id_sesion';
    public $timestamps = false;
    
    protected $fillable = [
        'level_reached',
        'n_attemps',
        'errors',
        'date_time',
        'helps_clicks'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }

    public function partida()
    {
        return $this->hasOne(Partida::class, 'id_sesion');
    }
}
