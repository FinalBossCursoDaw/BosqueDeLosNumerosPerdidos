<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fecha extends Model
{
    protected $table = 'Fechas';
    protected $primaryKey = 'fecha';
    public $incrementing = false;
    protected $keyType = 'date';
    public $timestamps = false;
    
    protected $fillable = ['fecha'];
}
