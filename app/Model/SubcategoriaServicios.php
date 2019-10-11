<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;

class SubcategoriaServicios extends Model
{
    protected $table='subcategoria_servicios';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'subcategoria',
    	'id_categoria',
        'renovacion',
        'vencimiento',
        'recordatorio',
        'comprobacion_uso',
    	'estatus'
    ];
}
