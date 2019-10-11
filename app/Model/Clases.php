<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;

class Clases extends Model
{
    protected $table='clases';

    protected $primaryKey='id';

    protected $fillable =
    [
        'clave',
        'clase',
        'descripcion',
        'estatus'
    ];

    protected $guarded =[

    ];
}
