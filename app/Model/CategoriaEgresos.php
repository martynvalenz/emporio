<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;
use Emporio\Model\EstadosCuenta;

class CategoriaEgresos extends Model
{
    protected $table='categoria_egresos';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'clasificacion',
    	'cuenta',
    	'subcuenta',
    	'categoria',
    	'estatus'
    ];

    protected $guarded =[

    ];

    public function EstadosCuenta()
    {
        return $this->hasMany('Emporio\Model\EstadosCuenta', 'id_categoria', 'id');
    }
}
