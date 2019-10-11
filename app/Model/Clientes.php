<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;
use Emporio\Model\Estrategias;
use Emporio\Model\Control;
use Emporio\User;
use Emporio\Model\Servicios;
use Emporio\Model\EstadosCuenta;

class Clientes extends Model
{
    protected $table='clientes';

    protected $primaryKey='id';

    protected $fillable =
    [
        'nombre_comercial',
        'logo',
        'pagina_web',
        'carpeta',
        'comentarios',
        'estatus',
        'id_estrategia',
        'id_admin'
    ];

    protected $guarded =[

    ];

    protected $dates=[
        'created_at', 'updated_at'
    ];

    public function Estrategias()
    {
        return $this->hasOne('Emporio\Model\Estrategias', 'id', 'id_estrategia');
    }
    public function Admins()
    {
        return $this->hasOne('Emporio\User', 'id', 'id_admin');
    }
    public function Control()
    {
        return $this->hasMany('Emporio\Model\Control', 'id_cliente', 'id');
    }
    
    public function Servicios()
    {
        return $this->belongsTo('Emporio\Model\Servicios', 'id_cliente', 'id');
    }
    
    public function EstadosCuenta()
    {
        return $this->hasMany('Emporio\Model\EstadosCuenta', 'id_cliente', 'id');
    }

    public function setNombreComercialAttribute($value)
    {
        $this->attributes['nombre_comercial'] = strtoupper($value);
    }
}
