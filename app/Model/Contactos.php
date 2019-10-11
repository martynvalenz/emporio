<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;

class Contactos extends Model
{
    protected $table='clientes_users';

    protected $primaryKey='id';

    // protected $fillable =
    // [
    //     'clave',
    //     'clase',
    //     'descripcion',
    //     'estatus'
    // ];

    protected $guarded =[

    ];
}
