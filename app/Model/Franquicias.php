<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;

class Franquicias extends Model
{
    protected $table='franquicias';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'franquicia',
        'logo',
        'nosotros',
    	'resumen',
    	'mision',
        'vision',
    	'historia',
    	'cuota_inicial',
    	'adaptacion_local',
    	'regalias',
    	'publicidad',
    	'publicidad_institucional',
    	'capital_trabajo',
        'inversion',
    	'retorno_inversion',
    	'utilidad',
    	'contrato',
        'inicio_operaciones',
    	'punto_equilibrio',
    	'procedencia',
    	'estatus',
        'id_categoria'
    ];

    public function setFranquiciaAttribute($value)
    {
        $this->attributes['franquicia'] = strtoupper($value);
    }
}
