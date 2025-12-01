<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    protected $table = 'Sesiones';
    protected $primaryKey = 'id_sesion';
    public $timestamps = false;
    
    protected $fillable = ['id_usuario', 'date_time', 'hora'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }

    public function partida()
    {
        return $this->hasOne(Partida::class, 'id_sesion');
    }
}
