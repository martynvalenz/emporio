<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;
use Emporio\Model\CatalogoServicios;

class CategoriaBitacoras extends Model
{
    protected $table='categoria_bitacoras';

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
        return $this->belongsTo('Emporio\Model\CatalogoServicios', 'id_categoria_bitacora', 'id');
    }
}
