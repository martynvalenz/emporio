<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;
use Emporio\Model\CatalogoServicios;
use Emporio\Model\Servicios;

class CategoriaEstatus extends Model
{
    protected $table='categoria_estatus';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'clave',
    	'bitacora',
    	'estatus'
    ];

    protected $guarded =[

    ];

    public function CatalogoServicios()
    {
        return $this->belongsTo('Emporio\Model\CatalogoServicios', 'id_categoria_estatus', 'id');
    }

    public function Servicios()
    {
        return $this->belongsTo('Emporio\Model\Servicios', 'id_bitacoras_estatus', 'id');
    }
}
