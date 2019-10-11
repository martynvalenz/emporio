<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;

class ServiciosComentarios extends Model
{
    protected $table='servicios_comentarios';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'comentario',
    	'id_servicio',
    	'id_admin',
    	'id_control'
    ];

    protected $guarded =[

    ];
}
