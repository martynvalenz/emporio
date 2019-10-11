<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;

class ListadoEstatus extends Model
{
    protected $table='listado_estatus';

    protected $primaryKey='id';

    public function Estatus()
    {
        return $this->belongsTo('Emporio\Estatus', 'estatus', 'estatus');
    }

    protected $dates =
    [
        'created_at',
        'updated_at',
    ];

    protected $fillable =
    [
    	'estatus',
    	'uso',
        'activo',
    	'color',
        'texto'
    ];
}
