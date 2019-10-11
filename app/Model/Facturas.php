<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;
use Emporio\Model\Clientes;
use Emporio\User;
use Emporio\Model\RazonSocial;
use Emporio\Model\FacturasDetalles;

class Facturas extends Model
{
    protected $table='facturas';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'tipo',
    	'folio_factura',
    	'folio_recibo',
    	'folio_fiscal',
    	'razon_social',
    	'fecha',
        'rfc',
        'calle',
        'numero',
        'numero_int',
        'colonia',
        'cp',
        'localidad',
        'municipio',
        'estado',
        'pais',
        'fecha_pagada',
        'subtotal',
        'porcentaje_iva',
        'iva',
        'total',
        'pagado',
        'pagado_terminado',
        'saldo',
        'comentarios',
    	'estatus',
    	'id_cliente',
    	'id_razon_social',
    	'id_admin'
    ];

    protected $guarded =[

    ];

    public function Admin()
    {
        return $this->hasOne('Emporio\User', 'id_admin', 'id');
    }

    public function Clientes()
    {
        return $this->hasOne('Emporio\Model\Clientes', 'id_cliente', 'id');
    }

    public function RazonSocial()
    {
        return $this->hasOne('Emporio\Model\RazonSocial', 'id_razon_social', 'id');
    }

    public function FacturasDetalles()
    {
        return $this->belongsToMany('Emporio\Model\FacturasDetalles', 'id', 'id_factura');
    }

    public function CobranzaDetalles()
    {
        return $this->belongsToMany('Emporio\Model\CobranzaDetalles', 'id', 'id_factura');
    }
}
