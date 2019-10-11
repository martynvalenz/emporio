<?php

namespace Emporio;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Emporio\Modal\Estados;
use Emporio\Modal\Paises;
use Emporio\Modal\Servicios;
use Emporio\Modal\Control;
use Emporio\Modal\Nomina;
use Emporio\Modal\RoleModel;

class User extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = 
    [
        'iniciales', 
        'nombre', 
        'apellido', 
        'usuario', 
        'email', 
        'contra',
        'rfc',
        'imss',
        'calle',
        'numero',
        'numero_int',
        'colonia',
        'cp',
        'localidad',
        'municipio',
        'estado',
        'acepta_comision',
        'responsabilidad',
        'nomina',
        'pais',
        'telefono',
        'celular',
        'oficina',
        'comentarios',
        'imagen', 
        'estatus',
        'sueldo_diario',
        'sueldo_quincenal',
        'id_pais',
        'id_estado'
    ];

    protected $hidden = 
    [
        'password', 'remember_token',
    ];

    public function Servicios()
    {
        return $this->belongsTo('Emporio\Modal\Servicios', 'id_admin', 'id');
    }
    
    public function setRfcAttribute($value)
    {
        $this->attributes['rfc'] = strtoupper($value);
    }

    public function setInicialesAttribute($value)
    {
        $this->attributes['iniciales'] = strtoupper($value);
    }

    public function Estados()
    {
        return $this->hasOne('Emporio\Modal\Estados', 'id', 'id_estado');
    }
    public function Paises()
    {
        return $this->hasOne('Emporio\Modal\Paises', 'id', 'id_pais');
    }

    public function Control()
    {
        return $this->belongsTo('Emporio\Modal\Control', 'id_admin', 'id');
    }

    public function Nomina()
    {
        return $this->hasMany('Emporio\Modal\Nomina', 'id_admin', 'id');
    }

    public function Role()
    {
        return $this->belongsTo('Emporio\Model\RoleModel', 'id', 'user_id');
    }
}
