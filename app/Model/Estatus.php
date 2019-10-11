<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;
use Emporio\Model\Clientes;
use Emporio\Model\CategoriaEstatus;
use Emporio\User;
use Emporio\Model\ListadoEstatus;
use Emporio\Model\Control;

class Estatus extends Model
{
    protected $table='bitacoras_estatus';

    protected $primaryKey='id';

    public function Clientes()
    {
        return $this->belongsTo('Emporio\Model\Clientes', 'id_cliente', 'id');
    }

    public function CategoriaEstatus()
    {
        return $this->belongsTo('Emporio\Model\CategoriaEstatus', 'id_bitacoras_estatus', 'id');
    }

    public function Control()
    {
        return $this->belongsTo('Emporio\Model\Control', 'id_control', 'id');
    }

    public function Admin()
    {
        return $this->belongsTo('Emporio\User', 'id_admin', 'id');
    }

    public function ListadoEstatus()
    {
        return $this->hasOne('Emporio\Model\ListadoEstatus', 'estatus', 'estatus');
    }

    protected $dates =
    [
        'created_at',
        'updated_at',
    ];

    protected $fillable =
    [
    	//Estatus
    	'folio_estatus',
    	'numero_expediente',
    	'expediente_url',
    	'numero_registro_reserva',
    	'registro_url',
    	'numero_tramite',
    	'tramite_url',
    	'patente',
    	'marca',
    	'nombre',
    	'pc',
    	'estatus_status',
    	'tipo_tramite',
    	'carpeta',
    	'carpeta_url',
    	'codigo_barras',
    	'representante',
    	'fecha_inicio',
    	'fecha_vencimiento',
    	'fecha_anualidad',
    	'observaciones',
    	//ids
    	'id_cliente',
    	'id_razon_social',
    	'id_control',
    	'id_servicio',
    	'id_admin',
    	'id_bitacoras_estatus',
    ];
}
