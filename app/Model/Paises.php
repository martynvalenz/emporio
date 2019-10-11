<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;

class Paises extends Model
{
    protected $table='paises';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'pais',
    	'estatus'
    ];

    protected $guarded =[

    ];
}
