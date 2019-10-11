<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;
use Emporio\Model\CategoriaServicios;
use Emporio\Model\CategoriaEstatus;
use Emporio\Model\CategoriaBitacoras;
use Emporio\Model\Monedas;

class CatalogoServicios extends Model
{
    protected $table='catalogo_servicios';

    protected $primaryKey='id';

    protected $fillable =
    [
        'clave',
        'servicio',
        'comentarios',
        'concepto',
        'moneda',
        'costo',
        'costo_servicio',
        'honorarios',
        'utilidad',
        'porcentaje_utilidad',
        'comision_venta',
        'comision_venta_monto',
        'porcentaje_venta',
        'comision_operativa',
        'comision_operativa_monto',
        'porcentaje_operativa',
        'comision_gestion',
        'comision_gestion_monto',
        'porcentaje_gestion',
        'avance_total',
        'procedimiento',
        'diagrama',
        'estatus',
        'id_categoria_servicios',
        'id_subcategoria',
        'id_categoria_bitacora',
        'id_categoria_estatus'
    ];

    protected $guarded =[

    ];

    public function CategoriaServicios()
    {
        return $this->hasOne('Emporio\Model\CategoriaServicios', 'id', 'id_categoria_servicios');
    }

    public function CategoriaEstatus()
    {
        return $this->hasOne('Emporio\Model\CategoriaEstatus', 'id', 'id_categoria_estatus');
    }

    public function CategoriaBitacoras()
    {
        return $this->hasOne('Emporio\Model\CategoriaBitacoras', 'id', 'id_categoria_bitacora');
    }

    public function Monedas()
    {
        return $this->hasOne('Emporio\Model\Monedas', 'clave', 'moneda');
    }
    
    // public function setClaveAttribute($value)
    // {
    //     $this->attributes['clave'] = strtoupper($value);
    // }
}
