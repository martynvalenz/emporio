<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;

class FranquiciaCategorias extends Model
{
    protected $table='franquicia_categorias';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'categoria',
    	'estatus'
    ];

    protected $guarded =[

    ];
}
