<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;

class Colores extends Model
{
    protected $table='listado_estatus';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'estatus', 'id_bitacoras_estatus', 'activo', 'color', 'texto'
    ];
}
