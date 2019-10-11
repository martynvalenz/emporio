<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    protected $table='estados';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'estado',
    	'pais',
    	'estatus'
    ];

    protected $guarded =[

    ];
}
