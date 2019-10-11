<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;
use Emporio\Model\Clientes;
use Emporio\Model\RazonSocial;

class ClientesUser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'puesto', 'titulo', 'area', 'nombre', 'email', 'email2', 'email3', 'tipo', 'telefono', 'ext', 'tipo2', 'telefono2', 'ext2', 'tipo3', 'telefono3', 'ext3', 'estatus', 'id_cliente','contra', 'id_razon_social'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Clientes()
    {
        return $this->hasOne('Emporio\Model\Clientes', 'id', 'id_cliente');
    }

    public function RazonSocial()
    {
        return $this->hasOne('Emporio\Model\RazonSocial', 'id', 'id_razon_social');
    }
    protected $dates =[
        'created_at','updated_at',
    ];
}
