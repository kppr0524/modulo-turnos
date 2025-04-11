<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $table = 'registros_turnos';

    protected $fillable = ['fecha', 'maquina', 'proyecto', 'turno_id'];

    public function turno()
    {
        return $this->belongsTo(Turno::class);
    }
}
