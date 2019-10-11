<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;

class Requisitos extends Model
{
    protected $table='requisitos';

    protected $primaryKey='id';

    protected $fillable = [
        'categoria', 'nombre', 'estatus'
    ];
}
