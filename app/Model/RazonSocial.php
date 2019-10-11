<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;
use Emporio\User;
use Emporio\Model\Estados;
use Emporio\Model\Paises;
use Emporio\Model\Clientes;

class RazonSocial extends Model
{
    protected $table='razones_sociales';

    protected $primaryKey='id';

    protected $fillable =
    [
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
        'telefono',
        'correo',
        'subcarpeta',
        'comentarios',
        'estatus',
        'id_estado',
        'id_admin',
        'id_cliente',
        'id_pais'
    ];

    protected $guarded =[

    ];

    public function Clientes()
    {
        return $this->hasOne('Emporio\Model\Clientes', 'id', 'id_cliente');
    }
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
    public function setRazonSocialAttribute($value)
    {
        $this->attributes['razon_social'] = strtoupper($value);
    }
    public function setRfcAttribute($value)
    {
        $this->attributes['rfc'] = strtoupper($value);
    }
}
