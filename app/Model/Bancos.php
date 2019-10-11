<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;
use Emporio\Cuentas;

class Bancos extends Model
{
    protected $table='bancos';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'banco',
        'estatus'
    ];

    protected $guarded =[

    ];

    public function Admins()
    {
        return $this->belongsTo('Emporio\Model\Cuentas', 'id_banco', 'id');
    }
}
