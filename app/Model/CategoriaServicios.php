<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;
use Emporio\Model\CatalogoServicios;

class CategoriaServicios extends Model
{
    protected $table='categoria_servicios';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'categoria',
    	'descripcion',
    	'estatus'
    ];

    protected $guarded =[

    ];

    public function Monedas()
    {
        return $this->hasOne('Emporio\Model\Monedas', 'moneda', 'clave');
    }
}
