<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;
use Emporio\Model\Clientes;
use Emporio\Model\CatalogoServicios;
use Emporio\Model\CategoriaBitacoras;
use Emporio\Model\CategoriaEstatus;
use Emporio\User;
use Emporio\Model\Nomina;
use Emporio\Model\Control;
use Emporio\Model\EstadosCuenta;
use Emporio\Model\FacturasDetalles;
use Emporio\Model\Monedas;

class Servicios extends Model
{
    protected $table='servicios';

    protected $primaryKey='id';

    public function Clientes()
    {
        return $this->belongsTo('Emporio\Model\Clientes', 'id_cliente', 'id');
    }

    public function CatalogoServicios()
    {
        return $this->belongsTo('Emporio\Model\CatalogoServicios', 'id_catalogo_servicio', 'id');
    }

    public function CategoriaBitacoras()
    {
        return $this->belongsTo('Emporio\Model\CategoriaBitacoras', 'id_bitacoras', 'id');
    }

    public function CategoriaEstatus()
    {
        return $this->hasMany('Emporio\Model\CategoriaEstatus', 'id_bitacoras_estatus', 'id');
    }

    public function Control()
    {
        return $this->belongsTo('Emporio\Model\Control', 'id_control', 'id');
    }

    public function Admin()
    {
        return $this->belongsTo('Emporio\User', 'id_admin', 'id');
    }

    public function EstadosCuenta()
    {
        return $this->hasMany('Emporio\Model\EstadosCuenta', 'id_servicio', 'id');
    }

    public function Nomina()
    {
        return $this->hasMany('Emporio\Model\Nomina', 'id_servicio', 'id');
    }

    public function Monedas()
    {
        return $this->belongsTo('Emporio\Model\Monedas', 'moneda', 'clave');
    }

    protected $dates =
    [
        'created_at',
        'updated_at',
    ];

    protected $fillable =
    [
    	//Datos Generales
    	'tramite',
        'id_clase',
    	'concepto_costo',
        'moneda',
        'costo_servicio',
        'asignar_costo_servicio',
        'costo_pagado',
    	'costo_ini',
        'costo',
        'saldo',
    	'tipo_cambio',
    	//Datos de comision
    	'responsable_venta',
    	'responsable_operativo',
        'responsable_gestion',
        'concepto_venta',
        'concepto_operativo',
    	'concepto_gestion',
    	'comision_venta',
    	'comision_operativa',
    	'comision_gestion',
        'comision_venta_restante',
        'comision_operativa_restante',
        'comision_gestion_restante',
    	'aplica_comision_venta',
    	'aplica_comision_operativa',
    	'aplica_comision_gestion',
        'listo_comision_venta',
        'listo_comision_operativa',
        'listos_comision_gestion',
        /*'comision_venta_aplicada',
        'comision_operativa_aplicada',
        'comision_gestion_aplicada',*/
        'fecha_comision_venta',
        'fecha_comision_operativa',
        'fecha_comision_gestion',
        'mostrar_bitacora',
        'avance_total',
    	//Datos de bitacoras
    	'alta_control_archivar',
    	'alta_estatus',
    	'carta_poder',
    	'cobro',
    	'contrato',
    	'elaboracion_notificacion_agradecimiento',
    	'elaboracion_expediente',
    	'entrega_titulo_agradecimiento',
    	'envio_notificacion',
    	'envio_resultados',
    	'envio_expediente',
    	'escaneo',
    	'explicacion_comentarios',
    	'firma_fiel',
    	'formato',
    	'impresion',
    	'logo',
    	'logo_url',
    	'marca_lista_ingreso',
    	'pago',
    	'presentacion',
    	'recepcion_alta',
    	'registro',
    	'reglas_uso',
    	'respuesta_cliente',
    	'revision',
    	'pago_marca',
    	'validacion_marca',
    	'vencimiento_tramite',
    	'estatus_tramite',
    	'estatus_cobranza',
    	//Comentarios
    	'alta_control_archivar_comentarios',
    	'alta_estatus_comentarios',
    	'carta_poder_comentarios',
    	'cobro_comentarios',
    	'contrato',
    	'elaboracion_notificacion_agradecimiento_comentarios',
    	'elaboracion_expediente_comentarios',
    	'entrega_titulo_agradecimiento_comentarios',
    	'envio_notificacion_comentarios',
    	'envio_resultados_comentarios',
    	'envio_expediente_comentarios',
    	'escaneo_comentarios',
    	'explicacion_comentarios_comentarios',
    	'firma_fiel_comentarios',
    	'formato_comentarios',
    	'impresion_comentarios',
    	'logo_comentarios',
    	'marca_lista_ingreso_comentarios',
    	'pago_comentarios',
    	'presentacion_comentarios',
    	'recepcion_alta_comentarios',
    	'registro_comentarios',
    	'reglas_uso_comentarios',
    	'respuesta_cliente_comentarios',
    	'revision_comentarios',
    	'pago_marca_comentarios',
    	'validacion_marca_comentarios',
    	'vencimiento_tramite_comentarios',
    	'estatus_tramite_comentarios',
    	//Fechas Bitacora
    	'alta_control_archivar_fecha',
    	'alta_estatus_fecha',
    	'carta_poder_fecha',
    	'cobro_fecha',
    	'contrato_fecha',
    	'elaboracion_notificacion_agradecimiento_fecha',
    	'elaboracion_expediente_fecha',
    	'entrega_titulo_agradecimiento_fecha',
    	'envio_notificacion_fecha',
    	'envio_resultados_fecha',
    	'envio_expediente_fecha',
    	'escaneo_fecha',
    	'explicacion_comentarios_fecha',
    	'firma_fiel_fecha',
    	'formato_fecha',
    	'impresion_fecha',
    	'logo_fecha',
    	'marca_lista_ingreso_fecha',
    	'pago_fecha',
    	'presentacion_fecha',
    	'recepcion_alta_fecha',
    	'registro_fecha',
    	'reglas_uso_fecha',
    	'respuesta_cliente_fecha',
    	'revision_fecha',
    	'pago_marca_fecha',
    	'validacion_marca_fecha',
    	'vencimiento_tramite_fecha',
    	'estatus_tramite_fecha',
    	'estatus_cobranza_fecha',
    	
    	//ids
    	'id_cliente',
    	'id_control',
    	'id_catalogo_servicio',
    	'id_admin',
    	'id_bitacoras',
    	'id_bitacoras_estatus',
    ];
}
