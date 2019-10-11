<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;

class Metas extends Model
{
    protected $table='metas';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'anio', 'estatus', 'historico', 'servicios', 'ingresos', 'egresos'
    ];
}
