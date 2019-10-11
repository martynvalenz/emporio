<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;

class Emporio extends Model
{
    protected $table='emporio';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'nombre_comercial',
    	'razon_social',
    	'rfc',
    	'calle',
    	'numero',
    	'numero_int',
    	'colonia',
    	'cp',
    	'localidad',
    	'municipio',
    	'estado',
    	'pais',
    	'logo',
    	'telefono',
    	'telefono2',
    	'telefono3',
    	'pagina_web',
    ];

    protected $guarded =[

    ];

    public function setRazonSocialAttribute($value)
    {
        $this->attributes['razon_social'] = strtoupper($value);
    }
    public function setRfcAttribute($value)
    {
        $this->attributes['rfc'] = strtoupper($value);
    }
}
