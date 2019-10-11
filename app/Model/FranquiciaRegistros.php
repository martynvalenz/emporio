<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;

class FranquiciaRegistros extends Model
{
    protected $table='registro_franquicias';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'nombre',
    	'correo',
    	'telefono',
    	'mensaje',
    	'leido',
    	'id_franquicia',
    ];
}
