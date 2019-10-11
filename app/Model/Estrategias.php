<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;
use Emporio\Model\Clientes;

class Estrategias extends Model
{
    protected $table='estrategias';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'estrategia',
    	'estatus'
    ];

    protected $guarded =[

    ];

    public function Admins()
    {
        return $this->hasMany('Emporio\Model\Clientes', 'id_estrategia', 'id');
    }
}
