<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;
use Emporio\User;
use Emporio\Model\Estados;
use Emporio\Model\Paises;
use Emporio\Model\EstadosCuenta;

class Proveedores extends Model
{
    protected $table='proveedores';

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
        'id_estado',
        'id_pais',
        'contacto',
        'telefono',
        'telefono2',
        'correo',
        'comentarios',
        'estatus',
        'id_estado',
        'id_admin',
        'id_pais'
    ];

    protected $guarded =[

    ];

    public function Admins()
    {
        return $this->hasOne('Emporio\User', 'id', 'id_admin');
    }
    public function Estados()
    {
        return $this->hasOne('Emporio\Model\Estados', 'id', 'id_estado');
    }
    public function Paises()
    {
        return $this->hasOne('Emporio\Model\Paises', 'id', 'id_pais');
    }
    public function setNombreComercialAttribute($value)
    {
        $this->attributes['nombre_comercial'] = strtoupper($value);
    }
    public function setRazonSocialAttribute($value)
    {
        $this->attributes['razon_social'] = strtoupper($value);
    }
    public function setRfcAttribute($value)
    {
        $this->attributes['rfc'] = strtoupper($value);
    }

    public function EstadosCuenta()
    {
        return $this->hasMany('Emporio\Model\EstadosCuenta', 'id_proveedor', 'id');
    }
}
